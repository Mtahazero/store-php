<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Pagination</title>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }

        .pagination ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 5px;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #f0f0f0;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination .disabled {
            color: #aaa;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    $host = 'localhost';
    $dbname = 'your_database';
    $username = 'your_username';
    $password = 'your_password';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Pagination logic
    $itemsPerPage = 10;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($currentPage < 1) $currentPage = 1;

    // Count total items
    $stmt = $pdo->query("SELECT COUNT(*) FROM your_table");
    $totalItems = $stmt->fetchColumn();
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Adjust current page if it's beyond total pages
    if ($currentPage > $totalPages) $currentPage = $totalPages;

    // Get data for current page
    $offset = ($currentPage - 1) * $itemsPerPage;
    $stmt = $pdo->prepare("SELECT * FROM your_table LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display your data here
    echo "<h2>Page $currentPage Results</h2>";
    echo "<ul>";
    foreach ($results as $row) {
        echo "<li>" . htmlspecialchars($row['your_column']) . "</li>";
    }
    echo "</ul>";

    // Display pagination
    echo '<div class="pagination"><ul>';
    
    // Previous button
    if ($currentPage > 1) {
        echo '<li><a href="?page=' . ($currentPage - 1) . '" class="prev-next">&laquo;</a></li>';
    } else {
        echo '<li><span class="prev-next disabled">&laquo;</span></li>';
    }

    // Page numbers
    $startPage = max(1, $currentPage - 2);
    $endPage = min($totalPages, $currentPage + 2);
    
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            echo '<li><span class="active">' . $i . '</span></li>';
        } else {
            echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Next button
    if ($currentPage < $totalPages) {
        echo '<li><a href="?page=' . ($currentPage + 1) . '" class="prev-next">&raquo;</a></li>';
    } else {
        echo '<li><span class="prev-next disabled">&raquo;</span></li>';
    }

    echo '</ul></div>';
    ?>
</body>
</html>