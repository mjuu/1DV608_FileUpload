<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:38
 */
namespace controller;


use view\LoggedUser;

class MasterController
{
    private $uploadView;
    private $view;
    private $loginView;
    private $fileDal;
    private $loginDal;
    private $loginCont;
    private $memberV;

    /**
     * MasterController constructor.
     * @param \view\UploadView $uploadView
     * @param \view\View $view
     * @param \model\FileDAL $fileDAL
     * @param \view\LoginView $lv
     * @param \model\LoginDAL $ld
     * @param LoginController $loginC
     */
    public function __construct(\view\UploadView $uploadView, \view\View $view,\model\FileDAL $fileDAL ,\view\LoginView $lv, \model\LoginDAL $ld, \controller\LoginController $loginC)
    {
        $this->uploadView = $uploadView;
        $this->view = $view;
        $this->loginView = $lv;
        $this->fileDal=$fileDAL;
        $this->loginDal= $ld;
        $this->loginCont = $loginC;
        $this->memberV = new LoggedUser();
    }

    /**
     * Control this webbpage.
     */
    public function doControl(){

        //If upload link clicked show public upload page
        if($this->uploadView->uploadLinkClicked()==true){
            //Show public upload page
            $this->uploadView->response();
            //If user want to upload a file
            if($this->uploadView->submitFile()==true){
                //Upload the file
                $this->fileDal->publicUpload();
            }
            //Else if the user want to register a new account do register controls
        }elseif($this->loginView->wantToRegisterURL()==true){
            $this->loginCont->registerControl();
            //Else if user want to login, do login control
        } elseif($this->uploadView->loginLinkClicked()==true){
            $this->loginCont->control();
            //If user is logged in, redirect them to member area
            if($this->loginView->loggedIN() == 1){
                $this->uploadView->redirect();
            }
            //Else if user is logged in and member url typed, show member page
        }elseif($this->loginView->loggedIN()==1) {
            if ($this->memberV->memberPage() == true) {
                $this->memberV->render();
            }
            //If user want to logout, do logout
            if ($this->memberV->getLogout() == true) {
                $this->memberV->doLogout();
            }

            //user want to do a private upload
            if($this->memberV->privateUploadClicked() == true){
                //Show message and render the upload page
                $this->uploadView->privateResponse();
                //User submit and the file is processed for upload
                if($this->uploadView->submitFile()==true){
                    $this->fileDal->privateUpload();
                }
            }
            //Else show the public page
        }else{
            $this->view->showFileList();
        }
    }
}