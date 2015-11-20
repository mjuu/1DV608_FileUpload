<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-11-20
 * Time: 18:47
 */
namespace controller;
class LoginController{

    private $view;
    private $loginView;
    private $loginDal;

    public function __construct( \view\View $view ,\view\LoginView $lv, \model\LoginDAL $ld)
    {
        $this->view = $view;
        $this->loginView = $lv;

        $this->loginDal= $ld;
    }

    public function controll(){

        $this->loginView->render();

        if($this->loginView->wantToLogin() == true){
            $this->loginView->login();
            var_dump($this->loginView->getLoginOK());
            if($this->loginDal->loggedIn()==true){
                $this->loginView->setLoginOK();
                $this->view->showFileList();
            }else{

                $this->loginView->setLoginFailed();
            }
        }
    }
}