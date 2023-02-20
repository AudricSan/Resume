<?php

use MyBook\WorkExperience;
use MyBook\Env;

class WorkExperienceDAO extends Env {
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
        $this->table = "WorkExperience"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data) {
        if (!$data) {
            return false;
        }

        return new WorkExperience(
            $data['WorkExperience_ID'],
            $data['WorkExperience_Name'],
            $data['WorkExperience_Description'],
            $data['WorkExperience_Icon'],
            $data['Cities_name'],
            $data['Countries_Name'],
            $data['WorkExperience_Start'],
            $data['WorkExperience_End']
        );
    }

    public function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN cities on {$this->table}_city = cities_id INNER JOIN countries on cities_country = countries_id");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $WorkExperiences = array();
            foreach ($results as $result) {
                array_push($WorkExperiences, $this->create_object($result));
            }

            return $WorkExperiences;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE WorkExperience_ID = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create_object($result);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function delete($id) {
    }

    public function store($data) {
    }

    public function update($id, $data) {
    }
}