<?php
$config = 'config.php';
require_once($config);
session_start();
if(!isset($_SESSION['admin'])){
	header('Location: return.php');
}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<h3>Welcome admin</h3>
<p>news at the moment are:</p>
<?php $newsQuery->showNewsAdmin(); ?>
</br>

<form method="post" action="" name="addNews">
	<label for="article">add news</label>
	</br>
	<textarea name="article"></textarea>
	</br>
	<input type="submit" name="insertArticle">
	<?php $newsQuery->insertArticle(); ?>
	
</form>
<br>
<form method="post" action="" name="logout">
	<input type="submit" name="logout_btn"  value="logout">
	<?php 
		if(isset($_POST['logout_btn'])){	
			 session_destroy();
			header("location: index.php");
		}
	?>
</form>


</body>
</html>