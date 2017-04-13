<?php
	$dbhost = 'localhost:3036';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, "CYPRESS");
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$date_sql = "SELECT reportDate, reportDescript, reportLoc, reportVotes FROM report WHERE reportStatus = 0 ORDER BY reportDate DESC";
	$priority_sql = "SELECT reportDate, reportDescript, reportLoc, reportVotes FROM report WHERE reportStatus = 0 ORDER BY reportVotes DESC";
	$img_arr = array("/assets/utility.png","/assets/pothole.png","/assets/graffiti.png",
					 "/assets/road.png","/assets/flood.png","/assets/tree.png","/assets/mould.png",
					 "/assets/trash.png");

	$date_val = mysql_query( $date_sql, $conn ); 
	$priority_val = mysql_query( $priority_sql, $conn ); 
	if ( (!$date_val) || (!$priority_val) ) {
	  die('Could not get data: ' . mysql_error());
	}

	$str = 		
		'<img src='.$img_arr[$row['reportType']].'> </img>
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
		</form> </p> </div> </tr> <br>'
	while ($row = mysql_fetch_array($date_val, MYSQL_ASSOC)) {
		echo '<tr> <div id="incident" class="date"> <p>';
	    echo $str;
	}
	while ($row = mysql_fetch_array($priority_val, MYSQL_ASSOC)) {
		echo '<tr> <div id="incident" class="priority"> <p>';
	    echo $str;
	}

	mysqli_close($conn);
	die();
?>