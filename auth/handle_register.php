<?php
require_once "../inc/conn.php";
require_once "../inc/functions.php";
checkSub("register","register.php");

$name = clean($_POST["name"]);
$email = clean($_POST["email"]);
$password = clean($_POST["password"]);

$errors = [];
if(empty($name) || empty($email) || empty($password)){
    $errors[] = "Please fill all fields correctly.";
}
if(is_numeric($name)){
    $errors[] = "please enter a valid name.";
}

if(is_numeric($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "please enter a valid email.";
}

if(strlen($password) <= 6){
    $errors[] = "password must be longer than 6 characters.";
}

if(!empty($errors)){
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    pushError($errors,"register.php");
}
$query = "select id from users where email = '$email'; ";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    pushError(["Email already exists, please user another."], "register.php");
}else{
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query= "insert into `users`(`name`,`email`,`password`) values('$name', '$email', '$password')";
    $result = mysqli_query($conn, $query);
    if($result){
        $_SESSION["success"] = "Registeration successful! please log in!";
        redirect("login.php");
    }else{
        pushError([], "../errors/404.php");
    }

}

