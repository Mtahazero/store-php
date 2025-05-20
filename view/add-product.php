<?php
session_start();
include "../Model/Category.php";
if(isset($_SESSION['id'])&&isset($_SESSION['role'])&&$_SESSION['role']=='admin'){
$categories = new Category();

$category = $categories->all()->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add-product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-md border py-3 ">
         <?php if(isset($_SESSION['error'])&&!empty($_SESSION['error'])){ ?>
            <div class="alert alert-danger" role="alert">
                <?=$_SESSION['error']?>
            </div>
        <?php } unset($_SESSION['error']); ?>
        
        <form class="row g-3 d-flex justify-content-center " method="post"action="../action/add-product.php" enctype="multipart/form-data">
            <h1 class ="text-center">product Form</h1>
            <div class="col-md-8 position-relative">
                <label for="validationTooltip01" class="form-label">Title</label>
                <input type="text" class="form-control" name ='title' id="validationTooltip01"
                value="<?php echo isset($_SESSION['title'])?$_SESSION['title']:'' ;unset($_SESSION['title']) ?>"
                placeholder ='Title product' required>
            </div>
            <div class="col-md-8 position-relative">
                <label for="validationTooltip01" class="form-label">Description</label>
                <textarea class="form-control" name = 'description' placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                
            </div>
            <div class="col-md-8 position-relative">
                <label for="validationTooltip03" class="form-label">price</label>
                <input type="number" class="form-control" name ='price' id="validationTooltip03" required>
              
            </div>
         
            <div class="col-md-8 position-relative">
                <label for="validationTooltip05" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="validationTooltip05" name="quantity" required>
            </div>
            <div class="col-md-8 position-relative">
                <label for="validationTooltip05" class="form-label">Category</label>
                    <select class="form-control" name="category" required>
                        <?php if(isset($category)&&!empty($category)){ 
                            foreach($category as $items) { ?>
                            <option value="<?=$items['id']?>"><?=$items['title'] ?></option>
                        <?php } }?>
                    </select>
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
}?>