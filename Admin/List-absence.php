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


    $statDB = new C_Stat();

    $allFicheAbsence = $statDB->getAllFicheAbsence();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedNomEtudiant = $_POST['nom_etudiant'] ?? null;
        $selectedPrenomEtudiant = $_POST['prenom_etudiant'] ?? null;
        $selectedDateDebut = $_POST['date_debut'] ?? null;
        $selectedDateFin = $_POST['date_fin'] ?? null;
        $selectedNomClasse = $_POST['nom_classe'] ?? null;

        $absenceByMatiere = $statDB->listeAbsenceEtudiantParMatiere($selectedNomEtudiant, $selectedPrenomEtudiant, $selectedDateDebut, $selectedDateFin);

        $absenceByEtudiant = $statDB->listeAbsenceEtudiant($selectedNomEtudiant, $selectedPrenomEtudiant, $selectedDateDebut, $selectedDateFin, $selectedNomClasse);


        echo '<pre>';
        print_r($absenceByEtudiant);
        echo '</pre>';

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

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Get Absence Statistics</button>
            </div>
        </div>
    </form>



    <?php if (isset($absenceByMatiere) && !empty($absenceByMatiere)) : ?>
        <h3 class="mt-4">Absence Details by Matiere</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom Enseignant</th>
                    <th>Date Absence</th>
                    <th>Seance Absence</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absenceByMatiere as $absence) : ?>
                    <tr>
                        <td><?= $absence['nom_enseignant']; ?></td>
                        <td><?= $absence['date_absence']; ?></td>
                        <td><?= $absence['seance_absence']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

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
                        <td><?= $absence['nombre_absences']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div class="container mt-5">
    <h2 class="mb-4">All Fiche Absence</h2>

    <?php
    if (!empty($allFicheAbsence)) :
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Fiche Absence ID</th>
                <th>Etudiant Name</th>
                <th>Matiere</th>
                <th>Class</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allFicheAbsence as $fiche) : ?>
                <tr>
                    <td><?= $fiche['CodeFicheAbsence']; ?></td>
                    <td><?= $fiche['EtudiantNom'] . ' ' . $fiche['EtudiantPrenom']; ?></td>
                    <td><?= $fiche['NomMatiere']; ?></td>
                    <td><?= $fiche['NomClass']; ?></td>
                    <td><?= $fiche['DateJour']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
        <p>No Fiche Absence found.</p>
    <?php endif; ?>
</div>


<?php include $tpl.'footer.php' ?>


