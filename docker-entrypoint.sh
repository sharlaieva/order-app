#!/bin/bash
set -e

echo "Waiting for database to be ready..."

until mysqladmin ping -h database -uuser -ppassword --silent; do
  echo -n "."
  sleep 2
done

echo
echo "Database is ready, configuring git safe directory..."

git config --global --add safe.directory /var/www/html

echo "Installing dependencies..."

composer install --no-interaction --prefer-dist --no-progress

export $(cat .env.local | grep -v '^#' | xargs)


echo "Running migrations and fixtures..."

php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures:load --no-interaction

echo "Setup finished, starting the main process..."

exec "$@"
