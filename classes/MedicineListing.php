<?php
// Including the configuration file to establish database connection
include 'includes/config.php';

// Define the MedicineListing class which handles medicine operations
class MedicineListing {
    // Declare a private variable to hold the database connection
    private $conn;

    // Constructor to initialize the database connection using the Config class
    public function __construct() {
        // Instantiate the Config class to get the database connection
        $config = new Config();
        // Store the database connection in the $conn variable
        $this->conn = $config->getConnection();
    }

    // Method to add a new medicine to the medicines table
    public function addMedicine($name) {
        // Prepare the SQL statement to insert a new medicine into the medicines table
        $stmt = $this->conn->prepare("INSERT INTO medicines (name) VALUES (?)");
        // Bind the parameter 'name' to the SQL statement
        $stmt->bind_param("s", $name);
        // Execute the statement to insert the data into the database
        $stmt->execute();
    }

    // Method to delete a medicine from the medicines table based on its ID
    public function deleteMedicine($medicine_id) {
        // Prepare the SQL statement to delete the medicine with the given ID
        $stmt = $this->conn->prepare("DELETE FROM medicines WHERE medicine_id = ?");
        // Bind the parameter 'medicine_id' to the SQL statement
        $stmt->bind_param("i", $medicine_id);
        // Execute the statement to delete the medicine from the database
        $stmt->execute();
    }

    // Method to retrieve all medicines from the medicines table
    public function getAllMedicines() {
        // Execute the SQL query to select all records from the medicines table
        $result = $this->conn->query("SELECT * FROM medicines");
        // Return the result of the query (the medicines records)
        return $result;
    }

    // Method to update the details of an existing medicine
    public function updateMedicine($medicine_id, $name) {
        // Prepare the SQL statement to update the medicine name where the ID matches
        $stmt = $this->conn->prepare("UPDATE medicines SET name = ? WHERE medicine_id = ?");
        // Bind the parameters 'name' and 'medicine_id' to the SQL statement
        $stmt->bind_param("si", $name, $medicine_id);
        // Execute the statement to update the medicine details in the database
        $stmt->execute();
    }
}
?>
