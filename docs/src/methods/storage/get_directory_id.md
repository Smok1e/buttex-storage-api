# get_directory_id
Returns directory id by the given path

URL: **https://storage.buttex.ru/api/storage/get_directory_id**\
Method: **GET**\
Access level: **ANY**

## Query
| Parameter           | Type   | Required | Description       |
|---------------------|--------|----------|-------------------|
| path                | String | Yes      | Directory path    |
| parent_directory_id | Int    | No       | Root directory id |

## Returns
| Value         | Type          | Description              |
|---------------|---------------|--------------------------| 
| directory_id  | Int           | Requested directory id   |

> ### Remarks
> - If `parent_directory_id` parameter is passed, then the given path will be
> considered as relative to this directory. Otherwise, the path will be considered as absolute