#!/bin/bash
set -e

echo "Waiting for database to be ready..."
until mysqladmin ping -h database -uuser -ppassword --silent; do
  echo -n "."
  sleep 2
done

echo
echo "Database is ready, configuring git safe directory..."
git config --global --add safe.directory /var/www/html || true

if [ -f composer.json ]; then
  echo "Installing dependencies..."
  composer install --no-interaction --prefer-dist --no-progress
else
  echo " composer.json not found — skipping composer install"
fi

echo "Running migrations and fixtures..."
php bin/console doctrine:migrations:migrate --no-interaction || true
php bin/console doctrine:fixtures:load --no-interaction || true

echo "Setup finished, starting the main process..."
exec "$@"
