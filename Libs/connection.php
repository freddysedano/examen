<?php

namespace Libs;

class Connection
{
    private $host;
    private $username;
    private $password;
    private $db;
    private $pdo=null;
    private static $_instance = null;
    private function __construct()
    {
        $this->host =env('DB_HOST');
        $this->username =env('DB_USERNAME');
        $this->password =env('DB_PASSWORD');
        $this->db =env('DB_DATABASE');
        $this->connect();
    }
    public static function getInstance()
    { //patron singilton
        if (self::$_instance==null) {
            self::$_instance=new Connection();
        }
        return self::$_instance;
    }
    public function connect()
    {
        try {
            $options =array(
                \PDO::ATTR_PERSISTENT=>false,
                \PDO::ATTR_EMULATE_PREPARES=>false,
                \PDO::ATTR_ERRMODE=> \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'",
            );
            $dsn =  "mysql:host={$this->host}; dbname={$this->db}";
            $this->pdo= new \PDO(
                $dsn,
                $this->username,
                $this->password,
                $options
            );
        } catch (\PDOException $e) {
            myEcho ("error de connec". $e->getMessage());
            throw $e;
        }
    }
    public function getConnection()
    {
        return $this->pdo;
    }
}