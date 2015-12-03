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
    private static $repassword = 'LoginView::rePassword';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';
    private static $registerButton = "LoginView::register";
    private static $registerURL = "register";
    public  $usernameStatus = false;
    public  $passwordStatus = false;
    public  $loginFailed = false;
    public  $loggedin;
    public $loginDAL;
    public $regFail = true;

    public function __construct(){
        $this->loginDAL = new LoginDAL();
        $this->loggedin =-1;
}

    public function render(){
        if($this->loggedIN() ==0||-1 ){
            $this->doLogin();
        }
    }

    public function login(){
        $this->loginDAL->doLogin($this->getUsername(),$this->getPassword());
    }

    public function register(){
        if($this->regFail == false){
            $this->loginDAL->doRegisterNewUser($this->getUsername(),$this->getPassword());
            echo "User registered!";
        }else{
            
        }

    }

    public function  doLogin(){
        $message='';
        //echo $this->loggedin;

        if(!$this->wantToLogin()==true ){
            $message="";
        }
        elseif($this->wantToLogin()==true && $this->getUsername()==false || $this->getUsername()==''){
            $message="Empty username";
        }elseif($this->wantToLogin()==true &&$this->getUsername()==''){
            $message="Wrong username";
        }
        elseif($this->getPassword()==false || $this->getPassword()==''){
            $message="Wrong password";
        } else{
            $message = "Wrong username and pass";
        }

        echo $this->generateLoginFormHTML($message);
    }

    public function doRegister(){
        $message = "Enter Username and password";

        if(!$this->wantToRegister() == true && $this->regFail==true){
            $message = "Enter Username and password";
        }
        elseif($this->wantToRegister() ==true && $this->getUsername() == false || $this->getUsername()==''){
            $message="Empty username";
        }elseif($this->wantToRegister() == true && $this->getPassword() =='') {
            $message="Empty password";
        }elseif($this->wantToRegister() ==true && $this->getPassword() && $this->getRePassword() == false){
            $message = "Password miss match";
        }elseif($this->wantToRegister() ==true && $this->getPassword() === $this->getRePassword()){
            $this->regFail =false;
        }

        echo $this->generateRegisterFormHTML($message);
    }
    public function setMessage($message){
        $this->message =$message;
    }
    private function generateLoginFormHTML($message) {
        $up= new UploadView();
        echo $up->showBackButton();
        echo ' ';
        echo $this->showRegisterButton();
        return '
			<form action ="" method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$username . '">Username :</label>
					<input type="text" id="' . self::$username . '" name="' . self::$username . '" value="" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
    }


    private function generateRegisterFormHTML($message) {
        $up= new UploadView();
        echo $up->showBackButton();
        echo ' ';
        echo $up->showloginButton();
        return '
			<form action ="" method="post" >
				<fieldset>
					<legend>Register a new account </legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$username . '">Username :</label>
					<input type="text" id="' . self::$username . '" name="' . self::$username . '" value="" />
					<br>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
                    <br>
					<label for="' . self::$repassword . '">Retype Password :</label>
					<input type="password" id="' . self::$repassword . '" name="' . self::$repassword . '" />

					<input type="submit" name="' . self::$registerButton . '" value="register" />
				</fieldset>
			</form>
		';
    }

    public function showRegisterButton(){
        return "<a href='?" . self::$registerURL. "'> Sign up</a>";
    }

    public function loggedIN(){
        if(isset($_SESSION['loggedIn'])) {
            $fd = $_SESSION['loggedIn'];
            if($fd ==1){
               return $this->loggedin=1;
            }else{
                $this->loginFailed == true;
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

    public static function wantToRegisterURL(){
        return isset($_GET[self::$registerURL]);
    }
    public static function wantToRegister(){
        return isset($_POST[self::$registerButton]);
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
        else
            return '';
    }
    public static function getRePassword(){
        if(isset($_POST[self::$repassword]))
            return $_POST[self::$repassword];
        else
            return '';
    }
}