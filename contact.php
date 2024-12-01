<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - MediConnect</title>

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

        .contact-message {
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

            .contact-message {
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
    Contact MediConnect
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

    <div class="contact-message">
        We're here to help! Reach out to us anytime.
    </div>

    <!-- Contact Information Section -->
    <section>
        <h3>How to Contact MediConnect</h3>
        <p>
            At MediConnect, we value our users and are always available to answer your questions, listen to your feedback, and assist you with any issues you might encounter. You can reach out to us via email or phone.
        </p>
        <p>
            Whether you have a question about your account, need assistance with the scheduling process, or want to know more about our medicines, we are here for you.
        </p>
    </section>

    <!-- Contact Details Section -->
    <section>
        <h3>Contact Details</h3>
        <p><strong>Email:</strong> <a href="mailto:mediconnect@gmail.com">mediconnect@gmail.com</a></p>
        <p><strong>Phone:</strong> 091234567891</p>
        <p>
            Feel free to contact us during business hours. Our customer support team is always ready to assist.
        </p>
    </section>
</main>

<footer>
    &copy; 2024 MediConnect. All rights reserved.
</footer>

<script>
    // Example SweetAlert2 usage (can be customized as needed)
    Swal.fire({
        title: 'Hello!',
        text: 'Reach out to us with any questions or feedback!',
        icon: 'info',
        confirmButtonColor: '#4CAF50',
        confirmButtonText: 'Got it!'
    });
</script>

</body>
</html>
