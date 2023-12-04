<?php
    ob_start();
    session_start();
    $pageTitle = 'Registeration';
    include 'init.php';
    $enseignantDB = new C_enseignant();
    $etudiantDB = new C_etudiant();
    $database = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo '<h1 class="text-center mb-5 mt-4">Register Enseignant</h1>';

    echo '<div class="container mt-3">';
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateRecrutement = $_POST['daterecrutement'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $codeDepartement = $_POST['codedepartement'];
    $codeGrade = $_POST['codegrade'];

    $formErrors = array();

 
    // Validate Nom
    if (empty($nom) || strlen($nom) < 4) {
        $formErrors[] = "Nom can't be empty and should be at least 4 characters.";
    }

    // Validate Prenom
    if (empty($prenom) || strlen($prenom) < 4) {
        $formErrors[] = "Prenom can't be empty and should be at least 4 characters.";
    }


    // Validate Address
    if (empty($address)) {
        $formErrors[] = "Address can't be empty.";
    }

    // Validate Email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formErrors[] = "Email is not valid.";
    }

    // Validate Tel
    if (empty($tel)) {
        $formErrors[] = "Tel can't be empty.";
    }

    // Validate Code Departement
    if (empty($codeDepartement)) {
        $formErrors[] = "Code Departement can't be empty.";
    }

    // Validate Code Grade
    if (empty($codeGrade)) {
        $formErrors[] = "Code Grade can't be empty.";
    }

    // Display form errors
    foreach ($formErrors as $error) {
        echo "<div class='alert alert-danger my-2 '>" . $error . "</div>";
    }

    // Check if there are no errors
    if (empty($formErrors)) {
           // Check if the enseignant with the same Prenom already exists
            $check = $enseignantDB->checkItem("Prenom", "enseignant", $prenom);

            if ($check == 1) {
                echo "<div class='alert alert-success'>Enseignant with the same Prenom already exists in the database.</div>";
            } else {
                // Insert a new enseignant
                $insertResult = $enseignantDB->addEnseignant(
                    $nom,
                    $prenom,
                    $dateRecrutement,
                    $address,
                    $email,
                    $tel,
                    $codeDepartement,
                    $codeGrade
                );

                if ($insertResult > 0) {
                
                    $userId = $_SESSION['uid'];

                    // echo $insertResult." ".$userId;

                    $database->updateUserRoleId($userId, $insertResult); 

                    $_SESSION['verified'] = true;

                    header('Location: index.php'); 

                    echo '<div class="alert mb-3 alert-success">Enseignant added successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger">Error inserting enseignant record.</div>';
                }
            }
    }
    
}
echo '</div>';
?>

<?php
    include $tpl . "footer.php";
    ob_end_flush();
?>
