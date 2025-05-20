<?php
session_start();
include "../public/Validation.php";
include "../Model/Category.php";

function redire($location ='../view/add-category.php'){
    header("location:$location");
    exit(); 
}

if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['submit'])){
    redire();
}


$title = Validation::clean($_POST['title']);

if(is_numeric($title)){
    $_SESSION['error'] = 'title mast be alpha';
    redire();
}

$category = new Category();

if(!$category->isUnique($title)){
    $_SESSION['error']  = "Category Title ($title) is exist";
    redire();
}

$category->insert($title);
redire('../view/category.php');