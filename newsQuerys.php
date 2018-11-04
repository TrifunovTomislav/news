<?php 
class NewsQuerys {
	
		public function showNews(){
		
			$db = DB::getInstance();
		    $query = "SELECT * FROM articles";
			$stmt = $db->conn->query($query);
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if($stmt != false){

			foreach($rows as $row){

				echo $row['article'];
				?>
					&nbsp;&lt;&lt;&lt;<a href="addComment.php?id=<?php echo $row['id'] ?>">add a comment to this article</a><br>
				<?php

				$query2 = "SELECT * FROM comments WHERE marker = '{$row['id']}'";           
				$stmt2 = $db->conn->query($query2);
				$comments = $stmt2->fetchAll(PDO::FETCH_ASSOC);

				foreach($comments as $key=>$value){
					echo "<p>" . $value['comment'] . "</p>";

				}

			}

			}else{
				echo "<p>no news at the moment</p>";

			}
		}
	
			public function showNewsAdmin(){
		
				$db = DB::getInstance();
				$query = "SELECT * FROM articles";
				$stmt = $db->conn->query($query);
				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if($stmt != false){

					foreach($rows as $row){
						
						echo $row['article'];
						?>
							&nbsp;&lt;&lt;&lt;<a href="deleteArticle.php?id=<?php echo $row['id'] ?>">delete article</a>&nbsp;&lt;&lt;&lt;<a href="addComment.php?id=<?php echo $row['id'] ?>">add a comment to this article</a><br>
						<?php

						$query2 = "SELECT * FROM comments WHERE marker = '{$row['id']}'";           
						$stmt2 = $db->conn->query($query2);
						$comments = $stmt2->fetchAll(PDO::FETCH_ASSOC);

						foreach($comments as $key=>$value){
							echo $value['comment'];
							?>
							&nbsp;&lt;&lt;&lt;<a href="deleteComment.php?id=<?php echo $value['id'] ?>">delete a comment</a><br>
							<?php
						}
					}

				}else{
				echo "<p>no news at the moment</p>";
			}
		}
	
		public function insertArticle(){
			if (isset($_POST['insertArticle'])){
				if (isset($_POST['article']) && !empty($_POST['article'])){

						$article = trim($_POST['article']);
						$article = filter_var($article, FILTER_SANITIZE_STRING);
						$db = DB::getInstance();
						$query = "INSERT INTO articles (article) VALUES (:article)";
						$stmt = $db->conn->prepare($query);
						$stmt->bindValue(':article',$article);

						if($stmt->execute() === TRUE){
							header("location: adminpage.php");
						}else{
							echo "<p>article not added</p>";
						}
					}else{
						echo "<p>field must not be empty</p>";
					}
				}
		}
		
		public function deleteArticle(){
		
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$db = DB::getInstance();
				$query = "DELETE FROM articles WHERE id =:id";
				$query2 = "DELETE FROM comments WHERE marker = :id";
				$stmt = $db->conn->prepare($query);
				$stmt2 = $db->conn->prepare($query2);
				$stmt->bindValue(':id',$id);
				$stmt2->bindValue(':id',$id);
				if($stmt->execute() === TRUE && $stmt2->execute() === TRUE){
					header("Location: adminpage.php");
				}else{
					echo "<p>failed to delete</p>";
				}
			}
		}
	
		public function addComment(){
			if (isset($_POST['addComment']) && isset($_GET['id'])){	
				if (isset($_POST['comment']) && !empty($_POST['comment'])){

						$id = $_GET['id'];
						$comment = trim($_POST['comment']);
						$comment = filter_var($comment, FILTER_SANITIZE_STRING);
						$db = DB::getInstance();
						$query = "INSERT INTO comments (comment,marker) VALUES (:comment,:id)";
						$stmt = $db->conn->prepare($query);
						$stmt->bindValue(':comment',$comment);
						$stmt->bindValue(':id',$id);

						if($stmt->execute() === TRUE){
							if($_SESSION['admin'] === 'admin'){
								header("location: adminpage.php");
							}else{
								header("location: news.php");
							}	
						}else{
							echo "<p>comment not added</p>";
						}
					}else{
						echo "<p>field must not be empty</p>";
					}
			}		
		}
	
			public function deleteComment(){
		
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$db = DB::getInstance();
					$query = "DELETE FROM comments WHERE id = :id";
					$stmt = $db->conn->prepare($query);
					$stmt->bindValue(':id',$id);
					if($stmt->execute() === TRUE){
						header("Location: adminpage.php");
					}else{
						echo "<p>failed to delete</p>";
					}
				}
		}
}
$newsQuery = new NewsQuerys;
