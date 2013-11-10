# Frontage
[![Build Status](https://travis-ci.org/ChristianGaertner/Frontage.png?branch=master)](https://travis-ci.org/ChristianGaertner/Frontage)
[![Coverage Status](https://coveralls.io/repos/ChristianGaertner/Frontage/badge.png?branch=master)](https://coveralls.io/r/ChristianGaertner/Frontage?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dagardner/frontage/v/stable.png)](https://packagist.org/packages/dagardner/frontage)

An implementation of the facade pattern.

Create a facade in seconds:

```php
use DaGardner\Frontage\AbstractFrontage;
use DaGardner\DaContainer\Container;

class Model extends DaGardner\Frontage\AbstractFrontage
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

### About

The Frontage package is just a tiny helper and doesn't do too much.

Note that this requires a container from which it can pull from.

#### License
MIT