<?php 

	if (isset($_POST['submit']))
	{
		$file = file_get_contents("db/product.csv");
		$products = explode("\n", $file);

		$id = $_POST['title'];
		$ret = 0;

		foreach ($products as $el) {
			if (preg_match('/^'.$id.';/', $el))
				$ret = 1;
		}

		if ($ret === 0)
		{
			if ($_POST['category'])
			{
				$str = implode(",", $_POST['category']);
				$products[] = $_POST['title'].";".$_POST['url'].";".$_POST['price'].";".$str;
				$save = implode("\n", $products);
				file_put_contents("db/product.csv", $save);
				header('Location: list.php');
			}
			else 
				$msg = "Choisissez au moins une categorie !";
		}
		else
			$error = "Title already exist !";
	}

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">
	
	<a href="list.php" class="grey-button">Back</a>
	<h1>Add a product</h1>

	<form action="add_product.php" method="POST">

		Title <input type="text" name="title" id="" required>
		<br />
		URL <input type="text" name="url" id="" required>
		<br />
		Price <input type="text" name="price" id="" required>
		<br />
		Category
		<!-- <select name="category" multiple id=""> -->
		<?php 

			$f_cat = file_get_contents("db/category.csv");
			$category = explode(";", $f_cat);

			foreach ($category as $cat) {
				?><input type="checkbox" name="category[]" value="<?php echo $cat; ?>"><?php echo ucfirst($cat); ?></input><?php
			}

		?>
		<!-- </select> -->
		<br />
		<input type="submit" name="submit" value="Envoyer">
		<?php echo $msg; ?>	
		
	</form>
	
	<br />
	<?php echo $error; ?>

</div>

<?php require_once("includes/footer.php") ?>