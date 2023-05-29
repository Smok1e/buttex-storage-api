# get_file_path
Returns absolute file path by the given file id

URL: **https://storage.buttex.ru/api/storage/get_file_path** \
Method: **GET**\
Access level: **ANY**

## Query
| Parameter | Type   | Required | Description |
|-----------|--------|----------|-------------|
| file_id   | Int    | Yes      | File id     |

## Returns
| Value | Type   | Description         |
|-------|--------|---------------------|
| path  | String | Requested file path |