<?php

ob_start();
session_start();
include 'init.php';
// Check if the user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: Login.php');
    exit();
}

// Check if the user is not logged in
if (isset($_SESSION['verified']) && $_SESSION['verified'] == false) {
    header('Location: registeration.php');
    exit();
}

$statDB = new C_Stat();
$etudiantDB = new C_etudiant();
$enseignantDB = new C_enseignant();
$allFicheAbsence = $statDB->getAllFicheAbsence();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selectedNomEtudiant = $_POST['nom_etudiant'] ?? null;
    $selectedPrenomEtudiant = $_POST['prenom_etudiant'] ?? null;
    $selectedDateDebut = $_POST['date_debut'] ?? null;
    $selectedDateFin = $_POST['date_fin'] ?? null;
    $selectedNomClasse = $_POST['nom_classe'] ?? null;




    $absenceByEtudiant = $statDB->listeAbsenceEtudiant($selectedNomEtudiant, $selectedPrenomEtudiant, $selectedDateDebut, $selectedDateFin, $selectedNomClasse);


    // echo '<pre>';
    // print_r($absenceByEtudiant);
    // echo '</pre>';

}




?>



<div class="container mt-5">
    <h2 class="mb-4">Absence Statistics</h2>

    <form action="" method="post">
        <div class="mb-3 row">
            <label for="inputNomEtudiant" class="col-sm-2 col-form-label">Nom Etudiant</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" class="form-control" name="nom_etudiant" id="inputNomEtudiant" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPrenomEtudiant" class="col-sm-2 col-form-label">Prenom Etudiant</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" class="form-control" name="prenom_etudiant" id="inputPrenomEtudiant" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputDateDebut" class="col-sm-2 col-form-label">Date Debut</label>
            <div class="col-sm-10 col-md-4">
                <input type="date" class="form-control" name="date_debut" id="inputDateDebut" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputDateFin" class="col-sm-2 col-form-label">Date Fin</label>
            <div class="col-sm-10 col-md-4">
                <input type="date" class="form-control" name="date_fin" id="inputDateFin" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputNomClasse" class="col-sm-2 col-form-label">Nom Classe</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" class="form-control" name="nom_classe" id="inputNomClasse" required>
            </div>
        </div>
        <!-- <div class="mb-3 row">
            <label for="inputClass" class="col-sm-2 col-form-label">Class Name</label>
                <div class="col-sm-10 col-md-4">
                    <select required="required" name="class" class="form-control" id="inputClass">
                   
                    <option value="" disabled selected>Select a class</option>

                    //<?php
                    // Fetch class options from the database
                    //$classOptions = $etudiantDB->getAllRecords("SELECT * FROM class");

              

                    // Loop through the options and generate <option> elements
                    //foreach ($classOptions as $class) {
                        //echo '<option value="' . $class['CodeClass'] . '">' . $class['NomClass'] . '</option>';
                    //}
                    ?>
                </select>
            </div>
        </div> -->

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Get Absence Statistics</button>
            </div>
        </div>
    </form>


    <?php
        echo $_SESSION['uid'];
        $ensigantDep = $enseignantDB->getEnseignantById("CodeEnseignant",$_SESSION['uid']);
        // echo $enseignantDB;
        echo "<pre>";
        print_r($ensigantDep);
        echo "</pre>";

    ?>



    <?php if (isset($absenceByEtudiant) && !empty($absenceByEtudiant)) : ?>
        
        <h3 class="mt-4">Absence Statistics by Matiere</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom Matiere</th>
                    <th>Nombre Absences</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absenceByEtudiant as $absence) : ?>
                    <tr>
                        <td><?= $absence['nom_matiere']; ?></td>
                        <td>
                            <!-- Generate a link with etudiantId and matiereId as parameters -->
                            <a href="seance-detail.php?etudiantId=<?= $absence['CodeEtudiant']; ?>&matiereId=<?= $absence['CodeMatiere']; ?>&dateDebut=<?= $selectedDateDebut; ?>&dateFin=<?= $selectedDateFin; ?>">
                                <?= $absence['nombre_absences']; ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <?php include $tpl . 'footer.php' ?>