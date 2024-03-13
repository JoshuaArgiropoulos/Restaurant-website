<?php
require_once 'connectdb.php';

$stmt = $conn->prepare("SELECT DATE(date) as date, COUNT(*) as order_count FROM payment GROUP BY DATE(date)");
$stmt->execute();
$order_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1>All Orders</h1>
        <nav>
            <ul>
                <?php
                $pages = [
                   
                ];

                foreach ($pages as $url => $name) {
                    echo "<li><a href='{$url}'>{$name}</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>
    <h1></h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Number of Orders</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_data as $data): ?>
                <tr>
                    <td><?php echo $data['date']; ?></td>
                    <td><?php echo $data['order_count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><a href="restaurant.php">Back to the Homepage</a></p>
</body>
</html>