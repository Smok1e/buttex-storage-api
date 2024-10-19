# set_file_lifetime
Changes file lifetime

URL: `https://storage.buttex.ru/api/storage/set_file_lifetime`\
Method: **GET**\
Access level: **USER**

## Query
| Parameter         | Type | Required | Description       |
|-------------------|------|----------|-------------------|
| file_id           | Int  | Yes      | File id           |
| new_file_lifetime | Int  | Yes      | New file lifetime |

## Returns
This method does not returns any values.

> ### Remarks
> If user is not owner of the file, then at least **MODERATOR** access level
> is required for this method (see [permission system](../../users/permission-system.md)).