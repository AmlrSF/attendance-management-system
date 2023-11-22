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

        //get all records
        public function getAllRecords($query, $params = []) {
            try {
                $stmt = $this->conn->prepare($query);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return [];
            }
        }

        //insert a record
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

        //check if a record exist 
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


        public function getRecordById($table, $idColumn, $idValue) {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $idColumn = :idValue");
                $stmt->bindParam(':idValue', $idValue);
                $stmt->execute();
        
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false; // or handle the error in a way that makes sense for your application
            }
        }

        // delete record by ID
        public function deleteRecordById($table, $columnName, $id) {
            try {
                $stmt = $this->conn->prepare("DELETE FROM $table WHERE $columnName = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
        
                return $stmt->rowCount();
            } catch (PDOException $e) {
                echo "Delete failed: " . $e->getMessage();
                return 0;
            }
        }
        

    
        //  $data = [
        //     'Nom' => 'John',
        //     'Prenom' => 'Doe',
        //     'DateNaissance' => '1990-01-01',
        //     'CodeClass' => 'CS101',
        //     'NumInscription' => '123456',
        //     'Address' => '123 Main St',
        //     'Mail' => 'john.doe@example.com',
        //     'Tel' => '555-1234',
        //  ];
        
        //

        // edit record by ID
        public function editRecordById($table, $idColumn, $idValue, $data) {
            try {
                $updateFields = '';
                foreach ($data as $key => $value) {
                    $updateFields .= "$key = :$key, ";
                }
                $updateFields = rtrim($updateFields, ', ');
        
                $stmt = $this->conn->prepare("UPDATE $table SET $updateFields WHERE $idColumn = :idValue");
        
                $stmt->bindValue(':idValue', $idValue);
        
                foreach ($data as $key => $value) {
                    $stmt->bindValue(":$key", $value);
                }
        
                $stmt->execute();
        
                return $stmt->rowCount();
            } catch (PDOException $e) {
                echo "Edit failed: " . $e->getMessage();
                return 0;
            }
        }

        public function getClassesByDepartment($departmentCode) {
            try {
                $stmt = $this->conn->prepare("
                    SELECT c.*, g.NomGroupe
                    FROM class c
                    JOIN groupe g ON c.CodeGroupe = g.CodeGroupe
                    WHERE c.CodeDepartement = :departmentCode
                ");
                $stmt->bindParam(':departmentCode', $departmentCode);
                $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return [];
            }
        }
        
        function countMatieres() {
            // Your SQL query to count matieres
            $query = "SELECT COUNT(*) FROM matiere";
            return $this->countItems($query);
        }
    
        function countEnseignants() {
            // Your SQL query to count enseignants
            $query = "SELECT COUNT(*) FROM enseignant";
            return $this->countItems($query);
        }
    
        function countEtudiants() {
            // Your SQL query to count etudiants
            $query = "SELECT COUNT(*) FROM etudiant";
            return $this->countItems($query);
        }
    
        function countAbsences() {
            // Your SQL query to count absences
            $query = "SELECT COUNT(*) FROM ficheabsence";
            return $this->countItems($query);
        }
    
        function countItems($query) {  
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();
        }
       
    }

?>