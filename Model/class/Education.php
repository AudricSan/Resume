<?php

namespace MyBook;

class Education
{
    private int $_id;
    private string $_name;
    private string $_start;
    private string $_end;
    private int $_school;
    private int $_level;

    //Manufacturer
    public function __construct($id, $name, $start, $end, $school, $level)
    {
        $this->_id = intval($id);
        $this->_name = $name;
        $this->_start = $start;
        $this->_end = $end;
        $this->_school = intval($school);
        $this->_level = intval($level);
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