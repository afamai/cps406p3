<?php
	$conn = mysqli_connect('localhost', 'root', '', 'CYPRESS');
	if (mysqli_connect_errno()) {
	    die('Connection failed');
	}

	$date_sql = "SELECT reportID, reportDate, reportDescript, reportLoc, reportStatus, reportType, reportVotes FROM report WHERE reportStatus = 0 ORDER BY reportDate DESC";
	$priority_sql = "SELECT reportID, reportDate, reportDescript, reportLoc, reportStatus, reportType, reportVotes FROM report WHERE reportStatus = 0 ORDER BY reportVotes DESC";

	$date_val = mysqli_query( $conn, $date_sql ); 
	$priority_val = mysqli_query( $conn, $priority_sql ); 
	if ( (!$date_val) || (!$priority_val) ) {
	  die('Could not get data: ' . mysql_error());
	}

	$count = 0;
	while($row = mysqli_fetch_assoc($priority_val)) {
		$reports_priority[] = array("id" => $row["reportID"], "date" => $row["reportDate"], "description" => $row["reportDescript"], 
		"location" => $row["reportLoc"], "status" => $row["reportStatus"], "type" => $row["reportType"], "votes" => $row["reportVotes"], "class" => "priority");
		$count++;
	}
	while($row = mysqli_fetch_assoc($date_val)) {
		$reports_date[] = array("id" => $row["reportID"], "date" => $row["reportDate"], "description" => $row["reportDescript"], 
		"location" => $row["reportLoc"], "status" => $row["reportStatus"], "type" => $row["reportType"], "votes" => $row["reportVotes"], "class" => "date");
	}
	if ($count > 0) {
		//$reports_date = array("reports_date" => $reports_date);
		$reports_priority = array("reports_priority" => $reports_priority);
		//echo json_encode($reports_date);
		echo json_encode($reports_priority);
	} else {
		echo -1;
	}

	mysqli_close($conn);
	die();
?>
