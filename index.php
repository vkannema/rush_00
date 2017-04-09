<?php

	session_start();

	if (file_exists("admin/db/product.csv"))
	{
		$file = file_get_contents("admin/db/product.csv");
		$products = explode("\n", $file);
	}
	else
		$error = "product.csv doesn't exist !\n";

?>
<?php require_once("admin/includes/header.php") ?>

	<div class="container">

		<?php echo $error; ?>

		<?php
			if (isset($_SESSION['loggued_on_user'])) {
		?>
			<h1>Hello <?php echo $_SESSION['loggued_on_user']; ?>, See our fucking :</h1>
		<?php } else { ?>
			<h1>See our fucking :</h1>
		<?php } ?>

		<div class="category">
			<a href="index.php">All products</a>
			<?php 

				$f_cat = file_get_contents("admin/db/category.csv");
				$category = explode(";", $f_cat);

				foreach ($category as $cat) {
					?><a href="index.php?cat=<?php echo $cat; ?>"> <?php echo ucfirst($cat); ?> </a><?php
				}

			?>
		</div>

		<?php

		if (isset($_GET['cat']))
		{

			foreach ($products as $el) {
				if ($el)
				{
					$product = explode(";", $el);
					if ($product[3] == $_GET['cat']) {
					?>
					<div class="product align-left">
						<img src="<?php echo $product[1];?>" alt="" />
						<h2><?php echo $product[0]; ?></h2>
						<div class="price align-center">
							<span><?php echo $product[2]; ?>$</span>
							<a href="add.php?title=<?php echo $product[0]; ?>&price=<?php echo $product[2]; ?>">ADD</a>
						</div>
					</div>
					<?php
					}
				}
			}

		} else {

			foreach ($products as $el) {
				if ($el)
				{
					$product = explode(";", $el);
					?>
					<div class="product align-left">
						<img src="<?php echo $product[1];?>" alt="" />
						<h2><?php echo $product[0]; ?></h2>
						<div class="price align-center">
							<span><?php echo $product[2]; ?>$</span>
							<a href="add.php?title=<?php echo $product[0]; ?>&price=<?php echo $product[2]; ?>">ADD</a>
						</div>
					</div>
					<?php
				}
			}

		}
		?>

	</div>

<?php require_once("admin/includes/footer.php") ?>
