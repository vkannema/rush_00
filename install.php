<?php 

	if (file_exists("private"))
	{
		echo "Error : you already install you e-shop !";
		exit();
	}

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
			file_put_contents("admin/db/category.csv", "shoes;t-shirt;clothes;food");
		else
		{
			echo "Error : admin/db/category.csv already exist !";
			exit();
		}

		if (!file_exists("admin/db/product.csv"))
		{
			$products = "Converse;img/converse.jpg;49;shoes,clothes\nNike;img/nike.jpg;69;shoes,clothes\nDecathlon;img/tees.jpg;15;t-shirt,clothes\nPate de campagne;http://p5.storage.canalblog.com/54/27/794150/84795470_o.jpg;6;food";
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
<head>
	<title>Install your e-shop</title>
	<link rel="stylesheet" href="css/style.css">
</head>
	<body>
		
	<h1>Install your e-shop</h1>
	<form action="install.php" method="POST">
		
		Choose a SuperAdmin login : <br>
		<input type="text" name="login" required>
		<br>
		Password : <br>
		<input type="password" name="passwd" required>
		<br>
		<input type="submit" name="submit" value="Start installation">

	</form>

	</body>
</html>