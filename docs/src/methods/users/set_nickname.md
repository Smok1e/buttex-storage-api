# set_nickname
Changes user's nickname

URL: `https://storage.buttex.ru/api/users/set_nickname`\
Method: **GET**\
Access level: **USER**

## Query
| Parameter    | Type    | Required | Description   |
|--------------|---------|----------|---------------|
| user_id      | Int     | No       | User ID       |
| new_nickname | String  | Yes      | New nickname  |

## Returns
This methods does not return any values

> ### Remarks
> - Don't pass the `user_id` parameter to change your own nickname; 
> To change nickname by user user id, at least **ADMIN** access level is required (see [permission system](../../users/permission-system.md)).
> - Nickname is limited by 32 characters