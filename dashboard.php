<?php
require_once 'includes/config.php'; // Include database connection
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MediConnect</title>

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
        }

        .dashboard-message {
            font-size: 1.5em;
            margin: 20px 0;
            font-weight: bold;
            color: #4CAF50;
            text-align: center;
        }

        /* Medicines List Section */
        .medicines-list, .uses-list {
            margin-top: 30px;
            width: 100%;
            max-width: 900px;
        }

        .medicines-list ul, .uses-list ul {
            list-style-type: none;
            padding: 0;
        }

        .medicines-list li, .uses-list li {
            margin-bottom: 10px;
            font-size: 1.1em;
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

            .dashboard-message {
                font-size: 1.2em;
            }

            .medicines-list, .uses-list {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<header>
    Welcome to Your Dashboard
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

    <div class="dashboard-message">
        Welcome back! Manage your medicine listings and schedules here.
    </div>

    <!-- medicine image-->
    <img src="images/medicine.webp" alt="Falling Medicines Image" style="width:100%; max-height:700px; margin: 20px 0;">

    <!-- Medicines List Section -->
    <div class="medicines-list">
        <h3>Below is the list of available medicines:</h3>
        <ul>
            <li>Biogesic (Paracetamol)</li>
            <li>Tempra (Paracetamol)</li>
            <li>Neozep</li>
            <li>Bioflu</li>
            <li>Alaxan (Ibuprofen + Paracetamol)</li>
            <li>Decolgen</li>
            <li>Benadryl (Diphenhydramine)</li>
            <li>Kremil-S (Antacid)</li>
            <li>Tuseran</li>
            <li>Solmux (Carbocisteine)</li>
            <li>Diatabs (Loperamide)</li>
            <li>Hydrite (Oral Rehydration Salts)</li>
            <li>Enervon (Multivitamin)</li>
            <li>Rexidol Forte (Paracetamol + Caffeine)</li>
        </ul>
    </div>

    <img src="images/usesofmedicines.webp" alt="Uses of Medicines Image" style="width:100%; max-height:500px; margin: 20px 0;">

    <!-- Uses List Section -->
    <div class="uses-list">
        <h3>Uses of the Medicines:</h3>
        <ul>
            <li>Pain and Fever Relief</li>
            <li>Cold and Flu Relief</li>
            <li>Cough Relief</li>
            <li>Allergy Relief</li>
            <li>Digestive Relief</li>
            <li>Rehydration and Supplementation</li>
        </ul>
    </div>
</main>

<footer>
    &copy; 2024 MediConnect. All rights reserved.
</footer>

<script>
    // Example SweetAlert2 usage (can be customized as needed)
    Swal.fire({
        title: 'Welcome!',
        text: 'Glad to have you back!',
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Thanks!'
    });
</script>

</body>
</html>
