# laravel Translatable
This package to make translate easly in laravel and to save your translate words in datatabse with many usefull functions.

## Install

Via Composer

``` bash
$ composer require Aktaa/laravel-translate
```

## Usage

You shoud publish provider to use package without errors.
``` bash
$ php artisan vendor:publish --provider=Aktaa\translatable\TranslatableServiceProvider
```
After that use this command ti initialize package's files (Model,Provider,viewComposer,helper file,translate table migration)

``` bash
$ php artisan make:translate-init --langs=en,ar
```
The name of Model will be Translate by default if you want to change it you just write this command istead of the above,
and you want to deploy it in another directory you just add option ``` bash --dir=folder ```.

``` bash
$ php artisan make:translate-init Example --langs=en,ar --dir=Models
```

The file generated is:

App\Helper\Helpers.php,

App\Models\Translate.php,

App\Providers\ComposerServiceProvider.php,

database\migrations\2018_05_09_124224_create_translates_table.php,

resources\lang\{lang}\words.php,

The words file is if you want to use php helper function ```php trans('words.example')```.

you should put in ```php app.config``` file.
```php
App\Providers\ComposerServiceProvider::class
```
and 
```php
Aktaa\translatable\TranslatableServiceProvide::class  
```
Facade:
```php
   'Translatable' => Aktaa\translatable\Facades\Translatable::class,
   ```
 The helper function is
``` php
translate($word,$lang,$default);
ex:translate('hello_word',Translatable::getCurrentLocale(),'Hello World!);
```

```php $default``` the word appear if the word you entered doesn't exist.

After all of this you will be able to use it
go to this url:
``` php
 http://localhost/your-project-name/public/{lang}/translates
 ```
