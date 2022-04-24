<nav class="top" id="nav">
         <a href="admin.php" class="ank">Home</a>
			<?php if(isset($_SESSION['username'])){ ?>
         	<a href="users.php" class="ank" id="ref">Users</a>
				<a href="design.php" class="ank">Design</a>
			<?php } ?>	
      </nav>
