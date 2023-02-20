<?php

namespace MyBook;

class WorkExperience {

    private int $_id;
    private string $_name;
    private string $_description;
    private string $_icon;
    private string $_city;
    private string $_country;
    private string $_start;
    private string $_end;

    //Manufacturer
    public function __construct($id, $name, $desc, $icon, $city, $country, $start, $end) {
        $this->_id          = intval($id);
        $this->_name        = $name;
        $this->_description = $desc;
        $this->_icon        = $icon;
        $this->_city        = $city;
        $this->_country     = $country;
        $this->_start       = $start;
        $this->_end         = $end;
    }

    //SUPER SETTER
    public function __set($prop, $value) {
        if (property_exists($this, $prop)) {
            return $this->$prop = $value;
        }
    }


    //SUPER GETTER
    public function __get($prop) {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
}