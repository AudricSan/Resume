<?php

use MyBook\School;
use MyBook\Env;
use MyBook\Title;

class TitlelDAO extends Env {
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
        $this->table = "Title"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data) {
        if (!$data) {
            return false;
        }

        return new Title(
            $data['Title_id'],
            $data['Title_info']
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

    public function fetch($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE School_ID = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create_object($result);
        } catch (PDOException $e) {
            var_dump($e);
        }
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
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE title_id = ? ");
                $statement->execute([$id]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
            header('location: /settings');
            die;
        }
    }

    public function store($data) {
        if (empty($data)) {
            $error[] = "No data Set";
            return false;
        }

        unset($_SESSION['error']);
        $error = [];

        var_dump($data);

        $obj = $this->create_object([
            'Title_id' => 0,
            'Title_info'       => $data['_title']
        ]);

        if ($obj) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (title_info) VALUES (?)");

                $statement->execute([
                    $obj->_content,
                ]);

                $obj->id = $this->connection->lastInsertId();
            } catch (PDOException $e) {
                echo $e;
                die;
            }
        }

        header('location: /settings');
        die;
    }

// public function update($id, $data){}
}