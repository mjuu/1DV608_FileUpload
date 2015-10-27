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
        $uploadBTN = new UploadView();


        echo "file list comming soon";
        echo "<br>".$uploadBTN->showUpload();

    }


}