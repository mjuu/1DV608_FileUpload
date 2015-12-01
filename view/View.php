<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:39
 */

namespace view;

class View{

    public function showFileList(){
        //phpinfo();
        $uploadBTN = new UploadView();
        $showTabellView = new FileView();

        echo "<H1>File Upload</H1>";
        echo "<p><H2>Public List</H2>";
        $showTabellView->showPublicFileList();

        echo "<br>".$uploadBTN->showloginButton();
        echo "<br>".$uploadBTN->showUploadButton();

    }


}