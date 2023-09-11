composer install &&\
./artisan migrate:fresh &&\
./artisan test &&\
./artisan db:seed &&\
./artisan app:fetch-hn-feed &&\
chmod -R o+rw storage/ &&\
php-fpm;
