<?php
	$conn = mysqli_connect('localhost', 'root', '', 'CYPRESS');
	if (mysqli_connect_errno()) {
	    die('Connection failed');
	}

	$date_sql = "SELECT reportDate, reportDescript, reportLoc, reportVotes FROM report WHERE reportStatus = 0 ORDER BY reportDate DESC";
	$priority_sql = "SELECT reportDate, reportDescript, reportLoc, reportVotes FROM report WHERE reportStatus = 0 ORDER BY reportVotes DESC";
	$img_arr = array("/assets/utility.png","/assets/pothole.png","/assets/graffiti.png",
					 "/assets/road.png","/assets/flood.png","/assets/tree.png","/assets/mould.png",
					 "/assets/trash.png");

	$date_val = mysqli_query( $conn, $date_sql ); 
	$priority_val = mysqli_query( $conn, $priority_sql ); 
	if ( (!$date_val) || (!$priority_val) ) {
	  die('Could not get data: ' . mysql_error());
	}

	while($row = mysqli_fetch_assoc($priority_val)) {
		echo 
		'<tr> <div id="incident" class="date"> <p>
		<img src='.$img_arr[$row['reportType']].'> </img>
		<h3> <b>'.$row['reportLoc'].'</b> </h3> <br>'
		.$row['reportDescript'].'<br>
		Votes - '.$row['reportVotes'].'<br>
		<form action="/scripts/upvote.php" method="post" id="upvoteForm">
			<input type="hidden" name="vote" value=1>
			<input type="hidden" name="id" value='.$row['reportId'].'>
			<button type="button" form="upvoteForm" class="btn btn-success">Upvote</button>
		</form>
		<form action="/scripts/upvote.php" method="post" id="downvoteForm">
			<input type="hidden" name="vote" value=-1>
			<input type="hidden" name="id" value='.$row['reportId'].'>
			<button type="button" form="downvoteForm" class="btn btn-danger">Downvote</button>
		</form> </p> </div> </tr> <br>';
	}
	while($row = mysqli_fetch_assoc($date_val)) {
		echo
		'<tr> <div id="incident" class="date"> <p>
		<img src='.$img_arr[$row['reportType']].'> </img>
		<h3> <b>'.$row['reportLoc'].'</b> </h3> <br>'
		.$row['reportDescript'].'<br>
		Votes - '.$row['reportVotes'].'<br>
		<form action="/scripts/upvote.php" method="post" id="upvoteForm">
			<input type="hidden" name="vote" value=1>
			<input type="hidden" name="id" value='.$row['reportId'].'>
			<button type="button" form="upvoteForm" class="btn btn-success">Upvote</button>
		</form>
		<form action="/scripts/upvote.php" method="post" id="downvoteForm">
			<input type="hidden" name="vote" value=-1>
			<input type="hidden" name="id" value='.$row['reportId'].'>
			<button type="button" form="downvoteForm" class="btn btn-danger">Downvote</button>
		</form> </p> </div> </tr> <br>';
	}

	mysqli_close($conn);
	die();
?>
