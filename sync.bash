#!/bin/bash

# This runs php script which will synchronize physical 
# storage and database files. All files that exists in
# data directory but does not exist in database will
# be deleted as well as records of files that exists 
# in database but not in data directory 
# will be deleted from database.

php -d include_path=./include/ ./utils/sync.php