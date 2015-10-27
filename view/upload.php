<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-27
 * Time: 16:38
 */
namespace view;
require_once("model/Database_config.php");

class Upload
{

    private $db_con;
    private $up;

    public function __construct(\model\Database_config $db_con, UploadView $up){
        $this->db_con = $db_con;
        $this->up = $up;


    }
    public function uploadFile(){
    $file = rand(1000,100000)."-".$_FILES[$this->up->getFile()]["name"];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder="uploads/";

        // new file size in KB
        $new_size = $file_size/1024;
        // new file size in KB

        // make file name in lower case
        $new_file_name = strtolower($file);
        // make file name in lower case

        $final_file=str_replace(' ','-',$new_file_name);

        if(move_uploaded_file($file_loc,$folder.$final_file))
        {
            $sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
            mysql_queryi($sql);
            return 1;
        }
        else
        {
            return -1;
        }
    }


    public function checkFile()
    {
        $file = $this->up->getFile();
        echo "file:" .$file;
        $target_dir = "";
        $target_file = $target_dir . basename($_FILES[$file][$file]);
        echo $target_file = $target_dir . basename($_FILES[$this->up->getFile()]['name']);
        $uploadOK = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if($this->up->submitFile()){
            $check = getimagesize($_FILES[$this->up->getFile()]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }


        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
}