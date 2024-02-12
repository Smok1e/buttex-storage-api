# Permission system
This section describes how does permission system works in API.

## Access level
Each user has it's access level. It is number value, the larger it is, the more
permission user have. Regular user have access level 0, that means it have access to
most of common methods. Some methods could have different behaviour depending on 
user access level (for example, [delete_file](../methods/storage/delete_file.md), 
that will deny access if you are trying to delete file that you don't own while
your access level is lower than **MODERATOR**).

## Methods access
You can determine required access level for specific method by documentation.
Each documented method says it's required access level such as **ANY**, **USER**, or **MODERATOR**.

Here is a table that compares access level number value with it's meaning:

| Number value | Access level  | Meaning                                                                  |
|--------------|---------------|--------------------------------------------------------------------------|
| -1           | **ANY**       | User have only access to methods with access level of **ANY**            |
|  0           | **USER**      | User have access to methods with access level of **USER** and lower      |
|  1           | **MODERATOR** | User have access to methods with access level of **MODERATOR** and lower |
|  2           | **ADMIN**     | User have access to any method                                           |

> If method access level is marked as **ANY**, it means that method is not using any user information, and 
> access token is not required for this this method. Otherwise, you can't invoke this method without token.

## Access violation
If user is trying to have access to method that requires more permissions
than user is currently have, then method will return [error response](../response-structure.md#error-response) 
with status code 403.