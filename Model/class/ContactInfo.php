<?php

namespace MyBook;

class ContactInfo {
    private int $_id;
    private string $_name;
    private string $_icon;
    private string $_link;

    //Manufacturer
    public function __construct($id, $name, $icon, $link) {
        $this->_name = $name;
        $this->_icon = $icon;
        $this->_link = $link;
        $this->_id   = intval($id);
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