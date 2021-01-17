<?php

session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gestionabsence_v');
 
// Connexion � la base de donn�es MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $conn->query("DELETE FROM professeur WHERE ID_PROF=$id");
    $conn->query("DELETE FROM coordonner WHERE ID_PROF=$id");

    $_SESSION['message']="Professeur est suprimé!";

    header("location:../listerProf.php");
    


}


?>