## About this project

This is a simple CRUD of manager series list with Laravel.

## Requirements

- PHP ^8.1
- Composer
- Laravel ^9

## Installation

Install the package through [Composer](http://getcomposer.org/). 

Run the Composer require command from the Terminal:

    composer create-project phdomiciano/serieslistlaravel

Create a file sqlite in folder "database" or other DB you wish (For others, configure ".env" file):

    database/database.sqlite

If necessary update your requiries, run on Terminal:

    composer update

    composer dump-autoload

Create the database tables, run on Terminal:

    php artisan migrate

Run your php server and access the url from project in a web browser.

## Possible problem in installation

If you get a 505 error when accessing an application for the first time, run:

    php artisan key:generate

If you get a error like "\bootstrap\cache directory must be present and writable", just delete the folder "cache" and create again a new folder empty

Now go up the server again.

<br />

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
