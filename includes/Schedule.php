<?php
// Define the Schedule class to handle operations related to scheduling medicine pickups
class Schedule {
    private $conn; // Declare a private variable to store the database connection

    // Constructor method to initialize the Schedule object with a database connection
    public function __construct($conn) {
        $this->conn = $conn; // Assign the passed connection to the $conn property
    }

    // Method to add a new schedule to the database
    public function addSchedule($userId, $medicineId, $quantity, $pickupDate) {
        // Prepare an SQL statement to insert the schedule data into the 'schedules' table
        $stmt = $this->conn->prepare("INSERT INTO schedules (user_id, medicine_id, quantity, pickup_date) VALUES (?, ?, ?, ?)");
        
        // Bind the parameters to the prepared statement, specifying their types: 
        // 'i' for integer (userId, medicineId, quantity), 's' for string (pickupDate)
        $stmt->bind_param("iiis", $userId, $medicineId, $quantity, $pickupDate);
        
        // Execute the prepared statement and return the result (true if successful, false if not)
        return $stmt->execute();
    }
}
?>
