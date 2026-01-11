## Oil Change Challenge

A small Laravel app to check form inputs for Vehikl.

Mainly based on documentation and tutorial resources from [laravel.com](https://laravel.com).

## Setup Instructions

Assuming you have the repository cloned locally already and have PHP/Composer/Laravel installed, run the following in the directory. 

```
composer install
php artisan migrate
composer run dev
```

The first 2 lines are for initialization, and on later runs you only need to run `composer run dev`.

The app will be hosted at http://localhost:8000.