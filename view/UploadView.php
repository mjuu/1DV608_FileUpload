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
    private static $backButton = "";
    public  static $messageToUsr="";
    private static $uploadURL = "upload";
    private static $loginURL = "login";

    /**
     * Show the public upload view with standard message
     */
    public function response(){
        $message = "You can upload any file. <br>
        File size limit is 20MB";
        echo $this->generateUploadFormHTML($message);
    }

    /**
     * Generating the upload form
     * @param $message
     * @return string
     */
    public function generateUploadFormHTML($message) {

       echo $this->showBackButton();
        return '<p>

                 <form action="" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Upload file</legend>
					<p id="' .self::$message.'">'.$message.'</p>

					<label for="'.self::$file.'">File :</label>
					<input type="file" id="'.self::$file.'" name="'.self::$file.'"/>

					<input type="submit" id="submit" name="'.self::$upload.'" value="Upload"/>
				</fieldset>
			</form>
			<br>

		';
    }

    /**
     * Show the standard private upload message in the private upload form
     */
    public function privateResponse(){
        $message = "You can upload any file. <br>
        File size limit is 20MB. <br>
        Private file uploads will only be accessible from member areas";

        echo $this->generateUploadFormHTMLPrivate($message);

    }

    /**
     * Generate the private upload view form
     * @param $message
     * @return string
     */
    public function generateUploadFormHTMLPrivate($message) {

        echo $this->showBackToMemberAreaButton();
        return '<p>

                 <form action="" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Upload file</legend>
					<p id="' .self::$message.'">'.$message.'</p>

					<label for="'.self::$file.'">File :</label>
					<input type="file" id="'.self::$file.'" name="'.self::$file.'"/>

					<input type="submit" id="submit" name="'.self::$upload.'" value="Upload"/>
				</fieldset>
			</form>
			<br>

		';
    }

    /**
     * Returns true/false if user want to submit a file to the server
     * @return bool
     */
    public function submitFile(){
        return isset($_POST[self::$upload]);
    }

    /**
     * Return filename
     * @return string
     */
    public function getFile(){
    return trim(self::$file);
    }

    /**
     * Returns true if user click on upload button
     * @return bool
     */
    public function uploadLinkClicked(){
        return isset($_GET[self::$uploadURL]);
    }

    /**
     * Shows a link to upload page
     * @return string
     */
    public function showUploadButton(){
        return "<a href='?" . self::$uploadURL . "'>Upload a file</a>";
    }

    /**
     * Shows a link back to root
     * @return string
     */
    public function showBackButton(){
        return "<a href='?" . self::$backButton. "'> Back to Start</a>";
    }

    /**
     * Shows a link back to member area
     * @return string
     */
    public function showBackToMemberAreaButton(){
        return "<a href='?member" . self::$backButton. "'> Back to member area</a>";
    }

    /**
     * Shows a link to login page
     * @return string
     */
    public function showloginButton(){
        return "<a href='?" . self::$loginURL. "'> Sign in</a>";
    }

    /**
     * Returns true if user clicked on login link
     * @return bool
     */
    public function loginLinkClicked(){
        return isset($_GET[self::$loginURL]);
    }

    /**
     * Redirect user back to the member area
     */
    public function redirect() {
        header("Location: ?member");
    }
}