<?php

use MyBook\Education;
use MyBook\Env;

class EducationDAO extends Env {
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
        $this->table = "resume_Education"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data) {
        if (!$data) {
            return false;
        }

        return new Education(
            $data['Education_ID'],
            $data['Education_Name'],
            $data['Education_Start'],
            $data['Education_End'],
            $data['Education_School'],
            $data['Cities_name'],
            $data['Countries_Name'],
            $data['EducationLevel_Name']
        );
    }

    public function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN resume_educationlevel on Education_level = EducationLevel_Id INNER JOIN resume_cities on education_city = cities_id INNER JOIN resume_countries on cities_country = countries_id");
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
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE Education_ID = ? ");
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

        $citiesDAO = new CitiesDAO;
        $city      = $citiesDAO->fetch($data['_city']);

        $LEDAO = new EducationLevelDAO;
        $level = $LEDAO->fetch($data['_level']);

        $obj = $this->create_object([
            'Education_ID'        => 0,
            'Education_Name'      => $data['_name'],
            'Education_Start'     => $data['_start'],
            'Education_End'       => $data['_end'],
            'Education_School'    => $data['_school'],
            'Cities_name'         => $city->_name,
            'Countries_Name'      => $city->_country,
            'EducationLevel_Name' => $level->_name,
        ]);

        if ($obj) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (`Education_Name`, `Education_Start`, `Education_End`, `Education_School`, `Education_Level`, `Education_City`) VALUES (?, ?, ?, ?, ?, ?)");
                $statement->execute([
                    $obj->_name,
                    $obj->_start,
                    $obj->_end,
                    $obj->_school,
                    $level->_id,
                    $city->_id
                ]);

                $obj->id = $this->connection->lastInsertId();
            } catch (PDOException $e) {
                echo $e;
            }
        }

        header('location: /settings');
        die;
    }

// public function update($id, $data) {
// }
}