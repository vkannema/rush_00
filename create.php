<?php
if($_POST['submit'] == "OK" && $_POST['login'] && $_POST['passwd'])
{
	if (!file_exists("private"))
	{
		mkdir("private");
	}
	if (!file_exists("private/passwd"))
	{
		$admin = "2";
		file_put_contents("private/passwd", "");
	}
	else
		$admin = "0";
	$array = unserialize(file_get_contents("private/passwd"));
	$login = $_POST['login'];
	if ($array)
	{
		foreach($array as $elem)
		{
			if ($elem['login'] == $login)
				$error = "Login already existing";
		}
	}
	if (!isset($error))
	{
		$hash = hash(whirlpool, $_POST['passwd']);
		$array[] = array(login=> $login, passwd=>$hash, admin=>$admin);
		file_put_contents("private/passwd", serialize($array));
		session_start();
		$_SESSION['loggued_on_user'] = $login;
		$_SESSION['admin'] = $admin;
		header('Location: index.php');
		exit ();
	}
}
else
	echo "ERROR\n";
?>
<?php require_once("admin/includes/header.php") ?>

	<div class="container">
		<h1>Se creer un compte</h1>
		<form method="post" action= "create.php" >
			Identifiant: <input type="text" name="login" /></br>
			Mot de passe: <input type="text" name="passwd" /></br>
			Confirmer le mot de passe: <input type="text" name="conf" /></br>
			<input type="submit" name="submit" value="OK" />
			<?php echo $error; ?>
		</form>
	</div>



<?php require_once("admin/includes/footer.php") ?>
