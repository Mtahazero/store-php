<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['role'])&&$_SESSION['role']=='admin'){
    include "../Model/Category.php";
    $categtories = new Category();
    $categtory = $categtories->All()->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar bg-dark text-white">
                <div class="sidebar-sticky">
                    <h2 class="p-3">Dashboard</h2>
                    <ul class="nav flex-column">
                    <li class="nav-item">
                            <a class="nav-link active" href="../view/category.php"><i class="fas fa-box me-2"></i>Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="../admin/index.php"><i class="fas fa-box me-2"></i>Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""><i class="fas fa-shopping-cart me-2"></i>Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../view/customer.php"><i class="fas fa-users me-2"></i>Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../action/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Categroy Dashboard</h1>
                    <div class="d-flex align-items-center">
                        <a href="../view/add-category.php" class="btn btn-primary me-3"><i class="fas fa-plus me-2"></i>Add Category</a>
                        <div class="user-profile d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" alt="User" class="rounded-circle me-2">
                            <span>John Doe</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($categtory)&&!empty($categtory)){ 
                                $i=1; foreach ($categtory as $items){
                                ?>
                                <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><?=$items['title']?></td>
                                    <td>
                                        <a href="../view/edit-category.php?id=<?=$items['id']?>" class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>
                                        <a href="../action/delete-category.php?id=<?=$items['id']?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                       
                                    </td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<?php }?>