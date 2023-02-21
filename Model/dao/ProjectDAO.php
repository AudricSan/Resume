<?php

use MyBook\Project;
use MyBook\Env;
use MyBook\Technologies;

class ProjectDAO extends Env {
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
        $this->table = "project"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data) {
        if (!$data) {
            return false;
        }

        $projects = array();
        foreach ($data as $result) {
            $projectId = $result['Project_ID'];

            if (!isset($projects[$projectId])) {
                $project = new Project(
                    $result['Project_ID'],
                    $result['Project_Name'],
                    $result['Project_Description'],
                    $result['Project_Link'],
                    $result['Project_Icon'],
                    array()
                );

                $projects[$projectId] = $project;
            }

            $technology = new Technologies(
                $result['technologies_ID'],
                $result['technologies_Name'],
                $result['technologies_Description'],
                $result['technologies_Icon'],
                $result['Level_Name']
            );

            $projects[$projectId]->addTechnology($technology);
        }

        return $projects;
    }

    public function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN technologiesuse on {$this->table}_id = technologiesuse_project INNER JOIN technologies on technologiesuse_techno = technologies_id INNER JOIN technologylevel on technologies_level = technologylevel_id");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $res = $this->create_object($results);
            return $res;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN technologiesuse on {$this->table}_id = technologiesuse_project INNER JOIN technologies on technologiesuse_techno = technologies_id INNER JOIN technologylevel on technologies_level = technologylevel_id WHERE project_id = ?");
            $statement->execute([$id]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $res = $this->create_object($results);
            return $res;
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