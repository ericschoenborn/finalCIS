<?php
	include("../config.php");
	session_start();
	$updated = false;
	if(!isset($_SESSION['username'])){
		header("location: welcome.php");
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['logout'])){
  			if(session_destroy()){
      		header("Location: home.php");
   		}else{
				echo "still here";
			}
		}else if(isset($_POST['phone'])){
			$phone = $_POST['phone'];
			UpdatePhone($phone);
			$updated = true;
			$date = date('m/d/Y H:i:s', time());
		}
	}
	$sql = "SELECT username, password, phone FROM users WHERE username = '{$_SESSION['username']}';";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $username = $row['username'];
	$phone = $row['phone'];
      
   $count = mysqli_num_rows($result);

	function UpdatePhone($newPhone){
      GLOBAL $db;

      $user = $_SESSION['username'];
      $sql = "Update users SET phone = '$newPhone' WHERE username = '$user';";
      $result = mysqli_query($db,$sql);
   }

?>
<!DOCKTYPE html>
<html>
	<head>
      <link rel="stylesheet" href="../style.css">
   </head>
   <body>
		<?php include "nav.php" ?>
		<div class="content">
			<h1>User Info</h1>
			<?php if($updated){?>
            <p>Phone number last updated <?php echo $date; ?></p>
         <?php } ?>
			<form method="post" action="user.php">
				<label>Phone Number</label><input type="text" name="phone" value=<?= $phone ?> />
				<input type="submit" value="Update">
			</form>
			<form method="post" action="user.php">
					<input type="hidden" name="logout" value=true />
  					<input type="submit" value="Log Out">
			</form>
		</div>
      <?php include_once "foot.php" ?>
   </body>
<body>
</html>

