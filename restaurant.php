<?php
$title = "Restaurants";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1>Welcome to the Restaurant</h1>
        <nav>
            <ul>
                <?php
                $pages = [
                    'orders.php' => 'Orders by Date',
                    'add_Customer.php' => 'Add Customer',
                    'allOrders.php' => 'All Orders',
                    'employeeSchedule.php' => 'Employee Schedule',
                ];

                foreach ($pages as $url => $name) {
                    echo "<li><a href='{$url}'>{$name}</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
  
    </main>
    <footer>
        
    </footer>
</body>
</html>