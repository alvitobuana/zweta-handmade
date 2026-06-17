#!/usr/bin/env bash
mkdir -p /data
if [ ! -f /data/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /data/database.sqlite
fi
echo "Setting permissions for /data..."
chown -R www-data:www-data /data
chmod -R 775 /data
