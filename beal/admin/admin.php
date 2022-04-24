<?php
   include("../config.php");
   session_start();
	$type="login"; 
   if($_SERVER["REQUEST_METHOD"] == "POST") {
		if($_POST['action'] != "login"){
         if(isset($_POST['logout'])){
         	if(session_destroy()){
            	header("Location: admin.php");
         	}else{
            	echo "still here";
         	}
			}
      }else{
			$error = LogInUser();
		}
   }

	function LogInUser(){
		GLOBAL $db;
		$username = $_POST['username'];
      $password = $_POST['password']; 
      
      $sql = "SELECT id FROM admin WHERE username = '$username' and password = '$password';";
		$result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);

      if($count > 0) {
 			$_SESSION['admin'] = $username; 
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
      	<?php if(isset($_SESSION['admin'])){ ?>
            <div>you are logged in as <?= $_SESSION['admin'] ?></div>
				<form method="post" action="admin.php">
               <input type="hidden" name="logout" value=true />
               <input type="submit" value="Log Out">
         	</form>
         <?php
            }else{
               if($type == "login" || $type == "back"){
         ?>
				<h1><b>Login</b></h1>
            <form action = "" method = "post">
               <label>UserName </label><input type = "text" name = "username" /><br /><br />
 <label>Password </label><input type = "password" name = "password" /><br/><br />
               <button name="action" type="submit" value="login">LogIn</button><br />
            </form>

            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
          <?php
               }
            }
         ?>
      </div>
		<?php include_once "foot.php" ?>
   </body>
</html>        
