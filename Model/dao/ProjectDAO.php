<?php

use MyBook\Project;
use MyBook\Env;
use MyBook\Technologies;

class ProjectDAO extends Env
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
        $this->table = "resume_project"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data)
    {
        if (!$data) {
            return false;
        }

        $obj = new Project(
            $data['Project_ID'],
            $data['Project_Name'],
            $data['Project_Description'],
            $data['Project_Link'],
            $data['Project_Icon'],
            array()
        );

        return $obj;
    }


    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $result) {
                $res[] = $this->create_object($result);
            }

            if (!empty($res)) {
                foreach ($res as $value) {
                    $TDAO    = new TechnologyUselDAO;
                    $technos = $TDAO->fetchByProject($value->_id);

                    foreach ($technos as $techno) {
                        $TDAO = new TechnologiesDAO;
                        $value->addTechnology($TDAO->fetch($techno->_techno));
                    }
                }

                return $res;
            }
            return false;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN resume_technologiesuse on project_id = technologiesuse_project INNER JOIN resume_technologies on technologiesuse_techno = technologies_id INNER JOIN resume_technologylevel on technologies_level = technologylevel_id WHERE project_id = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $res = $this->create_object($result);

            $TDAO    = new TechnologyUselDAO;
            $technos = $TDAO->fetchByProject($res->_id);

            foreach ($technos as $techno) {
                $TDAO = new TechnologiesDAO;
                $res->addTechnology($TDAO->fetch($techno->_techno));
            }

            // var_dump($res);
            return $res;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function store($data)
    {
        if (empty($data)) {
            $error[] = "No data Set";
            return false;
        }
        // var_dump($data);

        unset($_SESSION['error']);
        $error = [];

        $regex = '/techID=[0-9]+/i';
        $techs = [];
        foreach ($data as $key => $value) {
            if (preg_match($regex, $key)) {
                $techs[] = $value;
            }
        }

        foreach ($techs as $tech) {
            $TDAO     = new TechnologiesDAO;
            $techno[] = $TDAO->fetch($tech);
        }

        $obj = $this->create_object([
            'Project_ID'          => 0,
            'Project_Name'        => $data['_name'],
            'Project_Description' => $data['_description'],
            'Project_Link'        => $data['_link'],
            'Project_Icon'        => $data['_icon'],
        ]);

        $obj->addTechnology($techno);

        if ($obj) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (`Project_Name`, `Project_Link`, `Project_Description`, `Project_Icon`) VALUES (?,?,?,?)");
                $statement->execute([
                    $obj->_name,
                    $obj->_link,
                    $obj->_desc,
                    $obj->_icon,
                ]);

                $obj->_id = $this->connection->lastInsertId();

                $TUDAO = new TechnologyUselDAO;
                $TUDAO->store($obj, $techs);
            } catch (PDOException $e) {
                echo $e;
                die;
            }
        }

        header('location: /settings');
        die;
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
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE project_id = ? ");
                $statement->execute([$id]);

                $TUDAO = new TechnologyUselDAO;
                $TUDAO->delete($id);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
            header('location: /settings');
        }
    }

    public function update($id, $data)
    {
        if (empty($data)) {
            $error[] = "No data Set";
            return false;
        }

        unset($_SESSION['error']);
        $error = [];

        $regex = '/techID+/i';
        $techs = [];

        foreach ($data as $key => $value) {

            if (preg_match($regex, $key)) {
                $techs[] = $value;
            }
        }

        foreach ($techs[0] as $tech) {
            $TDAO     = new TechnologiesDAO;
            $techno[] = $TDAO->fetch($tech);
        }

        $obj = $this->create_object([
            'Project_ID'          => 0,
            'Project_Name'        => $data['_name'],
            'Project_Description' => $data['_desc'],
            'Project_Link'        => $data['_link'],
            'Project_Icon'        => $data['_icon'],
        ]);

        $obj->addTechnology($techno);

        if ($obj) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET `Project_Name` = ?, `Project_Link` = ?, `Project_Description` = ?, `Project_Icon` = ? WHERE `Project_id` = ?");
                $statement->execute([
                    $obj->_name,
                    $obj->_link,
                    $obj->_desc,
                    $obj->_icon,
                    $obj->_id
                ]);

                $TUDAO = new TechnologyUselDAO;
                $TUDAO->store($obj, $techs);
            } catch (PDOException $e) {
                echo $e;
            }
        }

        header('location: /settings');
        die;
    }
}
