<?php
require_once "../inc/functions.php";
require_once "../inc/conn.php";
if(isset($_SESSION["user_id"]) && isset($_GET["id"]) && isset($_POST["update"])){
    $user_id = $_SESSION["user_id"];
    $id = $_GET["id"];
    $title = clean($_POST["title"]);
    $desc = clean($_POST["desc"]);
    $errors = [];
    if(empty($title) || empty($desc)){
        $errors[] = "Please fill all fields correctly";
    }elseif(strlen($desc) > 150){
        $errors[] = "Please enter a short Description.";
    }
    $query = "select * from tasks where id=$id && user_id=$user_id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        $task = mysqli_fetch_assoc($result);
        if(!empty($errors)){
            $title = $task["title"];
            $desc = $task["desc"];
            pushError($errors,"edit.php?id=" . $id);
        }
        $query = "update tasks set `title` = '$title' , `description` = '$desc' where id=$id && user_id=$user_id";
        $result = mysqli_query($conn, $query);
        if($result){
            $_SESSION["success"] = "Task updated successfully!";
            redirect("index.php");
        }else{
            redirect("../errors/404.php");
        }
    }else{
    redirect("../errors/404.php");

    }
}else{
    redirect("../errors/404.php");
}