<?php 
    include 'init.php';

    $pageTitle = 'Enseignants';
    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    $enseignantDB = new C_enseignant();



    if($do == 'Manage'){ 
        $enseignants = $enseignantDB->getAllEnseignants();
    ?>

    <h1 class="text-center mb-5 mt-4">Manage Enseignants</h1>
    <div class="container">
        <div class="table-responsive-sm">
            <table class="dark-table table table-hover">
                <
                <thead>
                    <tr class="bg-dark">
                        <th class="text-center py-3 bg-primary text-white" scope="col">#ID</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">Last name</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">First name</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">Date Recrutement</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">Address</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">Mail</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">Tel</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">Code Departement</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">Code Grade</th>
                        <th class="text-center py-3 bg-primary text-white" scope="col">Control</th>
                    </tr>
                </thead>
                <!-- Data Rows -->
                <tbody>
                    <?php foreach ($enseignants as $index => $enseignant) : ?>
                        <tr>
                            <td class="text-center">#<?= $index + 1 ?></td>
                            <td class="text-center"><?= $enseignant['Nom'] ?></td>
                            <td class="text-center"><?= $enseignant['Prenom'] ?></td>
                            <td class="text-center"><?= $enseignant['DateRecrutement'] ?></td>
                            <td class="text-center"><?= $enseignant['Address'] ?></td>
                            <td class="text-center"><?= $enseignant['Mail'] ?></td>
                            <td class="text-center"><?= $enseignant['Tel'] ?></td>
                            <td class="text-center"><?= $enseignant['CodeDepartement'] ?></td>
                            <td class="text-center"><?= $enseignant['CodeGrade'] ?></td>
                            <td class="text-center d-flex gap-2 ">
                                <a href="Enseignant.php?do=Edit&enseignantId=<?= $enseignant['CodeEnseignant'] ?>" class="btn btn-success d-flex btn-sm align-items-center gap-2">
                                    Edit<i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="Enseignant.php?do=Delete&enseignantId=<?= $enseignant['CodeEnseignant'] ?>" class="btn btn-danger d-flex btn-sm align-items-center gap-2">
                                    Delete<i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="Enseignant.php?do=Add" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add an Enseignant
        </a>
    </div>

    <?php 
    }else if($do == "Add"){
        $pageTitle = 'Add new enseignant';
        ?>
        
        <h1 class="text-center mb-5 mt-4">Add New Enseignant</h1>
    <div class="container">
        <form class="edit-form" action='?do=Insert' method="POST" enctype='multipart/form-data'>
            <div class="mb-3 row">
                <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter nom" required="required" type="text" name="nom" class="form-control" id="inputNom">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPrenom" class="col-sm-2 col-form-label">Prenom</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter prenom" required='required' type="text" name='prenom' class="form-control" id="inputPrenom">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputDateRecrutement" class="col-sm-2 col-form-label">Date Recrutement</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter date de recrutement" required="required" type="date" name="daterecrutement" class="form-control" id="inputDateRecrutement">
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
            <div class="mb-3 row">
                <label for="inputCodeDepartement" class="col-sm-2 col-form-label">Code Departement</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter code departement" required="required" type="text" name="codedepartement" class="form-control" id="inputCodeDepartement">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputCodeGrade" class="col-sm-2 col-form-label">Code Grade</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter code grade" required="required" type="text" name="codegrade" class="form-control" id="inputCodeGrade">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Enseignant</button>
        </form>
    </div>

        <?php
    }else if($do == 'Insert'){


        echo '<div class="container">';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo '<h1 class="text-center mb-5 mt-4">Insert Enseignant</h1>';
    
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
    
            // Validate Date Recrutement
            // Add more specific validation if needed
    
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
                        echo '<div class="alert mb-3 alert-success">Enseignant added successfully!</div>';
                        redirectHome("you will be directed To ", 'back', 3);
                    } else {
                        echo '<div class="alert alert-danger">Error inserting enseignant record.</div>';
                        redirectHome("you will be directed To ", 'back', 3);
                    }
                }
            }
        } else {
            $theMsg = '<div class="alert mt-5 alert-danger">You can\'t browse this page directly</div>';
            redirectHome($theMsg);
        }
        echo "</div>";
    
        
    }else if($do == 'Edit'){ 
        $enseignantId = isset($_GET['enseignantId']) ? $_GET['enseignantId'] : null;
        $enseignantData = $enseignantDB->getEnseignantById('CodeEnseignant', $enseignantId);
        ?>
    <h1 class="text-center mb-5 mt-4">Edit Enseignant</h1>
    <div class="container">
        <form class="edit-form" action='?do=UpdateEnseignant&enseignantId=<?= $enseignantId ?>' method="POST" enctype='multipart/form-data'>
            
            <div class="mb-3 row">
                <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter nom" required="required" type="text" name="nom" class="form-control" id="inputNom" value="<?= $enseignantData['Nom'] ?? '' ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPrenom" class="col-sm-2 col-form-label">Prenom</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter prenom" required='required' type="text" name='prenom' class="form-control" id="inputPrenom" value="<?= $enseignantData['Prenom'] ?? '' ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputDateRecrutement" class="col-sm-2 col-form-label">Date Recrutement</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter date de recrutement" required="required" type="date" name="daterecrutement" class="form-control" id="inputDateRecrutement" value="<?= $enseignantData['DateRecrutement'] ?? '' ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter address" required="required" type="text" name="address" class="form-control" id="inputAddress" value="<?= $enseignantData['Address'] ?? '' ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter email" required="required" type="text" name="email" class="form-control" id="inputEmail" value="<?= $enseignantData['Mail'] ?? '' ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputTel" class="col-sm-2 col-form-label">Tel</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter telephone number" required="required" type="text" name="tel" class="form-control" id="inputTel" value="<?= $enseignantData['Tel'] ?? '' ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputCodeDepartement" class="col-sm-2 col-form-label">Code Departement</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter code departement" required="required" type="text" name="codedepartement" class="form-control" id="inputCodeDepartement" value="<?= $enseignantData['CodeDepartement'] ?? '' ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputCodeGrade" class="col-sm-2 col-form-label">Code Grade</label>
                <div class="col-sm-10 col-md-4">
                    <input placeholder="Enter code grade" required="required" type="text" name="codegrade" class="form-control" id="inputCodeGrade" value="<?= $enseignantData['CodeGrade'] ?? '' ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Enseignant</button>
        </form>
    </div>
     <?php   
    }else if($do == 'Update'){

        
    }else if($do == "Delete"){
    }

?>