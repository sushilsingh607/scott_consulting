<?php 
class Database {
	// The database connection
    public $connection;

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {
        // Try and connect to the database
        if(isset($connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('config.ini');
            $connection = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
        }
		
		// Check for connection error
		if ($connection->connect_error) {
			echo "Connection Failed";
			return false;
		} else {
			return $connection;
		}
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
        // Connect to the database
        $connection = $this->connect();
        
        // Query the database
        $result = $connection->query($query);
        
        // Return the result
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) {
        // Query
        $result = $this->query($query);
		
		// Check for query result
        if($result === false) {
			return false;
        }
        
        // Loop and store the data in array
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        // Return the rows
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        $connection = $this->connect();
        return $connection->error;
    }
}
?>
