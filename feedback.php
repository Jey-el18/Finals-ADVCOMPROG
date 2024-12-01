<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "mediconnect"; // The name of your database

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an empty feedback array
$feedbacks = [];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the feedback data
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $feedback = htmlspecialchars($_POST['feedback']);

    // Prepare SQL statement to insert new feedback into the database
    $sql = "INSERT INTO feedback (name, username, feedback) VALUES ('$name', '$username', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        echo "New feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all feedback from the database
$sql = "SELECT * FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if there are any feedback entries
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
} else {
    echo "No feedback found.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    
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

        .about-message {
            font-size: 1.5em;
            margin: 20px 0;
            font-weight: bold;
            color: #4CAF50;
            text-align: center;
        }

        /* Content Area */
        section {
            width: 100%;
            max-width: 900px;
            margin-bottom: 30px;
        }

        section h3 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #4CAF50;
        }

        section p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #333;
        }

        /* Feedback Form */
        form {
            width: 100%;
            max-width: 600px;
            margin: 20px 0;
            text-align: center;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Feedback Display */
        .feedback {
            width: 100%;
            max-width: 900px;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .feedback h3 {
            font-size: 2.5em; 
            margin-bottom: 15px;
            color: #4CAF50;
        }

        .feedback p {
            font-size: 1.1em;
            line-height: 1.5;
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

            .about-message {
                font-size: 1.2em;
            }

            section {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<header>
    Customer Feedback
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

    <form method="POST" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="username" placeholder="Your Username" required>
        <textarea name="feedback" placeholder="Your Feedback" rows="5" required></textarea>
        <button type="submit">Submit Feedback</button>
    </form>

    <div class="feedback">
        <h3>Previous Feedbacks</h3>
        <?php
        // Display the feedback if there are any submissions
        if (!empty($feedbacks)) {
            foreach ($feedbacks as $feedback) {
                echo "<p><strong>" . htmlspecialchars($feedback['name']) . "</strong> (Username: " . htmlspecialchars($feedback['username']) . ")<br>" . htmlspecialchars($feedback['feedback']) . "<br><small>Submitted on: " . $feedback['created_at'] . "</small></p>";
            }
        }
        ?>
    </div>
</main>

<footer>
    &copy; 2024 MediConnect. All rights reserved.
</footer>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Add an event listener to the form submission
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to submit your feedback?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4CAF50',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                event.target.submit();
            }
        });
    });
</script>

</body>
</html>

