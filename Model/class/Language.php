<?php

namespace MyBook;

class Language {
    private int $_id;
    private string $_name;
    private string $_tag;

    //Manufacturer
    public function __construct($id, $name, $tag) {
        $this->_id   = intval($id);
        $this->_name = $name;
        $this->_tag  = $tag;
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