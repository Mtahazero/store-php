<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['role'])&&$_SESSION['role']=='admin'){

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
        
        <form class="row g-3 d-flex justify-content-center " method="post"action="../action/add-category.php" enctype="multipart/form-data">
            <h1 class ="text-center">Category Form</h1>
            <div class="col-md-8 position-relative">
                <label for="validationTooltip01" class="form-label">Title</label>
                <input type="text" class="form-control" name ='title' id="validationTooltip01"placeholder ='Title Category' required>
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