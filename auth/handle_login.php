<?php
require_once "../inc/conn.php";
require_once "../inc/functions.php";
checkSub("register","register.php");

$email = clean($_POST["email"]);
$password = clean($_POST["password"]);

$errors = [];
if(empty($email) || empty($password)){
    $errors[] = "Please fill all fields correctly.";
}

if(!empty($errors)){
    pushError($errors,"register.php");
}
$query = "select * from users where email = '$email'; ";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 1){
    $user = mysqli_fetch_assoc($result);
    $validPass = password_verify($password, $user["password"]);
    if(!$validPass){
        $errors[] = "Incorrect Email or password";
        pushError($errors,"login.php");
    }
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["name"];
    redirect("../tasks/index.php");
}else{
    $errors[] = "Incorrect Email or password";
    pushError($errors,"login.php");
}

