<?php
    
    namespace model;

    class Database {
        // Variables
        // Private:
        private string $host;
        private string $username;
        private string $password;
        private string $database;
        private bool $isConnected;

        // Public:
        public \mysqli $mysqli;

        // Functions
        public function __construct(string $host, string $username, string $password, string $database) {
            if (!$host || !$username || !$database) throw new \Exception("databse::__construct - received empty arguments");

            $this->host = $host;
			$this->username = $username;
			$this->password = $password;
            $this->database = $database;
            
            $this->connect();
        }

        private function connect() {
			$this->mysqli = new \mysqli($this->host, $this->username, $this->password, $this->database);
			if ($this->mysqli->connect_error) throw new \Exception("Database.php - " . $this->mysqli->connect_error);
			$this->isConnected = true;
        }

        public function query(string $sql) {
			if (!$this->isConnected) throw new \Exception("database::query - isConnected is false");
			if (!$sql) throw new \Exception("databse::query - received empty arguments");
            
            $query = $this->mysqli->query($sql);
            echo $this->mysqli->error;

			return $query;
        }
        
        public function get(string $sql) {
            if (!$this->isConnected) throw new \Exception("database::query - isConnected is false");
			if (!$sql) throw new \Exception("databse::query - received empty arguments");

            $query = $this->mysqli->query($sql);
            return $query->fetch_assoc();
        }

        public function numberOfRows(string $sql) {
            if (!$this->isConnected) throw new \Exception("database::query - isConnected is false");
            if (!$sql) throw new \Exception("databse::query - received empty arguments");
            
            $query = $this->query($sql);

            return $query->num_rows;
        }

        public function rowExists(string $sql) {
            if (!$this->isConnected) throw new \Exception("database::query - isConnected is false");
            if (!$sql) throw new \Exception("databse::query - received empty arguments");
            
            $query = $this->query($sql);

            if ($query->num_rows > 0) return true;
            return false;
        }

		public function protect(string $string) {
			return $this->mysqli->real_escape_string($string);
		}
        
	};
	
?>