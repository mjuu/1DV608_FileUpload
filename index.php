<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:35
 */
require_once("controller/MasterController.php");
require_once("model/FileModel.php");
require_once("model/FileDAL.php");
require_once("view/View.php");
require_once("view/UploadView.php");
require_once("/var/conf/conf.php");

$fileDal = new \model\FileDAL();
$up = new \view\UploadView();
$v = new view\View();
$m = new model\FileModel();
$c = new controller\MasterController($m,$up,$v,$fileDal);

$c->doControl();
