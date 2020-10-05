#!/bin/bash

echo "running install"

PROVISIONING_FILE=.env
if [ ! -f ${PROVISIONING_FILE} ]; then
    php -r "file_exists('.env') || copy('.env.example', '.env');"
    php artisan key:generate --ansi
    touch ${PROVISIONING_FILE}
fi

composer dump-autoload
echo "running migration"
php artisan migrate

exec "$@"
