<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes/head.html'; ?>
  </head>
  <body>
    <div id="horizontal-scroll">
    <div class="container"><b>
      <header>
        <?php include 'includes/header.php'; ?>
      </header>
	  <div class="row">
			<div class="col-sm-3">
				<?php include 'includes/profileSidebar.html'?>
			</div>
			<div class="col-sm-8">
				<?php include "views/$content" ?>
			</div>
	  </div>
    </div>
  </body>
</html>