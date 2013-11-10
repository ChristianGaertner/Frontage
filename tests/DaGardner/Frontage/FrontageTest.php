<?php
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework Tests
 * License: View distributed LICENSE file
 *
 * 
 * This file is meant to be used in PHPUnit Tests
 */

use DaGardner\DaContainer\Container;
use DaGardner\Frontage\AbstractFrontage;

/**
* PHPUnit Test
*/
class FrontageTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $container = new Container;
        
        $container->bind('mock', function() {
            return new MockConcrete;
        }, true);

        AbstractFrontage::setContainer($container);

    }

	public function testGeneral()
	{
        $this->assertEquals('Foo', Mock::get());
        Mock::set('Bar');
        $this->assertEquals('Bar', Mock::get());
	}

}


class Mock extends DaGardner\Frontage\AbstractFrontage
{
	public static function getFacadeID() {
		return 'mock';
	}
}


class MockConcrete
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