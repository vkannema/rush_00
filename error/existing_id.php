<?php require_once("../admin/includes/header.php") ?>

<div class="container">
	<h1>Se connecter</h1>
	<form method="post" action= "../create.php" >
		Identifiant: <input type="text" name="login" /></br>
		Mot de passe: <input type="text" name="passwd" /></br>
		<i>Login name already taken</i></br>
		<input type="submit" name="submit" value="OK" />
	</form>
	<a href="../create.php">Se creer un compte</a>
</div>

<?php require_once("../admin/includes/footer.php") ?>
