<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Description 

This is report app backend. This project use sqlite as database.

## Install 

Follow this steps:

1. Copy .env.example file into .env file
2. Run migrations and seeders:
    ```php artisan migrate --seed```
3. Create symbolic link:
    ```php artisan storage:link```
4. Run application: 
```php artisan serve```
5. Run queue:
```
php artisan queue:listen //production
php artisan queue:work //local
```


## Run test

This project have many tests.

Execute this command:
```php artisan test```
