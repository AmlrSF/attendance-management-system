
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

    
?>

<div class="container">
    <h1 class='text-center mt-3 mb-5'>Get Deeper In Our Shop</h1>
    <!-- Your content goes here -->
</div>

<?php
    include $tpl . "footer.php";
    ob_end_flush();
?>
