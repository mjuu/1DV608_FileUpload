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
    public  $usernameStatus = false;
    public  $passwordStatus = false;
    public  $loginFailed = false;
    public  $loggedin=-1;
    public $loginDAL;

    public function __construct(){
        $this->loginDAL = new LoginDAL();
        $this->loggedin =false;
}

    public function render(){
        if($this->loggedIN() ==0 || -1){
            $this->doLogin();
        }
        elseif($this->loggedIN() == 1){
          //  echo $this->generateLoginFormHTML("logged in");
            echo 'logged in';

        }
    }

    public function login(){
        $this->loginDAL->doLogin($this->getUsername(),$this->getPassword());
    }

    public function  doLogin(){
        $message='';
        //session_destroy();
        echo $this->loggedin;
        if($this->loggedIN() ==-1 ){
            $message="";
        }
        elseif($this->getUsername()==false || $this->getUsername()==''){
            $message="wrong username";
        }
        elseif($this->getPassword()==false || $this->getPassword()==''){
            $message="wrong password";
        } else{
            $message = "wrong username and pass";
        }

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



    public function loggedIN(){
        if(isset($_SESSION['loggedIn'])) {
            $fd = $_SESSION['loggedIn'];
            if($fd ==1){
               return $this->loggedin=1;
            }else{
                return $this->loggedin = -1;
            }
        }

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