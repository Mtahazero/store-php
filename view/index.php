<?php
session_start();
if(isset($_SESSION['id']) &&isset($_SESSION['role'])&&$_SESSION['role']=='user'){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNow - E-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <?php  
        include('../public/nav.php');
    ?>
    

   <?php
         include('../public/footer.php');
   ?>
</body>
</html>
<?php  } else {
    header('location:login.php');
} ?>