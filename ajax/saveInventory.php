<?php
require_once "../includes/initialize.php";
if(sizeof($_POST)>0){
    // TODO: Add loggedInUser Id here @develen
    $userId     =   0 ;
    $type = (int) $_POST['type'];
    $typeName   =   ($type==2) ? "Animal" : "Plant";

    //1 - plant 2- animal
    if($type==1){
        $plantName  =   mysql_prep($_POST['plantName']);
        $quantity   =   mysql_prep($_POST['quantity']);
        $qry = mysqli_query($database, "INSERT INTO inventory (user_id,name,type,quantity
      ) VALUES('$userId','$plantName','$typeName','$quantity')");
        if($qry)
            echo 1;
    }elseif($type==2){
        //Livestock
        $animalName =   $_POST['animalName'];
        $quantity   =   $_POST['animalQty'];
        $qry =mysqli_query($database, "INSERT INTO inventory (id,user_id,name,type,quantity) VALUES('','$userId','$animalName','$typeName','$quantity')");
        if($qry)
            echo 1;
    }else{
        echo -1;
    }
}else{
    echo -1;
}
