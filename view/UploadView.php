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
    private static $file = "FileToUpload";
    private static $upload = "UploadView::Upload";
    private static $private = "private";
    private static $backButton = "";
    private static $messageId = "";
    public  static $messageToUsr="";
    private static $uploadURL = "up";


    public function response(){
        echo $this->generateLoginFormHTML(self::$message);
      // $this->doUpload();
    }

    public function doUpload(){
        if($this->submitFile()==true){
            echo "sfsfsfsf";
            //var_dump($this->getFile());
            $upl = new Upload();
            $upl->uploadFile();
            if($upl->uploadFile()==1){

                echo "success";
                $this->setMessage("Success");
            }else{
                echo "fail";
                $this->setMessage("Fail");
            }

        }else{
            echo "dddd";
        }

}
    public function generateLoginFormHTML($message) {
       // var_dump($message);
        $message = "You can only upload files with these extensions: '.bat', '.exe', '.sh','.jar' <br>
         This is to prevent from uploading non-virus files!";
        $messageId = "d";
        //<form action ='Upload.php' method='post' enctype='multipart/form-data'>
       echo $this->showBackButton();
        return '<p>

                 <form action="?upload" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Upload file</legend>
					<p id="' .self::$message.'">'.$message.'</p>

					<label for="'.self::$file.'">File :</label>
					<input type="file" id="'.self::$file.'" name="'.self::$file.'"/>

					<label for="'.self::$private.'">Private :</label>
					<input type="checkbox" id="'.self::$private.'" name="'.self::$private.'"/>

					<input type="submit" name="'.self::$upload.'" value="Upload"/>
				</fieldset>
			</form>
			<br>

		';


    }

    public function submitFile(){
        return isset($_POST[self::$upload]);
    }
    public function getFile(){
        return isset($_POST[self::$file]);
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