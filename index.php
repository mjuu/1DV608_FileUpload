<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:35
 */
require_once("Settings.php");
require_once("controller/MasterController.php");
require_once("model/FileModel.php");
require_once("model/Database_config.php");
require_once("view/View.php");
require_once("view/UploadView.php");
require_once("view/upload.php");


$up = new \view\UploadView();
$v = new view\View();
$m = new model\FileModel();
$c = new controller\MasterController($m,$up,$v);

$c->doControl();
