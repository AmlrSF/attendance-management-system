<?php

class C_Stat extends Database
{
    public function listeAbsenceEtudiantParMatiere($codeEtudiant, $codeMatiere, $dateDebut, $dateFin)
    {
        $query = "
            SELECT
                e.nom AS nom_enseignant,
                f.DateJour AS date_absence,
                s.NomSeance AS seance_absence
            FROM
                ficheabsence f
            JOIN
                enseignant e ON f.CodeEnseignant = e.CodeEnseignant
            JOIN
                ficheabsenceseance fs ON f.CodeFicheAbsence = fs.CodeFicheAbsence
            JOIN
                seance s ON fs.CodeSeance = s.CodeSeance
            JOIN
                ligneficheabsence lfa ON f.CodeFicheAbsence = lfa.CodeFicheAbsence
            WHERE
                lfa.CodeEtudiant = :codeEtudiant
                AND f.CodeMatiere = :codeMatiere
                AND f.DateJour BETWEEN :dateDebut AND :dateFin;
        ";
    
        $params = [
            'codeEtudiant' => $codeEtudiant,
            'codeMatiere' => $codeMatiere,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
        ];
    
        return $this->getAllRecords($query, $params);
    }
    

    
    //list absence
    public function listeAbsenceEtudiant($nomEtudiant, $prenomEtudiant, $dateDebut, $dateFin, $nomClasse)
    {
        $query = "
            SELECT
                m.NomMatiere AS nom_matiere,
                COUNT(fs.CodeFicheAbsence) AS nombre_absences,
                e.*,
                m.*
            FROM
                ficheabsence f
            JOIN
                matiere m ON f.CodeMatiere = m.CodeMatiere
            JOIN
                ficheabsenceseance fs ON f.CodeFicheAbsence = fs.CodeFicheAbsence
            JOIN
                seance s ON fs.CodeSeance = s.CodeSeance
            JOIN
                ligneficheabsence lfa ON f.CodeFicheAbsence = lfa.CodeFicheAbsence
            JOIN
                etudiant e ON lfa.CodeEtudiant = e.CodeEtudiant
            JOIN
                class c ON e.CodeClass = c.CodeClass
            WHERE
                e.Nom = :nomEtudiant
                AND e.Prenom = :prenomEtudiant
                AND f.DateJour BETWEEN :dateDebut AND :dateFin
                AND c.NomClass = :nomClasse
            GROUP BY
                m.NomMatiere;
        ";
    
        $params = [
            'nomEtudiant' => $nomEtudiant,
            'prenomEtudiant' => $prenomEtudiant,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'nomClasse' => $nomClasse,
        ];
    
        return $this->getAllRecords($query, $params);
    }
    
    
    public function getAllFicheAbsence() {
        $query = "SELECT DISTINCT
                f.CodeFicheAbsence,
                e.Nom AS EtudiantNom,
                e.Prenom AS EtudiantPrenom,
                m.NomMatiere,
                c.NomClass,
                f.DateJour
            FROM
                ficheabsence f
            JOIN
                ligneficheabsence lf ON f.CodeFicheAbsence = lf.CodeFicheAbsence
            JOIN
                etudiant e ON lf.CodeEtudiant = e.CodeEtudiant
            JOIN
                matiere m ON f.CodeMatiere = m.CodeMatiere
            JOIN
                class c ON f.CodeClass = c.CodeClass
        ";

        return $this->getAllRecords($query);
    }

    
}

?>

