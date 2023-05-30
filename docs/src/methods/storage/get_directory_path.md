# get_directory_path
Returns absolute directory path by the given directory id

URL: **https://storage.buttex.ru/api/storage/get_directory_path**\
Method: **GET**\
Access level: **ANY**

## Query
| Parameter    | Type   | Required | Description  |
|--------------|--------|----------|--------------|
| directory_id | Int    | No       | Directory id |

## Returns
| Value | Type   | Description              |
|-------|--------|--------------------------|
| path  | String | Requested directory path |

## Remarks
If *parent_directory_id* parameter is not passed, then this method will return 
path of the root directory