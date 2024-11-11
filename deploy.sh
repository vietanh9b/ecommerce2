npm run dev &&
php artisan migrate &&
php artisan l5-swagger:generate &&
mkdir -p storage/framework/cache/data &&
php artisan route:clear &&
php artisan cache:clear &&
php artisan config:clear &&
php artisan view:clear


