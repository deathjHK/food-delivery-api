#!/bin/bash
sed -i 's/\r$//' start.sh

echo -e "\033[0;32m=== Starting Food Delivery System ===\033[0m"

export WWWGROUP=$(id -g)
export WWWUSER=$(id -u)

echo "Creating .env file..."
cat <<EOF > backend/.env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:QkXhkgDXl9uAwD9Vfoo1mMWa7oHc9QTIMLFVqNFS5HU=
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_PORT=8000

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

VITE_API_BASE=http://localhost:8000/api
EOF
echo "Default .env created."



# 1. Create .env if it doesn't exist
echo "Creating .env file..."
cat <<EOF > .env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:QkXhkgDXl9uAwD9Vfoo1mMWa7oHc9QTIMLFVqNFS5HU=
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_PORT=8000

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

VITE_API_BASE=http://localhost:8000/api
EOF
echo "Default .env created."


# 2. Ensure backend dependencies exist
if [ ! -f "backend/vendor/autoload.php" ]; then
    echo "Installing backend dependencies..."
    docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd)/backend:/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
fi

# 3. Build and start
docker compose up --build