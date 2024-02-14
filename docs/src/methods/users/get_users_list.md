# get_users_list
Returns the list of users in the system

URL: `https://storage.buttex.ru/api/users/get_users_list`\
Method: **GET**\
Access level: **MODERATOR**

## Query
This method does not expect any query parameters

## Returns
This method returns an array of objects; Each returned object has the following structure:

| Value        | Type   | Description        |
|--------------|--------|--------------------|
| id           | Int    | User ID            |
| name         | String | User name          |
| nickname     | String | User nickname      |
| timestamp    | Int    | User creation time |
| access_level | Int    | User access level  |