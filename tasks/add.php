<?php
require_once "../inc/functions.php";
require_once "../inc/conn.php";

checkSub("add","index.php");

$title = clean($_POST["title"]);
$desc = clean($_POST["desc"]);
$errors = [];
if(empty($title) || empty($desc)){
    $errors[] = "Please fill all fields correctly";
}elseif(strlen($desc) > 150){
    $errors[] = "Please enter a short Description.";
}
pushError($errors,"index.php");

$user_id = $_SESSION["user_id"];

$query = "select id from users where id=$user_id";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 1){
    $query = "insert into tasks(`title`, `description`,`user_id`) values('$title','$desc',$user_id)";
    $result = mysqli_query($conn, $query);
    if($result){
        $_SESSION["success"] = "Task added successfully!";
        redirect("index.php");
    }else{
        pushError(["Error while inserting."],"index.php");
    }
}else{
    redirect("../errors/404.php");
}