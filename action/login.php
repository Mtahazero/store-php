<?php
session_start();
include '../public/CSRF.php';
include '../public/Validation.php';
require '../Model/User.php';
//requiest method must be POST
if($_SERVER['REQUEST_METHOD']!='POST' || ! isset($_POST['submit'])){
    return header('location:../view/login.php');
}

// CSRF  validation secuirty 
if(!validateCsrfToken($_POST['csrf_token'])){
    return header('location:../view/login.php?error=An error Accourred');
}

if(isset($SESSION['csrf_token'])){
    unset($SESSION['csrf_token']);
}

//redirect to signup page
function redire($location = '../view/login.php'){
    header("location:$location");
    exit();
}
$email = Validation::clean($_POST['email']);
$password = Validation::clean($_POST['password']);
$agree = Validation::clean($_POST['agree']);

if(!Validation::validateEmail($email)){
    $_SESSION['error'] = 'Email is invalid';
    redire();
}else if(!Validation::validatePassword($password)){
    $_SESSION['error']  = 'Password is invalid';
    redire();
}else if($agree !=='on'){ // check click agree politics page
    $_SESSION['error']  = 'click on agree ';
    redire();
}

$user = new User();

if($user->isUnique('email',$email)){
    $_SESSION['error']  = 'Email or Passwor is incorrect';
    redire();
}


$fetch = $user->single('email',$email)->fetch(PDO::FETCH_ASSOC) ;

if($fetch['email'] !== $email){
    $_SESSION['error']  = 'Email or Passwor is incorrect ';
    redire();
}
if(!password_verify(  $password,$fetch['password'])){
    $_SESSION['error']  = 'Email or Passwor is incorrect ';
    redire();
}

$_SESSION['id']=$fetch['id'];
$_SESSION['role'] = $fetch['role'];
$_SESSION['fullname']=$fetch['fullname'];


if($_SESSION['role']=='user'){
    redire('../view/index.php');
}

if($_SESSION['role']=='admin'){
    redire('../admin/index.php');
}

