# create_file
Uploads file to storage

URL: `https://storage.buttex.ru/api/storage/create_file`\
Method: **POST**\
Access level: **USER**

## Query
| Parameter           | Type   | Required | Description                                             |
|---------------------|--------|----------|---------------------------------------------------------|
| parent_directory_id | Int    | No       | ID of directory where the uploaded file will be placed  |
| hidden              | Int    | No       | If 1, the uploaded file will not be seen by other users |
| lifetime            | Int    | No       | Time (in seconds) after which the file will be deleted  |

## POST body
| Parameter | Type      | Required | Description |
|-----------|-----------|----------|-------------|
| file      | Multipart | Yes      | The file    |

## Returns
| Value              | Type    | Description                                 |
|--------------------|---------|---------------------------------------------|
| file_id            | Int     | Uploaded file ID                            |
| file_url           | String  | Uploaded file URL                           |
| file_premanent_url | String  | Permanent URL (not affected by file rename) |

> ### Remarks
> - If `parent_directory_id` parameter is passed, file will be placed into specified directory.
> Otherwise, file will be placed into root directory.
> - Only owner of directory and users with access **MODERATOR** or higher can upload files
> under this directory (see [permission system](../../users/permission-system.md)).