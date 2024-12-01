<?php
require_once 'includes/config.php'; // Include Config class
require_once 'includes/Schedule.php'; // Include Schedule class
require_once 'includes/Medicine.php'; // Include Medicine class

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Initialize the Config class to get the database connection
$config = new Config();
$conn = $config->getConnection(); // Get the database connection

// Instantiate Schedule and Medicine classes
$scheduleManager = new Schedule($conn);
$medicineManager = new Medicine($conn);

// Handle medicine pickup scheduling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medicineId = $_POST['medicine_id'];
    $quantity = $_POST['quantity'];
    $pickupDate = $_POST['pickup_date'];

    $scheduleManager->addSchedule($userId, $medicineId, $quantity, $pickupDate);
}

// Fetch all medicines for selection
$medicines = $medicineManager->getAllMedicines();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Medicine Pickup - MediConnect</title>

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: Arial, sans-serif;
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f9;
        }

        /* Make header, main, and footer full-width */
        header, main, footer {
            width: 100%;
        }

        /* Header styling */
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 2em;
        }

        /* Navigation menu */
        nav {
            text-align: center;
            margin: 10px 0 20px;
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

        /* Form container */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 0 auto 30px;
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

        select, input[type="number"], input[type="date"], input[type="submit"] {
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

        /* Footer */
        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        /* Make website responsive */
        @media (max-width: 768px) {
            header {
                font-size: 1.5em;
                padding: 15px;
            }

            nav a {
                display: block;
                margin: 10px 0;
            }

            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<header>
    <h2>Schedule Medicine Pickup</h2>
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

    <div class="form-container">
        <h2>Schedule Your Medicine Pickup</h2>
        <form method="POST">
            <label for="medicine_id">Medicine:</label>
            <select name="medicine_id" id="medicine_id" required>
                <?php foreach ($medicines as $medicine): ?>
                    <option value="<?= htmlspecialchars($medicine['medicine_id']) ?>">
                        <?= htmlspecialchars($medicine['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="5" required>

            <label for="pickup_date">Pickup Date:</label>
            <input type="date" id="pickup_date" name="pickup_date" required>

            <input type="submit" value="Schedule">
        </form>
    </div>
</main>

<footer>
    &copy; 2024 MediConnect. All rights reserved.
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert2 integration
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Success!',
                text: 'Your medicine pickup has been scheduled.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                this.submit();
            });
        });
    });
</script>

</body>
</html>
