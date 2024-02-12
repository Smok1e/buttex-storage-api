# Authorization
Each user in API has it's own access token (API key) that is required 
for many methods, such as [create_file](../methods/storage/create_file.md).
Access token is used to identify user in system.

If method access level is marked as **ANY**, such as [get_files_list](../methods/storage/get_files_list.md) 
then the access token is not required to use this method (see [permission system](permission-system.md)).

This token is then passed with `Authorization` header to identify the user.
To retrieve your access token, use [get_token](../methods/users/get_token.md) method.

> Authorization header example: `Authorization: 5d7b38a7-fefd-11ed-b5e1-305a3a090b6e`

Here is an example of authorization request:
`https://storage.buttex.ru/api/users/get_token?user_name=test_user&user_password=test_password`
```json
{
	"data": {
		"token": "5d7b38a7-fefd-11ed-b5e1-305a3a090b6e",
		"user_id": 32
	}
}
```

## Invalid tokens
If you are passing a wrong token to any method that requires it, then you will get 
an [error response](../response-structure.md#error-response) with status code 401;

> Note that after successful invocation of [set_password](../methods/users/set_password.md) method,
> current user's token will become invalid and you'll have to authorize again.