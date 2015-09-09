<?php

namespace tests\tp2;

use tp2\Person;
use tp2\Enterprise;
use tp2\HRDepartment;
use tp2\Exception\AlreadyEmployedException;

class HRDepartmentTest extends \PHPUnit_Framework_TestCase
{
    protected $HRDepartment;
    protected $enterprise;

    public function setUp()
    {
        $this->enterprise = \Phake::mock('tp2\Enterprise');

        $this->HRDepartment = new HRDepartment($this->enterprise);
        
        \Phake::when($this->enterprise)->employ()->thenReturn(false);
    }

    public function testHire()
    {
        $person = new Person("Richard");

        $this->HRDepartment->hire($person); // pas d'exception

        \Phake::verify($this->enterprise)->add($person); // s'assure que hire() fait bien un add() de la personne        
    }

    public function testHireException()
    {
        $person = new Person("Richard");

        \Phake::when($this->enterprise)->employ()->thenReturn(true);

        $this->setExpectedException('AlreadyEmployedException', 'This person is already an employee');
        $this->HRDepartment->hire($person); // exception

    }

    public function testFire()
    {
        
    }

    public function testIsEmployee()
    {
        
    }
}