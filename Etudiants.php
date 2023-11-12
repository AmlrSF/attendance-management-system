<?php 
    include 'init.php';

    $pageTitle = 'Members';
    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    $etudiantDB = new C_etudiant();


    if($do == 'Manage'){ 
            $pageTitle = 'Manage etudiants';
            $students = $etudiantDB->getAllStudents();
        ?>
        <h1 class="text-center mb-5 mt-4">Manage  Etudiants</h1>
        <div class="container">
            <div class="able-responsive-sm">
                <table class="dark-table table table-hover">
                    <thead>
                        <tr class="bg-dark">
                            <th class="text-center py-3 bg-primary text-white" scope="col">#ID</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Last name</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">First name</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Birth date</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Class</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Address</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Mail</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Tel</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Inscription ID</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $index => $student): ?>
                            <tr>
                                <td class="text-center " >#<?= $index + 1 ?></td>
                                <td class="text-center " ><?= $student['Nom'] ?></td>
                                <td class="text-center " ><?= $student['Prenom'] ?></td>
                                <td class="text-center " ><?= $student['DateNaissance'] ?></td>
                                <td class="text-center " ><?= $student['CodeClass'] ?></td>
                                <td class="text-center " ><?= $student['Address'] ?></td>
                                <td class="text-center " ><?= $student['Mail'] ?></td>
                                <td class="text-center " ><?= $student['Tel'] ?></td>
                                <td class="text-center " ><?= $student['NumInscription'] ?></td>
                                <td class="text-center d-flex gap-2 "> 
                                    <a href="Etudiants.php?do=Edit&etudiantId=<?= $student['CodeEtudiant'] ?>" class="btn btn-success d-flex btn-sm align-items-center   gap-2">
                                        Edit<i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="Etudiants.php?do=Delete&etudiantId=<?= $student['CodeEtudiant'] ?>" class="btn btn-danger d-flex btn-sm align-items-center  gap-2">
                                        Delete<i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="Etudiants.php?do=Add" class="btn btn-primary">
            <i class="fa fa-plus"></i> Edit an etudiant</a>
        </div> <?php 

   
    }else if($do == "Add"){
        $pageTitle = 'Add new etudiant';
        ?>
        
        <h1 class="text-center mb-5 mt-4">Add New Etudiant</h1>
        <div class="container">
            <form class="edit-form" action='?do=Insert' method="POST" enctype='multipart/form-data'>
                <div class="mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter name" required="required" type="text" name="name" class="form-control" id="inputName">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPrenom" class="col-sm-2 col-form-label">Prenom</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter prenom" required='required' type="text" name='prenom' class="form-control" id="inputPrenom">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDateNaissance" class="col-sm-2 col-form-label">Date Naissance</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter date de naissance" required="required" type="date" name="datenaissance" class="form-control" id="inputDateNaissance">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputClass" class="col-sm-2 col-form-label">Class Name</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter class" required="required" type="text" name="class" class="form-control" id="inputClass">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputInscription" class="col-sm-2 col-form-label">Inscription ID</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter inscription ID" required="required" type="text" name="inscription" class="form-control" id="inputInscription">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter address" required="required" type="text" name="address" class="form-control" id="inputAddress">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter email" required="required" type="text" name="email" class="form-control" id="inputEmail">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputTel" class="col-sm-2 col-form-label">Tel</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter telephone number" required="required" type="text" name="tel" class="form-control" id="inputTel">
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary">Add Etudiant</button>
                    <a href="Etudiants.php" class="btn btn-primary">Students List</a>
                </div>
            </form>
        </div>
        <?php
    }else if($do == 'Insert'){

        echo '<div class="container">';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo '<h1 class="text-center mb-5 mt-4">Insert Members</h1>';
        
           
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
                
                

                // Check if the username 'john_doe' already exists
                $check = $etudiantDB->checkItem("Prenom", "etudiant", $prenom);

                if ($check == 1) {
                    
                    echo "<div class='alert alert-success'>Username already exists in the etudiant table.</div>";

                } else {
                   
                    // Insert a new etudiant($nom, $prenom, $dateNaissance, $codeClass, $numInscription, $address, $mail, $tel)
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
                        echo '<div class="alert mb-3 alert-success">Form submitted successfully!</div>';
                        redirectHome("you will be directed To ",'back',3);
                    } else {
                        echo '<div class="alert alert-danger">Error inserting record.!</div>';
                        redirectHome("you will be directed To ",'back',3);
                    }
                }
                            
        
                ;
            }
        } else {
            
            
            $theMsg = '<div class="alert mt-5 alert-danger">You can\'t browse this page directly</div>';
            redirectHome($theMsg);
        }
        
        
        echo "</div>";
        
    
        
    }else if($do == 'Edit'){ 
        $pageTitle = 'edit an etudiant';
        $etudiantId = isset($_GET['etudiantId']) ? $_GET['etudiantId'] : null;
        $etudiantData = $etudiantDB->getEtudiantById('CodeEtudiant', $etudiantId);
        ?>
        
        <h1 class="text-center mb-5 mt-4">Edit an Etudiant</h1>
        <div class="container">
            <form class="edit-form" action='?do=Update&etudiantId=<?= $etudiantId ?>' method="POST" enctype='multipart/form-data'>
                <div class="mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter name" required="required" type="text" name="name" class="form-control" id="inputName" value="<?= $etudiantData['Nom'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPrenom" class="col-sm-2 col-form-label">Prenom</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter prenom" required='required' type="text" name='prenom' class="form-control" id="inputPrenom" value="<?= $etudiantData['Prenom'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDateNaissance" class="col-sm-2 col-form-label">Date Naissance</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter date de naissance" required="required" type="date" name="datenaissance" class="form-control" id="inputDateNaissance" value="<?= $etudiantData['DateNaissance'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputClass" class="col-sm-2 col-form-label">Class Name</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter class" required="required" type="text" name="class" class="form-control" id="inputClass" value="<?= $etudiantData['CodeClass'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputInscription" class="col-sm-2 col-form-label">Inscription ID</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter inscription ID" required="required" type="text" name="inscription" class="form-control" id="inputInscription" value="<?= $etudiantData['NumInscription'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter address" required="required" type="text" name="address" class="form-control" id="inputAddress" value="<?= $etudiantData['Address'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter email" required="required" type="text" name="email" class="form-control" id="inputEmail" value="<?= $etudiantData['Mail'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputTel" class="col-sm-2 col-form-label">Tel</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter telephone number" required="required" type="text" name="tel" class="form-control" id="inputTel" value="<?= $etudiantData['Tel'] ?? '' ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit Etudiant</button>
            </form>
        </div>       

     <?php   
    }else if($do == 'Update'){

        
        echo '<div class="container">';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $etudiantId = isset($_GET['etudiantId']) ? $_GET['etudiantId'] : null;
            echo '<h1 class="text-center mb-5 mt-4">Insert Members</h1>';
        
           
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

            if ($updateResult > 0) {
                echo '<div class="alert mb-3 alert-success">Record updated successfully!</div>';
                redirectHome("You will be redirected To ","Etudiants.php",3);
                exit();
            } else {
                echo '<div class="alert alert-danger">Error updating record.</div>';
                redirectHome("You will be redirected To ","Etudiants.php",3);
            }    
            
            }
        }    
          echo "</div>";
        
    }else if($do == "Delete"){
        echo '<div class="container">';
        echo '<h1 class="text-center mb-5 mt-4">Delete Members</h1>';

        
        $etudiantId = isset($_GET['etudiantId']) ? $_GET['etudiantId'] : null;

       
        $check = $etudiantDB->checkItem("CodeEtudiant", "etudiant", $etudiantId);

        if ($check == 1) {
        
            $result = $etudiantDB->deleteRecordById('etudiant', 'CodeEtudiant', $etudiantId);

            if ($result > 0) {
                echo "<div class='alert alert-success'>Etudiant successfully deleted from the database</div>";
                redirectHome("you will be redirect to ", 'back', 4);
            } else {
                echo "<div class='alert alert-danger'>Error deleting Etudiant from the database</div>";
                redirectHome("you will be redirect to ", 'back', 4);
            }
        } else {
            
            echo '<div class="alert mt-5 alert-danger">There is no such Etudiant with ID: ' . $etudiantId . '</div>';
            redirectHome("you will be redirect to ", 'back', 4);
        }

        echo '</div>';

    }
?>