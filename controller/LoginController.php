<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-11-20
 * Time: 18:47
 */
namespace controller;
use view\UploadView;

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
        if($this->loginView->loggedIN()==1){
            $this->view->showFileList();
        }elseif($this->loginView->wantToLogin() == true){
            $this->loginView->login();
        }
    }
}