<?php
if (isset($_POST['submit']) && $_POST['login'] && $_POST['passwd'] && $_POST['conf'])
{
	if (empty(trim($_POST['login'])))
		$error = "Wrong login";
	if ($_POST['conf'] !== $_POST['passwd'])
		$error = "The password and the confirmation one must be identic";
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
				$error = "Login already exist !";
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
else if (isset($_POST['submit']))
	$error = "Please fill all the champs";
?>
<?php require_once("admin/includes/header.php") ?>

	<div class="container">
		<a href="login.php" class="grey-button">Back</a>
		<h1>Create an account</h1>
		<form method="post" action= "create.php" >
			Login: <input type="text" name="login" required /></br>
			Password: <input type="password" name="passwd" required /></br>
			Confirmation: <input type="password" name="conf" required /></br>
			<input type="submit" name="submit" value="Create" />
			<?php echo $error; ?>
		</form>
	</div>



<?php require_once("admin/includes/footer.php") ?>
