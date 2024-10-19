# create_user
Creates new user

URL: `https://storage.buttex.ru/api/users/create_user`\
Method: **GET**\
Access level: **ADMIN**

## Query
| Parameter         | Type   | Required | Description     |
|-------------------|--------|----------|-----------------|
| user_name         | String | Yes      | Username        |
| user_nickname     | String | Yes      | Nickname        |
| user_password     | String | Yes      | Password        |
| user_avatar_url   | String | No       | User avatar URL |
| user_access_level | Int    | Yes      | Access level    |

## Returns
| Value   | Type   | Description                    |
|---------|--------|--------------------------------| 
| token   | String | Token associated with the user |
| user_id | Int    | ID associated with the user    |

### Remarks
> `user_access_level` must be set to a valid enumeration value except ANY (see [permission system](../../users/permission-system.md))