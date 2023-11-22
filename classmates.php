
<?php
    ob_start();
    session_start();
    $pageTitle = 'HomePage';
    include 'init.php';

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
    $database = new Database();
    $etudiantDB = new C_etudiant();
    
    $students = $etudiantDB->getAllStudents();
    $etudiantId = $database->getUserRoleId($_SESSION['uid']);

    $etudiantData = $etudiantDB->getEtudiantById('CodeEtudiant', $etudiantId);
    $classEtudiant = $database->getClassNameByCode($etudiantData['CodeClass']);
    
    // echo $classEtudiant;
?>

    <h1 class="text-center mb-5 mt-4">Class mates</h1>
    <div class="container">
    <div class="able-responsive-sm">
        <table class="dark-table table table-hover">
            <thead>
                <tr class="bg-dark">
                    <th class="text-center py-3 bg-primary text-white" scope="col">#ID</th>
                    <th class="text-center py-3 bg-primary text-white" scope="col">Last name</th>
                    <th class="text-center py-3 bg-primary text-white" scope="col">First name</th>
                    <th class="text-center py-3 bg-primary text-white" scope="col">Birth date</th>

                    <th class="text-center py-3 bg-primary text-white" scope="col">Departement</th>
                    <th class="text-center py-3 bg-primary text-white" scope="col">Class</th>
                    <th class="text-center py-3 bg-primary text-white" scope="col">Groupe</th>

                    <th class="text-center py-3 bg-primary text-white" scope="col">Address</th>
                    <th class="text-center py-3 bg-primary text-white" scope="col">Mail</th>
                    <th class="text-center py-3 bg-primary text-white" scope="col">Tel</th>
                    <th class="text-center py-3 bg-primary text-white" scope="col">Inscription ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $index => $student): ?>
                    <?php if ($student['NomClass'] == $classEtudiant): ?>
                        <tr>
                            <td class="text-center">#<?= $index + 1 ?></td>
                            <td class="text-center"><?= $student['Nom'] ?></td>
                            <td class="text-center"><?= $student['Prenom'] ?></td>
                            <td class="text-center"><?= $student['DateNaissance'] ?></td>
                            <td class="text-center"><?= $student['NomDepartement'] ?></td>
                            <td class="text-center"><?= $student['NomClass'] ?></td>
                            <td class="text-center"><?= $student['NomGroupe'] ?></td>
                            <td class="text-center"><?= $student['Address'] ?></td>
                            <td class="text-center"><?= $student['Mail'] ?></td>
                            <td class="text-center"><?= $student['Tel'] ?></td>
                            <td class="text-center"><?= $student['NumInscription'] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php
    include $tpl . "footer.php";
    ob_end_flush();
?>
