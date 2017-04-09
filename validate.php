<?php 

	if (isset($_GET['user']) && isset($_GET['price']))
	{
		if (!file_exists("admin/db/commande.csv"))
			file_put_contents("admin/db/commande.csv", "");

		$file = file_get_contents("admin/db/commande.csv");
		if (!$file)
			$commands = array();
		else
			$commands = explode("\n", $file);
		$commands[] = $_GET['user'].";".$_GET['price'];
		$save = implode("\n", $commands);
		file_put_contents("admin/db/commande.csv", $save);
		file_put_contents("admin/db/panier.csv", "");
		header('Location: index.php');
	}

?>