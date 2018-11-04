<?php 
$config = 'config.php';
require_once($config); 
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<form method="post" action="" name="addComment">
	<label for="comment">add a comment</label>
	</br>
	<textarea name="comment"></textarea>
	</br>
	<input type="submit" name="addComment">
	<?php $newsQuery->addComment() ?>
</form>
</body>
</html>