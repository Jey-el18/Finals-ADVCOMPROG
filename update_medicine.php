<?php
require_once 'includes/config.php'; // Include the Config file
session_start(); // Start session

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Establish the database connection
$config = new Config(); // Create an instance of the Config class
$conn = $config->getConnection(); // Initialize the connection

if (isset($_GET['medicine_id'])) {
    $medicine_id = $_GET['medicine_id']; // Get medicine id

    // Fetch medicine data
    $stmt = $conn->prepare("SELECT name FROM medicines WHERE medicine_id = ?");
    $stmt->bind_param("i", $medicine_id); // Bind parameter
    $stmt->execute(); // Execute query
    $result = $stmt->get_result(); // Get result
    $medicine = $result->fetch_assoc(); // Fetch medicine data

    // Handle medicine update
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['medicine_name']; // Get new medicine name

        // Update medicine in database
        $stmt = $conn->prepare("UPDATE medicines SET name = ? WHERE medicine_id = ?");
        $stmt->bind_param("si", $name, $medicine_id); // Bind parameters
        $stmt->execute(); // Execute query
        header("Location: medicine_listing.php"); // Redirect to medicine listing page
        exit();
    }
} else {
    header("Location: medicine_listing.php"); // Redirect if medicine_id is not set
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medicine - MediConnect</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
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

        /* Make the header, main, and footer stretch full width */
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

        input[type="text"], input[type="submit"] {
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
    <h2>Update Medicine</h2>
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
        <h2>Update Medicine Information</h2>
        <form method="POST">
            <label for="medicine_name">Medicine Name:</label>
            <input type="text" name="medicine_name" value="<?php echo htmlspecialchars($medicine['name']); ?>" required>
            <input type="submit" value="Update">
        </form>
    </div>
</main>

<footer>
    &copy; 2024 MediConnect. All rights reserved.
</footer>

</body>
</html>
