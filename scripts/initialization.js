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
function profileInit()
{
	jQuery.ajax({
		url: "scripts/getUserReports.php",
		type: "POST",
		success:function(data){
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
function generateReport(report)
{
	html = "<div id=\"incident\"><h4>" + report.type + "</h4>"+
			"<p>Location: " + report.location + "</p><br>"+
			"<p>" + report.description + "</p>";
	if(report.description != "")
		html += "<br>";
	
	html += "<p>Posted at " + report.date + " by " + report.user + "</p><br>";
	if(report.status == 0)
	{
		html += "<p>Status: No Solution Found</p><br>";
	}
	else if(report.status == 1)
	{
		html += "<p>Status: Looking for a Solution</p><br>";
	}
	else if(report.status == 2)
	{
		html += "<p>Status: Currently Solving the Issue</p><br>";
	}
	else if(report.status == 3)
	{
		html += "<p>Status: Problem Resolved</p><br>"
	}
	html += "<a href=\"\" class=\"btn btn-default\">Edit Report</a>"+
			"<a href=\"\" class=\"btn btn-default\">Delete Report</a></div>";
	return html;
}