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

```php
use Soandso\LaravelOptions\Option;

Option::set($key, $value);
```

The method returns ```true``` in case of successful setting of the parameter value or ```false``` in case of an error

Get parameter value:

```php
Option::get($key);
```

License
-------

Laravel option is licensed under the MIT License (https://github.com/appstract/laravel-options/blob/HEAD/LICENSE.md).