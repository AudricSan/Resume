<?php

use MyBook\Env;
use MyBook\SelectedLanguage;

class SelectedLanguageDAO extends Env
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
        $this->table = "resume_selectedlanguage"; // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create_object($data)
    {
        if (!$data) {
            return false;
        }

        return new SelectedLanguage(
            $data['SelectedLanguage_id'],
            $data['Language_Name'],
            $data['LanguageLevel_Name']
        );
    }

    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN resume_language on SelectedLanguage_Language = language_id INNER JOIN resume_languagelevel on SelectedLanguage_Level = LanguageLevel_ID");
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

    public function fetchByLanguage($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} INNER JOIN resume_language on SelectedLanguage_Language = language_id INNER JOIN resume_languagelevel on SelectedLanguage_Level = LanguageLevel_ID WHERE SelectedLanguage_Language = ? ");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create_object($result);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetchByLevel($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE SelectedLanguage_Level = ?");
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $this->create_object($result);
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

        unset($_SESSION['error']);
        $error = [];

        $levelDAO = new LanguageLevelDAO;
        $level    = $levelDAO->fetch($data['_level']);

        $language = new LanguageDAO;
        $lang     = $language->fetch($data['_language']);

        var_dump($data);
        $obj = $this->create_object([
            'SelectedLanguage_id' => 0,
            'Language_Name'       => $lang->_name,
            'LanguageLevel_Name'  => $level->_name,
        ]);

        $SLDAO = new SelectedLanguageDAO;
        $sl    = $SLDAO->fetchByLanguage($lang->_id);

        if ($sl) {
            $error = ['ALREADY EXIST'];
            header('location: /settings');
            die;
        }

        if ($obj) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (SelectedLanguage_Language, SelectedLanguage_Level) VALUES (?,?)");

                $statement->execute([
                    $lang->_id,
                    $level->_id
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

    public function delete($id)
    {
        $adminDAO       = new AdminDAO;
        $adminConnected = $adminDAO->validate($_SESSION['logged'], $_SESSION['uuid']);

        if (!$adminConnected) {
            unset($_SESSION['logged']);
            header('location: /');
            die;
        } else {
            $id = intval($id);

            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE SelectedLanguage_id = ? ");
                $statement->execute([$id]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
            header('location: /settings');
            die;
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

        $adminDAO       = new AdminDAO;
        $adminConnected = $adminDAO->validate($_SESSION['logged'], $_SESSION['uuid']);

        if (!$adminConnected) {
            unset($_SESSION['logged']);
            header('location: /');
            die;
        } else {
            $id = intval($id);

            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE SelectedLanguage_id = ? ");
                $statement->execute([$id]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
        }

        $levelDAO = new LanguageLevelDAO;
        $level    = $levelDAO->fetch($data['_level']);

        $language = new LanguageDAO;
        $lang     = $language->fetchByName($data['_language']);

        try {
            $statement = $this->connection->prepare("INSERT INTO {$this->table} (SelectedLanguage_Language, SelectedLanguage_Level) VALUES (?,?)");

            $statement->execute([
                $lang->_id,
                $level->_id
            ]);
        } catch (PDOException $e) {
            echo $e;
            die;
        }

        header('location: /settings');
        die;
    }
}
