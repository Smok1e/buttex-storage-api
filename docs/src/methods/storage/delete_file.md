# delete_file
Deletes file from storage

URL: `https://storage.buttex.ru/api/storage/delete_file`\
Method: **GET**\
Access level: **USER***

## Query
| Parameter | Type   | Required | Description       |
|-----------|--------|----------|-------------------|
| file_id   | Int    | Yes      | File id           |

## Returns
This method does not returns any values.

> ### Remarks
> If user is not owner of the file, then at least **MODERATOR** access level
> is required for this method (see [permission system](../../users/permission-system.md)).