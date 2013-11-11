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

    public function testFactory()
    {
        $this->assertInstanceOf('DaGardner\Frontage\AliasLoader', AliasLoader::make());
    }

    public function testAliasSettingAndGetting()
    {
        
        $loader = new AliasLoader(array('foo' => 'bar'));

        $this->assertEquals(array('foo' => 'bar'), $loader->getAliases());

        $loader->setAliases(array('bar' => 'baz'));

        $this->assertEquals(array('bar' => 'baz'), $loader->getAliases());

        $loader->alias('alias', 'stdClass');

        $this->assertEquals(array('bar' => 'baz', 'alias' => 'stdClass'), $loader->getAliases());
    }

    public function testAliasing()
    {
        // MockConcrete is definded in ./FrontageTest.php
        $loader = new AliasLoader(array('AliasName' => 'MockConcrete'));

        $loader->create('AliasName');

        $mock = new AliasName;

        $this->assertEquals('Foo', $mock->get());
    }

    public function testAutoLoader()
    {
        // MockConcrete is definded in ./FrontageTest.php
        $loader = new AliasLoader(array('MC' => 'MockConcrete'));

        $loader->makeAutoloader();

        $mock = new MC;

        $this->assertEquals('Foo', $mock->get());
    }

    public function testIsAutoloaded()
    {
        $loader = new AliasLoader;
        $loader->makeAutoloader();

        $this->assertTrue($loader->isAutoloader());
    }
}