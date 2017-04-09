<?php 


	//mkdir("private", 0777);
	//mkdir("admin/db", 0777);

	if (!file_exists("admin/db/category.csv"))
		file_put_contents("admin/db/category.csv", "shoes;t-shirt");
	else
	{
		echo "Error : admin/db/category.csv already exist !";
		exit();
	}

	if (!file_exists("admin/db/product.csv"))
	{
		$products = "Converse;img/converse.jpg;49;shoes\nNike;img/nike.jpg;69;shoes";
		file_put_contents("admin/db/product.csv", $products);
		header('Location: index.php');
	}
	else
	{
		echo "Error : admin/db/product.csv already exist !";
		exit();
	}

?>