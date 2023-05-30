# set_password
Changes associated to given *token* user's password

URL: **https://storage.buttex.ru/api/users/set_password**\
Method: **GET**\
Access level: **ANY**

## Query
| Parameter    | Type   | Required | Description  |
|--------------|--------|----------|--------------|
| token        | String | Yes      | Access token |
| new_password | String | Yes      | New password |

> Note that after successful invocation of this method, **old user's token will become invalid**.
> Use [users/get_token](get_token.md) method to retrieve new token associated to user.

## Returns
This methods does not return any values