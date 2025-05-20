<?php
session_start();
include "../public/Validation.php";
include "../Model/Category.php";

function redire($location ='../view/category.php'){
    header("location:$location");
    exit(); 
}


if(isset($_SESSION['id'])&&isset($_SESSION['role'])&&$_SESSION['role']=='admin' && isset($_GET['id'])){
    $id = Validation::clean($_GET['id']);
    $category =new Category();
    $category->delete($id);
}

redire();
?>