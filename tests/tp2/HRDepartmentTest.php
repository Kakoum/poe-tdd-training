<?php

namespace tests\tp2;

use tp2\Person;
use tp2\Enterprise;
use tp2\HRDepartment;
use tp2\Exception\AlreadyEmployedException;
use tp2\Exception\NoEmployedException;

class HRDepartmentTest extends \PHPUnit_Framework_TestCase
{
    protected $HRDepartment;
    protected $enterprise;
    protected $person;

    public function setUp()
    {
        $this->person = new Person("Richard");
        $this->enterprise = \Phake::mock('tp2\Enterprise');

        $this->HRDepartment = new HRDepartment($this->enterprise);
        
        \Phake::when($this->enterprise)->employ($this->person)->thenReturn(false);
    }

    public function testHire()
    {
        $this->HRDepartment->hire($this->person); // pas d'exception

        \Phake::verify($this->enterprise)->add($this->person); // s'assure que hire() fait bien un add() de la personne        
    }

    /**
     * @expectedException \tp2\Exception\AlreadyEmployedException
     */
    public function testHireException()
    {
        \Phake::when($this->enterprise)->employ($this->person)->thenReturn(true);

        $this->HRDepartment->hire($this->person); // exception

    }

    public function testFire()
    {
        \Phake::when($this->enterprise)->employ($this->person)->thenReturn(true);

        $this->HRDepartment->fire($this->person); // pas d'exception

        \Phake::verify($this->enterprise)->remove($this->person); // s'assure que fire() fait bien un remove() de la personne   
    }

    /**
     * @expectedException \tp2\Exception\NoEmployedException
     */
    public function testFireException()
    {
        $this->HRDepartment->fire($this->person); // exception
    }

    public function testIsEmployee()
    {
        \Phake::when($this->enterprise)->employ($this->person)->thenReturn(true);
        $this->assertEquals(true, $this->HRDepartment->isEmployee($this->person));
    }
}