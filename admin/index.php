<?php

	session_start();

	if (!isset($_SESSION['loggued_on_user']))
		header('Location: ../login.php');
	if ($_SESSION['admin'] === "0")
		header('Location: ../index.php');

?>

<?php require_once("includes/admin-header.php") ?>

<div class="container">

	<h1>Hello <?php echo $_SESSION['loggued_on_user']; ?>, you can manage :</h1>

	<ul class="admin">
		<li><a href="add_product.php">Add a Product</a></li>
		<li><a href="list.php">Product List</a></li>	
		<li><a href="category.php">Manage Category</a></li>
		<li><a href="manage_users.php">Manage users</a></li>
		<li><a href="commande.php">See your Orders</a></li>
	</ul>
</div>

<?php require_once("includes/footer.php") ?>
