#!/bin/bash
sed -i 's/\r$//' start.sh

echo -e "\033[0;32m=== Starting Food Delivery System ===\033[0m"

export WWWGROUP=$(id -g)
export WWWUSER=$(id -u)

# Ensure backend dependencies exist before booting
if [ ! -f "backend/vendor/autoload.php" ]; then
    echo "Installing backend dependencies..."
    docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd)/backend:/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
fi

# Build and start everything
docker compose up --build