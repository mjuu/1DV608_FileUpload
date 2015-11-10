<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-11-03
 * Time: 14:08
 */
namespace model;

use view\UploadView;

class FileDAL
{

    private $pdo;
    private $file = '';
    private $filetype = '';
    private $fileSize = '';
    private $filePath = "uploads/";

    public function __construct(){

        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        try {
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            exit('Connection error');
        }

    }

    public function fileUpload(){

        $upView = new UploadView();
        $this->fileSize =$_FILES[$upView->getFile()]['size'];
        $this->filetype = $_FILES[$upView->getFile()]["type"];
        $this->file =$this->filePath.($_FILES[$upView->getFile()]['name']);

        if ($_FILES[$upView->getFile()]['size'] < 10000000) {
            if ($_FILES[$upView->getFile()]["type"] == "image/png" || "image/jpg" || "image/jpeg") {
                if ($_FILES[$upView->getFile()]["error"] == 0) {
                    $filePath = "uploads/";
                  //  $filePathToSLQTable = $filePath.($_FILES[$upView->getFile()]['name']);
                    $filePath = $filePath . basename($_FILES[$upView->getFile()]['name']);

                    if (move_uploaded_file($_FILES[$upView->getFile()]['tmp_name'], $filePath)) {
                        echo "The file " . basename($_FILES[$upView->getFile()]['name']) . " was uploaded successfully.";
                        echo '<p>'.$this->file;
                        echo '<p>'.$this->filetype;
                        echo '<p>'.$this->fileSize;
                        $this->uploadSQL();
                    } else {
                        echo "A problem occurred while uploading your file, please try again.";
                    }
                } else {
                    echo "Something went wrong...";
                }
            } else {
                echo "Wrong filetype..";
            }
        } else {
            echo "File is to large";
        }

    }

    public function uploadSQL(){
        //$file = 'testfile';
        //$filetype = 'exe';
        //$fileSize = 14;
        //$sql = "INSERT INTO file_uploads(id,file,type,size) VALUES('' ,:file,:filetype,:filesize)";
        $sql = "INSERT INTO " . DB_TABELL . "(id,file,type,size) VALUES('' ,:file,:filetype,:filesize)";

        $query = $this->pdo->prepare($sql);
        $query->bindParam(':file', $this->file);
        $query->bindParam(':filetype', $this->filetype);
        $query->bindParam(':filesize', $this->fileSize);
        echo "Query is sending";
        return $query->execute();
    }

    public function showTabell()
    {
        $sql = "SELECT * FROM ".DB_TABELL;
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $results = $query->fetchAll();

        foreach ($results as $a) {
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

}