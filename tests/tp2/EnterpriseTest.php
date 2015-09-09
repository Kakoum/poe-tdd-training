<?php

namespace tests\tp2;

use tp2\Enterprise;
use tp2\Person;

class EnterpriseTest extends \PHPUnit_Framework_TestCase
{
    protected $enterprise;

    public function setUp()
    {
        $this->enterprise = new Enterprise();
    }

    public function testAdd()
    {
        $person = new Person("Richard");
        $this->enterprise->add($person);

        $this->assertEquals(true, $this->enterprise->employ($person));
    }

    public function testRemove()
    {
        $person = new Person("Richard");

        $this->enterprise->add($person);
        $this->assertEquals(true, $this->enterprise->employ($person));

        $this->enterprise->remove($person);
        $this->assertEquals(false, $this->enterprise->employ($person));
    }

    public function testEmploy()
    {
        $person = new Person("Richard");

        $this->assertEquals(false, $this->enterprise->employ($person)); // false car on l'a pas ajouté

        $this->enterprise->add($person);
        $this->assertEquals(true, $this->enterprise->employ($person)); // true car on vient de l'ajouter
    }
}