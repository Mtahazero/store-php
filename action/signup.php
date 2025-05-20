<?php
session_start();
include '../public/CSRF.php';
include '../public/Validation.php';
require '../Model/User.php';
//requiest method must be POST
if($_SERVER['REQUEST_METHOD']!='POST' || ! isset($_POST['submit'])){
    return header('location:../view/signup.php');
}

// CSRF  validation secuirty 
if(!validateCsrfToken($_POST['csrf_token'])){
    return header('location:../view/signup.php?error=An error Accourred');
}

if(isset($SESSION['csrf_token'])){
    unset($SESSION['csrf_token']);
}

//redirect to signup page
function redire($location = '../view/signup.php'){
    header("location:$location");
    exit();
} 

$fullname = Validation::clean($_POST['fullname']);
$email = Validation::clean($_POST['email']);
$password = Validation::clean($_POST['password']);
$confirmPassword = Validation::clean($_POST['confirmPassword']);
$agree = Validation::clean($_POST['agree']);

$_SESSION['fullname'] = $fullname ;
$_SESSION['email'] = $email ;

if(!Validation::validateFullname($fullname)){
    $_SESSION['error'] = 'Full name is invalid';
    redire();
}else if(!Validation::validateEmail($email)){
    $_SESSION['error'] = 'Email is invalid';
    redire();
}else if(!Validation::validatePassword($password)){
    $_SESSION['error']  = 'Password is invalid';
    redire();
}else if(!Validation::match($password,$confirmPassword)){
    $_SESSION['error']  = 'Confirm Password is invalid';
    redire();
}else if($agree !=='on'){ // check click agree politics page
    $_SESSION['error']  = 'click on agrre ';
    redire();
}else{
    $user = new User;
    if(!$user->isUnique('email',$email)){
        $_SESSION['error']  = "Email ($email) is exist";
        redire();
    } 

    $hashPassword =password_hash($password,PASSWORD_DEFAULT); 

    $userData = ['fullname'=>$fullname,'email'=>$email,'password'=>$hashPassword];

    if(!$user->insert($userData)){
        $_SESSION['error']  = "Faild insetring data";
        redire();
    }

    $_SESSION['success']  = "Successfully insetring data";
    redire();
    
}

?>