<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-27
 * Time: 23:20
 */

namespace model;

     $dbhost = \Settings::DB_host;
     $dbuser = \Settings::DB_user;
     $dbpass = \Settings::DB_pass;
     $dbname = \Settings::DB_name;
     $dbtabell = \Settings::DB_tabel;

    mysql_connect($dbhost,$dbuser,$dbpass) or die('Cannot connect to server');
    mysql_select_db($dbname,$dbtabell);


