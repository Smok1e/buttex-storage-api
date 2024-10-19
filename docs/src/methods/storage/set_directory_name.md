# set_directory_name
Changes directory name

URL: `https://storage.buttex.ru/api/storage/set_directory_name`\
Method: **GET**\
Access level: **USER**

## Query
| Parameter          | Type   | Required | Description        |
|--------------------|--------|----------|--------------------|
| directory_id       | Int    | Yes      | Directory id       |
| new_directory_name | String | Yes      | New directory name |

## Returns
This method does not returns any values.

> ### Remarks
> If user is not owner of the directory, then at least **MODERATOR** access level
> is required for this method (see [permission system](../../users/permission-system.md)).