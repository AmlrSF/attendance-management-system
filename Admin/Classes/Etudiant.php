<?php
    class C_etudiant extends Database {

        public function addEtudiant($nom, $prenom, $dateNaissance, $codeClass, $numInscription, $address, $mail, $tel) {
            $data = [
                'Nom' => $nom,
                'Prenom' => $prenom,
                'DateNaissance' => $dateNaissance,
                'CodeClass' => $codeClass,
                'NumInscription' => $numInscription,
                'Address' => $address,
                'Mail' => $mail,
                'Tel' => $tel
            ];

            return $this->insertRecord('etudiant', $data);
        }

    //get all etudiant
    public function getAllStudents() {
            $query = "SELECT e.*, c.NomClass, g.NomGroupe, d.NomDepartement
                FROM etudiant e
                LEFT JOIN class c ON e.CodeClass = c.CodeClass
                LEFT JOIN groupe g ON c.CodeGroupe = g.CodeGroupe
                LEFT JOIN departement d ON c.CodeDepartement = d.CodeDepartement
            ";
            return $this->getAllRecords($query);
        }

    // get etudiant by ID
        public function getEtudiantById($idColumn, $etudiantId) {
            return $this->getRecordById('etudiant', $idColumn, $etudiantId);
        }


        //delete etudiant by id
        public function deleteEtudiantById($etudiantId) {
            return $this->deleteRecordById('etudiant',$idColumn, $etudiantId);
        }


        //edit etudinat by id
        public function editEtudiantById($etudiantId, $data) {
            return $this->editRecordById('etudiant', $etudiantId, $data);
        }

        public function getStudentsByClass($classCode) {
            try {
                $query = "
                    SELECT *
                    FROM etudiant
                    WHERE CodeClass = :classCode
                ";
        
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':classCode', $classCode);
                $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return [];
            }
        }

    
        public function markEtudiantAbsent($etudiantId, $matiereId, $enseignantId, $seanceId, $classId, $dateJour) {
            try {
                // Step 1: Create a new entry in ficheabsence
                $query = "INSERT INTO `ficheabsence` (`CodeMatiere`, `CodeEnseignant`, `CodeClass`, `DateJour`) 
                VALUES (:matiereId, :enseignantId, :classId, :dateJour)";

                $params = [    
                    'matiereId' => $matiereId,
                    'enseignantId' => $enseignantId,
                    'classId' => $classId,
                    'dateJour' => $dateJour,
                ];
                $this->insertMarkedEtudiant($query, $params);
        
                // Step 2: Get the last inserted ficheabsence ID
                $ficheAbsenceId = $this->conn->lastInsertId();
                
        
                // Step 3: Associate ficheabsence with seance
                $query = "INSERT INTO ficheabsenceseance (`CodeFicheAbsence`, CodeSeance) VALUES (:ficheAbsenceId, :seanceId)";
                $params = [
                    'ficheAbsenceId' => $ficheAbsenceId,
                    'seanceId' => $seanceId,
                ];
                $this->insertMarkedEtudiant($query, $params);
        
                // Step 4: Update ligneficheabsence
                $query = "INSERT INTO ligneficheabsence (CodeFicheAbsence, CodeEtudiant) VALUES (:ficheAbsenceId, :etudiantId)";
                $params = [
                    'ficheAbsenceId' => $ficheAbsenceId,
                    'etudiantId' => $etudiantId,
                ];
                $this->insertMarkedEtudiant($query, $params);
        
                return true;  // Marking absent successful
            } catch (PDOException $e) {
                // Log or handle the error
                return false;  // Marking absent failed
            }
        }
        
        private function insertMarkedEtudiant($query, $params) {
            try {
                $stmt = $this->conn->prepare($query);
                $stmt->execute($params);
            } catch (PDOException $e) {
                // Log or handle the error
                throw $e; // Rethrow the exception for better error handling in the calling code
            }
        }
        
    
    }
?>
    