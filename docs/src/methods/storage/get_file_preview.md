# get_file_content
Returns file preview by the given id

URL: `https://storage.buttex.ru/api/storage/get_file_preview`\
Method: **GET**\
Access level: **ANY**

## Query
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| file_id   | Int  | Yes      | File id     |

## Returns
Requested file preview (if available), or an empty response

> ### Remarks
> - Unlike other methods, this method will not return json as the response body.
> This method will return file preview with respective Content-Type.
> - If preview is not available for the file, then this method will return an empty response
> with status code 204 (NO_CONTENT).
> - If the requested file is not found, method will return plain text saying that
> the file was not found with code 404