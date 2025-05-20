<?php
session_start();
include "../public/Validation.php";
include "../Model/Product.php";

function redire($location ='../view/add-product.php'){
    header("location:$location");
    exit(); 
}

if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['submit'])){
    redire();
}


$title = Validation::clean($_POST['title']);
$description = Validation::clean($_POST['description']);
$price = Validation::clean($_POST['price']);
$quantity = Validation::clean($_POST['quantity']);
$category = Validation::clean($_POST['category']);
$image = $_FILES['image'];



$extensionAllow=['png','jpg','pdf','jpeg'];
$extension = pathinfo($image['name'],PATHINFO_EXTENSION );

$_SESSION['title'] =$title;

if($image['error']!==0){
    $_SESSION['error'] = 'reloade image again';
    redire();
}else if($image['size'] > 500000){
    $_SESSION['error'] = 'file Size is big';
    redire();
}else if(!in_array($extension,$extensionAllow)){
    $_SESSION['error'] = 'file extension not allow';
    redire();
}



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
}else if(!is_numeric($category)){
    $_SESSION['error'] = 'category mast be numbers';
    redire();
}

$nameFile = uniqid().'.'.$extension ;

$product = new Product();
if(!$product->isUnique('title',$title)){
    $_SESSION['error']  = "product Title ($title) is exist";
    redire();
} 
$data = ['title'=>$title,'description'=>$description,'price'=>$price,'quantity'=>$quantity,'category_id'=>$category,'image'=>$nameFile];

$product->insert($data);
move_uploaded_file($image['tmp_name'],"../image/$nameFile");

redire("../admin/index.php");


?>