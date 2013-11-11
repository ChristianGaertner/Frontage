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

    public function testFactoryAndImplements()
    {
        $this->assertInstanceOf('DaGardner\Frontage\ArrayCase', ArrayCase::make());
        $this->assertInstanceOf('Countable', new ArrayCase);
        $this->assertInstanceOf('IteratorAggregate', new ArrayCase);
        $this->assertInstanceOf('ArrayAccess', new ArrayCase);
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

    public function testMerge()
    {
        $c = ArrayCase::make(array('foo' => 'bar'));
        $c->merge(array('baz' => 'qux'));

        $this->assertEquals(array('foo' => 'bar', 'baz' => 'qux'), $c->all());

        $c = ArrayCase::make(array('foo' => 'bar'));
        $c2 = ArrayCase::make(array('baz' => 'qux'));

        $c->merge($c2);

        $this->assertEquals(array('foo' => 'bar', 'baz' => 'qux'), $c->all(), 'You should be able to merge 2 ArrayCase instances');
    }

    public function testGetKeys()
    {
        $c = ArrayCase::make(array('foo' => 'bar', 'baz' => 'qux'));

        $this->assertEquals(array('foo', 'baz'), $c->keys());
    }

    public function testPush()
    {
        $c = ArrayCase::make(array('foo', 'bar'));

        $c->push('baz');

        $this->assertEquals('baz', $c->last());
    }

    public function testCallbackOnEach()
    {
        $array = array('foo', 'bar', 'baz');
        
        $c = ArrayCase::make($array);

        $test = array();

        $c->each(function($value) use (&$test)
        {
            $test[] = $value;
        });

        $this->assertEquals($array, $test);

        $this->assertInstanceOf('DaGardner\Frontage\ArrayCase', $c->each(function() {}));
    }

    public function testJSONConversation()
    {
        $c = ArrayCase::make(array('foo' => 'bar'));

        $this->assertEquals('{"foo":"bar"}', $c->json());
    }

    public function testStringConversation()
    {
        $c = ArrayCase::make(array('foo' => 'bar'));

        $this->assertEquals('{"foo":"bar"}', (string) $c);
    }

    public function testCounting()
    {
        $this->assertEquals(1, count(ArrayCase::make(array('foo'))));
    }

    public function testIteratingOverCase()
    {
        $array = array('foo' => 'Foo', 'bar' => 'Bar', 'baz' => 'Baz'); 
        $c = ArrayCase::make($array);
        $test = array();

        foreach ($c as $key => $value) {
            $test[$key] = $value;
        }

        $this->assertEquals($array, $test);
    }

    public function testArrayAccess()
    {
        $c = ArrayCase::make();

        $c['key'] = 'value';

        $this->assertEquals('value', $c['key']);
        $this->assertTrue(isset($c['key']));

        $c['unset'] = 'me';

        unset($c['unset']);

        $this->assertFalse($c->has('unset'));
    }
}