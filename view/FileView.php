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

    /**
     * FileView constructor.
     *
     */
    public function __construct(){
        $this->DBConn = new DBConn();
        $this->pdo= $this->DBConn->conn();
    }

    /**
     * Prints the private file list for the logged in user
     */
    public function showPrivateFileList(){
        echo '<H2>This is your private files</H1>';
        $list1 = $this->DBConn->getPrivateFileList();
        foreach ($list1 as $a) {
            $file = $a['file'];
            $type = $a['type'];
            $size = $a['size'];
            echo "File:"."<a href='" . $file . "'>$file</a>";
            echo "
                   Type: " . $type . "<br>
                   Size: " . $size . "<br>
                   <br>
            ";
        }
        return;
    }

    /**
     * Shows the public file list
     */
    public function showPublicFileList(){
        $list = $this->DBConn->getPublicFileList();
        foreach ($list as $a) {
            $file = $a['file'];
            $type = $a['type'];
            $size = $a['size'];
            echo "File:"."<a href='" . $file . "'>$file</a>";
            echo "
                   Type: " . $type . "<br>
                   Size: " . $size . "<br>
                   <br>
            ";
        }
        return;
    }

    /**
     * Prints message to the view if anny error occur
     * @param $msg
     */
    public function FileUploadEvent($msg){
        echo $msg;
    }
}