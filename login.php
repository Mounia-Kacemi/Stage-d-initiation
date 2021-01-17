<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style_login.css" />
</head>
<body>
<?php
session_start();

if (isset($_POST['password']) ) if ( $_POST['password']=="enset"){

	    $_SESSION['password'] = $_POST['password'];
		header("Location: index.php");
	}else{
		$message = "le mot de passe est incorrect.";
	}

?>
<form class="box" action="" method="post" name="login">
<img class="logo" src="image/logo.png" alt="logo">
	<hr><hr>
<h1 class="box-title">Connexion</h1>
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">
<br><br><br>
<?php if (!empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>