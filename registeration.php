


<?php

    ob_start();
    session_start();
    $pageTitle = 'Registeration';
    include 'init.php';
    $enseignantDB = new C_enseignant();
    $etudiantDB = new C_etudiant();
    $database = new Database();

    if (isset($_SESSION['role'])) {
        $userRole = $_SESSION['role']; 

        if ($userRole == 3) { 
        
            
            ?>
            
                <h1 class="text-center mb-5 mt-4">Complete Your information as Teacher</h1>
                <div class="container">
                    <form class="edit-form" action='registerEnseignant.php' method="POST" enctype='multipart/form-data'>
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
                        <!-- ********** -->
                        <div class="mb-3 row">
                            <label for="inputCodeDepartement" class="col-sm-2 col-form-label">Code Departement</label>
                            <div class="col-sm-10 col-md-4">
                                <select required="required" name="codedepartement" class="form-control" id="inputCodeDepartement">
                                    <!-- Placeholder option -->
                                    <option value="" disabled selected>Select a departement</option>

                                    <?php
                                    $departmentOptions = $enseignantDB->getAllRecords("SELECT * FROM departement");
                                    echo $departmentOptions;
                                    foreach ($departmentOptions as $departement) {
                                        echo '<option value="' . $departement['codeDepartement'] . '">' . $departement['nomDepartement'] . '</option>';
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
                                    <option value="" disabled selected>Select a grade</option>

                                    <?php
                                    $gradeOptions = $enseignantDB->getAllRecords("SELECT * FROM grade");

                                    foreach ($gradeOptions as $grade) {
                                        echo '<option value="' . $grade['CodeGrade'] . '">' . $grade['NomGrade'] . '</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                        <div>
                        <button type="submit" class="btn w-25  mt-4 btn-primary">Register Your information</button>
                            
                        </div>
                        
                    </form>
                </div>
                
            <?php  
        } elseif ($userRole == 2) { 
            
            ?>
                <!-- etudiant -->
                
                <h1 class="text-center mb-5 mt-4">Complete Your information as Student</h1>
                <div class="container">
                    <form class="edit-form" action='registerEtudiant.php' method="POST" enctype='multipart/form-data'>
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
                        <!-- ******************* -->
                        <div class="mb-3 row">
                            <label for="inputClass" class="col-sm-2 col-form-label">Class Name</label>
                                <div class="col-sm-10 col-md-4">
                                        <select required="required" name="class" class="form-control" id="inputClass">
                                        <!-- Placeholder option -->
                                        <option value="" disabled selected>Select a class</option>

                                        <?php
                                        // Fetch class options from the database
                                        $classOptions = $etudiantDB->getAllRecords("SELECT * FROM class");

                                        // Loop through the options and generate <option> elements
                                        foreach ($classOptions as $class) {
                                            echo '<option value="' . $class['CodeClass'] . '">' . $class['NomClass'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <!-- ******************** -->
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
                        <div>
                        <button type="submit" class="btn w-25  mt-4 btn-primary">Register Your information</button>
                            
                        </div>
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



