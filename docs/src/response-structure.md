# Response structure
Each method, except [get_file_content](#get_file_content), will return content formatted as json 
with the following structure depending on success of the method

## Successful response
Successful response will always return code in range [200; 299]
and the response body will contain *data* object with the response data,
even if the response data is empty.

## Error response
Error response will retrn code in range outside of [200; 299]
and the response body will contain *error* string and *error_data* object
that could contain some additional error information.