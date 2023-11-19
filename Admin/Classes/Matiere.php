<?php
    class C_matiere extends Database {

        // Add a new Matiere record
        public function addMatiere($nomMatiere, $nbreHeureCours, $nbreHeureTD, $nbreHeureTP) {
            $data = [
                'NomMatiere' => $nomMatiere,
                'NbreHeureCoursParSemaine' => $nbreHeureCours,
                'NbreHeureTDParSemaine' => $nbreHeureTD,
                'NbreHeureTPParSemaine' => $nbreHeureTP,
            ];

            return $this->insertRecord('matiere', $data);
        }

        // Retrieve all Matiere records
        public function getAllMatieres() {
            $query = "SELECT * FROM matiere";
            return $this->getAllRecords($query);
        }

        // Retrieve a Matiere record by its CodeMatiere
        public function getMatiereById($codeMatiere) {
            return $this->getRecordById('matiere', 'CodeMatiere', $codeMatiere);
        }

        // Delete a Matiere record by its CodeMatiere
        public function deleteMatiereById($codeMatiere) {
            return $this->deleteRecordById('matiere', 'CodeMatiere', $codeMatiere);
        }

        // Update an existing Matiere record by its CodeMatiere
        public function editMatiereById($codeMatiere, $data) {
            return $this->editRecordById('matiere', 'CodeMatiere', $codeMatiere, $data);
        }
    }
?>
