<?php

class UserQuerys {
		public function registerUser(){
		if(isset($_POST['register'])){
			if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){	
					
					$username = trim($_POST['username']);
					$password = trim($_POST['password']);
					$username = filter_var($username, FILTER_SANITIZE_STRING);
					$password = filter_var($password, FILTER_SANITIZE_STRING);
					
					$db = DB::getInstance();
					$query = "INSERT INTO users (name, password) VALUES (:username,:password)";
					$query2 = "SELECT name FROM users ";
					$stmt = $db->conn->prepare($query);
					$stmt2 = $db->conn->query($query2);
					$stmt->bindValue(':username',$username);
					$stmt->bindValue(':password',$password);
					$result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
					foreach ($result as $res){
						$name = $res['name'];
					}
					if ($name != $username){
						if( $stmt->execute() === TRUE){
							$_SESSION['user'] = $username;
							header("Location: welcome.php");
						}else{
							echo "<p>an error happend</p>";
						}
					}else{
						echo "<p>username is taken</p>";
						echo "<a href=\"register.php\">back</a>";
					}
				}else{
					echo "<p>fields must not be empty</p>";
				}

			}

		}
	
		public function loginCheck(){
		
		if(isset($_POST['login'])){
			if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
					
					$username = trim($_POST['username']);
					$password = trim($_POST['password']);
					$username = filter_var($username, FILTER_SANITIZE_STRING);
					$password = filter_var($password, FILTER_SANITIZE_STRING);
				
					$db = DB::getInstance();
					$query = "SELECT id FROM users WHERE name =:username AND password =:password";
					$stmt = $db->conn->prepare($query); 
					$stmt->bindValue(':username',$username);
					$stmt->bindValue(':password',$password);
					$stmt->execute();
					$result = $stmt->fetchAll();
					$count = count($result);
					
					if ($username === 'admin' && $password === 'admin'){
						$_SESSION['admin']=$username;
						header("Location: adminpage.php");	
					}elseif ($count == true){
						$_SESSION['user'] = $username;
						header("location: news.php");
					}else{	
						echo "<p>incorect username or password</p>";
					}
				}else{
					echo "<p>fields must not be empty</p>";
				}
			}
		}
}
$userQuery = new UserQuerys;
