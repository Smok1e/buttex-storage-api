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
This method does not return any values

> ### Remarks
> - Only owner of file and users with access **MODERATOR** or higher can modify
> the file (see [permission system](../../users/permission-system.md)).
> - Uploaded file name is ignored; To change file name, use [set_file_name](set_file_name.md)