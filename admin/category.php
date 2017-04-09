<?php 

	if (file_exists("db/category.csv"))
	{
		$file = file_get_contents("db/category.csv");
	}
	else
		$error = "category.csv doesn't exist !\n";

	if (isset($_POST['submit']))
	{
		$ret = 0;
		$array = explode(";", $file);
		foreach ($array as $key => $value) {
			if ($array[$key] == $_POST['cat'])
				$ret = 1;
		}
		if ($ret === 0)
		{
			$array[] = $_POST['cat'];
			$save = implode(";", $array);
			file_put_contents("db/category.csv", $save);
			header('Location: category.php');
		}
		else
			$message = " /!\ This category already exist !";
	}

	if (isset($_GET['del']))
	{
		$ret = 0;
		$array = explode(";", $file);
		foreach ($array as $key => $value) {
			if ($array[$key] == $_GET['del'])
				unset($array[$key]);
		}
		$save = implode(";", $array);
		file_put_contents("db/category.csv", $save);
		header('Location: category.php');
	}

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">
		
	<?php echo $error; ?>
	
	<a href="index.php" class="grey-button">Back</a>
	<h1>Vos categories</h1>

	<?php
	if ($file)
	{
		$cat = explode(";", $file);
		foreach ($cat as $value) {
			?>
				<div class="product">
					Category : <b><?php echo $value; ?></b>
					<?php 

						if ($value != "shoes" && $value != "t-shirt") {
							?><a href="category.php?del=<?php echo $value; ?>">- Retirer</a><?php
						}
					?>
				</div>
			<?php
		}
	}
	else {
		?><p>Il n'y a pas de categories !</p><?php
	}
	?>
	
	<div>
		<form action="category.php" method="POST">
			Add a Category: <input type="text" name="cat">
			<input type="submit" name="submit" value="Ajouter">
			<?php echo $message; ?>
		</form>
	</div>

</div>

<?php require_once("includes/footer.php") ?>