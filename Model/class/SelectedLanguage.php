<?php

namespace MyBook;

class SelectedLanguage {
    private int $_id;
    private string $_language;
    private string $_level;

    //Manufacturer
    public function __construct($id, $name, $level) {
        $this->_id       = intval($id);
        $this->_language = $name;
        $this->_level    = $level;
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