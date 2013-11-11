<?php
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework Tests
 * License: View distributed LICENSE file
 *
 * 
 * This file is meant to be used in PHPUnit Tests
 */

use DaGardner\Frontage\AliasLoader;

/**
* PHPUnit Test
*/
class AliasLoaderTest extends PHPUnit_Framework_TestCase
{

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