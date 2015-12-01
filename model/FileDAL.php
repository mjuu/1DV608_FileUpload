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
    private $fileView;
    private $upView;

    public function __construct(){
        $this->DBConn = new DBConn();
        $this->pdo= $this->DBConn->conn();

        $this->fileView = new FileView();
        $this->upView = new UploadView();

    }

    public function fileUpload(){

        $this->fileSize =$_FILES[$this->upView->getFile()]['size'];
        $this->filetype = $_FILES[$this->upView->getFile()]["type"];
        $this->file =$this->filePath.($_FILES[$this->upView->getFile()]['name']);

        if ($_FILES[$this->upView->getFile()]['size'] < 10000000) {
            if ($_FILES[$this->upView->getFile()]["type"] == "image/png" || "image/jpg" || "image/jpeg") {
                if ($_FILES[$this->upView->getFile()]["error"] == 0) {
                    $filePath = "uploads/";
                    $filePath = $filePath . basename($_FILES[$this->upView->getFile()]['name']);

                    if (move_uploaded_file($_FILES[$this->upView->getFile()]['tmp_name'], $filePath)) {
                        $this->fileView->FileUploadEvent("The file " . basename($_FILES[$this->upView->getFile()]['name']) . " was uploaded successfully.");
                        $this->fileView->FileUploadEvent(
                                                        '<p>'.'URL: '."<a href='" . $this->file. "'> $this->file</a>".
                                                        '<p>'.'File type: '.$this->filetype.
                                                        '<p>'.'File size: '.$this->fileSize);
                        $this->uploadSQL();
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

    public function uploadSQL(){
        $sql = "INSERT INTO " . DB_TABELLFILE . "(id,file,type,size) VALUES('' ,:file,:filetype,:filesize)";

        $query = $this->pdo->prepare($sql);
        $query->bindParam(':file', $this->file);
        $query->bindParam(':filetype', $this->filetype);
        $query->bindParam(':filesize', $this->fileSize);
        return $query->execute();
    }

}