
<?php
    ob_start();
    session_start();
    $pageTitle = 'HomePage';
    include 'init.php';
    $etudiantDB = new C_etudiant();
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

    $username = $_SESSION['role'];


    

    if (isset($_SESSION['role'])) {
        $userRole = $_SESSION['role']; 

        if ($userRole == 3) {    
        
            $etudiantId = $database->getUserRoleId($_SESSION['uid']);

            $etudiantData = $etudiantDB->getEtudiantById('CodeEtudiant', $etudiantId);
            $userData = $database->getUserById($_SESSION['uid']);
        
        
            ?>
        
            <h1 class="text-center mb-5 mt-4">Edit Profile</h1>
            <div class="container">
                <form class="edit-form" action='editEtudiant.php' method="POST">
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
                    <!-- ************* -->
                    <div class="mb-3 row">
                        <label for="selectClass" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-sm-10 col-md-4">
                            <select required="required" name="class" class="form-control" id="selectClass">
                                <!-- Placeholder option -->
                                <option value="" disabled>Select a class</option>

                                <?php
                                
                                $classOptions = $etudiantDB->getAllRecords("SELECT * FROM class");

                                
                                foreach ($classOptions as $class) {
                                    $selected = ($etudiantData['CodeClass'] ?? '') == $class['CodeClass'] ? 'selected' : '';
                                    echo '<option value="' . $class['CodeClass'] . '" ' . $selected . '>' . $class['NomClass'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- ************** -->
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
        } elseif ($userRole == 2) { 
            $enseignantId = $database->getUserRoleId($_SESSION['uid']);
            $enseignantData = $enseignantDB->getEnseignantById('CodeEnseignant', $enseignantId);
            $userData = $database->getUserById($_SESSION['uid']);
            ?>
                        
        <h1 class="text-center mb-5 mt-4">Edit Enseignant</h1>
        <div class="container">
            <form class="edit-form" action='editEnseignant.php' method="POST" enctype='multipart/form-data'>
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
                <!-- ******** -->

                <div class="mb-3 row">
                    <label for="inputCodeDepartement" class="col-sm-2 col-form-label">Code Departement</label>
                    <div class="col-sm-10 col-md-4">
                        <select required="required" name="codedepartement" class="form-control" id="inputCodeDepartement">
                            <!-- Placeholder option -->
                            <option value="" disabled>Select a departement</option>

                            <?php
                            $departmentOptions = $enseignantDB->getAllRecords("SELECT * FROM departement");

                            foreach ($departmentOptions as $departement) {
                                $selected = ($departement['codeDepartement'] == $enseignantData['codeDepartement']) ? 'selected' : '';
                                echo '<option value="' . $departement['codeDepartement'] . '" ' . $selected . '>' . $departement['nomDepartement'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputCodeGrade" class="col-sm-2 col-form-label">Code Grade</label>
                    <div class="col-sm-10 col-md-4">
                        <select required="required" name="codegrade" class="form-control" id="inputCodeGrade">
                            <!-- Placeholder option -->
                            <option value="" disabled>Select a grade</option>

                            <?php
                            $gradeOptions = $enseignantDB->getAllRecords("SELECT * FROM grade");

                            foreach ($gradeOptions as $grade) {
                                $selected = ($grade['CodeGrade'] == $enseignantData['CodeGrade']) ? 'selected' : '';
                                echo '<option value="' . $grade['CodeGrade'] . '" ' . $selected . '>' . $grade['NomGrade'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- ******** -->
                <button type="submit" class="btn btn-primary">Update Enseignant</button>
            </form>
        </div>
            <?php
        } else {          
            echo "Access denied or handle other roles";
        }
    } else {

        header('Location: login.php');
        exit(); 
    }
?>

     



<?php
    include $tpl . "footer.php";
    ob_end_flush();
?>
