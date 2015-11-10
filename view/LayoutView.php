<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2015-10-27
 * Time: 13:27
 */
namespace view;
class LayoutView
{

    public function render(View $v, \view\UploadView $up)
    {
       // $this->logged = $isLoggedIn;
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Login Example</title>
        </head>
    <body>
        <h1>Assignment 2</h1>

        <?php

        if (!$up->uploadLinkClicked()) {

            $up->showUpload();
            echo "<br>".$up->showBackButton();
            //  $this->isLoggedin();
            //  $dtv->show();
            //echo $rv->showCookieInfo();


        }elseif($up->submitFile()){
            echo "file upload";

        } else {

            //$this->isLoggedin();
            ?>
            <div class="container">
                <?php
                // echo $v->response();
                echo $up->response();

                // $dtv->show();
                ?>
            </div>
            <div>
                <em>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing
                    to our
                    use of cookies.</em>
            </div>
            </body>
            </html>
            <?php
        }
    }
}