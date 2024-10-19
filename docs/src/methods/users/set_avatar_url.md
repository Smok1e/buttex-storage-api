# set_avatar_url
Changes user's avatar URL

URL: `https://storage.buttex.ru/api/users/set_avatar_url`\
Method: **GET**\
Access level: **USER**

## Query
| Parameter      | Type    | Required | Description    |
|----------------|---------|----------|----------------|
| user_id        | Int     | No       | User ID        |
| new_avatar_url | String  | No       | New avatar URL |

## Returns
This methods does not return any values

> ### Remarks
> - If you want to delete avatar, don't pass new_avatar_url to this method
> - Don't pass the `user_id` parameter to change your own avatar url; 
> To change avatar url by user user id, at least **ADMIN** access level is required (see [permission system](../../users/permission-system.md)).