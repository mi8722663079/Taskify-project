<?php
require_once "../inc/functions.php";
require_once "../inc/conn.php";
if(isset($_SESSION["user_id"]) && isset($_POST["delete"])){
    $user_id = $_SESSION["user_id"];
    $id = $_POST["delete"];
    $query = "select * from tasks where id=$id && user_id=$user_id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        $query = "delete from tasks where id=$id && user_id=$user_id;";
        $result = mysqli_query($conn, $query);
        if($result){
            redirect("index.php");
        }else{
            pushError(["Error while deleting."],"index.php");
        }
    }else{
    redirect("../errors/404.php");
    }
}else{
    redirect("../errors/404.php");
}