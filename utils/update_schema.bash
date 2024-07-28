sudo mysqldump -u root storage > storage.sql

if [ $? -eq 0 ]; then
	echo "Schema exported successfully"
fi
