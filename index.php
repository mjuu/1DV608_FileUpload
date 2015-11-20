<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:35
 */
require_once("controller/MasterController.php");
require_once("controller/LoginController.php");
require_once("model/FileModel.php");
require_once("model/FileDAL.php");
require_once("model/LoginDAL.php");
require_once("view/View.php");
require_once("view/LoginView.php");
require_once("view/UploadView.php");
require_once("view/LoggedUser.php");
require_once("/var/conf/conf.php");

session_start();

$lv = new \view\LoginView();
$up = new \view\UploadView();
$v = new view\View();

$ld = new \model\LoginDAL();
$fileDal = new \model\FileDAL();
$m = new model\FileModel();
$lc = new \controller\LoginController($v,$lv,$ld);
$c = new controller\MasterController($m,$up,$v,$fileDal, $lv, $ld, $lc);

$c->doControl();
