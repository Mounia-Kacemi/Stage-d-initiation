<?php
	session_start();
	if(!isset($_SESSION["password"])){
		header("Location: ../login.php");
		exit(); 
	}
  ?>
<?php
require('../config.php');
$qr = "SELECT * FROM `classe`";
$resu= mysqli_query($conn, $qr);
?>
<!DOCTYPE html>
<html>
	<head>
  <title>lister</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="../css/style_etud.css"/>
    <link rel="stylesheet" href="../css/style_login.css" />
    <style>
       
.alert2 {
  padding: 20px;
  background-color: #f44336;
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
		width:100%;
	  }
	  table, th, td {
		border: 1px solid black;
    border-collapse: collapse;
	  }
	  th, td {
		padding: 5px;
    text-align: left;
    }
    th{
      background-color: rgb(30, 8, 153);
      color:white;
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
    button {
		background-color: rgb(9, 2, 49);
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
    cursor: pointer;
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
      <a href="insertEtudiant.php">Ajouter un étudiant</a>
      <a href="searchEtudiant.php">Chercher un étudiant</a>
      <a href="listerEtudiant.php">La liste des étudiants</a>
      
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
	  <a href="../absence/listerAbsence.php">Liste d'absence</a>
      <a href="../absence/afiche.php">La fiche d'absence</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Gestion des filières
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../filiere/listerFiliere.php">Liste des filieres</a>
      
      </div>
    </div>
    <div class="dropdown">
      <button class="dropbtn">Gestion des matieres
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="../matiere/insertMat.php">Ajouter une matiere</a>
        <a href="../matiere/listerMat.php">Liste des matieres</a>
        
      </div>
    </div>

  <a href="../logout.php">Déconnexion</a>
</div>
<?php 
if(isset($_SESSION['message'])):?>
  <div class="alert2"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <?php
  
  echo $_SESSION['message'];
  unset($_SESSION['message']);
  
  ?>
  </div>
  <?php endif?>

<div class="main"><br/>
<header>
    <h1>Liste des étudiants</h1>
    <div class="sucess"></div>
</header>
<form align="center" method="post" action="listerEtudiant.php" >
 
<input  name="keyword" type="text"class="inpp" Maxlength="20" placeholder="CLASSE*">

<input type="submit" name="lister" value="lister" class="right-btn"> 

</form>

<br/><br/>


   <?php if(isset($_POST['lister'])){ ?>
<table class="t01">
    
   <?php
    
        $keyword=$_POST['keyword'];
        $sql=("SELECT ID_ETUD,CIN,CNE,NOM_ETUD,PRENOM_ETUD,DATE_NAISS,LIEU_NAISS,TEL_ETUD,EMAIL_ETUD,CLASSE FROM etudiant INNER JOIN classe ON etudiant.ID_CLASSE=classe.ID_CLASSE WHERE CLASSE LIKE '$keyword'");
        $result=$conn->query($sql);
        if($result->num_rows>0){ ?>

			<a href="printListEtud.php?print=<?php echo $keyword; ?>"><button class="button">Imprimer la liste <?php echo $keyword; ?></button></a>
      <br><br>
      

            <thread class="alert-info">
        <tr>
            
            
            <th>CIN</th>
            <th>CNE</th>
            <th>ClASSE</th>
            <th>PRENOM</th>
            <th>NOM</th>
            <th>DATE DE NAISSANCE</th>
            <th>LIEU DE  NAISSANCE</th>
            <th>TELEPHONE</th>
            <th>EMAIL</th>
            <th>Modifier/<br/>supprimer</th>
        </tr>
            </thread>
    <tbody>
    
     

      <?php  while($row=$result->fetch_assoc()) {  ?>
          <tr>
          
             <td><?php echo $row['CIN']; ?></td>
             <td><?php echo $row['CNE']; ?></td>
            <td><?php echo $row['CLASSE']; ?></td>
             <td><?php echo $row['PRENOM_ETUD']; ?></td>
             <td><?php echo $row['NOM_ETUD']; ?></td>
             <td><?php echo $row['DATE_NAISS']; ?></td>
             <td><?php echo $row['LIEU_NAISS']; ?></td>
             <td><?php echo $row['TEL_ETUD']; ?></td>
             <td><?php echo $row['EMAIL_ETUD']; ?></td>
             <td>
               <a href="modifier-supprimer/modifier.php?edit=<?php echo $row['ID_ETUD'];?>" ><i class="material-icons" style="font-size:18px;color:green">update</i></a>  /
               
               <a href="modifier-supprimer/suprimer.php?delete=<?php echo $row['ID_ETUD'];?>" onclick="return confirm('Etes vous sûre de vouloir supprimer cet étudiant ?');"><i class="material-icons" style="font-size:18px;color:red">delete</i></a>
            </td>
             
          </tr>
          
          
     <?php  
         }?>
        
        <?php 


        
        }else{
            echo "<strong>Classe n'existe pas</strong>";
        }       
        $conn->close();
    }
?>    

</tbody>
</table>
</body>
</html>

