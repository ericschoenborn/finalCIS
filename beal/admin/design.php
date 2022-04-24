<?php
   include("../config.php");
   session_start();
	if(!isset($_SESSION['username'])){
		header("Location: admin.php");
	}
   if($_SERVER["REQUEST_METHOD"] == "POST"){
		$f=fopen('../content/header.php','w');
		fwrite($f,$_POST['header']);
		fclose($f);
		$f=fopen('../content/title.php','w');
		fwrite($f,$_POST['title']);
		fclose($f);
		$f=fopen('../content/desc.php','w');
		fwrite($f,$_POST['desc']);
		fclose($f);
		UpdateColors($_POST['content'],$_POST['background'],$_POST['banner'],$_POST['baseText'],$_POST['highlight']);
   }
	
	function UpdateColors($c1, $c2, $c3, $c4, $c5){
		$content = ":root {
   			--contentColor: $c1;
   			--backgroundColor: $c2;
   			--bannerColor: $c3;
   			--baseTextColor: $c4;
   			--highlightColor: $c5;
			}";
		$f=fopen('../content/vars.css','w');
		fwrite($f,$content);
		fclose($f);
	}
?>
<html>
   <head>
      <title>Login Page</title>
 		<link rel="stylesheet" href="../style.css"> 
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"
         integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
         crossorigin="anonymous">
		</script>
      <script type="text/javascript">
			$(document).ready(function(){
				var conCol = $("#content").css("background-color");
				$("#contentColor").val(rgb2hex(conCol));
				$("#backgroundColor").val(rgb2hex($("#body").css("background-color")));
				$("#bannerColor").val(rgb2hex($("#nav").css("background-color")));
				$("#baseColor").val(rgb2hex($("#content").css("color")));
				$("#highColor").val(rgb2hex($("#ref").css("color")));
      	});
			
			//This Code Was Lifted From : https://stackoverflow.com/questions/1740700/how-to-get-hex-color-value-rather-than-rgb-value
			function rgb2hex(rgb) {
    			rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    			function hex(x) {
        			return ("0" + parseInt(x).toString(16)).slice(-2);
    			}
    			return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
			}			
		</script>    
   </head>   
   <body id="body">
		<?php include "nav.php" ?>	
      <div class="content" id="content">
			<form method="POST" action="">
				<p>Header</p>
				<textarea cols="25" rows="3" name="header"><?php require "../content/header.php"; ?></textarea>
				<p>Title</p>
				<textarea cols="25" rows="3" name="title"><?php require "../content/title.php"; ?></textarea>
				<p>Description</p>
				<textarea cols="25" rows="3" name="desc"><?php require "../content/desc.php"; ?></textarea>
				</br>
				</br>
				<label>Content </label><input type="color" id="contentColor" name="content" value="#ff0000" /></br>
				<label>Background </label><input type="color" id="backgroundColor" name="background" value="#ff0000" /></br>
				<label>Banner </label><input type="color" id="bannerColor" name="banner" value="#ff0000" /></br>
				<label>Base Text </label><input type="color" id="baseColor" name="baseText" value="#ff0000" /></br>
				<label>Highlight </label><input type="color" id="highColor" name="highlight" value="#ff0000" /></br>
				</br>
				<input type="submit"/>
			</form>
      </div>
		<?php include_once "foot.php" ?>
   </body>
</html>        
