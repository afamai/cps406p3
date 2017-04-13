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
function editReportInit()
{
	if(getCookie("id") != "")
	{
		var form = document.forms["report"];
		var radios = document.getElementsByName('issue');
		var type = getCookie("type");
		for (var i = 0 ; i < radios.length; i++) {
			if (type == radios[i].value) {
				radios[i].checked = true;
				break;
			}
		}
		form["address"].value = getCookie("address");
		form["description"].value = getCookie("description");
		form["id"].value = getCookie("id");
	}	
}
function deleteCookies()
{
	document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "description=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
function getCookie(name)
{
	var decodedCookie = decodeURIComponent(document.cookie);
    var values = decodedCookie.split(';');
	for(var i = 0 ; i < values.length; i++)
	{
		var str = values[i];
		while (str.charAt(0) == ' ') {
            str = str.substring(1);
        }
        if (str.indexOf(name) == 0) {
            return str.substring(name.length+1, str.length);
        }
	}
	return "";
}
function generateReport(report)
{
	html = "<div id=\"incident\"><div class=\"row\"><div class=\"col-sm-2 vote\">"+
			
			"<img class=\"vote-icon\" onclick=\"upvote(this, " + report.id + ")\" src=\"assets/voteup.png\"></img><br>"+
			"<div>"+report.votes+"</div>"+
			"<img class=\"vote-icon\" onclick=\"downvote(this, "+ report.id +")\" src=\"assets/votedown.png\"></img></div>";
	html += "<div class=\"col-sm-10\"><h4>" + report.type + "</h4>"+
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
	
	html += "<a onclick=\"editReport(" + report.id + ",'" + report.type + "','" + report.location +"','"+ report.description +"')\" class=\"btn btn-default\">Edit Report</a>";
	html += "<a onclick=\"deleteReport("+ report.id + ")\" class=\"btn btn-default\">Delete Report</a></div></div></div>";
	return html;
}
function editReport(id, type, location, description)
{
	document.cookie = "id=" + id + ";";
	document.cookie = "type=" + type +";";
	document.cookie = "address=" + location +";";
	document.cookie = "description=" + description +";";
	
	var date = new Date();
	var exdays = 7;
	date.setTime(date.getTime() + exdays*24*60*60*1000);
	document.cookie = "expires=" + date.toUTCString();
	window.location.replace("?page=editReport");
}
function deleteReport(id)
{
	if(window.confirm("Are you sure?"))
	{
		jQuery.ajax({
			url: "scripts/deleteReport.php",
			type: "POST",
			data: "id=" + id,
			success:function(data){
				window.location.reload();
			},
			error:function (){}
		});
	}
}
function upvote(elem, id)
{
	if(elem.src != "http://cypress/assets/upvote.png")
	{
		jQuery.ajax({
			url: "scripts/upvote.php",
			type: "GET",
			data: {id : id, vote : 1 },
			success:function(data){
				window.location.reload();
			},
			error:function (){}
		});
	}
}
function downvote(elem, id)
{
	if(elem.src != "http://cypress/assets/downvote.png")
	{
		jQuery.ajax({
			url: "scripts/upvote.php",
			type: "GET",
			data: {id : id, vote : -1 },
			success:function(data){
				window.location.reload();
			},
			error:function (){}
		});
	}
}