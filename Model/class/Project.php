<?php

namespace MyBook;

class Project {
    private int $_id;
    private string $_name;
    private string $_desc;
    private string $_link;
    private string $_icon;
    private $_techno;

    //Manufacturer
    public function __construct($id, $name, $desc, $link, $icon, $techno) {
        $this->_id     = intval($id);
        $this->_name   = $name;
        $this->_desc   = $desc;
        $this->_link   = $link;
        $this->_icon   = $icon;
        $this->_techno = $techno;
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

    public function addTechnology($value) {
        $this->_techno[] = $value;
    }
}