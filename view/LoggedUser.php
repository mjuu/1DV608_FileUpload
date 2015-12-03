<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-11-20
 * Time: 22:36
 */
namespace view;
class LoggedUser{

    private static $member = "member";
    private static $logout = "logout";
    private static $privateUpload = "privateUp";
    private $fileView;

    /**
     * LoggedUser constructor.
     */
    public function __construct(){
        $this->fileView = new FileView();
    }

    /**
     * Shows the member area page to the user
     */
    public function render(){

        $user =$_SESSION['user'];
        echo '<H1>Welcome '.$user.' to the member area</H1>';
        echo $this->fileView->showPrivateFileList();
        echo '<H2> Public file list</H2>';
        echo $this->fileView->showPublicFileList();
        echo $this->privateUploadBTN().
             '<p>'.
             $this->logoutBTN();
    }

    /**
     * Returns true/false if user want go to member area
     * @return bool
     */
    public function memberPage(){
        return isset($_GET[self::$member]);
    }

    /**
     * Returns true/false if user want to logout
     * @return bool
     */
    public function getLogout(){
        return isset($_GET[self::$logout]);
    }

    /**
     * Show private upload button
     * @return string
     */
    public function privateUploadBTN(){
        return "<a href='?" . self::$privateUpload. "'> Private upload</a>";
    }

    /**
     * Show logout button
     * @return string
     */
    public function logoutBTN(){
        return "<a href='?" . self::$logout. "'> Logout</a>";
    }

    /**Returns true/false if private upload button clicked
     * @return bool
     */
    public function privateUploadClicked(){
        return isset($_GET[self::$privateUpload]);
    }

    /**
     * Do logout.
     * Destroys the sessions and then redirecting the user to the main page.
     */
    public function doLogout(){
        session_destroy();
        return header("Location: ?");
    }

    /**
     * Redirect to the member area
     */
    public function redirect(){
       return header("Location:?member");
    }
}