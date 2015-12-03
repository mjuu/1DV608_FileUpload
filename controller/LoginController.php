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

    /**
     * LoginController constructor.
     * @param \view\View $view
     * @param \view\LoginView $lv
     * @param \model\LoginDAL $ld
     */
    public function __construct( \view\View $view ,\view\LoginView $lv, \model\LoginDAL $ld)
    {
        $this->view = $view;
        $this->loginView = $lv;
        $this->loginDal= $ld;
    }

    /**
     * Control login functions
     */
    public function control(){
        //Show login page
        $this->loginView->render();
        //If user is logged in show public  file list
        if($this->loginView->loggedIN()==1){
            $this->view->showFileList();
            //if user want to login, do login
        }elseif($this->loginView->wantToLogin() == true){
            $this->loginView->login();
        }
    }

    /**
     * Do register controls
     */
    public function registerControl(){
        //Checks user input
        $this->loginView->doRegister();
        //User want to register
        if($this->loginView->wantToRegister() == true){
            //do register
               $this->loginView->register();
        }
    }
}