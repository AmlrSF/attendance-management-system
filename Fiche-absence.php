
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

    $statDB = new C_Stat();

    $allFicheAbsence = $statDB->getAllFicheAbsence();

    
?>

<div class="container mt-5">
    <h2 class="mb-4">All Fiche Absence</h2>

    <?php
    if (!empty($allFicheAbsence)) {
        
        $ficheByClass = [];
        foreach ($allFicheAbsence as $fiche) {
            $className = $fiche['NomClass'];

            if (!isset($ficheByClass[$className])) {
                $ficheByClass[$className] = [];
            }

            $ficheByClass[$className][] = $fiche;
        }

        // Display Table for Each Class
        foreach ($ficheByClass as $class => $ficheList) {
            echo "<h3 class='mt-3'>$class</h3>";

            echo "<table class='table'>";
            echo "<thead><tr><th>Fiche Absence ID</th><th>Etudiant Name</th><th>Matiere</th><th>Date</th></tr></thead>";
            echo "<tbody>";

            foreach ($ficheList as $fiche) {
                echo "<tr>";
                echo "<td>{$fiche['CodeFicheAbsence']}</td>";
                echo "<td>{$fiche['EtudiantNom']} {$fiche['EtudiantPrenom']}</td>";
                echo "<td>{$fiche['NomMatiere']}</td>";
                echo "<td>{$fiche['DateJour']}</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        }
    } else {
        echo "<p>No Fiche Absence found.</p>";
    }
    ?>
</div>


<?php
    include $tpl . "footer.php";
    ob_end_flush();
?>
