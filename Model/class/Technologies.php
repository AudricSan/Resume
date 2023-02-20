<?php

namespace MyBook;

class Technologies
{

    private int $_id;
    private string $_name;
    private string $_desc;
    private string $_icon;
    private string $_level;

    //Manufacturer
    public function __construct($id, $name, $desc, $icon, $level)
    {
        $this->_id = intval($id);
        $this->_name = $name;
        $this->_desc = $desc;
        $this->_icon = $icon;
        $this->_level = $level;
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