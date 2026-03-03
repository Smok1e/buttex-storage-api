# Users

This section describes buttex storage API user system.

Database stores following information about each user:

| Field        | Meaning                                                                                              |
|--------------|------------------------------------------------------------------------------------------------------|
| Name         | Login used for authorization (can't be changed)                                                      | 
| Nickname     | Nickname to display (can be changed)                                                                 |
| Password     | Password hash used for authorization                                                                 |
| Access level | User access level. See [permission system](users/permission-system.md) for more detailed explanation |

Main purpose of user system is to assign ownership to filesystem entries, such as files and directories.
Ownership defines who has uploaded the file and who is able to modify it. 

## See also:
* [Authorization](users/authorization.md)
* [Permission system](users/permission-system.md)
* [Users methods](methods/users.md)
