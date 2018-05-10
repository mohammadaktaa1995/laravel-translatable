# laravel Translatable
This package to make translate easly in laravel and to save your translate words in datatabse with many usefull functions.

## Install

Via Composer

``` bash
$ composer require Aktaa/laravel-translate
```

## Usage

you shoud publish provider to use package without errors.
``` bash
$ php artisan vendor:publish --provider=Aktaa\translatable\TranslatableServiceProvider
```
after that use this command ti initialize package's files

``` bash
$php artisan make:translate-init --langs=en,ar
```

``` php
$skeleton = new League\Skeleton();
echo $skeleton->echoPhrase('Hello, League!');
```
