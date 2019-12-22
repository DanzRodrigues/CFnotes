<?php

session_start();

$_SESSION['user'] = 'adm';

//if(!isset($_SESSION["user"])) { 
//    $_POST['action'] = 'notes'; 
//} else {
//    $_POST['action'] = 'notes'; 
//}

if(!isset($_POST["action"])) {
    $_POST['action'] = 'login'; 
}
    
if(isset($_POST['title']) && isset($_POST['content'])) {
    $_SESSION['title'] = $_POST['title'];
    $_SESSION['content'] = $_POST['content'];
}   
