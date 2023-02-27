<?php

namespace MyBook;

class TechnologyUse {
    private int $_id;
    private int $_project;
    private int $_techno;

    //Manufacturer
    public function __construct($id, $project, $techno) {
        $this->_id   = intval($id);
        $this->_project = intval($project);
        $this->_techno = intval($techno);
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