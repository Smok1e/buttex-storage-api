# get_files_list
Returns list of files and directories under the specified directory

URL: `https://storage.buttex.ru/api/storage/get_files_list`\
Method: **GET**\
Access level: **ANY**

## Query
| Parameter           | Type   | Required  | Description                          |
|---------------------|--------|-----------|--------------------------------------|
| parent_directory_id | Int    | No        | ID of directory that will be listed  |

## Returns
This method returns two arrays: `files` and `directories` \
Each array item has all of the following fields: 

| Value             | Type          | Description                                                     |
|-------------------|---------------|-----------------------------------------------------------------|
| id                | Int           | File/directory id                                               |
| name              | String        | name                                                            |
| size              | Int           | File size in bytes (*only for files*)                           |
| type              | String        | File content mime type (*only for files*)                       |
| directory_id      | Int or *null* | Parent directory id                                             |
| hidden            | Int           | Is file/directory hidden                                        |
| creation_time     | Int           | Creation timestamp                                              |
| modification_time | Int           | Modification timestamp (*only for files*)                       |
| has_preview       | Int           | Can file have [preview](get_file_preview.md) (*only for files*) |
| lifetime          | Int or *null* | File lifetime in seconds (*only for files*)                     |
| user_id           | Int           | Owner id                                                        |
| user_name         | String        | Owner username                                                  |
| user_nickname     | String        | Owner nickname                                                  |
| url               | String        | File url (*only for files*)                                     |
| permanent_url     | String        | File permanent url (*only for files*)                           |

> ### Remarks
> - If `parent_directory_id` parameter is not passed, then method will return
>   list of root directory files. Otherwise, the specified directory will be listed.
> - If the authorization header is passed, then hidden files that user owns will also be listed
> - This method **will not** list files recursively.