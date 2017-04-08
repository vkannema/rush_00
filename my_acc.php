<?php

if ($_POST['submit'] == "OK")
{
	$login = $_POST['login'];
$array = unserialize(file_get_contents("private/passwd"));
$done = 0;
foreach ($array as $key=>$elem)
{
	if ($elem['login'] == $login)
	{
		if (hash(whirlpool, $_POST['oldpw']) != $elem['passwd'])
			$error = "Wrong old password";
		if (!isset($error))
		{
			if (hash(whirlpool, $_POST['oldpw']) == hash(whirlpool, $_POST['newpw']))
				$error = "Le nouveau mot de passe doit etre different de l'ancien";
			if (hash(whirlpool, $_POST['conf']) != hash(whirlpool, $_POST['newpw']))
				$error = "La confirmation et le nouveau mot de passe doivent etre les memes.";
			if (!isset($error))
			{
				$array[$key]['passwd'] = hash(whirlpool, $_POST['newpw']);
				file_put_contents("private/passwd", serialize($array));
				$done = 1;
				echo "OK\n";
			}
		}
	}
	else
		$error = "Mauvais login";
}
}
else
	$error = "You must validate your choice";

?>

<?php session_start() ?>
<?php require_once("admin/includes/header.php") ?>

	<div class="container">
		<h1>Changer son mot de passe</h1>
		<form method="post" action= "my_acc.php" >
			Identifiant: <input type="text" name="login" /></br>
			Ancien mot de passe: <input type="password" name="oldpw" /></br>
			Nouveau mot de passe: <input type="password" name="newpw" /></br>
			Confirmation: <input type="password" name="conf" /></br>
			<input type="submit" name="submit" value="OK" />
			<?php echo $error; ?>
		</form>
	</div>



<?php require_once("admin/includes/footer.php") ?>
