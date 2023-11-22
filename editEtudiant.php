 
<?php
    ob_start();
    session_start();
    $pageTitle = 'HomePage';
    include 'init.php';
    $etudiantDB = new C_etudiant();
    $database = new Database();


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
    
    $etudiantId = $database->getUserRoleId($_SESSION['uid']);
    $etudiantData = $etudiantDB->getEtudiantById('CodeEtudiant', $etudiantId);
    $userData = $database->getUserById($_SESSION['uid']);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $name = $_POST['name'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['datenaissance'];
        $class = $_POST['class'];
        $inscription = $_POST['inscription'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $newUsername = $_POST['username'];
        $newPassword = $_POST['password'];
    
        $hashpass = sha1($newPassword);
        echo $newPassword." ".$newUsername;

        $formErrors = array();
    
        if (empty($newUsername) || empty($newPassword)) {
            $formErrors[] = 'All fields are required.';
        }
    
        if (strlen($newUsername) < 4) {
            $formErrors[] = 'Username must be at least 4 characters.';
        }

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
            
            
        // Update existing record
        $updateResult = $etudiantDB->editRecordById('etudiant', 'CodeEtudiant', $etudiantId, [
            'Nom' => $name,
            'Prenom' => $prenom,
            'DateNaissance' => $dateNaissance,
            'CodeClass' => $class,
            'NumInscription' => $inscription,
            'Address' => $address,
            'Mail' => $email,
            'Tel' => $tel,
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
        
        }
    }    

    
    include $tpl . "footer.php";
    ob_end_flush();
?>            