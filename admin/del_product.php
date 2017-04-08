<?php 

	if (isset($_GET['title']))
	{
		$id = $_GET['title'];

		$file = file_get_contents("db/product.csv");
		$products = explode("\n", $file);

		$i = 0;
		foreach ($products as $el) {
			if (preg_match('/^'.$id.';/', $el))
				unset($products[$i]);
			$i++;
		}

		$save = implode("\n", $products);
		file_put_contents("db/product.csv", $save);

		header('Location: list.php');
	}

?>