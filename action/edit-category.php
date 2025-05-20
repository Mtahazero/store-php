<?php
session_start();
include "../public/Validation.php";
include "../Model/Category.php";

$id = Validation::clean($_GET['id']);
function redire($location ="../view/edit-category.php"){
    header("location:$location");
    exit(); 
}

if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['submit'])||!isset($_GET['id'])){
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

$category->update($title,$id);
redire('../view/category.php');