<?php
ob_start();
session_start();
if(isset($_SESSION["Username"])){
    $pageTitle = 'Absence Statistics';
    include 'init.php';
}else{
    header('Location: index.php');
    exit();
}

if (isset($_GET['etudiantId']) && isset($_GET['matiereId'])) {
    $etudiantId = $_GET['etudiantId'];
    $matiereId = $_GET['matiereId'];

    
    $statDB = new C_Stat();
    $matiere = $statDB->getRecordById("matiere", "CodeMatiere", $matiereId);
        

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dateDebut = $_POST['date_debut'] ?? null;
        $dateFin = $_POST['date_fin'] ?? null;
        $absenceByMatiere = $statDB->listeAbsenceEtudiantParMatiere($etudiantId, $matiereId, $dateDebut, $dateFin);
    }

    echo '<div class="container mt-5">';
    echo '<h2>Absence Statistics</h2>';

    // Display the form for user input
    echo '<form action="" method="post">';
    echo '<input type="hidden" name="etudiantId" value="' . $etudiantId . '">';
    echo '<input type="hidden" name="matiereId" value="' . $matiereId . '">';
    
    echo '<div class="mb-3 row">';
    echo '<label for="inputDateDebut" class="col-sm-2 col-form-label">Date Debut</label>';
    echo '<div class="col-sm-10 col-md-4">';
    echo '<input type="date" class="form-control" name="date_debut" id="inputDateDebut" required>';
    echo '</div>';
    echo '</div>';

    echo '<div class="mb-3 row">';
    echo '<label for="inputDateFin" class="col-sm-2 col-form-label">Date Fin</label>';
    echo '<div class="col-sm-10 col-md-4">';
    echo '<input type="date" class="form-control" name="date_fin" id="inputDateFin" required>';
    echo '</div>';
    echo '</div>';

    echo '<div class="form-group row">';
    echo '<div class="col-sm-10 offset-sm-2">';
    echo '<button type="submit" class="btn btn-primary">Get Absence Statistics</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';

    // Display the absence statistics table
    if (!empty($absenceByMatiere)) {
        echo '<h3 class="mt-4">Absence Statistics by Matiere <span class="fw-9">'.$matiere["NomMatiere"].'</h3>';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Date of Absence</th>';
        echo '<th>Teacher ID</th>';
        echo '<th>Session Name</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($absenceByMatiere as $absence) {
            echo '<tr>';
            echo '<td>' . $absence['date_absence'] . '</td>';
            echo '<td>' . $absence['nom_enseignant'] . '</td>';
            echo '<td>' . $absence['seance_absence'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '<div>le nombre total des abscences est <span class="fw-500">'. count($absenceByMatiere).'</span></div>';
    } else {
        echo '<p>No absence records found.</p>';
    }

    echo '</div>';

} else {
    echo "Error: Etudiant ID or Matiere ID not provided.";
}

include $tpl.'footer.php';
?>
