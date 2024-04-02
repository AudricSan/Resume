<?php

use MyBook\Technologies;
use MyBook\Env;

class TechnologiesDAO extends Env
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
        $this->host     = parent::env('DB_HOST', 'localhost');
        $this->dbname   = parent::env('DB_NAME');
        //
        $this->table = "resume_technologies"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data)
    {
        if (!$data) {
            return false;
        }

        return new Technologies(
            $data['technologies_ID'],
            $data['technologies_Name'],
            $data['technologies_Description'],
            $data['technologies_Icon'],
            $data['Level_Name']
        );
    }

    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN resume_technologylevel on technologies_level = technologylevel_id");
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

    public function fetch($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN resume_technologylevel on technologies_level = technologylevel_id WHERE Technologies_id = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create_object($result);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function delete($id)
    {
        $adminDAO       = new AdminDAO;
        $adminConnected = $adminDAO->validate($_SESSION['logged'], $_SESSION['uuid']);

        if (!$adminConnected) {
            unset($_SESSION['logged']);
            header('location: /');
            die;
        } else {
            $id = intval($id['id']);

            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE technologies_id = ? ");
                $statement->execute([$id]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
            header('location: /settings');
        }
    }

    public function store($data)
    {
        if (empty($data)) {
            $error[] = "No data Set";
            return false;
        }

        unset($_SESSION['error']);
        $error = [];

        $TechLevelDAO = new TechnologyLevelDAO;
        $TechLevel    = $TechLevelDAO->fetch($data['_level']);

        $obj = $this->create_object([
            'technologies_ID'          => 0,
            'technologies_Name'        => $data['_name'],
            'technologies_Description' => $data['_description'],
            'technologies_Icon'        => $data['_icon'],
            'Level_Name'               => $TechLevel->_name
        ]);

        if ($obj) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (technologies_Name, technologies_Description, technologies_Icon, technologies_Level	) VALUES (?, ?, ?, ?)");

                $statement->execute([
                    $obj->_name,
                    $obj->_desc,
                    $obj->_icon,
                    $TechLevel->_id
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

    public function update($id, $data) {
        if (empty($data)) {
            $error[] = "No data Set";
            return false;
        }

        unset($_SESSION['error']);
        $error = [];

        $TechLevelDAO = new TechnologyLevelDAO;
        $TechLevel    = $TechLevelDAO->fetch($data['_Level']);

        $obj = $this->create_object([
            'technologies_ID'          => $id,
            'technologies_Name'        => $data['_name'],
            'technologies_Description' => $data['_desc'],
            'technologies_Icon'        => $data['_icon'],
            'Level_Name'               => $TechLevel->_name
        ]);

        if ($obj) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET technologies_Name = ?, technologies_Description = ?, technologies_Icon = ?, technologies_Level = ? WHERE `technologies_id` = ?");
                $statement->execute([
                    $obj->_name,
                    $obj->_desc,
                    $obj->_icon,
                    $TechLevel->_id,
                    $obj->_id
                ]);
            } catch (PDOException $e) {
                echo $e;
            }
        }

        header('location: /settings');
        die;
    }
}
