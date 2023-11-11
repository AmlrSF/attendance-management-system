<?php 

    class Database {
        private $host = 'localhost';
        private $dbname = 'Etudiants';
        private $user = 'root';
        private $password = '';



        protected $conn;

        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

    
        public function insertRecord($table, $data) {
            try {
                $columns = implode(", ", array_keys($data));
                $values = ":" . implode(", :", array_keys($data));

                $stmt = $this->conn->prepare("INSERT INTO $table ($columns) VALUES($values)");

                $stmt->execute($data);

                return $stmt->rowCount();
            } catch (PDOException $e) {
                echo "Insert failed: " . $e->getMessage();
                return 0;
            }
        }

        
        public function checkItem($column, $table, $value) {
            try {
                $stmt = $this->conn->prepare("SELECT COUNT(*) FROM $table WHERE $column = :value");
                $stmt->bindParam(':value', $value);
                $stmt->execute();

                return $stmt->fetchColumn();
            } catch (PDOException $e) {
                echo "Check failed: " . $e->getMessage();
                return 0;
            }
        }
    }