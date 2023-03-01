<?php

use MyBook\PointOfInterest;
use MyBook\Env;

class PointOfInterestDAO extends Env {
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
        $this->table = "resume_pointOfInterest"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data) {
        if (!$data) {
            return false;
        }

        return new PointOfInterest(
            $data['PointOfInterest_ID'],
            $data['PointOfInterest_Name'],
            $data['PointOfInterest_Icon']
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

    // public function fetch($id) {
    // }

    public function store($data) {
        if (empty($data)) {
            $error[] = "No data Set";
            return false;
        }

        unset($_SESSION['error']);
        $error = [];

        $obj = $this->create_object([
            'PointOfInterest_ID'   => 0,
            'PointOfInterest_Name' => $data['_name'],
            'PointOfInterest_Icon' => $data['_icon']

        ]);

        if ($obj) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (`PointOfInterest_Name`, `PointOfInterest_Icon`) VALUES (?, ?)");
                $statement->execute([
                    $obj->_name,
                    $obj->_icon,
                ]);

                $obj->id = $this->connection->lastInsertId();
            } catch (PDOException $e) {
                echo $e;
            }
        }

        header('location: /settings');
        die;
    }

    public function delete($id) {
        $adminDAO       = new AdminDAO;
        $adminConnected = $adminDAO->validate($_SESSION['logged'], $_SESSION['uuid']);

        if (!$adminConnected) {
            unset($_SESSION['logged']);
            header('location: /');
            die;
        } else {
            $id = intval($id['id']);

            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pointofinterest_id = ? ");
                $statement->execute([$id]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }

            header('location: /settings');
            die;
        }
    }

// public function update($id, $data){}
}