# create_file
Uploads file to storage

URL: **https://storage.buttex.ru/api/storage/create_file**\
Method: **POST**\
Access level: **USER**

## Query
| Parameter           | Type   | Required | Description                                             |
|---------------------|--------|----------|---------------------------------------------------------|
| token               | String | Yes      | User access token                                       |
| parent_directory_id | Int    | No       | ID of directory where the uploaded file will be placed  |
| hidden              | Int    | No       | If 1, the uploaded file will not be seen by other users |

## Body
| Parameter | Type      | Required | Description |
|-----------|-----------|----------|-------------|
| file      | Multipart | Yes      | The file    |

## Returns
| Value    | Type    | Description       |
|----------|---------|-------------------| 
| file_id  | Int     | Uploaded file ID  |
| file_url | String  | Uploaded file URL |

## Remarks
If *parent_directory_id* parameter is passed, file will be placed into specified directory. \
Otherwise, file will be placed into root directory
