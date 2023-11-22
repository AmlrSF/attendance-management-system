<?php
$pageTitle = 'Login';
include 'init.php';

$database = new Database();

session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $formErrors = [];

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $formErrors[] = 'Username and password are required.';
    }

    if (empty($formErrors)) {
        // Check if the user exists in the database
        $count = $database->checkItem('username', 'users', $username);

        if ($count > 0) {
            // User exists, now check the password
            $userData = $database->getRecordById('users', 'username', $username);

            if (sha1($password) == $userData['password']) {
                $_SESSION['user'] = $username;
                $_SESSION['role'] = $userData['role'];
                $_SESSION['uid'] = $userData['user_id'];
           

                $userRoleId = $database->getUserRoleId($_SESSION['uid']); // You need to implement this method in your Database class

                echo $userRoleId;

                // Check if userRoleId has a value different from 0
                $_SESSION['verified'] = ($userRoleId != 0);

                // Redirect to index.php after successful login
                header('Location: registeration.php');
                exit();
            } else {
                $formErrors[] = 'Invalid password.';
            }
        } else {
            $formErrors[] = 'User not found.';
        }
    }
}
?>

    <div class="container">
        <div style="max-width:300px; margin:0 auto;" class="login-page">
            <h1 class='text-center mt-4 mb-5'>Login</h1>

            <form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="usernameInput">Username</label>
                    <input required type="text" name='username' class="form-control mb-3" id="usernameInput"
                        placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input required type="password" name='password' class="form-control mb-1" id="passwordInput"
                        placeholder="Password">
                </div>
                <a href="register.php" class="text-secondary mb-3  ">Don't have an account  yet?</a>

                <input type="submit" style="width:100%" name="login" class="btn d-block mt-3 mb-5 btn-primary" value='Login' />
            </form>

            <div class="theErrors text-center">
                <?php
                if (isset($formErrors)) {
                    foreach ($formErrors as $error) {
                        echo "<div class='alert alert-danger'>" . $error . "</div>";
                    }
                }
                ?>
            </div>

        </div>
    </div>
