<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-12-01
 * Time: 11:56
 */
namespace view;
use model\DBConn;
require_once("model/DBConn.php");

class FileView{

    private $pdo;
    private $DBConn;
    public function __construct()
    {
        $this->DBConn = new DBConn();
       $this->pdo= $this->DBConn->conn();
    }

    public function showPrivateFileList(){
        echo "empty list".'<br>';
    }
    public function showPublicFileList(){
        $list = $this->DBConn->getPublicFileList();
        foreach ($list as $a) {
            $id = $a["id"];
            $file = $a['file'];
            $type = $a['type'];
            $size = $a['size'];
            //ID= ".$id."<br>
            echo "File:"."<a href='" . $file . "'>$file</a>";
            echo "
                   Type: " . $type . "<br>
                   Size: " . $size . "<br>
                   <br>
            ";
        }
        return;
    }

    public function FileUploadEvent($msg){
        echo $msg;
    }
}