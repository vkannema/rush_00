<?php
session_start();
if ($_POST['submit'] == "Change")
{
	if (file_exists("../private/passwd"))
	{
		$list = unserialize(file_get_contents("../private/passwd"));
		foreach($list as $key => $elem)
		{
			if ($_POST['login'] == $elem['login'])
			{
				if ($elem['admin'] == $_POST['rights'])
					$tip = "Nothing to change...";
				else
				{
					$list[$key]['admin'] = $_POST['rights'];
					$tip = "Rights changed !";
				}
			}
			file_put_contents("../private/passwd", serialize($list));
		}
		if (!isset($tip))
			$tip = "Login doesn't exist";
	}
}
else if ($_POST['submit'] == "Delete" && $_POST['login_delete'] && $_POST['delete'])
{
	$list = unserialize(file_get_contents("../private/passwd"));
	if ($_POST['delete'] !== "DELETE")
	{
		$msg = "Please enter DELETE to complete";
	}
	foreach($list as $key => $elem)
	{
		if ($elem['login'] == $_POST['login_delete'] && !isset($msg) && $_POST['login_delete'] != $_SESSION['loggued_on_user'])
		{
			unset($list[$key]);
			$list = array_values($list);
			file_put_contents("../private/passwd", serialize($list));
			$done = 1;
		}
		else if ($_SESSION['loggued_on_user'] == $_POST['login_delete'])
			$msg = "You can't delete yourself if you are superadmin.";
	}
	if ($done != 1 && !isset($msg))
		$msg = "This login does not exists";
}
else if ($_POST['submit'] == "Delete" && (!$_POST['login_delete'] || !$_POST['delete']))
{
	$msg = "You have to complete all champs";
}
?>


<?php

	if (file_exists("../private/passwd"))
	{
		$i = 0;
		$file = file_get_contents("db/product.csv");
		$list = unserialize(file_get_contents("../private/passwd"));
		foreach($list as $key=> $elem)
		{
			$array[$key]['login'] = $list[$key]['login'];
			$array[$key]['rights'] = $list[$key]['admin'];
			$i++;
		}
		if ($i === 1)
			$message = "There is no user in the database !";

	}

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">

		<?php echo $error; ?>

		<a href="index.php" class="grey-button">Back</a>
		<h1>Users list</h1>

		<?php echo $message; ?>

		<br>
		<?php
			foreach ($array as $key => $user) {
				if ($user['rights'] != "2" && $_SESSION['loggued_on_user'] != $user['login'])
				{?>
				<div class="product">
				Login : <b><?php echo($user['login']); ?></b> |
				Rights : <b><?php if ($user['rights'] === "1") { echo "Admin"; } else { echo "Customer"; } ?></b>
				</div>
				<?php	}} ?>
				<h2>Change the users's rights</h2>
				<form method="post" action= "manage_users.php">
					Login: <input type="text" name="login"/>
					<label for="rights">Rights</label>
					<select id="rights" name="rights">
						<option value="0">Customer</option>
						<option value="1">Admin</option>
					</select>
					<input type="submit" name="submit" value="Change" /><?php echo $tip ?>
				</form>
				<h2>Delete user</h2>
				<form method="post" action= "manage_users.php">
					Login: <input type="text" name="login_delete"/>
					Please enter "DELETE" to confirm your choice
					<input type="text" name="delete"/>
					<input type="submit" name="submit" value="Delete" /><?php echo $msg ?>
				</form>
</div>

<?php require_once("includes/footer.php") ?>
