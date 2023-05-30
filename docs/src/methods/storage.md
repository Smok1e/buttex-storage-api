# Storage methods

Base URL: **https://storage.buttex.ru/api/methods/storage/**

Storage methods allows client to interact with files and directories in storage:
upload files, create directories, resolve paths, etc.

| Method                                              | Description                                                         |
|-----------------------------------------------------|---------------------------------------------------------------------|
| [create_file](storage/create_file.md)               | Uploads file to storage                                             |
| [create_directory](storage/create_directory.md)     | Creates new directory                                               |
| [delete_file](storage/delete_file.md)               | Deletes file                                                        |
| [delete_directory](storage/delete_directory.md)     | Deletes directory recirsively                                       |
| [get_files_list](storage/get_files_list.md)         | Returns list of files and directories under the specified directory |
| [get_file_content](storage/get_file_content.md)     | Returns file content by the given path                              |
| [get_file_id](storage/get_file_id.md)               | Returns file id by the given path                                   |
| [get_directory_id](storage/get_directory_id.md)     | Returns directory id by the given path                              |
| [get_file_path](storage/get_file_path.md)           | Returns absolute file path by the given file id                     |
| [get_directory_path](storage/get_directory_path.md) | Returns absolute directory path by the given directory id           |