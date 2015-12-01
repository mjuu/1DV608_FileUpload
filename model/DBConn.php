<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-12-01
 * Time: 12:03
 */
namespace model;
class DBConn{
    private $pdo;
    public function conn(){
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAMEFILE;
        try {
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS);
            return $this->pdo;
        } catch (\PDOException $e) {
            exit('Connection error');
        }
    }

    public function getPublicFileList(){

        $sql = "SELECT * FROM ".DB_TABELLFILE;
        $query = $this->pdo->prepare($sql);
        $query->execute();
       return $results = $query->fetchAll();
    }

}