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

Set parameter value:

The parameter key must be unique to the Option entity
Formats available for the parameter value - string, array

### Facade

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

### Helper function

With helper ```setOption()``` you can set options
```php
setOption($key, $value)
```

helper ```getOption()``` will return the value of the option by its key
```php
getOption($key)
````

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