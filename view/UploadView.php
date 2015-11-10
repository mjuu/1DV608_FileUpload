<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-27
 * Time: 13:37
 */
namespace view;

class UploadView{
    private static $register = "RegisterView::Register";
    private static $username = "RegisterView::UserName";
    public static $message = "UploadView::Message";
    public static $file = "FileToUpload";
    private static $upload = "UploadView::Upload";
    private static $private = "private";
    private static $backButton = "";
    private static $messageId = "";
    public  static $messageToUsr="";
    private static $uploadURL = "up";


    public function response(){
        $message = "You can only upload files with these extensions: '.bat', '.exe', '.sh','.jar' <br>
        This is to prevent from uploading non-virus files!";

        echo $this->generateUploadFormHTML($message);

    }

    public function doUpload(){
        var_dump($this->getFile());
            $this->uploadFile();
            if($this->uploadFile()==1){
                echo $this->generateUploadFormHTML("success");
            }else{
                echo $this->generateUploadFormHTML("fail");
            }
}




    public function uploadFile()
    {
        $file = rand(1000, 100000) . "-" . $_FILES["FileToUpload"]["name"];
        $file_loc = $_FILES["FileToUpload"]['tmp_name'];
        $file_size = $_FILES["FileToUpload"]['size'];
        $file_type = $_FILES["FileToUpload"]['type'];
        $folder = "uploads/";

        // new file size in KB
        $new_size = $file_size / 1024;
        // new file size in KB

        // make file name in lower case
        $new_file_name = strtolower($file);
        // make file name in lower case

        $final_file = str_replace(' ', '-', $new_file_name);

        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $sql = "INSERT INTO file_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
            mysql_query($sql);
            return 1;
        } else {
            return -1;
        }
    }
    public function generateUploadFormHTML($message) {
       // var_dump($message);

        //<form action ='Upload.php' method='post' enctype='multipart/form-data'>
       echo $this->showBackButton();
        return '<p>

                 <form action="" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Upload file</legend>
					<p id="' .self::$message.'">'.$message.'</p>

					<label for="'.self::$file.'">File :</label>
					<input type="file" id="'.self::$file.'" name="'.self::$file.'"/>

					<label for="'.self::$private.'">Private :</label>
					<input type="checkbox" id="'.self::$private.'" name="'.self::$private.'"/>

					<input type="submit" id="submit" name="'.self::$upload.'" value="Upload"/>
				</fieldset>
			</form>
			<br>

		';


    }

    public function submitFile(){
        return isset($_POST[self::$upload]);
    }
    public function getFile(){

    return self::$file;
    }

    public function privateUpload(){
        return isset($_POST[self::$private]);
    }

    public function uploadLinkClicked(){
        return isset($_GET[self::$uploadURL]);
    }
    public function showUpload(){
        return "<a href='?" . self::$uploadURL . "'>Upload a file</a>";
    }
    public function showBackButton(){
        return "<a href='?" . self::$backButton. "'> Back to Start</a>";
    }
    public function setMessage($message){
    }
}