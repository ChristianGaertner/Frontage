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
        AbstractFrontage::setContainer(new Container);
    }

	public function testGeneral()
	{
        $this->assertEquals('Foo', Mock::get());
	}

}


class Mock extends DaGardner\Frontage\AbstractFrontage
{
	public static function getFacadeID() {
		return 'MockConcrete';
	}
}


class MockConcrete
{
	
	protected $name = 'Foo';



    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->name;
    }
    
    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    public function set($name)
    {
        $this->name = $name;

        return $this;
    }
}