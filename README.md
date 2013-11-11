# Frontage
[![Build Status](https://travis-ci.org/ChristianGaertner/Frontage.png?branch=master)](https://travis-ci.org/ChristianGaertner/Frontage)
[![Coverage Status](https://coveralls.io/repos/ChristianGaertner/Frontage/badge.png?branch=master)](https://coveralls.io/r/ChristianGaertner/Frontage?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dagardner/frontage/v/stable.png)](https://packagist.org/packages/dagardner/frontage)

This is a package with a few small classes which will make your life easier and your code cleaner.

The main component is the `AbstractFrontage` class which is an implementation of the facade pattern.

## Facades

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

## AliasLoader

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


#### License
MIT