<?php
session_start();
if (isset($_POST['submit']))
{
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
			$message = "T'as personne mec !";

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
				<h2>Changer les droits utilisateurs</h2>
				<form method="post" action= "manage_users.php">
					Login: <input type="text" name="login"/>
					<label for="rights">Rights</label>
					<select id="rights" name="rights">
						<option value="0">Customer</option>
						<option value="1">Admin</option>
					</select>
					<input type="submit" name="submit" value="Change" /><?php echo $tip ?>
				</form>

</div>

<?php require_once("includes/footer.php") ?>
