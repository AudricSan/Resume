<?php

use MyBook\Admin;
use MyBook\Env;

class AdminDAO extends Env
{
    //DON'T TOUCH IT, LITTLE PRICK
    private array $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    private string $username;
    private string $password;
    private string $host;
    private string $dbname;
    private string $table;
    private object $connection;

    public function __construct()
    {
        // Change the values according to your hosting IN ENV FILES!.
        $this->username = parent::env('DB_USERNAME', 'root');
        $this->password = parent::env('DB_PASSWORD', '');
        $this->host = parent::env('DB_HOST', 'localhost');
        $this->dbname = parent::env('DB_NAME');
        //
        $this->table = "admin"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data)
    {
        if (!$data) {
            return false;
        }

        return new Admin(
            $data['Admin_ID'],
            $data['Admin_Name'],
            $data['Admin_Email'],
            $data['Admin_Password']
        );
    }

    public function validate($id, $uuid)
    {
        if (!$id) {
            return false;
        }

        $toValidate = $this->fetch($id);
        if (!$toValidate) {
            return false;
        }

        $userUUID = parent::v5($toValidate->_name);
        if ($uuid !== $userUUID) {
            return false;
        }

        return true;
    }

    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            // $admins = array();
            foreach ($results as $result) {
                array_push($admins, $this->create_object($result));
            }

            return $admins;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE Admin_ID = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create_object($result);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function login($data)
    {
        $error = [];

        if (!isset($data)) {
            $error[] = "No Data Set";
        }

        if (empty($data['login']) || empty($data['pass'])) {
            $error[] = "Not Login Or Passowrd Set";
        }

        if (isset($error) && !empty($error)) {
            goto error;
        }

        $existAdmin = $this->fetchByMail($data['login']);
        if (!$existAdmin) {
            $error[] = "Not Exist";
            goto error;
        }

        $pass = $data['pass'];
        $dbpass = $existAdmin->_password;

        if (!password_verify($pass, $dbpass)) {
            $error[] = "Not Not Good Pass Or User Not Exist";
            goto error;
        }

        $_SESSION['logged'] = $existAdmin->_id;
        header('location: /admin');
        return true;

        error:
        $_SESSION['error'] = $error;
        header('location: /admin/login');
    }
    
    public function disconnect()
    {
        unset($_SESSION['logged']);
        unset($_SESSION['uuid']);
        header('location: /');
    }

    public function delete($id){}

    public function store($data){}

    public function update($id, $data){}
}