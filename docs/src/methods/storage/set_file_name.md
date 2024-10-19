# set_file_name
Changes file name

URL: `https://storage.buttex.ru/api/storage/set_file_name`\
Method: **GET**\
Access level: **USER**

## Query
| Parameter     | Type   | Required | Description       |
|---------------|--------|----------|-------------------|
| file_id       | Int    | Yes      | File id           |
| new_file_name | String | Yes      | New file name     |

## Returns
This method does not returns any values.

> ### Remarks
> If user is not owner of the file, then at least **MODERATOR** access level
> is required for this method (see [permission system](../../users/permission-system.md)).