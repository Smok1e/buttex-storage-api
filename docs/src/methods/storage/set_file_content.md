# set_file_content
Changes file content

URL: `https://storage.buttex.ru/api/storage/set_file_content`\
Method: **POST**\
Access level: **USER**

## Query
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| file_id   | Int  | Yes      | File id     |

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
> - Only owner of file and users with access **MODERATOR** or higher can modify
> the file (see [permission system](../../users/permission-system.md)).
> - Uploaded file name is ignored; To change file name, use [set_file_name](set_file_name.md)