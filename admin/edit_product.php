<?php 

	if (isset($_POST['submit']))
	{
		$file = file_get_contents("db/product.csv");
		$products = explode("\n", $file);

		$id = $_GET['title'];

		$ret = 0;

		foreach ($products as $el) {
			if (preg_match('/^'.$_POST['title'].';/', $el) && $_POST['title'] != $id)
				$ret = 1;
		}

		if ($ret === 0)
		{
			if ($_POST['category'])
			{
				$i = 0;
				foreach ($products as $el) {
					if (preg_match('/^'.$id.';/', $el))
						unset($products[$i]);
					$i++;
				}
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
	
	<a href="index.php" class="grey-button">Back</a>
	<h1>Edit product</h1>

	<form action="edit_product.php?title=<?php echo $_GET['title'];?>" method="POST">

		Title <input type="text" name="title" value="<?php echo $_GET['title']; ?>" required>
		<br />
		URL <input type="text" name="url" value="<?php echo $_GET['url']; ?>" required>
		<br />
		Price <input type="text" name="price" value="<?php echo $_GET['price']; ?>" required>
		<br />
		Category :
		<?php 

			$f_cat = file_get_contents("db/category.csv");
			$category = explode(";", $f_cat);

			foreach ($category as $cat) {
				?><input type="checkbox" name="category[]" value="<?php echo $cat; ?>"><?php echo ucfirst($cat); ?></input><?php
			}

		?>
		<br />
		<input type="submit" name="submit" value="Envoyer">
		<?php echo $msg; ?>
		
	</form>

	<br />
	<?php echo $error; ?>

</div>

<?php require_once("includes/footer.php") ?>