<?php 

    // Include the Database class
    require_once 'Classes/Database.php';

    // Include the Etudiant class
    require_once 'Classes/Etudiant.php';

    // Include the Etudiant class
    require_once 'Classes/Enseignant.php';

    $tpl    = 'includes/template/'; 
    $css    = 'layout/css/';
    $js     = 'layout/js/';
    $func   = 'includes/functions/';


    //including the importtant files 
    include $func . 'functions.php';
    include $tpl . 'header.php';
