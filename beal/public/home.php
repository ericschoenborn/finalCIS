<?php
	session_start();
	if($_SESSION['loggedIn'] != "true"){
		$_SESSION['loggedIn'] = "false";
	}

	$cookie_name = "displayMode";	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$_SESSION['loggedIn'] = "false";
	}
?>

<!DOCTYPE html>
<html>
	<head>
      <link rel="stylesheet" href="../style.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"
         integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
         crossorigin="anonymous">
		</script>
      <script type="text/javascript">
			var background = null;
			$(document).ready(function(){
				background =  document.getElementById("background");
      	});

			var i = 1;
			var images = ["./images/under1.jpg","./images/under2.jpg"];
			setInterval(function() {
				//alert("yo");
      		background.style.backgroundImage = "url(" + images[i] + ")";
      		i++;
      		if (i == images.length) {
        			i =  0;
      		}
			}, 10000);
		</script>
   </head>
   <body>
		<?php require "nav.php" ?>
		<div id="background" class="background">
      	<div class="content">
				<h1><?php require "../content/header.php" ?></h1>
				<h3><?php require "../content/title.php" ?></h3>
				<p><?php require "../content/desc.php" ?></p>
      	</div>
		</div>
		<?php include_once "foot.php" ?>
   </body>
</html>
