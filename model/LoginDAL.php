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
    public $username;
    public $password;
    public $loggedIn = true;
    public $notLoggedIn = -1;
    public function __construct(){



        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' .DB_LOGIN_NAME;
        try {
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            exit('Connection error');
        }

    }

    public function doLogin($username, $pass){
        //$sql = "SELECT * FROM ".DB_LOGIN_TABLE."WHERE username = :usernameInput AND password = :passwordInput";
        $sql = "SELECT username FROM members WHERE username = :usernameInput";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':usernameInput',$username);
        $query->execute();
        $result1 = $query->fetchColumn();


        //var_dump($result1);
        if($result1==false){
         //   echo 'username fail <p>';
           // var_dump($result1);
            $this->error =1;
            $this->username=false;

        }else{
          //  echo 'username ok <p>';
            //$this->error=3;
            $this->username = true;
        }

        $sql = "SELECT password FROM ".DB_LOGIN_TABLE." WHERE password = :passwordInput";
        $query = $this->pdo->prepare($sql);

        $query->bindParam(':passwordInput',$pass);
        $query->execute();
        $result2 = $query->fetchColumn();


       // var_dump($result2);
        if($result2==false){
            //echo 'pass fail <p>';
            $this->error=2;
            $this->password=false;

        }else{
            //echo 'pass ok <p>';
            $this->password =true;
        }

        $_SESSION['user']= $username;
        $_SESSION['pass']= $pass;

        if($result1 != false & $result2 !=false){
            $_SESSION['loggedIn'] =$this->loggedIn;
        }else{
            $_SESSION['loggedIn'] =$this->notLoggedIn;
        }

}
    public function getLoginStatus(){
        return $this->error;
    }
    public function getUsernameStatus(){
        return $this->username;
    }
    public function getPasswordStatus(){
        return $this->password;
    }
    public function loggedIn(){
        if($this->username == true){
            return true;
        }else{
            return false;
        }
        return false;
    }
}