<?php
session_start();
require('../config.php');



if(isset($_POST['valider'])){
  //echo "<pre>";
  //var_dump($_POST);
$id=$_POST['id'];
$matiere=$_POST['matiere'];
$prof=$_POST['professeur'];
$filiere=$_POST['filiere'];

$req="UPDATE matiere SET ID_PROF='$prof',ID_FILLIERE='$filiere',MATIERE='$matiere'
WHERE ID_MATIERE='$id' ";
  
  if(mysqli_query($conn, $req)){
  
  
  $_SESSION['message'] = "matiere est bien modifiée!";
  
  }  
}

?>

<!DOCTYPE html>
<html>
	<head>
    
  <title>Lister</title>
  <link rel="stylesheet" href="../css/style_etud.css" />
  <link rel="stylesheet" href="../css/style_login.css" />
  <link rel="stylesheet" href="../css/styleMod.css" />
    <style>
       .container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 16px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default radio button */
    .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #eee;
      border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
      background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .container input:checked~.checkmark {
      background-color: rgb(3, 8, 71);
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }


    /* Show the indicator (dot/circle) when checked */
    .container input:checked~.checkmark:after {
      display: block;
    }

    /* Style the indicator (dot/circle) */
    .container .checkmark:after {
      top: 9px;
      left: 9px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: white;
    }

    .alert {
      padding: 20px;
      background-color: #008000;
      color: white;
    }

    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }

    table {
      width: 100%;
    }

    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 9px;
      text-align: left;
    }

    th {
      background-color: rgb(30, 8, 153);
      color: white;
      text-align: center;

    }

    #t01 tr:nth-child(even) {
      background-color: #eee;
    }

    #t01 tr:nth-child(odd) {
      background-color: #fff;
    }

    #t01 th {
      background-color: blue;
      color: white;
    }
    </style>
	</head>
<body>
	<div class="logos">
	<img src="../image/logo.png" alt="logo" class="imgl">
	</div>
	<div class="topnav">
  <a class="active" href="../index.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Gestion des étudiants
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../etudiant/insertEtudiant.php">Ajouter un étudiant</a>
      <a href="../etudiant/searchEtudiant.php">Chercher un étudiant</a>
      <a href="../etudiant/listerEtudiant.php">La liste des étudiants</a>
      
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Gestion des professeurs
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../professeur/insertProf.php">Ajouter un professeur</a>
      <a href="../professeur/searchProf.php">Chercher un professeur</a>
      <a href="../professeur/listerProf.php">La liste des professeurs</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Gestion des absences
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../absence/insertAbsence.php">Ajouter absence</a>
      <a href="../absence/afficherAbsence.php">Consulter absence</a>
	  <a href="../absence/listerAbsence.php">Liste d'absence</a>
      <a href="../absence/afiche.php">La fiche d'absence</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Gestion des filliers
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../filiere/listerFiliere.php">Liste des filières</a>
      
      </div>
    </div>
    <div class="dropdown">
      <button class="dropbtn">Gestion des matieres
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="insertMat.php">Ajouter une matiere</a>
        <a href="listerMat.php">Liste des matieres</a>
        
      </div>
    </div>

  <a href="../logout.php">Déconnexion</a>
</div>
<?php
  if (isset($_SESSION['message'])) : ?>
    <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      <?php
      
      echo $_SESSION['message'];
      unset($_SESSION['message']);

      ?>
    </div>

  <?php endif ?>

<div class="main"><br/>
<header>
    <h1>Modifier une matière</h1>
    <div class="sucess"></div>
</header>
<form align="center" method="post" action="">
      <?php
      if (isset($_GET["edit"])) {
        $id = $_GET['edit'];


        $result = $conn->query("SELECT * FROM matiere,professeur,filiere WHERE  matiere.ID_PROF=professeur.ID_PROF  AND matiere.ID_FILLIERE=filiere.ID_FILLIERE AND  ID_MATIERE='$id'");
      ?>


        <form action="" method="post">

<table class="t01">
    
          
            
            <thread class="alert-info">
        <tr>
            
            
            <th>Matière</th>
            <th>Nom de Professeur</th>
            <th>Filière</th>
          
            
        </tr>
            </thread>
         <tbody> 
      
         <?php $i = 0;
              while ($row = $result->fetch_assoc()) {
                $i++;
               
                $idMat = $row['ID_MATIERE'];
                $idprof = $row['ID_PROF'];
                $idfiliere=$row['ID_FILLIERE'];
                $matiere = $row['MATIERE'];
                $prof = $row['NOM_PROF'];
                $filiere = $row['FILIERE'];
             
               
                $q = "SELECT * FROM `matiere`";
                $so = mysqli_query($conn, $q);

                $f = "SELECT * FROM `filiere`";
                $fo = mysqli_query($conn, $f);

                $p = "SELECT * FROM `professeur`";
                $po = mysqli_query($conn, $p);

              ?>
          <tr>
          
             <td><?php echo $matiere; ?></td>
             <td><?php echo $prof; ?></td>
             <td><?php echo $filiere; ?></td> 
            <td style="width:168px;" ><a href="#" class="button1" id="<?php echo $id; ?>" valeur="<?php echo $id; ?>">modifier </a></td>
          
             
               <div class="popup">
                    <div class="popup-content1">
                      <img src="../image/5.jpg" alt="absence" style="height: 160px;width: 200px;left:110px; margin: 10px auto 20px; display: block;">
                      <img src="../image/close.png" alt="close" class="close">
                      <br>
                      <div class="right">
                        <p>Le professeur :</p>
                        <select class="inp" name="professeur" style="margin: 10px 10px;">
                          <option value="<?php echo $idprof; ?>"><?php echo $prof; ?> </option>

                          <?php while ($ro = mysqli_fetch_array($po)) :; ?>

                            <option value="<?php echo $ro[0]; ?>"><?php echo $ro[1]; ?></option>

                          <?php endwhile; ?>

                        </select>
                      </div>
                      <div class="left">
                        <p>Matiere:</p>
                        <select class="inp" name="matiere" style="margin: 10px 10px;">
                          <option value="<?php echo $matiere; ?>"><?php echo $matiere; ?> </option>

                          <?php while ($ro = mysqli_fetch_array($so)) :; ?>

                            <option value="<?php echo $ro[3]; ?>"><?php echo $ro[3]; ?></option>

                          <?php endwhile; ?>

                        </select>
                        <br>
                        <br>
                        <p>Filiere:</p>
                        <select class="inp" name="filiere" style="margin: 10px 10px;">
                          <option value="<?php echo $idfiliere; ?>"><?php echo $filiere; ?> </option>

                          <?php while ($ro = mysqli_fetch_array($fo)) :; ?>

                            <option value="<?php echo $ro[0]; ?>"><?php echo $ro[2]; ?></option>

                          <?php endwhile; ?>

                        </select>
                      </div>
                      <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                      <div class="center">
                        <br><br><br><br><br><br><br>
                       <!-- <input type="submit" value="valider" name="valider" class="button1">-->
                        <button class="button1" name="valider">Valider</button>
                      </div>

                    </div>
                  </div>
                  <script>
                    document.getElementById("<?php echo $id; ?>").addEventListener("click", function() {
                      document.querySelector(".popup").style.display = "flex";
                    })
                    document.querySelector(".close").addEventListener("click", function() {
                      document.querySelector(".popup").style.display = "none";

                    })
                  </script>
                <?php
              }

              $conn->close(); ?>
             
</tbody>
</table>
  </form>
  <?php
      }
  
?>
</body>
</html>
