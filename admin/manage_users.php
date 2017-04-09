<?php
session_start();
if (file_exists("../private/passwd"))
{
	$list = unserialize(file_get_contents("../private/passwd"));
	foreach($list as $key => $elem)
	{
		if ($_POST['login'] == $elem['login'])
		{
			if ($elem['admin'] == $_POST['rights'])
				$tip = "Aucun changement a faire...";
			else
			{
				$list[$key]['admin'] = $_POST['rights'];
				$tip = "Changement effectue";
			}
		}
		file_put_contents("../private/passwd", serialize($list));
	}
	if (!isset($tip))
		$tip = "Login introuvable";
}

?>


<?php

	if (file_exists("../private/passwd"))
	{
		$file = file_get_contents("db/product.csv");
		$list = unserialize(file_get_contents("../private/passwd"));
		foreach($list as $key=> $elem)
		{
			$array[$key]['login'] = $list[$key]['login'];
			$array[$key]['rights'] = $list[$key]['admin'];
		}

	}

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">

		<?php echo $error; ?>

		<span><a href="index.php">Back</a></span>
		<h1>Users list</h1>

		<br /><br />
		<?php
			foreach ($array as $key => $user) {
				if ($user['rights'] != "2" && $_SESSION['loggued_on_user'] != $user['login'])
				{?>
				<div class="product">
				Login : <?php echo($user['login']); ?> |
				Rights : <?php echo($user['rights']); ?>
				</div>
				<?php	}} ?>
				<form method="post" action= "manage_users.php">
					Login: <input type="text" name="login"/>
					<label for="rights">Rights</label>
					<select id="rights" name="rights">
						<option value="0">0</option>
						<option value="1">1</option>
					</select>
					<input type="submit" value="Change" /><?php echo $tip ?>
				</form>

</div>

<?php require_once("includes/footer.php") ?>
