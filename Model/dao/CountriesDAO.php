<?php

use MyBook\Country;
use MyBook\Env;

class CountriesDAO extends Env {
    //DON'T TOUCH IT, LITTLE PRICK
    private array $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    private string $username;
    private string $password;
    private string $host;
    private string $dbname;
    private string $table;
    private object $connection;

    public function __construct() {
        // Change the values according to your hosting IN ENV FILES!.
        $this->username = parent::env('DB_USERNAME', 'root');
        $this->password = parent::env('DB_PASSWORD', '');
        $this->host     = parent::env('DB_HOST', 'localhost');
        $this->dbname   = parent::env('DB_NAME');
        //
        $this->table = "resume_country"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data) {
        if (!$data) {
            return false;
        }

        return new Country(
            $data['id'],
            $data['name']
        );
    }

    public function fetchAll() {
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

    // public function fetch($id) {
    // }

    // public function delete($id) {
    // }

    // public function store($data) {
    // }

    // public function update($id, $data) {
    // }
}