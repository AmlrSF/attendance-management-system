<?php
    ob_start();
    session_start();
    if(isset($_SESSION["Username"])){
        $pageTitle = 'Enseignant';
        include 'init.php'; 
        
    }else{
        header('Location: index.php');
        exit();
    }

    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    $datadb = new DataBase();

    

?>

<style>
    .home-stats .stat{
    background-color: #eee;
    border: 1px solid #ccc;
    padding: 20px;
    font-size: 15px;
    color: #fff;
    border-radius: 10px;
    margin-bottom: 10px;
}
.home-stats .stat i{
    font-size: 80px;
}
.home-stats .stat span{
    display: block;
    font-size: 60px;
}
.home-stats .stat span a{
    color: #fff;
    text-decoration: none;
}

.home-stats .st-absences{
    background-color: #3498db;
}

.home-stats .st-matieres{
    background-color: #c0392b;
}

.home-stats .st-etudiants{
    background-color: #d35400;
}

.home-stats .st-enseignants{
    background-color: #8e44ad;
}

</style>

<div class="home-stats">
    <div class="container text-center">
        <h1 class="mt-5 mb-5 mb-2">Dashboard</h1>
        <div class="row">
            <div class="col-md-3 ">
                <div class="stat 2 st-matieres">
                    Total Matieres
                    <span><a href="matieres.php"><?php echo $datadb->countMatieres(); ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-enseignants">
                    Total Enseignants
                    <span><a href="enseignants.php"><?php echo $datadb->countEnseignants(); ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-etudiants">
                    Total Etudiants
                    <span><a href="etudiants.php"><?php echo $datadb->countEtudiants(); ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-absences">
                    Total Absences
                    <span><a href="absences.php"><?php echo $datadb->countAbsences(); ?></a></span>
                </div>
            </div>
        </div>
    </div>   
</div>