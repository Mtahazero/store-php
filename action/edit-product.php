<?php
session_start();
include "../public/Validation.php";
include "../Model/Product.php";


function redire($location ='../view/edit-product.php'){
    header("location:$location");
    exit(); 
}

if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['submit'])||!isset($_GET['id'])){
    redire();
}

$id = Validation::clean($_GET['id']);
$title = Validation::clean($_POST['title']);
$description = Validation::clean($_POST['description']);
$price = Validation::clean($_POST['price']);
$quantity = Validation::clean($_POST['quantity']);
$image = $_FILES['image'];

if(is_numeric($title)){
    $_SESSION['error'] = 'title mast be alpha';
    redire();
}else if(empty($description)){
    $_SESSION['error'] = 'Description is required';
    redire();
}else if(!is_numeric($price)){
    $_SESSION['error'] = 'price mast be numbers';
    redire();
}else if(!is_numeric($quantity)){
    $_SESSION['error'] = 'quantity mast be numbers';
    redire();
}


$data = ['title'=>$title,'description'=>$description,'price'=>$price,'quantity'=>$quantity];
$product = new Product();
if($image['error'] > 0){

    $product->update($data,$id);
    redire("../admin/index.php");
}


$extensionAllow=['png','jpg','pdf'];
$extension = pathinfo($image['name'],PATHINFO_EXTENSION );



if($image['size'] > 500000){
    $_SESSION['error'] = 'file Size is big';
    redire();
}else if(!in_array($extension,$extensionAllow)){
    $_SESSION['error'] = 'file extension not allow';
    redire();
}

$nameFile = uniqid().'.'.$extension ;

$data['image']=$nameFile;

$product->update($data,$id);
move_uploaded_file($image['tmp_name'],"../image/$nameFile");

redire("../admin/index.php");


?>