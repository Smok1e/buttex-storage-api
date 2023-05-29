# create_directory
Creates new directory

URL: **https://storage.buttex.ru/api/storage/create_directory**\
Method: **GET**\
Access level: **USER**

## Query
| Parameter           | Type   | Required | Description                                         |
|---------------------|--------|----------|-----------------------------------------------------|
| token               | String | Yes      | User access token                                   |
| parent_directory_id | Int    | No       | ID of directory where new directory will be placed  |
| hidden              | Int    | No       | If 1, the directory will not be seen by other users |

## Returns
| Value        | Type | Description          |
|--------------|------|----------------------| 
| directory_id | Int  | Created directory ID |

## Remarks
If *parent_directory_id* parameter is passed, new directory will be placed into specified directory.
Otherwise, directory will be placed into root directory
