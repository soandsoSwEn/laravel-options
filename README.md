![GitHub](https://img.shields.io/github/license/soandsoSwEn/laravel-options)
![GitHub Workflow Status (event)](https://img.shields.io/github/workflow/status/soandsoSwEn/laravel-options/PHP%20Composer)
![GitHub top language](https://img.shields.io/github/languages/top/soandsoSwEn/laravel-options)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/soandsoSwEn/laravel-options)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/soandso/laravel-options)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/soandsoSwEn/laravel-options)
![GitHub Release Date](https://img.shields.io/github/release-date/soandsoSwEn/laravel-options)
![Codacy coverage](https://img.shields.io/codacy/coverage/4cf6615e8d76442cae636cdb42f2d09b)

Laravel options
========================================

Laravel service for global storing in database key-value structure data


Requirements
-----------

This library only requires PHP >= 8.0

Setup
-----

Add the library to your composer.json file in your project:

```bash
{
  "require": {
      "soandso/laravel-options": "0.*"
  }
}
```

Use [composer](http://getcomposer.org) to install the library:

```bash
$ php composer.phar install
```

You can also use composer on the command line to require and install Grouping:

```bash
$ php composer.phar require soandso/laravel-options
```

You should publish the migration with ```php artisan vendor:publish --provider="Soandso\LaravelOptions\OptionProvider" ```

Run ```php artisan migrate``` to migrate the table.

Usage
-----

### Facade

Set parameter value:

The parameter key must be unique to the Option entity
Formats available for the parameter value - string, array

```php
use Soandso\LaravelOptions\Option;

Option::set($key, $value);
```

The method returns ```true``` in case of successful setting of the parameter value or ```false``` in case of an error

Get parameter value:

```php
Option::get($key);
```

If there is no parameter for the specified key, the method will return ```false```

Check if the parameter with the given key exists
```php
Option::exists($key);
```
Returns ```true``` or ```false``` depending on the result

Delete a parameter by its key
```php
Option::destroyByKey($key);
```
Returns ```true``` if deletion was successful, ```false``` if deletion failed.

### Helper function

With helper ```setOption()``` you can set options
```php
setOption($key, $value)
```

helper ```getOption()``` will return the value of the option by its key
```php
getOption($key)
````

Helper function ```existsOption()``` checks if the parameter with the given key exists
```php
existsOption($key)
```

Function ```destroyOption``` deletes a parameter by its key
```php
destroyOption($key)
```

### Console

The command to delete parameters is available in the console.
```php
 php artisan option:clear
 ```
This command will delete all data. You can restrict deletion by the date of creation or last update of the parameter
```php
 php artisan option:clear <date>
 ```
Date must be in ```Y-m-d``` format. In this case, all parameters that are older than the specified date will be deleted.



License
-------

Laravel option is licensed under the MIT License (https://github.com/appstract/laravel-options/blob/HEAD/LICENSE.md).