<?php
session_start();
include "../public/Validation.php";
include "../Model/Product.php";

function redire($location ='../admin/index.php'){
    header("location:$location");
    exit(); 
}


if(isset($_SESSION['id'])&&isset($_SESSION['role'])&&$_SESSION['role']=='admin' && isset($_GET['id'])){
    $id = Validation::clean($_GET['id']);
    $product =new Product();
    $product->delete($id);
}

redire();
?>