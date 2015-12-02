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

    public function doControl(){

        //if logged in show member page

        if($this->uploadView->uploadLinkClicked()==true){
            $this->uploadView->response();
            if($this->uploadView->submitFile()==true){
                $this->fileDal->publicUpload();
            }
        }elseif($this->uploadView->loginLinkClicked()==true){
            $this->loginCont->control();
            if($this->loginView->loggedIN() == 1){
                $this->uploadView->redirect();
            }
        }elseif($this->loginView->loggedIN()==1) {
            if ($this->memberV->memberPage() == true) {
                $this->memberV->render();

            }
            if ($this->memberV->getLogout() == true) {
                $this->memberV->doLogout();
            }

            //user want to upload
            if($this->memberV->privateUploadClicked() == true){
                $this->uploadView->privateResponse();
                if($this->uploadView->submitFile()==true){
                    $this->fileDal->privateUpload();
                }
            }
        }else{
            $this->view->showFileList();
        }

    }
}