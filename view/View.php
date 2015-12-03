<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-26
 * Time: 20:39
 */

namespace view;

class View{

    /**
     * Shows the main page with public file list
     * and links to login and public upload
     */
    public function showFileList(){
        $uploadBTN = new UploadView();
        $fileView = new FileView();

        echo "<H1>File Upload</H1>";
        echo "<p><H2>Public List</H2>";
        $fileView->showPublicFileList();

        echo "<br>".$uploadBTN->showloginButton();
        echo ' ';
        echo $uploadBTN->showUploadButton();

    }


}