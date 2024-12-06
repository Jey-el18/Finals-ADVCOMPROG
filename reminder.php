<?php 
require_once 'includes/config.php'; // Use require_once to include the config file

session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Create an instance of the Config class and retrieve the connection
$config = new Config();
$conn = $config->getConnection(); // Get the database connection

$user_id = $_SESSION['user_id']; // Get user id from session

// Check if the form was submitted to update the status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_id'], $_POST['status'])) {
    $schedule_id = intval($_POST['schedule_id']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE schedules SET status = ? WHERE schedule_id = ?");
    if ($stmt) {
        $stmt->bind_param("si", $status, $schedule_id);
        if ($stmt->execute()) {
            $message = "Status updated successfully!";
        } else {
            $message = "Failed to update status.";
        }
        $stmt->close();
    } else {
        $message = "Failed to prepare the statement.";
    }
}

// Fetch user schedules
$stmt = $conn->prepare("SELECT schedules.schedule_id, medicines.name, schedules.quantity, schedules.pickup_date, schedules.status 
                        FROM schedules 
                        JOIN medicines ON schedules.medicine_id = medicines.medicine_id 
                        WHERE schedules.user_id = ?");
if (!$stmt) {
    die("An error occurred. Please try again later."); // Handle errors gracefully
}

$stmt->bind_param("i", $user_id); // Bind parameter
$stmt->execute(); // Execute query
$result = $stmt->get_result(); // Get result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder - MediConnect</title>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Full Height Layout */
        html, body {
            height: 100%;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f9;
        }

        /* Header Style */
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 2em;
        }

        /* Navigation Styles */
        nav {
            text-align: center;
            margin: 20px 0;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        nav a:hover {
            color: #4CAF50;
        }

        /* Main Section */
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
            align-items: center;
            justify-content: flex-start;
            max-width: 1200px; /* Limit width */
            margin: 0 auto; /* Center content */
        }

        .reminder-message {
            font-size: 1.5em;
            margin: 20px 0;
            font-weight: bold;
            color: #4CAF50;
            text-align: center;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #4CAF50;
            color: white;
        }

        table th, table td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            font-weight: bold;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .no-schedule {
            text-align: center;
            color: #888;
            font-style: italic;
            padding: 20px 0;
        }

        .status-form {
            display: flex;
            gap: 5px;
        }

        /* Footer */
        footer {
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
        }

        /* Add responsiveness for smaller screens */
        @media (max-width: 768px) {
            nav a {
                display: block;
                margin: 10px 0;
            }

            .reminder-message {
                font-size: 1.2em;
            }

            table {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>

<header>
    Your Upcoming Medicine Pickup Schedule
</header>

<main>
    <nav>
        <a href="dashboard.php">Home</a> |
        <a href="about.php">About</a> |
        <a href="contact.php">Contact</a> |
        <a href="reminder.php">Reminder</a> |
        <a href="schedule.php">Schedule Medicine Pickup</a> |
        <a href="medicine_listing.php">Medicine Listing</a> |
        <a href="feedback.php">Feedbacks</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <div class="reminder-message">
        Below is your scheduled medicine pickup. Please be reminded!
    </div>

    <?php if (isset($message)): ?>
        <p class="reminder-message"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <table id="scheduleTable" class="display">
        <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Pickup Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($schedule = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($schedule['name']); ?></td>
                        <td><?= htmlspecialchars($schedule['quantity']); ?></td>
                        <td><?= htmlspecialchars($schedule['pickup_date']); ?></td>
                        <td><?= htmlspecialchars($schedule['status'] ?? 'Not Picked Up'); ?></td>
                        <td>
                            <form action="reminder.php" method="POST" class="status-form">
                                <input type="hidden" name="schedule_id" value="<?= $schedule['schedule_id']; ?>">
                                <button type="submit" name="status" value="Picked Up">Picked Up</button>
                                <button type="submit" name="status" value="Not Picked Up">Not Picked Up</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="no-schedule">No schedule has been listed yet. Pick a schedule!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<footer>
    &copy; 2024 MediConnect. All rights reserved.
</footer>

// Initialize DataTables for the schedule table
<script>
    $(document).ready(function() {
        $('#scheduleTable').DataTable();
    });
</script>

</body>
</html>
