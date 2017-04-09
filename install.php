<?php 

	if (isset($_POST['submit']))
	{
		if ($_POST['login'] && $_POST['passwd'])
		{
			if (empty(trim($_POST['login']))) {
				echo "Login invalide";
				exit();
			}
			else
			{
				mkdir("private", 0777);
				file_put_contents("private/passwd", "");
				$hash = hash(whirlpool, $_POST['passwd']);
				$array = unserialize(file_get_contents("private/passwd"));
				$array[] = array(login => $_POST['login'], passwd => $hash, admin => "2");
				file_put_contents("private/passwd", serialize($array));
			}
		}
		else
		{
			echo "Login et le mot de passe obligatoire !";
			exit();
		}

		mkdir("admin/db", 0777);

		if (!file_exists("admin/db/category.csv"))
			file_put_contents("admin/db/category.csv", "shoes;t-shirt");
		else
		{
			echo "Error : admin/db/category.csv already exist !";
			exit();
		}

		if (!file_exists("admin/db/product.csv"))
		{
			$products = "Converse;img/converse.jpg;49;shoes\nNike;img/nike.jpg;69;shoes\nDecathlon;img/tees.jpg;15;t-shirt";
			file_put_contents("admin/db/product.csv", $products);
			header('Location: index.php');
		}
		else
		{
			echo "Error : admin/db/product.csv already exist !";
			exit();
		}
	}
	
?>

<html>
	<body>
		
	<form action="install.php" method="POST">
		
		Choisir votre login administrateur : <br>
		<input type="text" name="login" required>
		<br>
		Mot de passe administrateur : <br>
		<input type="password" name="passwd" required>
		<br><br>
		<input type="submit" name="submit" value="Lancer l'installation">

	</form>

	</body>
</html>