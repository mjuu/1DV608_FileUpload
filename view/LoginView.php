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
    public $loggedin=false;
    public $loginDAL;

    public function __construct(){
        $this->loginDAL = new LoginDAL();
        $this->loggedin =false;
}

    public function render(){
        if(!$this->getLoginOK()){
            $this->doLogin();
        }
        else{
            echo $this->generateLoginFormHTML("logged in");
        }
    }

    public function login(){
        $this->loginDAL->doLogin($this->getUsername(),$this->getPassword());
    }

    public function  doLogin(){
        $message='';


        if(!$this->wantToLogin()){
            $message = "";
        }
        elseif($this->getUsername()==false || $this->getUsername()==''){
            $message="wrong username";
        }
        elseif($this->getPassword()==false || $this->getPassword()==''){
            $message="wrong password";
        }elseif($this->getLoginOK()==true){
            $message ="logged in";
        } else{
            $message = "wrong username and pass";
        }



        //    $message = "wrong username and password";


        echo "login";
        echo $this->generateLoginFormHTML($message);
    }
    public function setMessage($message){
        $this->message =$message;
    }
    private function generateLoginFormHTML($message) {
       // var_dump($this->loggedin);
       // echo "login ok: ".var_dump($this->getLoginOK());
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
    public function getLoginFailed(){
       return $this->loginFailed;
    }
    public function setLoginOK(){
        $this->loggedin = true;
    }
    public function getLoginOK(){
        return $this->loggedin;
    }
    public function setUsernameFail(){
        $this->usernameStatus = true;
    }

    public function getUsernameFail(){
        return $this->usernameStatus;
    }

    public function setPasswordFail(){
        $this->passwordStatus = true;
    }

    public function getPasswordFail(){
        return $this->passwordStatus;
    }

    public static function wantToLogin(){
        return isset($_POST[self::$login]);
    }
    public static function getUsername(){
        if(isset($_POST[self::$username]))
            return $_POST[self::$username];
    }
    public static function getPassword(){
        if(isset($_POST[self::$password]))
          return $_POST[self::$password];
    }
}