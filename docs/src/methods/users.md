# Users methods

Base URL: **https://storage.buttex.ru/api/methods/users/**

Users section allows client to interact users: retrieve token by username and password
that is required for actions that are associated with specific user, change user nickname,
password, etc.

| Method                                        | Description                                    |
|-----------------------------------------------|------------------------------------------------|
| [validate_token](users/validate_token.md)     | Check if user token is valid                   |
| [get_token](users/get_token.md)               | Returns user's access token                    |
| [get_profile_info](users/get_profile_info.md) | Returns user profile info by the given user id |
| [get_users_list](users/get_users_list.md)     | Returns the list of users in the system        |
| [set_nickname](users/set_nickname.md)         | Changes nickname                               |
| [set_password](users/set_password.md)         | Changes password                               |
| [set_avatar_url](users/set_avatar_url.md)     | Changes user's avatar URL                      |
| [set_access_level](users/set_access_level.md) | Changes user's access level                    |
| [create_user](users/create_user.md)           | Creates new user                               |
| [delete_user](users/delete_user.md)           | Permanently deletes user                       |