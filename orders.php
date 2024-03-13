<?php
require_once 'connectdb.php';

$date = $_POST['date'] ?? '';

if (!empty($date)) {
    $stmt = $conn->prepare("SELECT c.firstName, c.lastName, i.food, f.totalPrice, f.tip, e.firstName AS delivery_first_name, e.lastName AS delivery_last_name
FROM orderPlacement o 
JOIN customerAccount c ON o.customerEmail = c.emailAddress

JOIN foodOrder f ON f.orderID = o.orderID
JOIN fooditemsinorder i ON i.orderID = o.orderID
JOIN delivery d ON d.orderID = o.orderID
JOIN employee e ON d.deliveryPerson = e.ID

                            WHERE DATE(o.orderDate) = :date");
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Orders by Date</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1>Orders by Date</h1>
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
    <h1>List Orders by Date</h1>



    <form method="post">
        <label for="date">Enter Date:</label>
        <input type="date" name="date" id="date" value="<?php echo $date; ?>" required>
        <button type="submit">Submit</button>
    </form>

    <?php if (!empty($date)): ?>
        <h2>Orders on <?php echo $date; ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Item Ordered</th>
                    <th>Total Amount</th>
                    <th>Tip</th>
                    <th>Delivery Person</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['firstName'] . ' ' . $order['lastName']; ?></td>
                        <td><?php echo $order['food']; ?></td>
                        <td><?php echo $order['totalPrice']; ?></td>
                        <td><?php echo $order['tip']; ?></td>
                        <td><?php echo $order['delivery_first_name'] . ' ' . $order['delivery_last_name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <p><a href="restaurant.php">Back to Home</a></p>
</body>
</html>