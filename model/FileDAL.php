<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-11-03
 * Time: 14:08
 */
namespace model;

use view\FileView;
use view\UploadView;
require_once("view/FileView.php");
require_once("model/DBConn.php");

class FileDAL
{
    private $pdo;
    private $DBConn;

    private $file = '';
    private $filetype = '';
    private $fileSize = '';
    private $filePath = "uploads/";
    private $filePathPrivate = "privateUploads/";
    private $fileView;
    private $upView;

    /**
     * FileDAL constructor.
     */
    public function __construct(){
        $this->DBConn = new DBConn();
        $this->pdo= $this->DBConn->conn();

        $this->fileView = new FileView();
        $this->upView = new UploadView();

    }

    /**
     * Do public upload
     */
    public function publicUpload(){
        $this->fileUpload(1);
    }

    /**
     * Do private upload
     */
    public function privateUpload(){
        $this->fileUpload(2);
    }

    /**
     * Uploads a file to the server
     * Returns message about the file
     * or if error occurred a error message will be returned
     */
    public function fileUpload($type){

        $this->fileSize =$_FILES[$this->upView->getFile()]['size'];
        $this->filetype = $_FILES[$this->upView->getFile()]["type"];
        if($type == 1){

            $this->file =$this->filePath.($_FILES[$this->upView->getFile()]['name']);
            $this->file= $this->removeChar($this->file);

        }else{

            $this->file =$this->filePathPrivate.($_FILES[$this->upView->getFile()]['name']);
            $this->file = $this->removeChar($this->file);
        }


        if ($_FILES[$this->upView->getFile()]['size'] < 20000000) {
            if ($_FILES[$this->upView->getFile()]["type"]) {
                if ($_FILES[$this->upView->getFile()]["error"] == 0) {
                    if($type == 1){
                        $filePath = "uploads/";
                        $filePath = $this->removeChar($filePath);
                    }else{
                        $filePath = "privateUploads/";
                        $filePath = $this->removeChar($filePath);
                    }

                    $filePath = $this->removeChar($filePath . basename($_FILES[$this->upView->getFile()]['name']));

                    $temp_name = $this->removeChar($_FILES[$this->upView->getFile()]['tmp_name']);
                    if (move_uploaded_file($temp_name, $filePath)) {
                        $this->fileView->FileUploadEvent("The file " . basename($_FILES[$this->upView->getFile()]['name']) . " was uploaded successfully.");
                        $this->fileView->FileUploadEvent(
                                                        '<p>'.'URL: '."<a href='" . $this->file. "'> $this->file</a>".
                                                        '<p>'.'File type: '.$this->filetype.
                                                        '<p>'.'File size: '.$this->fileSize);
                        $this->uploadSQL($type);
                    } else {
                        $this->fileView->FileUploadEvent("A problem occurred while uploading your file, please try again.");
                    }
                } else {
                    $this->fileView->FileUploadEvent("Something went wrong...");
                }
            } else {
                $this->fileView->FileUploadEvent("Wrong filetype..");
            }
        } else {
            $this->fileView->FileUploadEvent("File is to large");
        }
    }

    /**
     * Insert file properties to the database
     * @return bool
     */
    public function uploadSQL($type){
        if ($type == 1) {
            $sql = "INSERT INTO " . DB_TABELLFILE . "(id,file,type,size) VALUES('' ,:file,:filetype,:filesize)";

            $query = $this->pdo->prepare($sql);
            $query->bindParam(':file', $this->file);
            $query->bindParam(':filetype', $this->filetype);
            $query->bindParam(':filesize', $this->fileSize);
            return $query->execute();
        }elseif($type == 2){

            $username =$_SESSION['user'];

            $sql = "INSERT INTO " . DB_TABELLFILEPRIVATE . "(id,username,file,type,size) VALUES('' ,:username,:file,:filetype,:filesize)"; //PRIVATE TABLE

            $query = $this->pdo->prepare($sql);
            $query->bindParam(':username', $username);
            $query->bindParam(':file', $this->file);
            $query->bindParam(':filetype', $this->filetype);
            $query->bindParam(':filesize', $this->fileSize);
            return $query->execute();

        }
    }

    /**
     * Remove special chars from filename
     * @param $str
     * @return mixed
     */
    public function removeChar($str){
        $str = str_replace(' ','',$str);
        $str = str_replace('é','',$str);
        $str = str_replace('?','_',$str);
        $str = str_replace('!','_',$str);
        $str = str_replace('&','_',$str);
        $str = str_replace('"','_',$str);
        $str = str_replace(',','_',$str);
        $str = str_replace('-','_',$str);
        $str = str_replace('–','_',$str);
        $str = str_replace('\'','_',$str);

        $str= preg_replace('[/^a-zA-Z0-9]', '', $str );
        $str= preg_replace('/-+/', '-', $str);
        return $str;
    }

}
