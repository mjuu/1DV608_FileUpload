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
    private static $message = "UploadView::Message";
    private static $file = "File";
    private static $upload = "PasswordRep";
    private static $keep = "register";
    private static $backButton = "";
    private static $messageId = "";
    //public  $message = "";

    private static $uploadURL = "upload";


    public function response(){
       echo $this->generateLoginFormHTML(self::$message);
    }
    public function generateLoginFormHTML($message) {

        //$message = "test";
        $messageId = "d";
       echo $this->showBackButton();
        return "<form method='post' >
				<fieldset>
					<legend>Upload file</legend>
					<p id='".self::$message."'>$message</p>

					<label for='".self::$file."'>Password :</label>
					<input type='File' id='".self::$file."' name='".self::$file."'/>

					<label for='".self::$keep."'>Private :</label>
					<input type='checkbox' id='".self::$keep."' name='".self::$keep."'/>

					<input type='submit' name='".self::$upload."' value='Upload'/>
				</fieldset>
			</form>
			<br>

		";


    }
    /**
     * Check if "Register a new user" is clicked
     * @return bool
     */
    public function getUploadPressed(){
        return isset($_GET[self::$uploadURL]);
    }
    public function showUpload(){
        return "<a href='?" . self::$uploadURL . "'>Upload a file</a>";
    }
    public function showBackButton(){
        return "<a href='?" . self::$backButton. "'> Back to login</a>";
    }
    public function setMessage($message){

    }
}