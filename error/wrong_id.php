<?php require_once("../admin/includes/header.php") ?>

<div class="container">
	<h1>Se connecter</h1>
	<form method="post" action= "../is_correct.php" >
		<i>Wrong password or login...</i></br>
		Identifiant: <input type="text" name="login" /></br>
		Mot de passe: <input type="text" name="passwd" /></br>
		<input type="submit" name="submit" value="OK" />
	</form>
	<a href="create.php">Se creer un compte</a>
</div>

<?php require_once("../admin/includes/footer.php") ?>
