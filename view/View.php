<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:39
 */

namespace view;


use model\FileDAL;

class View{

    public function showFileList(){
        //phpinfo();
        $uploadBTN = new UploadView();
        $showTabell = new FileDAL();

        echo "<H1>File Upload</H1>";
        echo "<p><H2>List</H2>";
        $showTabell->showTabell();


        echo "<br>".$uploadBTN->showUpload();

    }


}