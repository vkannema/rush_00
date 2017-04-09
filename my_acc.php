<?php

session_start();
if ($_POST['submit'] == "Delete" && $_POST['delete'] === "DELETE")
{
	$list = unserialize(file_get_contents("private/passwd"));
	foreach($list as $key => $elem)
	{
		if ($elem['login'] == $_SESSION['loggued_on_user'])
		{
			if ($elem['passwd'] != hash(whirlpool, $_POST['passwd']))
				$tip = "Wrong password";
			else
			{
				unset($list[$key]);
				$list = array_values($list);
				file_put_contents("private/passwd", serialize($list));
				unset($_SESSION['loggued_on_user']);
				$_SESSION['admin'] = "0";
				file_put_contents("admin/db/panier.csv", "");
				header('Location: index.php');
			}
		}
	}
}
else if ($_POST['submit'] == "Delete" && $_POST['delete'] !== "DELETE")
	$tip = "Invalid confirmation word";
?>

<?php

if (isset($_POST['submit']) && $_POST['submit'] != "Delete")
{
	$array = unserialize(file_get_contents("private/passwd"));

	foreach ($array as $key=>$elem)
	{
		if (hash(whirlpool, $_POST['oldpw']) != $elem['passwd'])
			$error = "Wrong old password";
		else if (hash(whirlpool, $_POST['oldpw']) == hash(whirlpool, $_POST['newpw']))
			$error = "The new password must be different than the old one";
		else if (hash(whirlpool, $_POST['conf']) != hash(whirlpool, $_POST['newpw']))
			$error = "The new password and the confirmation one must be identic";
		else
		{
			$array[$key]['passwd'] = hash(whirlpool, $_POST['newpw']);
			file_put_contents("private/passwd", serialize($array));
			$error = "The changement worked !";
		}
	}
}
?>

<?php require_once("admin/includes/header.php") ?>

	<div class="container">
		<a href="index.php" class="grey-button">Back</a>
		<h1><?php echo ucfirst($_SESSION['loggued_on_user']); ?> account</h1>
		<h2>Change my password</h2>
		<form method="post" action= "my_acc.php">
			Old password: <input type="password" name="oldpw" required /></br>
			New password: <input type="password" name="newpw" required /></br>
			Confirmation: <input type="password" name="conf" required /></br>
			<input type="submit" name="submit" value="Submit" />
			<?php echo $error; ?>
		</form>
	<?php if ($_SESSION['admin'] !== "2"){?>
		<h1>Delete my account</h1>
		Confirm password:
		<form method="post" action ="my_acc.php">
			<input type="password" name= "passwd" required />
			Enter "DELETE" to confirm your action
			<input type="text" name="delete" required /></br>
			<input type="submit" name="submit" value="Delete" />
			<?php echo $tip; ?>
		</form>
		<?php } ?>
	</div>

<?php require_once("admin/includes/footer.php") ?>
