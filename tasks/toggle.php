<?php
require_once "../inc/functions.php";
require_once "../inc/conn.php";
if(isset($_SESSION["user_id"]) && isset($_GET["id"])){
    $user_id = $_SESSION["user_id"];
    $id = $_GET["id"];
    $query = "select * from tasks where id=$id && user_id=$user_id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        $task=mysqli_fetch_assoc($result);
        $status = $task["status"] == "pending" ? "done" : "pending";
        $query = "update tasks set `status` ='$status' where id=$id && user_id=$user_id;";
        $result = mysqli_query($conn, $query);
        if($result){
            redirect("index.php");
        }else{
            pushError(["Error while toggling."],"index.php");
        }
    }else{
    redirect("../errors/404.php");
    }
}else{
    redirect("../errors/404.php");
}