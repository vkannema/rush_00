<?php
include("auth.php");

if (isset($_POST['submit']))
{
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
		$error = "Please fill all the champs";
}

?>

<?php require_once("admin/includes/header.php") ?>
	
	<div class="container">
		<a href="index.php" class="grey-button">Back</a>
		<h1>Log in</h1>
		<form method="post" action= "login.php" >
			Login: <input type="text" name="login" required/></br>
			Password: <input type="password" name="passwd" required/></br>
			<input type="submit" name="submit" value="Log in" />
			<?php echo $error; ?>
		</form>
		
		<br>
		<p>You don't have an account ?</p>
		<a href="create.php" class="green-button">Sign in</a>
	</div>

<?php require_once("admin/includes/footer.php") ?>
