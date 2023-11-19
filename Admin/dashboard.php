<?php 

    ob_start();
    session_start();
    if(isset($_SESSION["Username"])){
        $pageTitle = 'Dashboard';
        include 'init.php'; 
        
    }else{
        header('Location: index.php');
        exit();
    }

    $etudiantDB = new C_etudiant();
    $database = new Database();
    
    $classOptions = [];  
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedDepartment = $_POST['codedepartement'] ?? null;
        $selectedClass = $_POST['codeclass'] ?? null;
        
        if ($selectedDepartment) {
            $classOptions = $database->getClassesByDepartment($selectedDepartment);
        }

        $studentsByClass = $etudiantDB->getStudentsByClass($selectedClass);
    }
?>

<div class="container mt-5">
    <h2 class="mb-4">Get Students by Department and Class</h2>
    
    <form action="" method="post">
        <div class="mb-3">
            <label for="inputCodeDepartement" class="col-sm-2 col-form-label">Code Departement</label>
            <div class="col-sm-10 col-md-4">
                <select required="required" name="codedepartement" class="form-control" id="inputCodeDepartement" onchange="this.form.submit()">
                    <option value="" disabled>Select a departement</option>
                    <?php
                        $departmentOptions = $etudiantDB->getAllRecords("SELECT * FROM departement");
                        foreach ($departmentOptions as $departement) {
                            $selected = ($selectedDepartment == $departement['codeDepartement']) ? 'selected' : '';
                            echo '<option value="' . $departement['codeDepartement'] . '" ' . $selected . '>' . $departement['nomDepartement'] . '</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="inputCodeClass" class="col-sm-2 col-form-label">Code Class</label>
            <div class="col-sm-10 col-md-4">
                <select required="required" name="codeclass" class="form-control" id="inputCodeClass">
                    <option value="" disabled selected>Select a class</option>
                    <?php
                        
                        if ($classOptions) {
                            $classesByGroup = [];
                            foreach ($classOptions as $class) {
                                $group = $class['NomGroupe'];
                                if (!isset($classesByGroup[$group])) {
                                    $classesByGroup[$group] = [];
                                }
                                $classesByGroup[$group][] = $class;
                            }

                            foreach ($classesByGroup as $groupName => $groupClasses) {
                                echo '<optgroup label="' . $groupName . '">';
                                foreach ($groupClasses as $class) {
                                    echo '<option value="' . $class['CodeClass'] . '">' . $class['NomClass'] . '</option>';
                                }
                                echo '</optgroup>';
                            }
                        }

                    ?>
                </select>
                
            </div>
        </div>

        <div class="form-group row">
            <div class="">
                <button type="submit" class="btn btn-primary">Get Students</button>
            </div>
        </div>
    </form>
</div>
<div class="container mt-5">
    

    <?php if (isset($studentsByClass) && !empty($studentsByClass)) : ?>
        <h2 class="mb-4"> <?php echo !empty($selectedClass) ? 'Class ' . $database->getRecordById('class','CodeClass',$selectedClass)['NomClass'] : ''; ?> Students</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Registration Number</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($studentsByClass as $student) : ?>
                    <tr>
                        <td><?= $student['CodeEtudiant']; ?></td>
                        <td><?= $student['Nom'] . ' ' . $student['Prenom']; ?></td>
                        <td><?= $student['DateNaissance']; ?></td>
                        <td><?= $student['NumInscription']; ?></td>
                        <td><?= $student['Address']; ?></td>
                        <td><?= $student['Mail']; ?></td>
                        <td><?= $student['Tel']; ?></td>
                        <td>
                            <form action="mark_absent.php?student_id=<?= $student['CodeEtudiant']; ?>" method="post">
                                <input type="hidden" name="student_id" value="<?= $student['CodeEtudiant']; ?>">
                                <button type="submit" class="btn btn-danger">Mark Absent</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No students found for the selected class.</p>
    <?php endif; ?>
</div>

<?php include $tpl.'footer.php' ;?>
