<?php
    ob_start();
    session_start();
    $pageTitle = 'Registeration';
    include 'init.php';
    $enseignantDB = new C_enseignant();
    $etudiantDB = new C_etudiant();
    $database = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<h1 class="text-center mb-5 mt-4">register Etudiant</h1>';

    echo '<div class="container mt-3">';
    $name = $_POST['name'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['datenaissance'];
    $class = $_POST['class'];
    $inscription = $_POST['inscription'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $formErrors = array();

    // Validate Name
    if (empty($name) || strlen($name) < 4) {
        $formErrors[] = "Name can't be empty and should be at least 4 characters.";
    }

    // Validate Prenom
    if (empty($prenom) || strlen($prenom) < 4) {
        $formErrors[] = "Prenom can't be empty and should be at least 4 characters.";
    }

    // Validate Class
    if (empty($class)) {
        $formErrors[] = "Class can't be empty.";
    }

    // Validate Inscription ID
    if (empty($inscription)) {
        $formErrors[] = "Inscription ID can't be empty.";
    }

    // Validate Address
    if (empty($address)) {
        $formErrors[] = "Address can't be empty.";
    }

    // Validate Email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formErrors[] = "Email is not valid.";
    }

    // Validate Tel (You can add more specific validation for phone number)
    if (empty($tel)) {
        $formErrors[] = "Tel can't be empty.";
    }

    // Display form errors
    foreach ($formErrors as $error) {
        echo "<div class='alert alert-danger my-2 '>" . $error . "</div>";
    }

    // Check if there are no errors
    if (empty($formErrors)) {
      // Check if the etudiant with the same Prenom already exists
        $check = $etudiantDB->checkItem("Prenom", "etudiant", $prenom);

        if ($check == 1) {
            echo "<div class='alert alert-success'>Etudiant with the same Prenom already exists in the database.</div>";
        } else {
            // Insert a new etudiant
            $insertResult = $etudiantDB->addEtudiant(
                $name,
                $prenom,
                $dateNaissance,
                $class,
                $inscription,
                $address,
                $email,
                $tel
            );

            if ($insertResult > 0) {
               
                $userId = $_SESSION['uid'];



                $database->updateUserRoleId($userId, $insertResult);

                $_SESSION['verified'] = true;
            
                header('Location: index.php');  

                echo '<div class="alert mb-3 alert-success">Etudiant added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error inserting etudiant record.</div>';
            }
        }
        }
    }

echo '</>';
?>
<?php
    include $tpl . "footer.php";
    ob_end_flush();
?>
