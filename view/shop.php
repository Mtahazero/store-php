<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
    include "../Model/Category.php";
    include "../Model/Product.php";
    

    $categories = new Category() ;
    $category = $categories ->All()->fetchAll(PDO::FETCH_ASSOC);

    $products = new Product() ;

    $start = 0 ;
    $rows_per_page = 4 ;

    $pages = ceil($products->All()->rowCount()/$rows_per_page);

    $sortOrder = $_POST['price'] ?? 'default'  ;
    $getCategory =$_POST['category'] ?? 'all';
  
    if(isset($_GET['page'])){
        $start = ($_GET['page'] -1)* $rows_per_page ;
    }

    $product =$products->generateProductQuery($getCategory, $sortOrder,$start, $rows_per_page);
 

    

   
   
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNow - E-commerce</title>   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/shop.css">
    <link rel="manifest" href="./manifest.json">
    <meta name="theme-color" content="#ff6b6b">
    <style>
        .pagin {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 2vh;
            margin-bottom: 25px;
            background-color: #f0f0f0;
        }
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 5px;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a {
            text-decoration: none;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #333;
            background-color: #fff;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination .active a {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
            cursor: default;
        }

        .pagination .disabled a {
            color: #ccc;
            cursor: not-allowed;
            background-color: #f9f9f9;
            border-color: #ddd;
        }
        /* Product page styles scoped to avoid conflicts */
        .shop-container {
            padding: 20px 5%;
            margin-top: 80px; /* Space for fixed navbar */
            margin-bottom: 60px; /* Space for footer */
        }
        .shop-container h1, .shop-container h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .filter-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .filter-bar select, .filter-bar button {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1em;
            cursor: pointer;
        }
        .filter-bar button {
            background-color: #ff6b6b;
            color: white;
            border: none;
        }
        .filter-bar button:hover {
            background-color: #e55a5a;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            animation: fadeIn 0.5s ease-in;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
            loading: lazy;
        }
        .product-card h3 {
            margin: 15px 0 10px;
            font-size: 1.4em;
            padding: 0 15px;
        }
        .product-card p {
            color: #7f8c8d;
            font-size: 0.95em;
            padding: 0 15px;
            margin: 5px 0;
        }
        .product-card .price {
            color: #ff6b6b;
            font-weight: bold;
            font-size: 1.2em;
        }
        .order-icon {
            display: inline-flex;
            align-items: center;
            margin: 15px;
            padding: 10px 20px;
            background-color: #ff6b6b;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }
        .order-icon i {
            margin-right: 8px;
        }
        .order-icon:hover, .order-icon:focus {
            background-color: #e55a5a;
            outline: none;
        }
      
        .modal-content button:hover {
            background-color: #e55a5a;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
            .product-card img {
                height: 180px;
            }
            #order-form {
                padding: 20px;
            }
            .filter-bar {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <?php  
        include('../public/nav.php');
    ?>
    
    <div class="shop-container">
        <h1>Explore Our Products</h1>
        <div class="filter-bar">
            <form action="<?=$_SERVER['PHP_SELF']?>"method ="POST">
                
                <select id="category-filter" aria-label="Filter by category" name = "category">
                    <option value="all" >All Categories</option>
                    <?php if(isset($category)&&!empty($category)){ 
                    foreach($category as $item){?>

                        <option value="<?=$item['id']?>"><?=ucfirst($item['title'])?></option>
                    <?php }} ?>
                </select>
                
                <select id="sort-filter" aria-label="Sort products" name = 'price'>
                    <option value="default">Default</option>
                    <option value="ASC">Price: Low to High</option>
                    <option value="DESC">Price: High to Low</option>
                </select>
                <button type ='submit' name ='submit'>Apply Filters</button>
                <button type ='reset' >Reset Filters</button>
            </form>
        </div>
       <div class="product-grid" id="product-grid">
            <?php if(isset($product)&&!empty($product)){
                    foreach($product as $items ){ ?>
                        <div class="product-card" data-category="electronics" data-price="10" role="region" aria-label="Wireless Headphones">
                            <img src="../image/<?=$items['image']?>" alt="Wireless Headphones" loading="lazy">
                            <h3><?=$items['title']?></h3>
                            <p class="price">$<?=number_format($items['price'],2)?></p>
                            <p><?=$items['description']?></p>
                            <a href="#order-form" class="order-icon" ><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>
            <?php } }?>
        </div>
        
       
    </div>
    <div class ="pagin">
        <ul class="pagination">
            <?php if(isset($_GET['page']) && $_GET['page'] > 1){?>

                <li><a href="?page=<?= $_GET['page']-1?>" class="disabled">&laquo; Previous</a></li>
            <?php } else{ ?>
           
                <li><a  class="disabled">&laquo; Previous</a></li>
            <?php }  for($counter=1;$counter<=$pages;$counter++ ){?>
                <li class="active"><a href="?page=<?=$counter?>"><?=$counter?></a></li>
            <?php  }if (!isset($_GET['page'])){?>

                <li><a href="<?= '?page=2'?>">Next &raquo;</a></li>
            <?php }else{ 
                    if($_GET['page']>=$pages){?>
                        <li><a>Next &raquo;</a></li>
            <?php  }else{ ?>
                        <li><a href="?page=<?= $_GET['page']+1?>">Next &raquo;</a></li>
            <?php  }}?>
        </ul>
    </div>
    <?php
        include('../public/footer.php');
    ?>

   

        
    </body>
</html>
<?php } else {
    header('location:login.php');
} ?>