<?php
// Including the configuration file to establish database connection
include 'Config.php';

// Define the Schedule class to handle scheduling operations
class Schedule {
    // Declare a private variable to hold the database connection
    private $conn;

    // Constructor to initialize the database connection using the Config class
    public function __construct() {
        // Instantiate the Config class to get the database connection
        $config = new Config();
        // Store the database connection in the $conn variable
        $this->conn = $config->getConnection();
    }

    // Method to add a new schedule entry for a user, medicine, quantity, and pickup date
    public function addSchedule($user_id, $medicine_id, $quantity, $pickup_date) {
        // Prepare the SQL statement to insert a new schedule entry
        $stmt = $this->conn->prepare("INSERT INTO schedules (user_id, medicine_id, quantity, pickup_date) VALUES (?, ?, ?, ?)");
        // Bind the parameters to the SQL statement: user_id (int), medicine_id (int), quantity (int), and pickup_date (string)
        $stmt->bind_param("iiis", $user_id, $medicine_id, $quantity, $pickup_date);
        // Execute the statement to insert the new schedule into the database
        $stmt->execute();
    }

    // Method to fetch all schedules for a specific user, including the medicine name, quantity, and pickup date
    public function getUserSchedules($user_id) {
        // Prepare the SQL statement to join the schedules and medicines tables and fetch relevant data for the user
        $stmt = $this->conn->prepare("SELECT schedules.schedule_id, medicines.name, schedules.quantity, schedules.pickup_date FROM schedules JOIN medicines ON schedules.medicine_id = medicines.medicine_id WHERE schedules.user_id = ?");
        // Bind the user_id parameter to the SQL statement
        $stmt->bind_param("i", $user_id);
        // Execute the statement
        $stmt->execute();
        // Return the result set, which contains the user's schedules
        return $stmt->get_result();
    }

    // Method to update a schedule entry (medicine, quantity, and pickup date) based on schedule ID
    public function updateSchedule($schedule_id, $medicine_id, $quantity, $pickup_date) {
        // Prepare the SQL statement to update an existing schedule entry based on its schedule_id
        $stmt = $this->conn->prepare("UPDATE schedules SET medicine_id = ?, quantity = ?, pickup_date = ? WHERE schedule_id = ?");
        // Bind the parameters to the SQL statement: medicine_id (int), quantity (int), pickup_date (string), and schedule_id (int)
        $stmt->bind_param("iisi", $medicine_id, $quantity, $pickup_date, $schedule_id);
        // Execute the statement to update the schedule in the database
        $stmt->execute();
    }
}
?>
