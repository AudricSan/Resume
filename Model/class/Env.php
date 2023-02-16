<?php
namespace MyBook;
class Env
{
    private $env = [
        //APP
        'APP_NAME' => 'MyBook',
        'APP_KEY' => '',
        'APP_VERSION' => '1.0.0',

        // DATABASE
        'DB_HOST' => 'localhost',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => '',
        'DB_NAME' => 'MyBook',
        'DB_PORT' => 3306,
    ];

    public function env($key, $default = null)
    {
        if ($key) {
            return $this->env[$key];
        } else {
            return $default;
        }
    }

    public function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
}
