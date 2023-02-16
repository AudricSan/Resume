<?php

namespace MyBook;

class Country
{
    private int $_id;
    private string $_name;

    //Manufacturer
    public function __construct($id, $name)
    {
        $this->_id = intval($id);
        $this->_name = $name;
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