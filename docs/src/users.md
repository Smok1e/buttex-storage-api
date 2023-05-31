# Users

This section describes how does user system works in API.

Each user has following fields in database:

| Field        | Meaning                                                                                                |
|--------------|--------------------------------------------------------------------------------------------------------|
| Name         | User's name that is used to authorize to API                                                           |
| Nickname     | User's nick name to display in client                                                                  |
| Password     | User's password hash that is used to authorize to API                                                  |
| Access level | User's access level. See [permission system](users/permission-system.md) for more detailed explanation |

Basically the user system is used to assign files/directories ownership to someone.
If user uploaded a file, then the ownership of this file will be assigned to this user.
Only file owner and admins are have permission to modify delete one.

## See also:
* [Autentication](users/authentication.md)
* [Permission system](users/permission-system.md)
* [Users methods](methods/users.md)

## Registration
Note that there is actually **no way** to register on Buttex Storage; only admins are able to register a new user :D