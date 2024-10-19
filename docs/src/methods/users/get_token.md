# get_token
Returns user's access token by given *username* and *password*

URL: `https://storage.buttex.ru/api/users/get_token`\
Method: **GET**\
Access level: **ANY**

## Query
| Parameter      | Type   | Required | Description |
|----------------|--------|----------|-------------|
| user_name      | String | Yes      | Username    |
| user_password  | String | Yes      | Password    |

## Returns
| Value   | Type   | Description                    |
|---------|--------|--------------------------------|
| token   | String | Token associated with the user |
| user_id | Int    | ID associated with the user    |