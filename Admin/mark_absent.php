<?php 
    ob_start();
    session_start();
    if(isset($_SESSION["Username"])){
        $pageTitle = 'Student Details';
        include 'init.php';
        
    }else{
        header('Location: index.php');
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
        if (isset($_POST['student_id'], $_POST['seance'])) {
            $studentId = $_POST['student_id'];
            $seanceId = $_POST['seance'];

            // Mark the student absent
            $result = $etudiantDB->markEtudiantAbsent($studentId, $seanceId);

            if ($result) {
                // Successful absence marking
                echo "Student marked absent successfully.";
            } else {
                // Handle the case where marking absent failed
                echo "Failed to mark student absent.";
            }
        } else {
            // Handle the case where student ID or seance is not provided
            echo "Student ID or seance not provided.";
        }
    }

?>

<div class="container mt-5">
    <h2>Student Details</h2>
    <p><strong>ID:</strong> <?= $studentDetails['CodeEtudiant']; ?></p>
    <p><strong>Name:</strong> <?= $studentDetails['Nom'] . ' ' . $studentDetails['Prenom']; ?></p>
    <p><strong>Date of Birth:</strong> <?= $studentDetails['DateNaissance']; ?></p>
    <p><strong>Class Code:</strong> <?= $studentDetails['CodeClass']; ?></p>

    <form action="student_details.php?student_id=<?= $studentId ?>" method="post">
        <input type="hidden" name="student_id" value="<?= $studentDetails['CodeEtudiant']; ?>">
        <label for="seance">Select Seance:</label>
        <select name="seance" id="seance" class="w-25 mt-1 form-control">
            <?php
                $seanceOptions = $database->getAllRecords("SELECT * FROM seance");
                foreach ($seanceOptions as $seance) {
                    echo "<option value=\"{$seance['CodeSeance']}\">{$seance['NomSeance']}</option>";
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
include $tpl.'footer.php';
?>
