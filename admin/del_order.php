<?php 

	if (isset($_GET['id']))
	{
		$file = file_get_contents("db/commande.csv");
		$orders = explode("\n", $file);

		foreach ($orders as $key => $value) {
			if ($_GET['id'] == $key)
				unset($orders[$key]);
		}

		$save = implode("\n", $orders);
		file_put_contents("db/commande.csv", $save);

		header('Location: commande.php');
	}

?>