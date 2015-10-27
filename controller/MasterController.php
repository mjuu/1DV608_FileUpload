<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:38
 */
namespace controller;
//require_once("/model/FileModel.php");

use view\View;

class MasterController
{
    private $uploadView;
    private $model;
    private $view;
    public function __construct(\model\FileModel $model, \view\UploadView $uploadView, View $view)
    {
        $this->model = $model;
        $this->uploadView = $uploadView;
        $this->view = $view;
    }

    public function doControl(){

        if($this->uploadView->uploadLinkClicked()==true){
            $this->uploadView->response();
            if($this->uploadView->submitFile()==true){
                $this->uploadView->doUpload();
            }
        }else{
            $this->view->showFileList();
        }
    }
    public function doUpload(){

    }
}