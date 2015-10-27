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
    private $file;

    public function __construct(\model\Database_config $db_con, UploadView $up)
    {
        $this->db_con = $db_con;
        $this->up = $up;
        $this->file = $this->up->getFile();


    }

    public function uploadFile()
    {
        var_dump($this->file);
        $file = rand(1000, 100000) . "-" . $_FILES[$this->file]["name"];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder = "uploads/";

        // new file size in KB
        $new_size = $file_size / 1024;
        // new file size in KB

        // make file name in lower case
        $new_file_name = strtolower($file);
        // make file name in lower case

        $final_file = str_replace(' ', '-', $new_file_name);

        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $sql = "INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
            mysql_queryi($sql);
            return 1;
        } else {
            return -1;
        }
    }
}