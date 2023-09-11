composer install &&\
./artisan migrate:fresh &&\
./artisan test &&\
./artisan db:seed &&\
./artisan app:fetch-hn-feed &&\
php-fpm;
