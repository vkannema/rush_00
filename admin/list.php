<?php 

	if (file_exists("db/product.csv"))
	{
		$file = file_get_contents("db/product.csv");
		$products = explode("\n", $file);
	}
	else
		$error = "product.csv doesn't exist !\n";

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">

		<?php echo $error; ?>

		<span><a href="index.php">Back</a></span>
		<h1>Product List</h1>

		<a href="add_product.php">+ Add a Product</a>

		<br /><br />

		<?php

		foreach ($products as $el) {
			if ($el)
			{
				$product = explode(";", $el);
				?>
				<div class="product">
					Title : <b><?php echo $product[0]; ?></b> - 
					Price : <b><?php echo $product[2]; ?>$</b> -  
					Category : <b><?php echo $product[3]; ?></b> | 

					<a href="edit_product.php?title=<?php echo $product[0];?>
					&url=<?php echo $product[1];?>&price=<?php echo $product[2];?>
					&cat=<?php echo $product[3];?>">Edit</a> - 
					<a href="del_product.php?title=<?php echo $product[0]; ?>">Delete</a>
				</div>
				<?php
			}
		}
		?>

</div>

<?php require_once("includes/footer.php") ?>