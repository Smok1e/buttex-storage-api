# validate_token
Check if user token is valid

URL: `https://storage.buttex.ru/api/users/validate_token`\
Method: **GET**\
Access level: **USER**

## Query
This method does not require any query parameters

## Returns
If token passed in `Authorization` header (see [authorization](../../users/authorization.md) is valid,
then this method will no return any values; Otherwise, this method will return an error message with status code 401.