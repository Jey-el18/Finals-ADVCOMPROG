<?php
session_start();
require_once 'classes/MedicineListing.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$medicineListing = new MedicineListing();

// Handle adding new medicine
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_medicine'])) {
    $name = $_POST['medicine_name'];
    $medicineListing->addMedicine($name);
}

// Handle medicine deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $medicineListing->deleteMedicine($delete_id);
}

$medicines = $medicineListing->getAllMedicines();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Listing - MediConnect</title>

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

        /* Table styling */
        table {
            margin: 20px auto;
            width: 90%;
            border-collapse: collapse;
            text-align: left;
        }

        table thead th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
        }

        table tbody tr {
            background-color: white;
            border-bottom: 1px solid #ccc;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        table tbody td {
            padding: 10px;
        }

        table tbody td a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        table tbody td a:hover {
            text-decoration: underline;
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

            table {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<header>
    <h2>Medicine Listing</h2>
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
        <h2>Add New Medicine</h2>
        <form method="POST">
            <label for="medicine_name">Medicine Name:</label>
            <input type="text" name="medicine_name" required>
            <input type="submit" name="add_medicine" value="Add Medicine">
        </form>
    </div>

    <h3 style="text-align: center;">Listed Medicines:</h3>
    <table id="medicineTable">
        <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($medicine = $medicines->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($medicine['name']); ?></td>
                    <td>
                        <a href="update_medicine.php?medicine_id=<?php echo $medicine['medicine_id']; ?>">Update</a>
                        <a href="#" class="delete-link" data-id="<?php echo $medicine['medicine_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<footer>
    &copy; 2024 MediConnect. All rights reserved.
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#medicineTable').DataTable();

        // SweetAlert2 for Delete Confirmation
        $('.delete-link').on('click', function(e) {
            e.preventDefault();
            const medicineId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `?delete_id=${medicineId}`;
                }
            });
        });
    });
</script>

</body>
</html>
