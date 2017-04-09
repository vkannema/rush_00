<?php

	if (isset($_GET['title']))
	{
		if (!file_exists("admin/db/panier.csv"))
			file_put_contents("admin/db/panier.csv", "");

		$file = file_get_contents("admin/db/panier.csv");
		if (!$file)
			$products = array();
		else
			$products = explode("\n", $file);

		foreach ($products as $key => $value) {
			$product = explode(";", $products[$key]);
			if ($product[0] == $_GET['title'])
			{
				$q = $product[1];
				$price = $product[2];
				unset($products[$key]);
			}
		}

		$products[] = $_GET['title'].";".($q + 1).";".($price + $_GET['price']);
		$save = implode("\n", $products);
		file_put_contents("admin/db/panier.csv", $save);
		header('Location: index.php');
	}

?>
