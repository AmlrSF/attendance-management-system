
<?php
    ob_start();
    session_start();
    $pageTitle = 'HomePage';
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

    $etudiantDB = new C_etudiant();
    $database = new Database();

    if (isset($_GET['student_id'])) {
        $studentId = $_GET['student_id'];
        $studentDetails = $etudiantDB->getRecordById('etudiant', 'CodeEtudiant', $studentId);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the form is submitted
        $studentId = $_POST['student_id'];
        $seanceId = $_POST['seance'];
        $matiereId = $_POST['matiere'];
        $date = $_POST['date'];
        $enseignantId = $_POST['enseignant'];
        echo $studentId." ".$seanceId." ".$studentId." ".$studentDetails['CodeClass']." ".$date." ".$enseignantId;


        //Mark the student absent
        $result = $etudiantDB->markEtudiantAbsent($studentId, $matiereId, $enseignantId, $seanceId, $studentDetails['CodeClass'], $date);

        echo '<div class="container mt-5">';
        if ($result) {
            // Successful absence marking
            echo "<div class='alert alert-success'>Student marked absent successfully.</div>";
        } else {
            // Handle the case where marking absent failed
            echo "<div class='alert alert-danger'>ailed to mark student absent..</div>";;
        }
        echo '</div class="container">';
    }

?>

<div class="container mt-5">
    <h2>Student Details</h2>
    <p><strong>ID:</strong> <?= $studentDetails['CodeEtudiant']; ?></p>
    <p><strong>Name:</strong> <?= $studentDetails['Nom'] . ' ' . $studentDetails['Prenom']; ?></p>
    <p><strong>Date of Birth:</strong> <?= $studentDetails['DateNaissance']; ?></p>
    <p><strong>Class Code:</strong> <?= $studentDetails['CodeClass']; ?></p>

    <form action="" method="post">
        <input type="hidden" name="student_id" value="<?= $studentDetails['CodeEtudiant']; ?>">
        <div class="mb-3">
            <label for="date" class="col-sm-2 col-form-label">Date Debut</label>
            <div class="col-sm-10 col-md-4">
                <input type="date" class="form-control" name="date" id="date" required>
            </div>
        </div>
        <label for="seance">Select Seance:</label>
        <select name="seance" id="seance" class="w-25 mt-1 form-control">
            <option value="" disabled selected>Select a Seance</option>
            <?php
                $seanceOptions = $database->getAllRecords("SELECT * FROM seance");
                foreach ($seanceOptions as $seance) {
                    echo "<option value=\"{$seance['CodeSeance']}\">{$seance['NomSeance']}</option>";
                }
            ?>
        </select>
        
        <label for="matiere">Select Matiere:</label>
        <select name="matiere" id="matiere" class="w-25 mt-1 form-control">
        <option value="" disabled selected>Select a Matiere</option>
            <?php
                $matiereOption = $database->getAllRecords("SELECT * FROM matiere");
                foreach ($matiereOption as $matiere) {
                    echo "<option value=\"{$matiere['CodeMatiere']}\">{$matiere['NomMatiere']}</option>";
                }
            ?>
        </select>
        <label for="enseignant">Select Enseignant:</label>
        <select name="enseignant" id="enseignant" class="w-25 mt-1 form-control">
            <option value="" disabled selected>Select a class</option>
            <?php
                // enseiagnt base on class an dep
                $enseignantOptions = $database->getAllRecords("SELECT * FROM enseignant");
                foreach ($enseignantOptions as $enseignant) {
                    $fullname = $enseignant['Nom']." ".$enseignant['Prenom'];
                    echo "<option value=\"{$enseignant['CodeEnseignant']}\">$fullname</option>";
                }
            ?>
        </select>
        <div class="d-flex align-items-center gap-2 mt-4">
            <button type="submit" class="btn btn-danger">Mark Absent</button>
            <a class="btn btn-primary" href="javascript:history.back()">Back</a>
        </div>
    </form>
</div>

<?php
    include $tpl . "footer.php";
    ob_end_flush();
?>
