# delete_user
Permanently deletes user

URL: `https://storage.buttex.ru/api/users/delete_user`\
Method: **GET**\
Access level: **ADMIN**

## Query
| Parameter | Type   | Required | Description  |
|-----------|--------|----------|--------------|
| user_id   | Int    | Yes      | User id      |

### Remarks
> All files and directories associated with the user will be deleted recursively