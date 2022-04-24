<nav class="top">
         <a href="home.php" class="ank">Home</a>
			<?php if(!isset($_SESSION['username'])){ ?>
         	<a href="login.php" class="ank">login</a>
			<?php }else{ ?>
         	<a href='user.php' class='ank'>User</a>
			<?php } ?>	
      </nav>
