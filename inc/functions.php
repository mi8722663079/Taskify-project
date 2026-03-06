<?php
function redirect($location){
    header("location: $location");
}
function checkSub($submitname, $location){
    if(!isset($_POST[$submitname])){
        redirect($location);
    }
}

function pushError($errors,$location){
    if(!empty($errors)){
        $_SESSION["errors"] = $errors;
        redirect($location);
        exit;
    }
}

function clean($field){
    return trim(htmlspecialchars($field));
}