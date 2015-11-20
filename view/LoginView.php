<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-11-10
 * Time: 23:58
 */
namespace view;

use model\LoginDAL;

class LoginView{

    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $username = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';
    public $usernameStatus = false;
    public $passwordStatus = false;
    public $loginFailed = false;
    public $loggedin = false;
    public $loginDAL;

    public function __construct(){

}

    public function render(){
        if($this->loggedin == false){
            $this->doLogin();
        }
        else{
            echo $this->generateLoginFormHTML("logged in");
        }
    }


    public function  doLogin(){
        $this->loginDAL = new LoginDAL();
        $message='';
        if(!$this->wantToLogin()){
            $message = "";
        }
        elseif($this->loginDAL->getErrorStatus() ==1){
            $message ="wrong username";
        }
        elseif($this->loginDAL->getErrorStatus()==2){
            $message= "wrong password";
        }
        elseif($this->loginDAL->getErrorStatus() == 3 || $this->loginDAL->getErrorStatus()== 4){
            $this->loggedin =true;
            $message ="pass";
        }else{
            var_dump($this->loginDAL->getErrorStatus());
            $message="wrong username and pass".$this->loginDAL->getErrorStatus();
        }

        echo "login";

        echo $this->generateLoginFormHTML($message);
    }
    public function setMessage($message){
        $this->message =$message;
    }
    private function generateLoginFormHTML($message) {
        var_dump($this->loggedin);
        $up= new UploadView();
        echo $up->showBackButton();
        return '
			<form action ="" method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$username . '">Username :</label>
					<input type="text" id="' . self::$username . '" name="' . self::$username . '" value="" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
    }


    public function setLoginFailed(){
        $this->loginFailed = true;
    }
    public function setLoginOK(){
        $this->loggedin = true;
    }
    public function setUsernameStatus(){
        $this->usernameStatus = false;
    }

    public function getUsernameStatus(){
        return $this->usernameStatus;
    }

    public function setPasswordStatusF(){
        $this->passwordStatus = false;
    }

    public function getPasswordStatus(){
        return $this->passwordStatus;
    }

    public static function wantToLogin(){
        return isset($_POST[self::$login]);
    }
    public static function getUsername(){
        if(isset($_POST[self::$username]))
            return $_POST[self::$username];
        return "";
    }
    public static function getPassword(){
        if(isset($_POST[self::$password]))
            return $_POST[self::$password];
        return "";
    }
}