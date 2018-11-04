<?php 
$config = 'config.php';
require_once($config);
session_start();
if(!isset($_SESSION['user'])){
	header("Location: return.php");
}else{
	echo "<p>Welcome " . $_SESSION['user'] . "</p>";
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<h3>Todays news are:</h3>
<?php $newsQuery->showNews(); ?>
<form method="post" action="" name="logout">
	<input type="submit" name="logout_btn"  value="logout">
	<?php 
		if(isset($_POST['logout_btn'])){	
			 session_destroy();
			header("Location: index.php");
		}
	?>
</form>
</body>
</html>