<?php
$pageTitle = 'Regiter';
include 'init.php';

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $formErrors = [];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $role = $_POST['role'];

    if (empty($username) || empty($password) || empty($password2) || empty($role)) {
        $formErrors[] = 'All fields are required.';
    }

    if (strlen($username) < 4) {
        $formErrors[] = 'Username must be at least 4 characters.';
    }

    if ($password !== $password2) {
        $formErrors[] = 'Passwords do not match.';
    }

    // Check if the username already exists
    $checkUsername = $database->checkItem('username', 'users', $username);
    if ($checkUsername > 0) {
        $formErrors[] = "Username '{$username}' is already taken. Choose another one.";
    }

    if (empty($formErrors)) {
        // Insert user info into the database
        $userData = [
            'username' => $username,
            'password' => sha1($password), // You may want to use a more secure hashing algorithm
            'role' => $role,
        ];

        $insertResult = $database->insertRecord('users', $userData);

        if ($insertResult > 0) {
            $successMsg = 'User registered successfully.';
            header('Location: Login.php');
            exit();
        } else {
            $formErrors[] = 'Failed to register the user. Please try again.';
        }
    }
}
?>


    <div class="container">
        <div style="max-width:300px; margin:0 auto;" class="register-page">
            <h1 class='text-center mt-4 mb-5'>Register</h1>

            <form class="register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="usernameInput">Username</label>
                    <input required type="text" name='username' class="form-control mb-3" id="usernameInput"
                        placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input required type="password" name='password' class="form-control mb-3" id="passwordInput"
                        placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password2Input">Re-enter Password</label>
                    <input required type="password" name='password2' class="form-control mb-3" id="password2Input"
                        placeholder="Re-enter your Password">
                </div>
                <div class="form-group">
                    <label for="roleSelect">Select Role:</label>
                    <select class="form-control" id="roleSelect" name="role">
                        <option value="2">Enseignant</option>
                        <option value="3">Etudiant</option>
                    </select>
                </div>

                <a href="Login.php" class="text-secondary mb-3  ">Already an account  yet?</a>

                <input type="submit" style="width:100%" name="register" class="btn mt-3 mb-5 d-block btn-success" value='Register' />
            </form>

            <div class="theErrors text-center">
                <?php
                if (isset($formErrors)) {
                    foreach ($formErrors as $error) {
                        echo "<div class='alert alert-danger'>" . $error . "</div>";
                    }
                }

                if (isset($successMsg)) {
                    echo '<div class="alert alert-success">' . $successMsg . '</div>';
                }
                ?>
            </div>

        </div>
    </div>

 