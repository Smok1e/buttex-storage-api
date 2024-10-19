# set_directory_hidden
Sets file hidden flag

URL: `https://storage.buttex.ru/api/storage/set_directory_hidden`\
Method: **GET**\
Access level: **USER**

## Query
| Parameter    | Type | Required | Description  |
|--------------|------|----------|--------------|
| directory_id | Int  | Yes      | Directory id |
| hidden       | Int  | Yes      | Hidden flag  |

## Returns
This method does not returns any values.

> ### Remarks
> The `hidden` parameter should be `1` or `0`, wich means the directory is hidden or not respectively.
> Hidden files and directories are only shown to it's owners or admins.
> If user is not owner of the directory, then at least **ADMIN** access level
> is required for this method (see [permission system](../../users/permission-system.md)).