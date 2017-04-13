<?php
	$conn = mysqli_connect('localhost', 'root', '', 'CYPRESS');
	if (mysqli_connect_errno()) {
	    die('Connection failed');
	}

	$date_sql = "SELECT reportID, reportDate, reportDescript, reportLoc, reportType, reportVotes FROM report WHERE reportStatus = 0 ORDER BY reportDate DESC";
	$priority_sql = "SELECT reportID, reportDate, reportDescript, reportLoc, reportType, reportVotes FROM report WHERE reportStatus = 0 ORDER BY reportVotes DESC";
	$img_arr = array(
			 "Utility Failure" => "assets/utility.png",
			 "Potholes" => "assets/pothole.png",
			 "Vandalism" => "assets/graffiti.png",
			 "Eroded Streets" => "assets/road.png",
			 "Flooded Streets" => "assets/flood.png",
			 "Tree Collapse" => "assets/tree.png",
			 "Mould and Spore Growth" => "assets/mould.png",
			 "Garbage or Other Road Blocking Objects" => "assets/trash.png");

	$date_val = mysqli_query( $conn, $date_sql ); 
	$priority_val = mysqli_query( $conn, $priority_sql ); 
	if ( (!$date_val) || (!$priority_val) ) {
	  die('Could not get data: ' . mysql_error());
	}

	while($row = mysqli_fetch_assoc($priority_val)) {
		echo 
		'<tr> <div id="incident" class="priority"> <p>
		<div class="row">
			<img class="col-lg-4" src='.$img_arr[$row['reportType']].'> </img>
			<h3> <b>'.$row['reportLoc'].'</b> </h3>'
			.$row['reportDescript'].'<br>
		</div>
		<div class="row">
			Votes - '.$row['reportVotes'].'&emsp;&emsp;&emsp;Date - '.$row['reportDate'].'&emsp;
			<form action="/scripts/upvote.php" method="post" id="upvoteForm" class="col-lg-4">
				<input type="hidden" name="vote" value=1>
				<input type="hidden" name="id" value='.$row['reportID'].'>
				<button type="button" form="upvoteForm" class="btn btn-success">Upvote</button>
			</form>
			<form action="/scripts/upvote.php" method="post" id="downvoteForm" class="col-lg-4">
				<input type="hidden" name="vote" value=-1>
				<input type="hidden" name="id" value='.$row['reportID'].'>
				<button type="button" form="downvoteForm" class="btn btn-danger">Downvote</button>
			</form>
		</div>
		</p> </div> </tr> <br>';
	}
	while($row = mysqli_fetch_assoc($date_val)) {
		echo
		'<tr> <div id="incident" class="date"> <p>
		<div class="row">
			<img class="col-lg-4" src='.$img_arr[$row['reportType']].'> </img>
			<h3> <b>'.$row['reportLoc'].'</b> </h3>'
			.$row['reportDescript'].'<br>
		</div>
		<div class="row">
			Votes - '.$row['reportVotes'].'&emsp;&emsp;&emsp;Date - '.$row['reportDate'].'&emsp;
			<form action="/scripts/upvote.php" method="post" id="upvoteForm" class="col-lg-4">
				<input type="hidden" name="vote" value=1>
				<input type="hidden" name="id" value='.$row['reportID'].'>
				<button type="button" form="upvoteForm" class="btn btn-success">Upvote</button>
			</form>
			<form action="/scripts/upvote.php" method="post" id="downvoteForm" class="col-lg-4">
				<input type="hidden" name="vote" value=-1>
				<input type="hidden" name="id" value='.$row['reportID'].'>
				<button type="button" form="downvoteForm" class="btn btn-danger">Downvote</button>
			</form>
		</div>
		</p> </div> </tr> <br>';
	}

	mysqli_close($conn);
	die();
?>
