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
			var reports = jQuery.parseJSON(data);
			
		},
		error:function (){}
	});
}