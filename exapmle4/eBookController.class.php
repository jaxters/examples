<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once './includes/Smarty/libs/Smarty.class.php';
include_once "eBookModel.class.php";
include_once './includes/Forms/DefaultView/DefaultViewController.class.php';

class eBookController {



    public function __construct() {
        
    }

    public function GetHtml() {
        $smarty = new Smarty();
        $model = new eBookModel();
        
        
        
        
                if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
                        {
                        $uploadOk = 1;
                        $fileName = $_FILES['userfile']['name'];
                        $tmpName  = $_FILES['userfile']['tmp_name'];
                        $fileSize = $_FILES['userfile']['size'];
                        $fileDesc = $_POST['ebookOpis'];
                        $content = "uploads/".$fileName."";
                        $fileType= pathinfo($fileName,PATHINFO_EXTENSION);

                        $target_dir = "uploads/";
                            $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                            if(isset($_POST["submit"])) {
                                $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                                if($check !== false) {
                                    echo "File is an image - " . $check["mime"] . ".";
                                    $uploadOk = 1;
                                } else {
                                    echo "File is not an image.";
                                    $uploadOk = 0;
                                }
                            }
                            if (file_exists($target_file)) {
                                echo "Sorry, file already exists.";
                                $uploadOk = 0;
                            }

                            if ($_FILES["userfile"]["size"] > 16777216) {
                                echo "Sorry, your file is too large.";
                                $uploadOk = 0;
                            }
                            if ($uploadOk == 0) {
                                echo "Sorry, your file was not uploaded.";
                            } else {
                                if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                                    $db = new DbHandler();
                                    $db->setEbook($fileName, $fileDesc, $fileType, $fileSize, $content, null, null);
                                } else {
                                }
                            }
                        
                        
                        
                        } 
                        
        if(isset($_POST['download'])){
            $id = $_POST['ebookDownloadId'];
            $db = new DbHandler();
            $row = $db->getEbookWeb($id);

            $bytes = $row['dane'];
            $name = $row['nazwa'];
            $size = $row['rozmiar'];
            $type = $row['typ'];
            ob_clean();
//                        header("Content-type: ".$type."");
            header("Content-type: application/pdf");
            header('Content-disposition: attachment; filename="'.$name.'"');
            header("Content-length: ".$size."");

            echo $bytes;
            die();
        }
        
        
        if(isset($_POST['ebookDelete'])){
            if($_POST['ebookDelete'] != null && $_POST['ebookDelete'] !=''){
                $link = $_POST['link'];
                $delete = unlink("$link");
                if($delete == true){
                $rowId=$_POST['ebookDelete'];
                $db = new DbHandler();
                $db->delEbook($rowId);
                ob_clean();   
                }
                
                die();
            }
                
            }

       
        $model->Init();
        
        $smarty->assign('data', $model);
        
        $content = $smarty->fetch('./includes/Forms/eBook/eBookView.tpl.php');
        $htmlBase = new DefaultViewController();
        $html = $htmlBase->GetHtml($content);

        return $html;
    }

}
