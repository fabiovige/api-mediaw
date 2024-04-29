php -v
composer install
php artisan key:generate
php artisan migrate
exit;
composer install
php artisan key:generate
php artisan migrate
exit;
php artisan migrate --seed
php artisan migrate:refresh --seed
exit;
