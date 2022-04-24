<?php
	session_start();
	if($_SESSION['loggedIn'] != "true"){
		$_SESSION['loggedIn'] = "false";
	}
		
	$cookie_name = "displayMode";
	if(!isset($_COOKIE[$cookie_name])){
		setcookie("displayMode", "light", time() + (86400 *30), "/");
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
  		$mode = $_POST['mode']; 		
		setcookie("displayMode", $mode, time() + (86400 *30), "/");
		$_COOKIE[$cookie_name] = $mode;
	}
?>
<!DOCKTYPE html>
<html>
	<head>
      <link rel="stylesheet" href="style.css">
   </head>
   <body>
      <nav class="top">
			<a href="home.php" class="ank">Home</a>
			<?php if($_SESSION['loggedIn'] == "true"){
         		echo("<a href='pref.php' class='ank'>Preferances</a>");
				}
			?>		
         <a href="login.php" class="ank">login</a>
      </nav>
		<?php if($_SESSION['loggedIn'] == "true"){ ?>
      <div class="<?= "content $_COOKIE[$cookie_name] "?>">
			<h1>preferance</h1>
			<p><?= "displaymode:  $_COOKIE[$cookie_name]" ?></p>
			<form method="post" action="pref.php">
					Mode: <input type="radio" name="mode" value="dark"> <input type="radio" name="mode" value="light" checked=true>
					</br> 
  					<input type="submit">
				</form>
      </div>
		<?php }else{ ?>
		<p> you are not logged in. please log in</p>
		<?php } ?>
      <footer class="footer">foot</footer>
   </body>
<body>
</html>

