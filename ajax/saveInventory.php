<?php
require_once "../includes/initialize.php";
if(sizeof($_POST)>0){
    $type = (int) $_POST['type'];
    if($type==0){
        $plantName  =   $_POST['plantName'];
        $quantity   =   $_POST['quantity'];
        //Save to Db;
    }elseif($type==1){
        //Livestock
        $animalName =   $_POST['animalName'];
        $quantity   =   $_POST['animalQty'];
    }
}
