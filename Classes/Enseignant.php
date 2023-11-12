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

        return $this->insertRecord('enseignant', $data);
    }

    // Get all enseignant
    public function getAllEnseignants() {
        $query = "SELECT * FROM enseignant";
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
