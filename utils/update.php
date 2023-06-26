<?php 
require_once "config.php";
require_once "database.php";
require_once "filesystem.php";

//------------------------------

$files = Database::get_table("
        SELECT 
            files.id as `id`,
            filesystem_entries.name as `name`
        FROM 
            filesystem_entries
            LEFT JOIN files
            ON files.filesystem_entry_id = filesystem_entries.id
        WHERE
            files.lifetime IS NOT NULL
            AND (UNIX_TIMESTAMP(filesystem_entries.creation_time) + files.lifetime) < UNIX_TIMESTAMP(CURRENT_TIMESTAMP())
    "
);

if (empty($files)) {
    echo "Expired files not found\n";
    die;
}

foreach ($files as $file) {
    echo "Deleting '$file[name]' (id $file[id])...\n";
    Filesystem::delete_file($file["id"]);
}

echo "Deleted " . count($files) . " files\n";

//------------------------------