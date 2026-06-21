#!/usr/bin/env bash
mkdir -p /data

# 1. Initialize SQLite database if it doesn't exist
if [ ! -f /data/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /data/database.sqlite
fi

# 2. Setup persistent uploads directory
echo "Setting up persistent uploads..."
mkdir -p /data/uploads
if [ -d /var/www/html/public/uploads ] && [ "$(ls -A /var/www/html/public/uploads)" ]; then
    # copy existing files to the persistent volume, only if newer or not present
    cp -ru /var/www/html/public/uploads/* /data/uploads/
fi
# Remove the ephemeral public/uploads folder and replace it with a symlink to /data/uploads
rm -rf /var/www/html/public/uploads
ln -sf /data/uploads /var/www/html/public/uploads

# 3. Setup persistent public storage
echo "Setting up persistent public storage..."
mkdir -p /data/public
if [ -d /var/www/html/storage/app/public ] && [ "$(ls -A /var/www/html/storage/app/public)" ]; then
    # copy existing files to the persistent volume, only if newer or not present
    cp -ru /var/www/html/storage/app/public/* /data/public/
fi
# Remove the ephemeral storage/app/public folder and replace it with a symlink to /data/public
rm -rf /var/www/html/storage/app/public
ln -sf /data/public /var/www/html/storage/app/public

# 4. Set permissions
echo "Setting permissions for /data..."
chown -R www-data:www-data /data
chmod -R 775 /data
