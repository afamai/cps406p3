function registerValidation()
{
	var form = document.forms["register"];
	var firstname = form["firstname"].value;
	var lastname = form["lastname"].value;
	var email = form["email"].value;
	var confirmEmail = form["email2"].value;
	var phone = form["phone"].value;
	var username = form["username"].value;
	var password = form["password"].value;
	var confirmPassword = form["password2"].value;
	
	clearErrorText(form);
	
	
	if(firstname.match("/[^a-zA-Z]/"))
		document.getElementById("firstname").innerHTML = "Invalid first name";
	
	if(lastname.match("/[^a-zA-Z]/"))
		document.getElementById("lastname").innerHTML = "Invalid last name";
	
	if(!(/^\d+$/.test(phone)))
		document.getElementById("phone").innerHTML = "Invalid phone number";
	
	if(confirmEmail != email)
		document.getElementById("email2").innerHTML = "Email no not match";
	
	if(confirmPassword != password)
		document.getElementById("password2").innerHTML = "Password no not match";
	
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		if(elem.value == "")
			document.getElementById(form[i].name).innerHTML = "Must fill required field";
	}
	
	return checkFields(form);
}
function clearErrorText(form)
{
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		document.getElementById(elem.name).innerHTML = "";
	}
}
function checkFields(form)
{
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		if(document.getElementById(elem.name).innerHTML != "")
			return false;
	}
	return true;
}
function checkAvailability(element) {
	var value = element.getAttribute("name");
	jQuery.ajax({
		url: "scripts/checkAvailability.php",
		data: value + "=" + $("input[name="+value+"]").val(),
		type: "POST",
		success:function(data){
			$("#"+value).html(data);
		},
		error:function (){}
	});
}
function loginValidation()
{
	var form = document.forms["login"];
	var username = form["username"].value;
	var password = form["password"].value;
	jQuery.ajax({
		url: "scripts/login.php",
		data: { username: username, password: password },
		type: "POST",
		success:function(data){
			if(data < 0){
				$("#error").html("Invalid username or password");
			}
			else{
				window.location.replace("?page=home");
			}
		},
		error:function (){}
	});
	return false;
}
function profileValidation()
{
	var form = document.forms["profile"];
	var firstname = form["firstname"].value;
	var lastname = form["lastname"].value;
	var email = form["email"].value;
	var phone = form["phone"].value;
	
	clearErrorText(form);
	
	if(firstname.match("/[^a-zA-Z]/"))
		document.getElementById("firstname").innerHTML = "Invalid first name";
	
	if(lastname.match("/[^a-zA-Z]/"))
		document.getElementById("lastname").innerHTML = "Invalid last name";
	
	if(!(/^\d+$/.test(phone)))
		document.getElementById("phone").innerHTML = "Invalid phone number";
	
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		if(elem.value == "")
			document.getElementById(form[i].name).innerHTML = "Must fill required field";
	}
	return checkFields(form);
}
function passwordValidation()
{
	var form = document.forms["password"];
	var currentPassword = form["cpassword"].value;
	var newPassword = form["pass"].value;
	var confirmPassword = form["pass2"].value;
	clearErrorText(form);
	if(confirmPassword != newPassword)
	{
		document.getElementById("p2").innerHTML = "Password no not match";
	}
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		if(elem.value == "")
			document.getElementById(form[i].name).innerHTML = "Must fill required field";
	}
	if(checkFields(form)){
		jQuery.ajax({
			url: "scripts/editPassword.php",
			data: {password: currentPassword, newPassword: newPassword},
			type: "POST",
			success:function(data){
				if(data < 0){
					$("#cpassword").html("Incorrect password. Try again.");
				}
				else{
					window.location.replace("?page=changePassword");
				}
			},
			error:function (){}
		});
	}
	return false;
}