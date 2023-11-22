<?php
    ob_start();
    session_start();
    if(isset($_SESSION["Username"])){
        $pageTitle = 'Enseignant';
        include 'init.php'; 
        
    }else{
        header('Location: index.php');
        exit();
    }


    $database = new DataBase();
    $userData = $database->getUserById($_SESSION['ID']);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newUsername = $_POST['username'];
        $newPassword = $_POST['password'];

        $formErrors = array();
    
        if (empty($newUsername) || empty($newPassword)) {
            $formErrors[] = 'All fields are required.';
        }
    
        if (strlen($newUsername) < 4) {
            $formErrors[] = 'Username must be at least 4 characters.';
        }

        // Display form errors
        foreach ($formErrors as $error) {
            echo "<div class='alert alert-danger my-2 '>" . $error . "</div>";
        }

        $updateResult = $database->updateUsernamePasswordById($_SESSION['ID'], $newUsername, $newPassword);

        if ($updateResult > 0) {
            header('Location: logout.php');
            exit();
        } else {
            echo '<div class="alert alert-danger">Error updating record.</div>';
            
        }

    }

?>

<h1 class="text-center mb-5 mt-4">Edit Profile</h1>
<div class="container">
    <form class="edit-form" action='' method="POST">
        <div class="mb-3 row">
            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10 col-md-4">
                <input placeholder="Enter username" required="required" type="text" name="username" class="form-control" id="inputUsername" value="<?= $userData['username'] ?? '' ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10 col-md-4">
                <input placeholder="Enter password" required="required" type="password" name="password" class="form-control" id="inputPassword">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Edit Etudiant</button>
    </form>
</div> 

<?php 
include $tpl . "footer.php";
?>
