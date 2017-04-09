<?php

session_start();
if ($_POST['submit'] == "Supprimer" && $_POST['delete'] === "SUPPRIMER")
{
	$list = unserialize(file_get_contents("private/passwd"));
	foreach($list as $key => $elem)
	{
		if ($elem['login'] == $_SESSION['loggued_on_user'])
		{
			if ($elem['passwd'] != hash(whirlpool, $_POST['passwd']))
				$tip = "Mauvais mot de passe";
			else
			{
				unset($list[$key]);
				$list = array_values($list);
				file_put_contents("private/passwd", serialize($list));
				unset($_SESSION['loggued_on_user']);
				$_SESSION['admin'] = "0";
				header('Location: index.php');
			}
		}
	}
}
else if ($_POST['submit'] == "Supprimer" && $_POST['delete'] !== "SUPPRIMER")
	$tip = "Champ texte invalide";
?>

<?php

if (isset($_POST['submit']) && $_POST['submit'] != "Supprimer")
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
	<?php if ($_SESSION['admin'] !== "2"){?>
		<h1>Supprimer son compte</h1>
		Mot de passe:
		<form method="post" action ="my_acc.php">
			<input type="password" name= "passwd" />
			Pour valider la suppression, entrer "SUPPRIMER" dans ce champ
			<input type="text" name="delete" /></br>
			<input type="submit" name="submit" value="Supprimer" />
			<?php echo $tip; ?>
		</form>
		<?php } ?>
	</div>



<?php require_once("admin/includes/footer.php") ?>
