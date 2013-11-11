# Frontage
[![Build Status](https://travis-ci.org/ChristianGaertner/Frontage.png?branch=master)](https://travis-ci.org/ChristianGaertner/Frontage)
[![Coverage Status](https://coveralls.io/repos/ChristianGaertner/Frontage/badge.png?branch=master)](https://coveralls.io/r/ChristianGaertner/Frontage?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dagardner/frontage/v/stable.png)](https://packagist.org/packages/dagardner/frontage)

This is a package with a few small classes which will make your life easier and your code cleaner.

The main component is the `AbstractFrontage` class which is an implementation of the facade pattern.

## Installation

Simply add `dagardner/frontage` to your composer dependencies and run composer install.

    "require": {
        "dagardner/frontage": "0.2"
    }

If you cannot use composer (you should!) you can still clone this repo and require all files you need manually.

## Components

### Facades

Create a facade in seconds:

```php
use DaGardner\DaContainer\Container;
use DaGardner\Frontage\AbstractFrontage;

class Model extends AbstractFrontage
{
    public static function getFacadeID() {
        return 'mymodel';
    }
}

class MyModel
{
    
    protected $name = 'Foo';



    /**
     * Gets the value of name.
     *
     * @return string
     */
    public function get()
    {
        return $this->name;
    }
    
    /**
     * Sets the value of name.
     *
     * @param string $name the name
     */
    public function set($name)
    {
        $this->name = $name;
    }
}

$container = new Container;
$container->bind('mymodel', function() {
    return new MyModel;
}, true);
```

Now you can access the `MyModel` object with a neat static syntax:

```php
Model::get();
Model::set('New Name');
```

### AliasLoader

The AliasLoader is a class alias creator with lazy loading enabled.

```php
use DaGardner\Frontage\AliasLoader;

AliasLoader::make()
    ->makeAutoloader()
    ->alias('Foo', 'MyModel');

// Now you can access the MyModel class this way:
$myModel = new Foo;
```

This AliasLoader plays nicely with the Frontage class. As you need to create a class for
each Facade you will most likley namespace these Facades and now they aren' t that nifty anymore:

```php
Vendor\Lib\Facades\Model::get()
```

Now an alias would be really nice:

```php
AliasLoader::make()
    ->alias('Model', 'Vendor\Lib\Facades\Model')
    ->makeAutoloader();

Model::get();
```

These alias are lazy loaded so they will get created on the first access of `Model`. However you can create the alias by hand this way:

```php
AliasLoader::make()
    ->alias('Model', 'Vendor\Lib\Facades\Model')
    ->create('Model');
```

### ArrayCase

An ArrayCase lets you handle a vanilla array in an OOP approach.

```php
$case = new ArrayCase(array('foo', 'bar'));
// or
$case = ArrayCase::make(array('foo', 'bar')); // this one is chainable :D
```

Just check out the code and see what is implemented. Just to show you a few:

This will call the callback on each element and after that we grab the first element.
```php
$case->each(function($value)
{
    $value->callMethodMayBe('?!');
})->first();
```

Or build in json support:

```php
echo $case->json();
// or just convert to string
echo $case;
```

Of course the standard array manipulation tools are implemented like pop, shift, unshift, etc.

#### License
MIT