# set_file_hidden
Sets file hidden flag

URL: `https://storage.buttex.ru/api/storage/set_file_hidden`\
Method: **GET**\
Access level: **USER**

## Query
| Parameter | Type   | Required | Description       |
|-----------|--------|----------|-------------------|
| file_id   | Int    | Yes      | File id           |
| hidden    | Int    | Yes      | Hidden flag       |

## Returns
This method does not returns any values.

> ### Remarks
> The `hidden` parameter should be `1` or `0`, wich means the file is hidden or not respectively.
> Hidden files and directories are only shown to it's owners or admins.
> If user is not owner of the file, then at least **ADMIN** access level
> is required for this method (see [permission system](../../users/permission-system.md)).