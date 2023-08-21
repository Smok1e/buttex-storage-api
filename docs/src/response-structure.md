# Response structure
Each method, except [get_file_content](methods/storage/get_file_content.md), will return content formatted as json 
with the following structure depending on success of the method

## Successful response
Successful response will always return code in range [200; 299]
and the response body will contain `data` object with the response data,
even if the response data is empty.

Here's an example of successful response from `https://storage.buttex.ru/api/storage/get_files_list?parent_directory_id=4`:
```json
{
  "data": {
    "files": [
      {
        "id": 163,
        "lifetime": null,
        "name": "xcom.mp4",
        "directory_id": 4,
        "hidden": 0,
        "creation_time": 1685445395,
        "user_id": 5,
        "user_name": "admin",
        "user_nickname": "admin"
      }
    ],
    "directories": [
      {
        "id": 5,
        "name": "test_subdirectory",
        "directory_id": 4,
        "hidden": 0,
        "creation_time": 1685445370,
        "user_id": 5,
        "user_name": "admin",
        "user_nickname": "admin"
      }
    ]
  }
}
```

## Error response
Error response will retrn code in range outside of [200; 299]
and the response body will contain `error` string and `error_data` object
that could contain some additional error information.

Here's an example of error response from `https://storage.buttex.ru/api/storage/get_file_path?file_id=1412`:
```json
{
	"error": "file not found",
	"error_data": {}
}
```