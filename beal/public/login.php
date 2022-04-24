<?php
   include("../config.php");
   session_start();
	$type="login"; 
   if($_SERVER["REQUEST_METHOD"] == "POST") {
		if($_POST['action'] != "login"){
         $type = $_POST['action'];
			if($type == "create"){
            $newError = NewUser();
				header("location: login.php");
         }
      }else{
			$error = LogInUser();
		}
   }

	function NewUser(){
      GLOBAL $db;
		GLOBAL $type;
      $username = $_POST['username'];
      $password = $_POST['password'];
		$phone = $_POST['phone'];
		
		if($username == null || trim($username) == ""){
			$type = "newUser";
			return "User name cannot be empty.";
		}
		if($password == null || trim($password) == ""){
			$type = "newUser";
			return "Password cannot be empty.";
		}
		if($phone == null || trim($phone) == ""){
			$type = "newUser";
			return "Phone number cannot be empty.";
		}
		
      $sql = "SELECT id FROM users WHERE username = '$username';";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);

      if($count > 0) {
			$type = "newUser";
         return "User already exists.";
      }
		
		$sql = "INSERT INTO users (username, password, phone) VALUES ('$username','$password','$phone');";
		$result = mysqli_query($db,$sql);
      return "New user created";
   }

	function LogInUser(){
		GLOBAL $db;
		$username = $_POST['username'];
      $password = $_POST['password']; 
      
      $sql = "SELECT id FROM users WHERE username = '$username' and password = '$password';";
		$result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);

      if($count > 0) {
 			$_SESSION['username'] = $username; 
			header("location: home.php");       
      }else {
        	return "Your Login Name or Password is invalid";
      }
		return "mellon";
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
      	<?php if(isset($_SESSION['username'])){ ?>
            <div>you are logged in as <?= $_SESSION['username'] ?></div>
         <?php
            }else{
               if($type == "login" || $type == "back"){
         ?>
				<h1><b>Login</b></h1>
            <form action = "" method = "post">
               <label>UserName </label><input type = "text" name = "username" /><br /><br />
               <label>Password </label><input type = "password" name = "password" /><br/><br />
               <button name="action" type="submit" value="login">LogIn</button><br />
               <button name="action" type="submit" value="newUser">New User</button>
            </form>

            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
         <?php }elseif($type=="newUser"){ ?>
				<h1><b>Create New User</b></h1>
            <form action = "" method = "post">
					<label>UserName </label><input type = "text" name = "username" /><br /><br />
               <label>Password </label><input type = "password" name = "password" /><br/><br />
               <label>Phone Number </label><input type = "text" name = "phone"/><br /><br />
					<button name="action" type="submit" value="create">Create</button><br />
               <button name="action" type="submit" value="back">Back to LogIn</button>
            </form>
				<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $newError; ?></div>
         <?php
               }
            }
         ?>
      </div>
		<?php include_once "foot.php" ?>
   </body>
</html>
