<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:38
 */
namespace controller;


class MasterController
{
    private $uploadView;
    private $model;
    private $view;
    private $lv;
    private $fileDal;
    private $loginDal;
    public function __construct(\model\FileModel $model, \view\UploadView $uploadView, \view\View $view,\model\FileDAL $fileDAL ,\view\LoginView $lv, \model\LoginDAL $ld)
    {
        $this->model = $model;
        $this->uploadView = $uploadView;
        $this->view = $view;
        $this->lv = $lv;
        $this->fileDal=$fileDAL;
        $this->loginDal= $ld;
    }

    public function doControl(){

        if($this->uploadView->uploadLinkClicked()==true){
            $this->uploadView->response();
            if($this->uploadView->submitFile()==true){
                $this->fileDal->fileUpload();
            }
        }elseif($this->uploadView->loginLinkClicked()==true){
            $this->lv->render();
            if($this->lv->wantToLogin() == true){
                $this->loginDal->doLogin();
                if($this->loginDal == true){
                    $this->lv->setLoginOK();
                $this->view->showFileList();
                }else{
                    $this->lv->setLoginFailed();
                }

            }
        }else{
            $this->view->showFileList();
        }
    }
}