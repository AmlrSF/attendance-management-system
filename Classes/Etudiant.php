<?php

class Etudiant extends Database {
    // Additional methods specific to Etudiant
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
}
?>
