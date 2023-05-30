# Users methods

Base URL: **https://storage.buttex.ru/api/methods/users/**

This section allows client to interact users: retrieve token by username and password
that is required for actions that are associated with specific user, change user nickname,
password, etc.

| Method                                        | Description                                    |
|-----------------------------------------------|------------------------------------------------|
| [get_token](users/get_token.md)               | Returns user's access token                    |
| [get_profile_info](users/get_profile_info.md) | Returns user profile info by the given user id |
| [set_nickname](users/set_nickname.md)         | Changes nickname                               |
| [set_password](users/set_password.md)         | Changes password                               |