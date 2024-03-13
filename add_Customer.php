<?php
require_once 'connectdb.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cellNum = $_POST['cellNum'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $emailAddress = $_POST['emailAddress'];
    $pc = $_POST['pc'];
    $streetAddress = $_POST['streetAddress'];
    $city = $_POST['city'];
    
    $stmt = $conn->prepare("SELECT * FROM customerAccount WHERE emailAddress = :emailAddress");
    $stmt->bindParam(':emailAddress', $emailAddress);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $message = "Customer with this email already exists.";
    } else {
        $credit = 5.00;

        $stmt = $conn->prepare("INSERT INTO customerAccount (cellNum, firstName, lastName, emailAddress, pc, streetAddress, city, creditAmt) VALUES (:cellNum, :firstName, :lastName, :emailAddress, :pc, :streetAddress, :city, :creditAmt)");
        $stmt->bindParam(':cellNum', $cellNum);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':emailAddress', $emailAddress);
        $stmt->bindParam(':pc', $pc);
        $stmt->bindParam(':streetAddress', $streetAddress);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':creditAmt', $creditAmt);
        
        if ($stmt->execute()) {
            $message = "Customer added successfully!";
        } else {
            $message = "Error: Unable to add customer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1>Add Customer</h1>
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

    <form method="post">
        <label for="cellNum">Phone Number:</label>
        <input type="tel" name="cellNum" id="cellNum" required>
        <br>

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" required>
        <br>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" required>
        <br>

        <label for="emailAddress">Email Address:</label>
        <input type="email" name="emailAddress" id="emailAddress" required>
        <br>

        <label for="pc">Postal Code:</label>
        <input type="text" name="pc" id="pc" required>
        <br>

        <label for="streetAddress">Street:</label>
        <input type="text" name="streetAddress" id="streetAddress" required>
        <br>

        <label for="city">City:</label>
        <input type="text" name="city" id="city" required>
        <br>

        <button type="submit">Add Customer</button>
    </form>

    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <p><a href="restaurant.php">Back to Homepage</a></p>
</body>
</html>