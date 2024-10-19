# set_password
Changes user's password

URL: `https://storage.buttex.ru/api/users/set_password`\
Method: **GET**\
Access level: **USER**

## Query
| Parameter    | Type   | Required | Description  |
|--------------|--------|----------|--------------|
| user_id      | Int    | No       | User ID      |
| new_password | String | Yes      | New password |

## Returns
This methods does not return any values

> ### Remarks
> - Don't pass the `user_id` parameter to change your own password; 
> To change password by user user id, at least **ADMIN** access level is required (see [permission system](../../users/permission-system.md)).
> - Note that after successful invocation of this method, **old user's token will become invalid**.
> Use [users/get_token](get_token.md) method to retrieve new token associated to user.