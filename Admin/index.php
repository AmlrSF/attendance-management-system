<?php 
    session_start();
    $noNavbar = "navbar";
    $pageTitle = "Login";
    include 'init.php';
    $database = new Database();

    if (isset($_SESSION['Username'])) {
        header('Location: dashboard.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        
        $hashedPassword = sha1($password);

        
        $query = "SELECT user_id, username, password FROM users WHERE username = ? AND password = ? AND role = 1 LIMIT 1";

        
        $params = [$username, $hashedPassword];
        $rows = $database->getAllRecords($query, $params);

    
    if (!empty($rows)) {
        $row = $rows[0]; 
        $_SESSION['Username'] = $username; 
        $_SESSION['ID'] = $row['user_id']; 

        
        header('Location: dashboard.php');
        exit();
    }
}
?>

<div class="container mt-lg-5 ">
    <div class="row justify-content-center mt-5 ">
        <div class="col-md-6 col-lg-4">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login" method="POST">
                <h4 class="text-center mb-4">Admin Login</h4>
                <input type="text" name="user" placeholder="Username" autocomplete="off" class="form-control mb-3" />
                <input type="password" name="pass" placeholder="Password" autocomplete="off" class="form-control mb-3" />
                <input type="submit" value="Login" class="btn btn-primary btn-block" />
            </form>
        </div>
    </div>
</div>

<?php 
include $tpl . "footer.php";
?>
