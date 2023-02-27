<?php

use MyBook\TechnologyUse;
use MyBook\Env;

class TechnologyUselDAO extends Env {
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
        $this->table = "technologiesUse"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data) {
        if (!$data) {
            return false;
        }

        return new TechnologyUse(
            $data['TechnologiesUse_id'],
            $data['TechnologiesUse_project'],
            $data['TechnologiesUse_techno']
        );
    }

    public function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $res = array();
            foreach ($results as $result) {
                array_push($res, $this->create_object($result));
            }

            return $res;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetchByProject($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE TechnologiesUse_project = ?");
            $statement->execute([$id]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $res = array();
            foreach ($results as $result) {
                array_push($res, $this->create_object($result));
            }

            return $res;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetchByTechno($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE TechnologiesUse_techno = ?");
            $statement->execute([$id]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $res = array();
            foreach ($results as $result) {
                array_push($res, $this->create_object($result));
            }

            return $res;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function store($project, $data) {
        if (empty($data)) {
            $error[] = "No data Set";
            return false;
        }

        if ($this->delete($project->_id)) {
            foreach ($data as $value) {
                try {
                    $statement = $this->connection->prepare("INSERT INTO {$this->table} (`TechnologiesUse_project`, `TechnologiesUse_techno`) VALUES (?, ?)");

                    $statement->execute([
                        $project->_id,
                        $value
                    ]);
                } catch (PDOException $e) {
                    echo $e;
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE `TechnologiesUse_project` = ?");
            $statement->execute([
                $id
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

// public function update($id, $data) {
// }
}