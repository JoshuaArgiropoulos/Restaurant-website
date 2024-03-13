<?php
require_once 'connectdb.php';

$Id = $_POST['ID'] ?? null;
$schedule = [];

if (!empty($Id)) {
    $stmt = $conn->prepare("SELECT day, startTime, endTime FROM shift WHERE empID = :ID AND day NOT IN ('Saturday', 'Sunday')");
    $stmt->bindParam(':ID', $Id);
    $stmt->execute();
    $schedule = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$stmt = $conn->prepare("SELECT ID, firstName, lastName FROM employee");
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Schedule</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1> 
</h1>
        <h1>Employee Schedule</h1>
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
    <h1>Employee Schedule</h1>
    <form method="post">
        <label for="ID">Select Employee:</label>
        <select name="ID" id="ID" required>
            <option value="">-- Select Employee --</option>
            <?php foreach ($employees as $employee): ?>
                <option value="<?php echo $employee['ID']; ?>" <?php echo ($employee['ID'] == $Id) ? 'selected' : ''; ?>>
                    <?php echo $employee['firstName'] . ' ' . $employee['lastName']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">View Schedule</button>
    </form>

    <?php if (!empty($Id)): ?>
        <h2>Schedule</h2>
        <table>
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Shift</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedule as $shift): ?>
                    <tr>
                        <td><?php echo $shift['day']; ?></td>
                        <td><?php echo $shift['startTime'] . ' ' . $shift['endTime']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p><a href="restaurant.php">Back to the Homepage</a></p>
</body>
</html>