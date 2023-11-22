 
<?php
    ob_start();
    session_start();
    $pageTitle = 'HomePage';
    include 'init.php';

    $database = new Database();
    $enseignantDB = new C_enseignant();

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

    $enseignantId = $database->getUserRoleId($_SESSION['uid']);
    $enseignantData = $enseignantDB->getEnseignantById('CodeEnseignant', $enseignantId);
    $userData = $database->getUserById($_SESSION['uid']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $enseignantId = isset($_GET['enseignantId']) ? $_GET['enseignantId'] : null;
        echo '<h1 class="text-center mb-5 mt-4">Update Enseignant</h1>';


        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateRecrutement = $_POST['daterecrutement'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $codeDepartement = $_POST['codedepartement'];
        $codeGrade = $_POST['codegrade'];
        $newUsername = $_POST['username'];
        $newPassword = $_POST['password'];

        
        echo $newPassword." ".$newUsername;

        $formErrors = array();
    
        if (empty($newUsername) || empty($newPassword)) {
            $formErrors[] = 'All fields are required.';
        }
    
        if (strlen($newUsername) < 4) {
            $formErrors[] = 'Username must be at least 4 characters.';
        }
        // Validate Nom
        if (empty($nom)) {
            $formErrors[] = 'Nom cannot be empty';
        }

        // Validate Prenom
        if (empty($prenom)) {
            $formErrors[] = 'Prenom cannot be empty';
        }

        // Validate DateRecrutement
        if (empty($dateRecrutement)) {
            $formErrors[] = 'Date Recrutement cannot be empty';
        }

        // Validate Address
        if (empty($address)) {
            $formErrors[] = 'Address cannot be empty';
        }

        // Validate Email
        if (empty($email)) {
            $formErrors[] = 'Email cannot be empty';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $formErrors[] = 'Invalid email format';
        }

        // Validate Tel
        if (empty($tel)) {
            $formErrors[] = 'Tel cannot be empty';
        }

        // Validate CodeDepartement
        if (empty($codeDepartement)) {
            $formErrors[] = 'Code Departement cannot be empty';
        }

        // Validate CodeGrade
        if (empty($codeGrade)) {
            $formErrors[] = 'Code Grade cannot be empty';
        }

        // Display form errors
        foreach ($formErrors as $error) {
            echo "<div class='alert alert-danger my-2 '>" . $error . "</div>";
            
        }


        if (empty($formErrors)) {


            $updateResult = $enseignantDB->editRecordById('enseignant', 'CodeEnseignant', $enseignantId, [
                'Nom' => $nom,
                'Prenom' => $prenom,
                'DateRecrutement' => $dateRecrutement,
                'Address' => $address,
                'Mail' => $email,
                'Tel' => $tel,
                'CodeDepartement' => $codeDepartement,
                'CodeGrade' => $codeGrade,
            ]);

            $updateResult = $database->updateUsernamePasswordById($_SESSION['uid'], $newUsername, $newPassword);

            if ($updateResult > 0) {
                header('Location: logout.php');
                exit();
            } else {
                
            }
    
            if ($updateResult > 0) {
                echo '<div class="alert mb-3 alert-success">Record updated successfully!</div>';
                redirectHome("You will be redirect to ","profile.php",3);
                
            } else {
                echo '<div class="alert alert-danger">Error updating record.</div>';
                redirectHome("You will be redirect to ","profile.php",3);
            }    
        }else{
            
            redirectHome("You will be redirect to ","Enseignant.php",3);
        }
        } else {
            $theMsg = '<div class="alert mt-5 alert-danger">You can\'t browse this page directly</div>';
            redirectHome("You can't access to this page ","Enseignant.php",3);
    }

    
    include $tpl . "footer.php";
    ob_end_flush();
?>            