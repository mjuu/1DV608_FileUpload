<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-27
 * Time: 13:37
 */
namespace view;

class UploadView{
    public static $message = "UploadView::Message";
    public static $file = "FileToUpload";
    private static $upload = "UploadView::Upload";
    private static $private = "private";
    private static $backButton = "";
    public  static $messageToUsr="";
    private static $uploadURL = "upload";
    private static $loginURL = "login";


    public function response(){
        $message = "You can upload any file. <br>
        File size limit is 20MB";

        echo $this->generateUploadFormHTML($message);

    }

    public function generateUploadFormHTML($message) {

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

    public function showUploadButton(){
        return "<a href='?" . self::$uploadURL . "'>Upload a file</a>";
    }

    public function showBackButton(){
        return "<a href='?" . self::$backButton. "'> Back to Start</a>";
    }

    public function showloginButton(){
        return "<a href='?" . self::$loginURL. "'> Login</a>";
    }

    public function loginLinkClicked(){
        return isset($_GET[self::$loginURL]);
    }

    public function redirect() {
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        header("Location: ?member");
    }
}