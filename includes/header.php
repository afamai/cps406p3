<header>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand title" href="?page=home">CYPRESS</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="?page=home">Home</a></li>
				<li><a href="?page=profile">My Profile</a></li>
				<li><a href="?page=report">My Reports</a></li>
				<li><a href="?page=contacts">Contacts</a></li>
				<li><a href="?page=FAQ">FAQ</a></li>
				<li><a href="?page=invite">Invite a Friend</a></li>
			</ul>
			<?php
				if(!isset($_SESSION["username"]))
				{
					echo
					'<ul class="nav navbar-nav navbar-right">
						<li><a href="?page=register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li><a href="?page=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					</ul>';
				}
				else
				{
					echo
					'<ul class="nav navbar-nav navbar-right">
						<li><a href="scripts/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Up</a></li>
					</ul>';
				}
			
			?>
		</div>
	</nav>
</header>