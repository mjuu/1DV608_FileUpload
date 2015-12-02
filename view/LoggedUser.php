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
    private static $privateUpload = "privUp";
    private $fileView;
    public function __construct(){
        $this->fileView = new FileView();
    }

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
    public function memberPage(){
        return isset($_GET[self::$member]);
    }

    public function getLogout(){
        return isset($_GET[self::$logout]);
    }

    public function privateUploadBTN(){
        return "<a href='?" . self::$privateUpload. "'> Private upload</a>";
    }
    public function logoutBTN(){
        return "<a href='?" . self::$logout. "'> Logout</a>";
    }
    public function privateUploadClicked(){
        return isset($_GET[self::$privateUpload]);
    }
    public function doLogout(){
        session_destroy();
        return header("Location: ?");
    }

    public function changeURL(){
        return isset($_GET['']);
    }
    public function redirect(){
       return header("Location:?member");
    }
}