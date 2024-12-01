<?php
require_once 'includes/config.php'; // Include database connection
session_start(); // Start session

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Initialize the database connection
$config = new Config(); // Create an instance of the Config class
$conn = $config->getConnection(); // Establish the connection

if (isset($_GET['schedule_id'])) {
    $schedule_id = $_GET['schedule_id']; // Get schedule id

    // Fetch schedule data
    $stmt = $conn->prepare("SELECT medicine_id, quantity, pickup_date FROM schedules WHERE schedule_id = ?");
    $stmt->bind_param("i", $schedule_id); // Bind parameter
    $stmt->execute(); // Execute query
    $result = $stmt->get_result(); // Get result
    $schedule = $result->fetch_assoc(); // Fetch schedule data

    // Handle schedule update
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $medicine_id = $_POST['medicine_id']; // Get selected medicine id
        $quantity = $_POST['quantity']; // Get quantity
        $pickup_date = $_POST['pickup_date']; // Get pickup date

        // Update schedule in database
        $stmt = $conn->prepare("UPDATE schedules SET medicine_id = ?, quantity = ?, pickup_date = ? WHERE schedule_id = ?");
        $stmt->bind_param("iisi", $medicine_id, $quantity, $pickup_date, $schedule_id); // Bind parameters
        $stmt->execute(); // Execute query
        header("Location: reminder.php"); // Redirect to reminder page
        exit();
    }
} else {
    header("Location: reminder.php"); // Redirect if schedule_id is not set
    exit();
}

// Fetch all medicines for selection
$medicines_result = $conn->query("SELECT * FROM medicines"); // Get all medicines
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Schedule - MediConnect</title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body and main structure */
        html, body {
            font-family: Arial, sans-serif;
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f9;
            padding: 0 20px;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Header */
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
        }

        /* Form container */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        label {
            font-size: 1.1em;
            margin-bottom: 8px;
            display: block;
        }

        input[type="number"], input[type="date"], select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #45a049;
        }

        /* Error message */
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<header>
    <h2>Update Medicine Pickup Schedule</h2>
</header>

<main>
    <div class="form-container">
        <form method="POST">
            <label for="medicine_id">Medicine:</label>
            <select name="medicine_id" id="medicine_id" required>
                <?php while ($medicine = $medicines_result->fetch_assoc()): ?>
                    <option value="<?php echo $medicine['medicine_id']; ?>" <?php echo ($medicine['medicine_id'] == $schedule['medicine_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($medicine['name']); ?>
                    </option> <!-- Medicine options -->
                <?php endwhile; ?>
            </select><br>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" min="1" max="5" value="<?php echo htmlspecialchars($schedule['quantity']); ?>" required><br>

            <label for="pickup_date">Pickup Date:</label>
            <input type="date" name="pickup_date" value="<?php echo htmlspecialchars($schedule['pickup_date']); ?>" required><br>

            <input type="submit" value="Update">
        </form>
    </div>

    <p><a href="reminder.php">Back to Reminder</a></p>
</main>

</body>
</html>
