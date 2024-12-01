<?php
class Medicine {
    private $conn;

    // Constructor to accept and assign the connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to fetch all medicines
    public function getAllMedicines() {
        // Check if $conn is null before querying to avoid errors
        if ($this->conn === null) {
            die("Database connection is not initialized.");
        }

        // Execute the query to fetch all medicines
        $stmt = $this->conn->query("SELECT * FROM medicines");
        if ($stmt) {
            return $stmt->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array
        } else {
            die("Error executing query: " . $this->conn->error); // Handle query errors
        }
    }
}
?>
