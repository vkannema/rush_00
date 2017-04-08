<?php

session_start();

if (isset($_POST['submit']))
{
	$array = unserialize(file_get_contents("private/passwd"));

	foreach ($array as $key=>$elem)
	{
		if (hash(whirlpool, $_POST['oldpw']) != $elem['passwd'])
			$error = "Wrong old password";
		else if (hash(whirlpool, $_POST['oldpw']) == hash(whirlpool, $_POST['newpw']))
			$error = "Le nouveau mot de passe doit etre different de l'ancien";
		else if (hash(whirlpool, $_POST['conf']) != hash(whirlpool, $_POST['newpw']))
			$error = "La confirmation et le nouveau mot de passe doivent etre les memes.";
		else 
		{
			$array[$key]['passwd'] = hash(whirlpool, $_POST['newpw']);
			file_put_contents("private/passwd", serialize($array));
			$error = "Le changement a ete effectue";
		}
	}
}

?>

<?php require_once("admin/includes/header.php") ?>

	<div class="container">
		<h1>Mon compte - <?php echo $_SESSION['loggued_on_user']; ?></h1>
		<h2>Changement de mot de passe</h2>
		<form method="post" action= "my_acc.php" >
			Ancien mot de passe: <input type="password" name="oldpw" /></br>
			Nouveau mot de passe: <input type="password" name="newpw" /></br>
			Confirmation: <input type="password" name="conf" /></br>
			<input type="submit" name="submit" value="Envoyer" />
			<?php echo $error; ?>
		</form>
	</div>



<?php require_once("admin/includes/footer.php") ?>
