composer install --ignore-platform-req=ext-gd --ignore-platform-req=ext-gd


copy .env from .example.env


Create a database and inform .env


php artisan migrate


php artisan vietnamzone:import


php artisan db:seed --class=DatabaseSeeder


php artisan key:generate


php artisan serve to  start the app on http://localhost:8000/
