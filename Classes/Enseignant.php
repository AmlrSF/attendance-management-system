<?php
    class C_enseignant extends Database {

        // Add a new enseignant
        public function addEnseignant($nom, $prenom, $dateRecrutement, $address, $mail, $tel, $codeDepartement, $codeGrade) {
            $data = [
                'Nom' => $nom,
                'Prenom' => $prenom,
                'DateRecrutement' => $dateRecrutement,
                'Address' => $address,
                'Mail' => $mail,
                'Tel' => $tel,
                'CodeDepartement' => $codeDepartement,
                'CodeGrade' => $codeGrade
            ];

            $this->insertRecord('enseignant', $data);

            // After the insert query, get the last inserted ID
            $lastInsertedId = $this->getLastInsertedId();

            // Return the last inserted ID
            return $lastInsertedId;

        }

        // Get all enseignant
        public function getAllEnseignants() {
            $query = "SELECT e.*, d.NomDepartement, g.NomGrade
            FROM enseignant e
            LEFT JOIN departement d ON e.CodeDepartement = d.CodeDepartement
            LEFT JOIN grade g ON e.CodeGrade = g.CodeGrade";

            return $this->getAllRecords($query);
        }

        // Get enseignant by ID
        public function getEnseignantById($idColumn, $enseignantId) {
            return $this->getRecordById('enseignant', $idColumn, $enseignantId);
        }

        // Delete enseignant by ID
        public function deleteEnseignantById($enseignantId) {
            return $this->deleteRecordById('enseignant', 'CodeEnseignant', $enseignantId);
        }

        // Edit enseignant by ID
        public function editEnseignantById($enseignantId, $data) {
            return $this->editRecordById('enseignant', 'CodeEnseignant', $enseignantId, $data);
        }

    }

?>
