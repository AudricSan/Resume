<?php

namespace MyBook;

class School
{
    private int $_id;
    private string $_name;
    private int $_city;
    //Manufacturer
    public function __construct($id, $name, $city)
    {$
        $this->_id = intval($id);
        $this->_name = $name;
        $this->_city = intval($city);
    }

    //SUPER SETTER
    public function __set($prop, $value)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop = $value;
        }
    }


    //SUPER GETTER
    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
}