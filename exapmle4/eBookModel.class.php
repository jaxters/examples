<?php

/*
 * To change this template, choose Tools | Templates and open the template in the editor.
 */

class eBookModel {

    var $test;
    var $user;

    public function Init() {
        $this->getTable();
        if(isset($_SESSION['user'])){
        $this->user = $_SESSION['user'];
        }else{
            $this->user ="";
        }

    }
    
    function getTable() {
        $db = new DbHandler();
        $result = $db->getEbookAll();    
        
            $response["error"] = false;
            $response["ebooks"] = array();
            $allEbooksArray = array();
            if($result!=null){
            while ($row = $result->fetch_assoc()) {
                $allEbooksArray [] = array(
                "Id" => $row['id'],
                "nazwa" => $row['nazwa'],
                "opis" => $row['opis'],
                "dane" => $row['dane']
                );
            }
            }
        $this->allEbooksArray = $allEbooksArray;
    }

}
