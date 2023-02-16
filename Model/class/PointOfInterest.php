<?php

namespace MyBook;

class PointOfInterest
{
    private int $_id;
    private string $_name;
    private string $_icon;

    //Manufacturer
    public function __construct($id, $name, $icon)
    {
        $this->_id = intval($id);
        $this->_name = $name;
        $this->_icon = $icon;
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