# delete_directory
Deletes directory **recursively**. All subdirectories and files under specified directory
will be deleted permanently.

URL: `https://storage.buttex.ru/api/storage/delete_directory`\
Method: **GET**\
Access level: **USER***

## Query
| Parameter    | Type   | Required | Description       |
|--------------|--------|----------|-------------------|
| token        | String | Yes      | User access token |
| directory_id | Int    | Yes      | File id           |

## Returns
This method does not returns any values.

> ### Remarks
> If user is not owner of the directory, than at least **MODERATOR** access level
> is required for this method (see [permission system](../../users/permission-system.md)).