<?php
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework Tests
 * License: View distributed LICENSE file
 *
 * 
 * This file is meant to be used in PHPUnit Tests
 */

use DaGardner\Frontage\ArrayCase;

/**
* PHPUnit Test
*/
class ArrayCaseTest extends PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        $this->assertInstanceOf('DaGardner\Frontage\ArrayCase', ArrayCase::make());
    }

    public function testArrayInitializationAndGetArray()
    {
    	$c = ArrayCase::make(array('foo' => 'bar'));

    	$this->assertEquals(array('foo' => 'bar'), $c->getArray());
    	$this->assertEquals(array('foo' => 'bar'), $c->all());
    }

    public function testGet()
    {
    	$c = ArrayCase::make(array('foo' => 'bar'));

    	$this->assertEquals('bar', $c->get('foo'));

    	$this->assertFalse($c->get('NONE', false));

    	$this->assertTrue($c->get('NONE', true));
    }

    public function testGetFirst()
    {
    	$c = ArrayCase::make(array('foo', 'bar'));

    	$this->assertEquals('foo', $c->first());
    }

    public function testGetLast()
    {
    	$c = ArrayCase::make(array('foo', 'bar'));

    	$this->assertEquals('bar', $c->last());
    }

    public function testShift()
    {
    	$c = ArrayCase::make(array('foo', 'bar'));

    	$this->assertEquals('foo', $c->shift());
    	$this->assertEquals(array('bar'), $c->all());
    }

    public function testPop()
    {
    	$c = ArrayCase::make(array('foo', 'bar'));

    	$this->assertEquals('bar', $c->pop());
    	$this->assertEquals(array('foo'), $c->all());
    }

    public function testUnshift()
    {
    	$c = ArrayCase::make(array('foo', 'bar'));

    	$this->assertInstanceOf('DaGardner\Frontage\ArrayCase', $c->prepend('baz'));
    	$this->assertEquals(array('baz', 'foo', 'bar'), $c->all());
    }

    public function testPut()
    {
    	$c = ArrayCase::make();

    	$this->assertTrue($c->put('foo', 'bar'));
    	$this->assertEquals(array('foo' => 'bar'), $c->all());

    	$this->assertFalse($c->put('foo', 'baz'));
    	$this->assertEquals(array('foo' => 'bar'), $c->all());

    	$this->assertTrue($c->put('foo', 'baz', true));
    	$this->assertEquals(array('foo' => 'baz'), $c->all());
    }

    public function testHas()
    {
    	$c = ArrayCase::make();

    	$this->assertFalse($c->has('foo'));
    	
    	$c->put('foo', 'bar');

    	$this->assertTrue($c->has('foo'));
    }

    public function testRemove()
    {
    	$c = ArrayCase::make(array('foo' => 'bar'));

    	$this->assertInstanceOf('DaGardner\Frontage\ArrayCase', $c->remove('foo'));

    	$this->assertEquals(array(), $c->all());
    }
}