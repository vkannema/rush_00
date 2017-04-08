<?php
include("auth.php");
if ($_POST['login'] && $_POST['passwd'])
{
	if (auth($_POST['login'], $_POST['passwd']) == TRUE)
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		header('Location: index.php');
	}
	else
		$error = "Wrong id or password";
}
else
	echo "ERROR2\n";
?>

<?php require_once("admin/includes/header.php") ?>

	<div class="container">
		<h1>Se connecter</h1>
		<form method="post" action= "login.php" >
			Identifiant: <input type="text" name="login" /></br>
			Mot de passe: <input type="text" name="passwd" /></br>
			<input type="submit" name="submit" value="OK" />
			<?php echo $error; ?>
		</form>
		<a href="create.php">Se creer un compte</a>
	</div>



<?php require_once("admin/includes/footer.php") ?>
