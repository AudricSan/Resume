<?php

namespace MyBook;

class WorkExperience
{

	private int $_id;
    private string $_name;
    private string $_description;
    private string $_icon;
    private int $_city;

    //Manufacturer
    public function __construct($id, $name, $desc, $icon, $city)
    {
        $this->_id = intval($id);
        $this->_name = $name;
        $this->_desc = $desc;
        $this->_icon = $icon;
        $this->_city = $city;
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