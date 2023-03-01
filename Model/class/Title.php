<?php

namespace MyBook;

class Title {
    private int $_id;
    private string $_content;

    //Manufacturer
    public function __construct($id, $content) {
        $this->_id   = intval($id);
        $this->_content = $content;
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