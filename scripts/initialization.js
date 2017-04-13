function profileChangeInit()
{
	
	jQuery.ajax({
		url: "scripts/getProfile.php",
		type: "POST",
		success:function(data){
			var profile = jQuery.parseJSON(data);
			var form = document.forms["profile"];
			form["firstname"].value = profile.firstname;
			form["lastname"].value = profile.lastname;
			form["phone"].value = profile.phone;
			form["email"].value = profile.email;
			
		},
		error:function (){}
	});
}

function homeInit()
{
	jQuery.ajax({
		url: "scripts/homeReport.php",
		type: "POST",
		success:function(data){
			if(data == -1)
				document.getElementById("message").innerHTML = "No Submissions";
			var obj = jQuery.parseJSON(data);
			var table = document.getElementById("reports");
			// for(var i = 0; i < Object.keys(obj.reports_date).length; i++)
			// {
			// 	var report = obj.reports_date[i];
			// 	var row = table.insertRow(i);
			// 	var col = row.insertCell(0);
				
			// 	col.innerHTML = generateHomeReport(report);
			// }
			for(var j = 0; j < Object.keys(obj.reports_priority).length; j++)
			{
				var report = obj.reports_priority[j];
				var row = table.insertRow(j);
				var col = row.insertCell(0);
				
				col.innerHTML = generateHomeReport(report);
			}
		},
		error:function (){}
	});
}
function profileInit()
{
	jQuery.ajax({
		url: "scripts/getUserReports.php",
		type: "POST",
		success:function(data){
			if(data == -1)
				document.getElementById("message").innerHTML = "No Submissions";
			var obj = jQuery.parseJSON(data);
			var table = document.getElementById("reports");
			for(var i = 0; i < Object.keys(obj.reports).length; i++)
			{
				var report = obj.reports[i];
				var row = table.insertRow(i);
				var col = row.insertCell(0);
				
				col.innerHTML = generateReport(report);
			}
			
		},
		error:function (){}
	});
}
function getImg(str) 
{
	if (str == "Utility Failure") { return "assets/utility.png"; }
	else if (str == "Potholes") { return "assets/pothole.png"; }
	else if (str == "Vandalism") { return "assets/graffiti.png"; }
	else if (str == "Eroded Streets") { return "assets/road.png"; }
	else if (str == "Flooded Streets") { return "assets/flood.png"; }
	else if (str == "Tree Collapse") { return "assets/tree.png"; }
	else if (str == "Mould and Spore Growth") { return "assets/mould.png"; }
	else if (str == "Garbage or Other Road Blocking Objects") { return "assets/trash.png"; }
	return "";	
}
function generateHomeReport(report)
{
	html = "<div id=\"incident\" " + report.class + "><div class=\"row\"><div class=\"col-sm-2 vote\">"+
			"<img class=\"vote-icon\" src=\"assets/voteup.png\"></img><br>"+
			"<div>"+report.votes+"</div>"+
			"<img class=\"vote-icon\" src=\"assets/votedown.png\"></img></div>";
	html += "<div class=\"col-sm-8\"><h4>" + report.type + "</h4>"+
			"<p>Location: " + report.location + "</p><br>"+
			"<p>" + report.description + "</p>";
	if(report.description != "")
		html += "<br>";
	
	html += "<p>Posted at " + report.date + " by " + report.user + "</p><br>";
	if(report.status == 0)
	{
		html += "<p>Status: Looking for a Solution</p><br>";
	}
	else if(report.status == 1)
	{
		html += "<p>Status: Currently Solving the Issue</p><br>";
	}
	else if(report.status == 2)
	{
		html += "<p>Status: Problem Resolved</p><br>"
	}
	else if(report.status == 4)
	{
		html += "<p>Status: No Solution Found</p><br>";
	}
	html += "</div><div class=\"col-sm-2\"><img src=\" " + getImg(report.type) + " \"></img></div>"; 
	html += "</div></div>";
	return html;
}
function generateReport(report)
{
	html = "<div id=\"incident\"><div class=\"row\"><div class=\"col-sm-2 vote\">"+
			"<img class=\"vote-icon\" src=\"assets/voteup.png\"></img><br>"+
			"<div>"+report.votes+"</div>"+
			"<img class=\"vote-icon\" src=\"assets/votedown.png\"></img></div>";
	html += "<div class=\"col-sm-8\"><h4>" + report.type + "</h4>"+
			"<p>Location: " + report.location + "</p><br>"+
			"<p>" + report.description + "</p>";
	if(report.description != "")
		html += "<br>";
	
	html += "<p>Posted at " + report.date + " by " + report.user + "</p><br>";
	if(report.status == 0)
	{
		html += "<p>Status: Looking for a Solution</p><br>";
	}
	else if(report.status == 1)
	{
		html += "<p>Status: Currently Solving the Issue</p><br>";
	}
	else if(report.status == 2)
	{
		html += "<p>Status: Problem Resolved</p><br>"
	}
	else if(report.status == 4)
	{
		html += "<p>Status: No Solution Found</p><br>";
	}
	html += "</div><div class=\"col-sm-2\"><img src=\" " + getImg(report.type) + " \"></img></div>"; 
	html += "</div></div>";
	return html;
}
