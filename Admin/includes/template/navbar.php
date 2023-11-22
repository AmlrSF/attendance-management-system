<nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand text-white" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-white navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <li class="nav-item">
                    <a class="nav-link text-white-50 " href="absence.php">absence</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 " href="Etudiants.php">Etudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 " href="Etudiants.php">Etudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 " href="Matieres.php">Matieres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 " href="List-absence.php">List d'absence</a>
                </li>
                <li class="nav-item dropdown me-auto d-block d-lg-none">
                <a class="nav-link text-white   dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['Username'] ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item " href="#">Profile</a></li>
                    <li><a class="dropdown-item " href="#">settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item " href="logout.php">Logout</a></li>
                </ul>
            </li>
            </ul>
            </div>
            <div class="nav-item dropdown me-auto d-none d-lg-block">
                <a class="nav-link text-white   dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['Username'] ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item " href="#">Profile</a></li>
                    <li><a class="dropdown-item " href="#">settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item " href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>