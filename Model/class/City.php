<?php

namespace MyBook;

class City {
    private int $_id;
    private string $_name;
    private string $_region;
    private string $_country;

    //Manufacturer
    public function __construct($id, $name, $region, $country) {
        $this->_id      = intval($id);
        $this->_name    = $name;
        $this->_region  = $region;
        $this->_country = $country;
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