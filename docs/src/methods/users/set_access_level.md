# set_access_level
Changes user's access level

URL: `https://storage.buttex.ru/api/users/set_access_level`\
Method: **GET**\
Access level: **ADMIN**

## Query
| Parameter    | Type    | Required | Description   |
|--------------|---------|----------|---------------|
| user_id      | Int     | Yes      | User ID       |
| access_level | String  | Yes      | New nickname  |

## Returns
This methods does not return any values

### Remarks
> `access_level` parameter must contain valid access level listed on the (see [permission system](../../users/permission-system.md)) page, 
> and not be -1 (**ANY**)