<?php

namespace MyBook;

class Env extends Uuid {
    private $env = [
        //APP
        'APP_NAME'    => 'Resume',
        'APP_KEY'     => 'dd1598c2-f974-5c95-9889-17304f6fc9d1',
        'APP_VERSION' => '0.0.1',

        // DATABASE
        'DB_HOST'     => 'localhost',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => 'root',
        'DB_NAME'     => 'resumedb',
        'DB_PORT'     => 3306,
    ];

    public function env($key, $default = null) {
        if ($key) {
            return $this->env[$key];
        } else {
            return $default;
        }
    }

    public function checkInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}