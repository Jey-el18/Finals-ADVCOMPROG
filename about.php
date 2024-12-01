<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - MediConnect</title>

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
    About MediConnect
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

    <div class="about-message">
        Learn more about how MediConnect can help you!
    </div>

    <!-- What is MediConnect Section -->
    <section>
        <h3>What is MediConnect?</h3>
        <p>
            MediConnect is an innovative and user-friendly platform designed to make the give out of over-the-counter (OTC) medicines more accessible. Our website allows users to easily schedule pickups for a variety of free medicines that they may need, ensuring that they never have to worry about running out of essential medications.
        </p>
        <p>
            The concept behind MediConnect is simple yet powerful: providing a seamless, cost-effective way for individuals to access necessary medications without the hassle of navigating complicated processes.
        </p>
        <p>
            MediConnect focuses on offering essential over-the-counter medications that can be picked up according to your schedule. From pain relief medicines like Paracetamol and Ibuprofen to allergy relief and digestive aids, we have a wide selection of medications available to suit your health needs.
        </p>
        <p>
            Our service is ideal for anyone looking for free, reliable ways to manage their medicine needs. With MediConnect, getting your medications has never been easier.
        </p>
    </section>

    <!-- Why Should You Use MediConnect Section -->
    <section>
        <h3>Why Should You Use MediConnect?</h3>
        <p>
            MediConnect is completely free. Many individuals may find it difficult to afford regular medications or might not have access to nearby pharmacies. MediConnect bridges that gap by offering free OTC medicines.
        </p>
        <p>
            Another key reason to use MediConnect is the convenience it offers. With our platform, you can select the medications you need and schedule a pickup at your preferred time. This flexibility ensures that you don't have to worry about fitting a trip to the pharmacy into your busy schedule.
        </p>
        <p>
            MediConnect also provides an array of medicines that cater to various common health concerns. Whether you're looking for pain relief, cold medicine, or digestive aids, we have a wide selection to choose from.
        </p>
        <p>
            Furthermore, MediConnect allows you to manage your medicine needs in a way that works for you. We give you the ability to schedule pickups based on your availability, ensuring that you always have your medications when you need them.
        </p>
    </section>

    <!-- Benefits of Using MediConnect Section -->
    <section>
        <h3>Benefits of Using MediConnect</h3>
        <p>
            One of the biggest benefits of using MediConnect is the ability to access free over-the-counter medications. Traditional pharmacies often charge high prices for medicines, but with MediConnect, you don’t have to worry about the cost.
        </p>
        <p>
            Another significant benefit is the convenience of scheduling medicine pickups. MediConnect removes that burden by allowing you to choose a time that works best for you. Whether you're at home or at work, you can select the most convenient time to pick up your medications.
        </p>
        <p>
            MediConnect is also beneficial because it helps ensure you don’t run out of medications. By setting up a schedule for medicine pickups, you’ll have your required medicines pickup on time and in the right quantity.
        </p>
        <p>
            The simplicity and ease of use of the MediConnect platform are additional advantages. You don’t need to navigate complex forms or deal with confusing processes. The platform is designed to be user-friendly, with an intuitive interface that allows you to book your pickups in just a few clicks.
        </p>
        <p>
            Lastly, MediConnect’s ability to provide a variety of OTC medicines for common health issues means that you don't have to worry. We offer solutions for your most common health concerns, from pain relief to digestive aids and more.
        </p>
    </section>
</main>

<footer>
    &copy; 2024 MediConnect. All rights reserved.
</footer>

<script>
    // Example SweetAlert2 usage (can be customized as needed)
    Swal.fire({
        title: 'Welcome!',
        text: 'Learn more about how we can help you!',
        icon: 'info',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Got it!'
    });
</script>

</body>
</html>
