# get_file_id
Returns file id by the given path

URL: **https://storage.buttex.ru/api/storage/get_file_id** \
Method: **GET**\
Access level: **ANY**

## Query
| Parameter           | Type   | Required | Description       |
|---------------------|--------|----------|-------------------|
| path                | String | Yes      | File path         |
| parent_directory_id | Int    | No       | Root directory id |

## Returns
| Value   | Type | Description       |
|---------|------|-------------------| 
| file_id | Int  | Requested file id |

> ### Remarks
> - If `parent_directory_id` parameter is passed, then the given path will be
> considered as relative to this directory.
> Otherwise, the path will be considered as absolute