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
    public function testAliasSettingAndGetting()
    {
        
        $loader = new AliasLoader(array('foo' => 'bar'));

        $this->assertEquals(array('foo' => 'bar'), $loader->getAliases());

        $loader->setAliases(array('bar' => 'baz'));

        $this->assertEquals(array('bar' => 'baz'), $loader->getAliases());

        $loader->alias('alias', 'stdClass');

        $this->assertEquals(array('bar' => 'baz', 'alias' => 'stdClass'), $loader->getAliases());

    }
}