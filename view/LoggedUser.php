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
    public function __construct()
    {
    }

    public function render(){
        $showTabell = new \model\FileDAL();
        
        $showTabell->showTabell();
        $user =$_SESSION['user'];

        echo 'welcome '.$user.
         "<br>".


            $this->logoutBTN();
    }
    public function memberPage(){
        return isset($_GET[self::$member]);
    }
    public function getLogout(){
        return isset($_GET[self::$logout]);
    }

    public function logoutBTN(){
        return "<a href='?" . self::$logout. "'> Logout</a>";
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