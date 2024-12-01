<?php
// Define the Config class to manage database connection
class Config {
    // Declare private variables to store the database connection details
    private $servername = "localhost"; // The database server (localhost in this case)
    private $username = "root"; // The database username (root)
    private $password = ""; // The password for the database user (empty in this case)
    private $dbname = "mediconnect"; // The name of the database to connect to
    private $conn; // Declare a variable to hold the database connection

    // Constructor method to create a new database connection when the object is instantiated
    public function __construct() {
        // Create a new mysqli object to establish a connection to the MySQL database
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        // Check if the connection was successful, if not, terminate the script and show an error message
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error); // Terminate and show the error
        }
    }

    // Method to get the connection object
    public function getConnection() {
        return $this->conn; // Return the database connection object
    }
}
?>
