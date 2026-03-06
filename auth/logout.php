<?php
session_start();
require_once "../inc/functions.php"; 
if(isset($_SESSION["user_id"])){
    unset($_SESSION["user_id"]);
    redirect("../tasks/index.php");
}else{
    redirect("login.php");
}