<?php
session_start();
include "../Model/Product.php";
include "../public/Validation.php";

if(!isset($_GET['id'])){
    header('location:../admin/index.php');
}
    
if(isset($_SESSION['id'])&&isset($_SESSION['role'])&&$_SESSION['role']=='admin'){
    $id =Validation::clean($_GET['id']);
    $products = new Product();
    $product =$products->single('id',$id)->fetch(PDO::FETCH_ASSOC);
    $category = $products->getCategory('id',$id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit-product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-md border py-3 ">
         <?php if(isset($_SESSION['error'])&&!empty($_SESSION['error'])){ ?>
            <div class="alert alert-danger" role="alert">
                <?=$_SESSION['error']?>
            </div>
        <?php } unset($_SESSION['error']); ?>

        <form class="row g-3 d-flex justify-content-center " method="post"action="../action/edit-product.php?id=<?=$id?>" enctype="multipart/form-data">
            <h1 class ="text-center">edit-product</h1>
        
            <div class="col-md-8 position-relative">
                <label for="validationTooltip01" class="form-label">Title</label>
                <input type="text" class="form-control" name ='title' id="validationTooltip01" placeholder ='Title product'value="<?=$product['title']?>" required>
            </div>
            <div class="col-md-8 position-relative">
                <label for="validationTooltip01" class="form-label">Description</label>
                <textarea class="form-control" name = 'description' placeholder="Leave a comment here" id="floatingTextarea"><?=$product['description']?></textarea>
                
            </div>
            <div class="col-md-8 position-relative">
                <label for="validationTooltip03" class="form-label">price</label>
                <input type="number" class="form-control" name ='price' id="validationTooltip03" value="<?=$product['price']?>" required>
              
            </div>
         
            <div class="col-md-8 position-relative">
                <label for="validationTooltip05" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="validationTooltip05" name="quantity" value="<?=$product['quantity']?>" required>
            </div>
            <div class="col-md-8 position-relative">
                <label for="validationTooltip05" class="form-label">Category</label>
                <input type="text" class="form-control" name ='category' id="validationTooltip01" placeholder ='Category product'  value="<?= $category['title'] ?>" readonly required>
                  
            </div>
            <div class=" col-md-8 position-relative">
            <input type="file" class="form-control" id="inputGroupFile04" name ='image' aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            </div>

            <div class="col-md-8 ">
                <button class="btn btn-primary" name="submit" type="submit">Submit form</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php  
} ?>