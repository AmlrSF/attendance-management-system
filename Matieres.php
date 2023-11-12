<?php
include 'init.php';

    $pageTitle = 'Matieres';
    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    $matiereDB = new C_matiere();

    if ($do == 'Manage') {
        $matieres = $matiereDB->getAllMatieres();
        ?>

        <h1 class="text-center mb-5 mt-4">Manage Matieres</h1>
        <div class="container">
            <div class="table-responsive-sm">
                <table class="dark-table table table-hover">
                    <thead>
                        <tr class="bg-dark">
                            <th class="text-center py-3 bg-primary text-white" scope="col">#ID</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Nom Matiere</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Heures Cours</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Heures TD</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Heures TP</th>
                            <th class="text-center py-3 bg-primary text-white" scope="col">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($matieres as $index => $matiere) : ?>
                            <tr>
                                <td class="text-center">#<?= $index + 1 ?></td>
                                <td class="text-center"><?= $matiere['NomMatiere'] ?></td>
                                <td class="text-center"><?= $matiere['NbreHeureCoursParSemaine'] ?></td>
                                <td class="text-center"><?= $matiere['NbreHeureTDParSemaine'] ?></td>
                                <td class="text-center"><?= $matiere['NbreHeureTPParSemaine'] ?></td>
                                <td class="text-center d-flex justify-content-center gap-2">
                                    <a href="Matieres.php?do=Edit&matiereId=<?= $matiere['CodeMatiere'] ?>" class="btn btn-success d-flex btn-sm align-items-center gap-2">
                                        Edit<i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="Matieres.php?do=Delete&matiereId=<?= $matiere['CodeMatiere'] ?>" class="btn btn-danger d-flex btn-sm align-items-center gap-2">
                                        Delete<i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="Matieres.php?do=Add" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add a Matiere
            </a>
        </div>
        <?php
    } else if ($do == "Add") {
        $pageTitle = 'Add new Matiere';
        ?>

        <h1 class="text-center mb-5 mt-4">Add New Matiere</h1>
        <div class="container">
            <form class="edit-form" action='?do=Insert' method="POST" enctype='multipart/form-data'>
                <div class="mb-3 row">
                    <label for="inputNomMatiere" class="col-sm-2 col-form-label">Nom Matiere</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter nom matiere" required="required" type="text" name="nomMatiere" class="form-control" id="inputNomMatiere">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputNbreHeureCours" class="col-sm-2 col-form-label">Heures Cours</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter heures cours" required='required' type="text" name='nbreHeureCours' class="form-control" id="inputNbreHeureCours">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputNbreHeureTD" class="col-sm-2 col-form-label">Heures TD</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter heures TD" required="required" type="text" name="nbreHeureTD" class="form-control" id="inputNbreHeureTD">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputNbreHeureTP" class="col-sm-2 col-form-label">Heures TP</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter heures TP" required="required" type="text" name="nbreHeureTP" class="form-control" id="inputNbreHeureTP">
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Add Matiere</button>
                    <a href="Matieres.php" class="btn btn-primary">Matiere List</a>
                </div>
            </form>
        </div>
        <?php
    } else if ($do == 'Insert') {
        echo '<div class="container">';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo '<h1 class="text-center mb-5 mt-4">Insert Matiere</h1>';

            $nomMatiere = $_POST['nomMatiere'];
            $nbreHeureCours = $_POST['nbreHeureCours'];
            $nbreHeureTD = $_POST['nbreHeureTD'];
            $nbreHeureTP = $_POST['nbreHeureTP'];

            $formErrors = array();

            // Validate Nom Matiere
            if (empty($nomMatiere)) {
                $formErrors[] = 'Nom Matiere cannot be empty';
            }

            // Validate Heures Cours
            if (empty($nbreHeureCours)) {
                $formErrors[] = 'Heures Cours cannot be empty';
            }

            // Validate Heures TD
            if (empty($nbreHeureTD)) {
                $formErrors[] = 'Heures TD cannot be empty';
            }

            // Validate Heures TP
            if (empty($nbreHeureTP)) {
                $formErrors[] = 'Heures TP cannot be empty';
            }

            // Display form errors
            foreach ($formErrors as $error) {
                echo "<div class='alert alert-danger my-2 '>" . $error . "</div>";
            }

            // Check if there are no errors
            if (empty($formErrors)) {
                // Check if the matiere with the same NomMatiere already exists
                $check = $matiereDB->checkItem("NomMatiere", "matiere", $nomMatiere);

                if ($check == 1) {
                    echo "<div class='alert alert-success'>Matiere with the same NomMatiere already exists in the database.</div>";
                    redirectHome("you will be directed To ", 'back', 3);
                } else {
                    // Insert a new matiere
                    $insertResult = $matiereDB->addMatiere($nomMatiere, $nbreHeureCours, $nbreHeureTD, $nbreHeureTP);

                    if ($insertResult > 0) {
                        echo '<div class="alert mb-3 alert-success">Matiere added successfully!</div>';
                        redirectHome("you will be directed To ", 'back', 3);
                    } else {
                        echo '<div class="alert alert-danger">Error inserting matiere record.</div>';
                        redirectHome("you will be directed To ", 'back', 3);
                    }
                }
            }
        } else {
            $theMsg = '<div class="alert mt-5 alert-danger">You can\'t browse this page directly</div>';
            redirectHome($theMsg);
        }
        echo "</div>";
    } else if ($do == 'Edit') {
        $matiereId = isset($_GET['matiereId']) ? $_GET['matiereId'] : null;
        $matiereData = $matiereDB->getMatiereById($matiereId);
        ?>

        <h1 class="text-center mb-5 mt-4">Edit Matiere</h1>
        <div class="container">
            <form class="edit-form" action='?do=Update&matiereId=<?= $matiereId ?>' method="POST" enctype='multipart/form-data'>
                <div class="mb-3 row">
                    <label for="inputNomMatiere" class="col-sm-2 col-form-label">Nom Matiere</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter nom matiere" required="required" type="text" name="nomMatiere" class="form-control" id="inputNomMatiere" value="<?= $matiereData['NomMatiere'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputNbreHeureCours" class="col-sm-2 col-form-label">Heures Cours</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter heures cours" required='required' type="text" name='nbreHeureCours' class="form-control" id="inputNbreHeureCours" value="<?= $matiereData['NbreHeureCoursParSemaine'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputNbreHeureTD" class="col-sm-2 col-form-label">Heures TD</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter heures TD" required="required" type="text" name="nbreHeureTD" class="form-control" id="inputNbreHeureTD" value="<?= $matiereData['NbreHeureTDParSemaine'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputNbreHeureTP" class="col-sm-2 col-form-label">Heures TP</label>
                    <div class="col-sm-10 col-md-4">
                        <input placeholder="Enter heures TP" required="required" type="text" name="nbreHeureTP" class="form-control" id="inputNbreHeureTP" value="<?= $matiereData['NbreHeureTPParSemaine'] ?? '' ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Matiere</button>
            </form>
        </div>
        <?php
    } else if ($do == 'Update') {
        echo '<div class="container">';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $matiereId = isset($_GET['matiereId']) ? $_GET['matiereId'] : null;
            echo '<h1 class="text-center mb-5 mt-4">Update Matiere</h1>';

            $nomMatiere = $_POST['nomMatiere'];
            $nbreHeureCours = $_POST['nbreHeureCours'];
            $nbreHeureTD = $_POST['nbreHeureTD'];
            $nbreHeureTP = $_POST['nbreHeureTP'];

            $formErrors = array();

            // Validate Nom Matiere
            if (empty($nomMatiere)) {
                $formErrors[] = 'Nom Matiere cannot be empty';
            }

            // Validate Heures Cours
            if (empty($nbreHeureCours)) {
                $formErrors[] = 'Heures Cours cannot be empty';
            }

            // Validate Heures TD
            if (empty($nbreHeureTD)) {
                $formErrors[] = 'Heures TD cannot be empty';
            }

            // Validate Heures TP
            if (empty($nbreHeureTP)) {
                $formErrors[] = 'Heures TP cannot be empty';
            }

            // Display form errors
            foreach ($formErrors as $error) {
                echo "<div class='alert alert-danger my-2 '>" . $error . "</div>";
            }

            if (empty($formErrors)) {
                $updateResult = $matiereDB->editRecordById('matiere', 'CodeMatiere', $matiereId, [
                    'NomMatiere' => $nomMatiere,
                    'NbreHeureCoursParSemaine' => $nbreHeureCours,
                    'NbreHeureTDParSemaine' => $nbreHeureTD,
                    'NbreHeureTPParSemaine' => $nbreHeureTP,
                ]);

                // Check update result
                if ($updateResult > 0) {
                    echo '<div class="alert mb-3 alert-success">Record updated successfully!</div>';
                    redirectHome("You will be redirected to ", 'Matieres.php', 3);
                } else {
                    echo '<div class="alert alert-danger">Error updating record.</div>';
                    redirectHome("You will be redirected to ", 'Matieres.php', 3);
                }
            }
        } else {
            echo '<div class="alert mt-5 alert-danger">You can\'t browse this page directly</div>';
            redirectHome("You will be redirected to","Matieres.php",3);
        }

        echo "</div>";


    } else if($do="Delete"){
        echo '<div class="container">';
        echo '<h1 class="text-center mb-5 mt-4">Delete Matiere</h1>';

        $matiereId = isset($_GET['matiereId']) ? $_GET['matiereId'] : null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
            $confirmDelete = isset($_POST['confirm-delete']) ? $_POST['confirm-delete'] : '';

            if ($confirmDelete === 'Yes') {
                
                $result = $matiereDB->deleteRecordById('matiere', 'CodeMatiere', $matiereId);

                if ($result > 0) {
                    echo "<div class='alert alert-success'>Matiere successfully deleted from the database</div>";
                    redirectHome("You will be redirected to ", 'Matieres.php', 3);
                } else {
                    echo "<div class='alert alert-danger'>Error deleting Matiere from the database</div>";
                    redirectHome("You will be redirected to ", 'Matieres.php', 3);
                }
            } else {
                echo '<div class="alert mt-5 alert-danger">Deletion canceled. You can\'t browse this page directly</div>';
                redirectHome("You will be redirected to ", 'Matieres.php', 3);
            }
        } else {
            ?>
            <form class="delete-form" action="?do=Delete&matiereId=<?= $matiereId ?>" method="POST">
                <p class="lead">Are you sure you want to delete this Matiere?</p>
                <div class="mb-3 row">
                    <div class="col-sm-10 col-md-4">
                        <button type="submit" class="btn btn-danger" name="confirm-delete" value="Yes">Yes</button>
                        <a href="?do=ManageMatieres" class="btn btn-secondary">No</a>
                    </div>
                </div>
            </form>
            <?php
        }

        echo '</div>';
    }