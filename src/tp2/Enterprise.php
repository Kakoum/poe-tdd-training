<?php

namespace tp2;

use tp2\Person;

class Enterprise
{
    protected $persons = array();

    public function add(Person $person)
    {
        $this->persons[spl_object_hash($person)] = $person;
    }

    public function remove(Person $personToRemove)
    {
        unset($this->persons[spl_object_hash($personToRemove)]);
    }

    /**
     * @return boolean
     */
    public function employ(Person $person)
    {
        return isset($this->persons[spl_object_hash($person)]) ? true : false;
    }
}