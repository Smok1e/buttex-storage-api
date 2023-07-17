# get_files_list
Returns list of files and directories under the specified directory

URL: `https://storage.buttex.ru/api/storage/get_files_list`\
Method: **GET** \
Access level: **ANY**

## Query
| Parameter           | Type   | Required  | Description                          |
|---------------------|--------|-----------|--------------------------------------|
| token               | String | No        | User access token                    |
| parent_directory_id | Int    | No        | ID of directory that will be listed  |

## Returns
This method returns two arrays: `files` and `directories` \
Each array item has all of the following fields: 

| Value         | Type          | Description              |
|---------------|---------------|--------------------------|
| id            | Int           | File/directory id        |
| name          | String        | name                     |
| directory_id  | Int or *null* | Parent directory id      |
| hidden        | Int           | Is file/directory hidden |
| creation_time | Int           | Creation timestamp       |
| user_id       | Int           | Owner id                 |
| user_name     | String        | Owner username           |
| user_nickname | String        | Owner nickname           |

Also, each `files` array item will have `lifetime` field set to `null` or to an integer 
value, represeting time in seconds after which the file will be deleted counting from `creation_time`.

> ### Remarks
> - If `parent_directory_id` parameter is not passed, then method will return
>   list of root directory files. Otherwise, the specified directory will be listed.
> - If `token` parameter is passed, then hidden files that user owns will also be listed
> - This method **will not** list files recursively.