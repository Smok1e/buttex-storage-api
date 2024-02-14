# get_file_info
Returns file info by id

URL: `https://storage.buttex.ru/api/storage/get_file_info`\
Method: **GET**\
Access level: **ANY**

## Query
| Parameter | Type   | Required | Description |
|-----------|--------|----------|-------------|
| file_id   | Int    | Yes      | File id     |

## Returns
| Value         | Type          | Description                                  |
|---------------|---------------|----------------------------------------------| 
| id            | Int           | Requested file id                            |
| lifetime      | Int or *null* | File lifetime in seconds                     |
| name          | String        | File name                                    |
| directory_id  | Int or *null* | Parent directory id                          |
| hidden        | Int           | Is file hidden                               |
| creation_time | Int           | Creatiom timestmap                           |
| has_preview   | Int           | Can file have [preview](get_file_preview.md) |
| user_id       | Int           | Owner id                                     |
| user_name     | String        | Owner name                                   |
| user_nickname | String        | Owner nickname                               |
| size          | Int           | File size                                    |
| type          | String        | File content mime type                       |
| url           | String        | File url                                     |
| permanent_url | String        | File permanent url                           |