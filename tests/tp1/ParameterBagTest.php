<?php

namespace tests\tp1;

use tp1\ParameterBag;

class ParameterBagTest extends \PHPUnit_Framework_TestCase
{
    protected $bag;

    public function setUp()
    {
        $this->bag = new ParameterBag(array(
            'foo' => 'bar', 
            'key1' => 'value1', 
            'key2' => 'value2', 
            'key3' => '4value3'
        ));
    }

    public function testCount()
    {
        // will pass
        $this->assertEquals(4, $this->bag->count());
    }

    public function testGet()
    {
        // will pass
        $this->assertEquals('bar', $this->bag->get('foo'));

        // default
        $this->assertEquals(null, $this->bag->get('pony'));

        // return second parameter
        $this->assertEquals('pwet', $this->bag->get('pony', 'pwet'));

        // will fail
        // $this->assertEquals('lol', $bag->get('foo'));
    }

    public function testGetInt()
    {
        // will pass
        $this->assertSame(0, $this->bag->getInt('foo'));

        $this->assertSame(4, $this->bag->getInt('key3'));

        // default = 666
        $this->assertSame(666, $this->bag->getInt('pony', 666));

    }

    public function testSet()
    {
        $this->bag->set('foo', 'hello');
        // will pass
        $this->assertEquals('hello', $this->bag->get('foo'));
    }

    public function testHas()
    {
        $this->assertEquals(true, $this->bag->has('key1'));
        $this->assertEquals(false, $this->bag->has('key27'));
    }

    public function testRemove()
    {
        $this->bag->remove('key1');

        // est-ce que c'est remove
        $this->assertEquals(true, $this->bag->has('key1'));

        // elle doit exister
        $this->assertEquals(true, $this->bag->has('key2'));
    }

    public function testAll()
    {
        $this->assertEquals(array(
            'foo' => 'bar', 
            'key1' => 'value1', 
            'key2' => 'value2', 
            'key3' => '4value3'
        ), $this->bag->all());
    }

    public function testKeys()
    {
        $this->assertEquals(array(
            'foo', 
            'key1', 
            'key2', 
            'key3'
        ), $this->bag->keys());
    }

    public function testAdd()
    {
        $this->bag->add(array(
            'foo' => 'barModify', 
            'key1' => 'value1Modify'
        ));

        $this->assertEquals(array(
            'foo' => 'barModify', 
            'key1' => 'value1Modify', 
            'key2' => 'value2', 
            'key3' => '4value3'
        ), $this->bag->all());
    }
}
