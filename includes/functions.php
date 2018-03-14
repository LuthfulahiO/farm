<?php

 function mysql_prep($value){
     $magic_quotes_active = get_magic_quotes_gpc();
     $real_escape_string_exists = function_exists("mysqli_real_escape_string");
    if($real_escape_string_exists){
        if($magic_quotes_active){
            $value = stripslashes($value);
        }

    }else {
        if(!$magic_quotes_active){
            $value = addslashes($value);
        }
    }
    return trim($value);
}

