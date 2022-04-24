<?php
   include("../config.php");
   session_start();
	$type="login";
	if(!isset($_SESSION['admin'])){
		header("Location: admin.php");
	}
   if($_SERVER["REQUEST_METHOD"] == "POST"){
      if($_POST['action'] == "update"){
         UpdateUser($_POST['username'], $_POST['phone']);
      }else if($_POST['action'] == "delete"){
         DeleteUser($_POST['username']);
      }
   }
	$users = [];
	GetUsers();

	function GetUsers(){
		GLOBAL $db;
		GLOBAL $users;
      
      $sql = "SELECT * FROM users;";
		$users = mysqli_query($db,$sql);
   }

	function UpdateUser($userName, $phone){
      GLOBAL $db;
      $sql = "UPDATE users SET phone='$phone' WHERE username = '$userName';";
      $result = mysqli_query($db, $sql);
   }
	
   function DeleteUser($userName){
      GLOBAL $db;
      $sql = "DELETE FROM users WHERE username = '$userName';";
      $result = mysqli_query($db, $sql);
   }	
?>
<html>
   <head>
      <title>Login Page</title>
 		<link rel="stylesheet" href="../style.css">     
   </head>   
   <body>
		<?php include "nav.php" ?>	
      <div class="content">
      	<?php if(count($users) > 0) {
				foreach($users as $row){
			?>
					<form action="" method="POST">
						<label>User: </label>
						<input type="text" name="username" value="<?= $row['username'] ?>" style="width:auto" disabled/>
						<input type="hidden" name=username" value="<?= $row['username'] ?>"/>
						<label>Phone: </label>
						<input type="text" name="phone" value="<?= $row['phone']?>">
						<input type="submit" name="action" value="update" />
						<input type="submit" name="action" value="delete" />
					</form>
			<?php
				}
		}else{
			echo "none";
		}
		?>
      </div>
		<?php include_once "foot.php" ?>
   </body>
</html>        
