<?php

namespace MyBook;

class Education {
    private int $_id;
    private string $_name;
    private string $_start;
    private string $_end;
    private string $_school;
    private string $_city;
    private string $_country;
    private string $_level;

    //Manufacturer
    public function __construct($id, $name, $start, $end, $school, $city, $country, $level) {
        $this->_id      = intval($id);
        $this->_name    = $name;
        $this->_start   = $start;
        $this->_end     = $end;
        $this->_school  = $school;
        $this->_city    = $city;
        $this->_country = $country;
        $this->_level   = $level;
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