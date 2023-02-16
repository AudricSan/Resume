<?php

namespace MyBook;

class City
{
    private int $_id;
    private string $_name;
    private int $_zip;
    private int $_country;

    //Manufacturer
    public function __construct($id, $name, $zip, $country)
    {
        $this->_id = intval($id);
        $this->_name = $name;
        $this->_zip = intval($zip);
        $this->_country = intval($country);
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