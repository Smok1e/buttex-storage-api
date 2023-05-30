# get_profile_info
Returns user profile info by the given user id

URL: **https://storage.buttex.ru/api/users/get_profile_info**\
Method: **GET**\
Access level: **ANY**

## Query
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| user_id   | Int  | Yes      | User ID     |

## Returns
| Value        | Type   | Description       |
|--------------|--------|-------------------| 
| id           | Int    | User ID           |
| name         | String | User name         |
| nickname     | String | User nickname     |
| access_level | Int    | User access level |