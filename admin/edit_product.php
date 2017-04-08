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
			$i = 0;
			foreach ($products as $el) {
				if (preg_match('/^'.$id.';/', $el))
					unset($products[$i]);
				$i++;
			}
			$products[] = $_POST['title'].";".$_POST['url'].";".$_POST['price'].";".$_POST['category'];
			$save = implode("\n", $products);
			file_put_contents("db/product.csv", $save);
			header('Location: list.php');
		}
		else
			$error = "Title already exist !";
		
	}

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">
	
	<span><a href="list.php">Back</a></span>
	<h1>Edit product</h1>

	<form action="edit_product.php?title=<?php echo $_GET['title'];?>" method="POST">

		Title <input type="text" name="title" value="<?php echo $_GET['title']; ?>" required>
		<br />
		URL <input type="text" name="url" value="<?php echo $_GET['url']; ?>" required>
		<br />
		Price <input type="text" name="price" value="<?php echo $_GET['price']; ?>" required>
		<br />
		Category
		<select name="category" value="<?php echo $_GET['cat']; ?>">
			<option value="shoes">Shoes</option>
			<option value="tees">T-Shirts</option>
		</select>
		<br />
		<input type="submit" name="submit" value="Envoyer">
		
	</form>

	<br />
	<?php echo $error; ?>

</div>

<?php require_once("includes/footer.php") ?>