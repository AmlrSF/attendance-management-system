<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container">
        <a class="navbar-brand text-white" href="index.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="text-white navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white-50 " href="Etudiants.php">Etudiants</a>
                    </li>
                    <li class="nav-item dropdown me-auto d-block d-lg-none">
                        <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['user']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <!-- Display these links if the user is not logged in -->
                    <div class="d-flex gap-2 d-block d-lg-none">
                        <a class="btn btn-outline-primary " href="register.php">Register</a>
                        <a class="btn btn-primary " href="Login.php">Login</a>
                    </div>
                <?php endif; ?>

            </ul>
        </div>

        <?php if (isset($_SESSION['user'])) : ?>
            <!-- Display this dropdown if the user is logged in -->
            <div class="nav-item dropdown me-auto d-none d-lg-block">
                <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['user']; ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        <?php else : ?>
            <!-- Display these buttons if the user is not logged in -->
            <div class="d-flex gap-2 d-none d-lg-block">
                <a class="btn btn-outline-primary " href="register.php">Register</a>
                <a class="btn btn-primary " href="Login.php">Login</a>
            </div>
        <?php endif; ?>

    </div>
</nav>