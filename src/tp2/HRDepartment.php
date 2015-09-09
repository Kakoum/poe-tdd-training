<?php

namespace tp2;

use tp2\Person;
use tp2\Enterprise;
use tp2\Exception\AlreadyEmployedException;

class HRDepartment
{
    protected $enterprise;

    public function __construct(Enterprise $enterprise)
    {
        $this->enterprise = $enterprise;
    }

    /**
     * @throws \tp2\Exception\AlreadyEmployedException When the given person is already an employee
     */
    public function hire(Person $person)
    {
        if($this->enterprise->employ($person))
        {
            throw new AlreadyEmployedException("This person is already an employee");
        }
        else
        {
            $this->enterprise->add($person);
        }
    }

    /**
     * @throws \tp2\Exception\NoEmployedException When the given person is not an employee
     */
    public function fire(Person $person)
    {
        // TO IMPLEMENT
    }

    /**
     * @return boolean
     */
    public function isEmployee(Person $person)
    {
        // TO IMPLEMENT
    }
}