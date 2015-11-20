<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-11-10
 * Time: 23:26
 */
namespace model;

use view\LoginView;

class LoginDAL{

    public $error;
    private $loginView;
   // private $username = 'admin';
    //private $password ='1pass';
    public function __construct(){
        $lv = new \view\LoginView;
        $this->loginView = $lv;

        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' .DB_LOGIN_NAME;
        try {
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            exit('Connection error');
        }

    }

    public function doLogin(){


        //$sql = "SELECT * FROM ".DB_LOGIN_TABLE."WHERE username = :usernameInput AND password = :passwordInput";
        $sql = "SELECT username FROM members WHERE username = :usernameInput";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':usernameInput',$this->loginView->getUsername());
        $query->execute();
        $result1 = $query->fetchColumn();


        var_dump($result1);
        if($result1==false){
//            $this->loginView->setLoginFailed();
//            $this->loginView->setUsernameStatus();
            echo 'username fail <p>';
            var_dump($result1);
            $this->error =1;

        }else{
//            $this->loginView->setUsernameStatus(true);
//            $this->loginView->setLoginOK();
            echo 'username ok <p>';
            $this->error=3;
        }

        $sql = "SELECT password FROM ".DB_LOGIN_TABLE." WHERE password = :passwordInput";
        $query = $this->pdo->prepare($sql);

        $query->bindParam(':passwordInput',$this->loginView->getPassword());
        $query->execute();
        $result2 = $query->fetchColumn();

        var_dump($result2);
        if($result2==false){
//            $this->loginView->setPasswordStatusF();
//            $this->loginView->setMessage("pass fail ");
            echo 'pass fail <p>';
            $this->error=2;

        }else{
            ;
//            $this->loginView->setMessage("pass OK");
//            $this->loginView->setLoginOK();
            echo 'pass ok <p>';
            $this->error='4';
        }
//        var_dump( $this->loginView->setLoginOK());

        $this->error;

        if($result1==false){
            return 1;
        }elseif($result2==false){
            return 2;
        }
        else{
            return true;
        }

}
    public function getErrorStatus(){
        return $this->error;
    }
}