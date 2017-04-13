/*
helper function for validation
This resets all the error fields so that the validation functions
can do a clean check.
*/
function clearErrorText(form)
{
	//go thorugh all the error fields (the <p> tags)
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		document.getElementById(elem.name).innerHTML = ""; //set them to blank
	}
}
/*
A helper function for the validations
This checks all the error messages within the form.
*/
function checkFields(form)
{
	//checks all the error fields
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		//if one of the field has a messsage return false
		if(document.getElementById(elem.name).innerHTML != "")
			return false;
	}
	//otherwise, everything is clear, return true
	return true;
}
/*
This function is used for the register pages to make sure that
the usernames and emails are unique

The parameter element is the field to check (ex. Username, Email)
*/
function checkAvailability(element) {
	
	var value = element.getAttribute("name");
	//send the value to the script
	jQuery.ajax({
		url: "scripts/checkAvailability.php",
		data: value + "=" + $("input[name="+value+"]").val(),
		type: "POST",
		success:function(data){
			//if there is any issues the script will return a message otherwise nothing
			$("#"+value).html(data); //the message is written in the error field
		},
		error:function (){}
	});
}
/*
This function will check the user input for a new account
*/
function registerValidation()
{
	//get the form values
	var form = document.forms["register"];
	var firstname = form["firstname"].value;
	var lastname = form["lastname"].value;
	var email = form["email"].value;
	var confirmEmail = form["email2"].value;
	var phone = form["phone"].value;
	var username = form["username"].value;
	var password = form["password"].value;
	var confirmPassword = form["password2"].value;
	
	//clear the error fields
	clearErrorText(form);
	
	//check the names
	if(firstname.match("/[^a-zA-Z]/"))
		document.getElementById("firstname").innerHTML = "Invalid first name";
	
	if(lastname.match("/[^a-zA-Z]/"))
		document.getElementById("lastname").innerHTML = "Invalid last name";
	//check the phone number
	if(!(/^\d+$/.test(phone)))
		document.getElementById("phone").innerHTML = "Invalid phone number";
	//check the emails
	if(confirmEmail != email)
		document.getElementById("email2").innerHTML = "Email no not match";
	//check the passwords
	if(confirmPassword != password)
		document.getElementById("password2").innerHTML = "Password no not match";
	//make sure all fields are not empty
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		if(elem.value == "")
			document.getElementById(form[i].name).innerHTML = "Must fill required field";
	}
	//check if there are any error messages
	return checkFields(form);
}
/*
This function will take the user input and submit it 
to the login script and check if the login info is correct
*/
function loginValidation()
{
	var form = document.forms["login"];
	var username = form["username"].value;
	var password = form["password"].value;
	//send form data to script
	jQuery.ajax({
		url: "scripts/login.php",
		data: { username: username, password: password },
		type: "POST",
		success:function(data){
			if(data < 0){
				//if info is incorrect, give user a message
				$("#error").html("Invalid username or password");
			}
			else{
				//otherwise, move the user to home page
				window.location.replace("?page=home");
			}
		},
		error:function (){}
	});
	return false;
}
/*
This function is used to validate the user info in the changeInfo page
*/
function profileValidation()
{
	//get form data
	var form = document.forms["profile"];
	var firstname = form["firstname"].value;
	var lastname = form["lastname"].value;
	var email = form["email"].value;
	var phone = form["phone"].value;
	
	//clear error messages
	clearErrorText(form);
	
	//check if the names are valid
	if(firstname.match("/[^a-zA-Z]/"))
		document.getElementById("firstname").innerHTML = "Invalid first name";
	
	if(lastname.match("/[^a-zA-Z]/"))
		document.getElementById("lastname").innerHTML = "Invalid last name";
	//check if phone number is valid
	if(!(/^\d+$/.test(phone)))
		document.getElementById("phone").innerHTML = "Invalid phone number";
	//check if any fields are empty
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		if(elem.value == "")
			document.getElementById(form[i].name).innerHTML = "Must fill required field";
	}
	//return the result, true=> no error message, else false
	return checkFields(form);
}
/*
This function is used for the changePassword page.
It checks if the fields are empty, confirms that the new passwords
are the same.
If the form successfully pass the validation it would send the data to 
a php script to change the password of the user.
*/
function passwordValidation()
{
	//get the form data
	var form = document.forms["password"];
	var currentPassword = form["cpassword"].value;
	var newPassword = form["pass"].value;
	var confirmPassword = form["pass2"].value;
	
	//clear all error messages
	clearErrorText(form);
	
	//check if the confirm password is the same as the new password
	if(confirmPassword != newPassword)
	{
		document.getElementById("p2").innerHTML = "Password no not match";
	}
	//check if there are any empty fields
	for(var i = 0; i < form.length-1; i++)
	{
		var elem = form.elements[i];
		if(elem.value == "")
			document.getElementById(form[i].name).innerHTML = "Must fill required field";
	}
	
	//if there are no error messages send the data to the script via ajax
	if(checkFields(form)){
		jQuery.ajax({
			url: "scripts/editPassword.php",
			data: {password: currentPassword, newPassword: newPassword},
			type: "POST",
			success:function(data){
				if(data < 0){
					//if the password was incorrect as user to try again.
					$("#cpassword").html("Incorrect password. Try again.");
				}
				else{
					//otherwise, refresh.
					window.location.replace("?page=changePassword");
				}
			},
			error:function (){}
		});
	}
	return false;
}
function reportValidation()
{
	var form = document.forms["report"];
	var address = form["address"].value;
	
	//clear all error messages
	document.getElementById('issue').innerHTML = "";
	document.getElementById('address').innerHTML = "";
	
	//get the issue from the radio buttons
	var radios = document.getElementsByName('issue');
	var problem = "";
	for (var i = 0 ; i < radios.length; i++) {
		if (radios[i].checked) {
			//get the checked vlaue
			var problem = radios[i].value;

			// only one radio can be logically checked, don't check the rest
			break;
		}
	}
	//if no input print error
	if(address == "")
	{
		document.getElementById('address').innerHTML = "Must fill required field";
	}
	if(problem == "")
	{
		document.getElementById('issue').innerHTML = "Please Select 1";
	}
	return (address != "" && problem != "");
}
function deleteValidation()
{
	var form = document.forms["deleteAccount"];
	var password = form["pass1"].value;
	document.getElementById('pass1').innerHTML = "";
	document.getElementById('other').innerHTML = "";
	
	var radios = document.getElementsByName('issue');
	var reason = "";
	for (var i = 0 ; i < radios.length; i++) {
		if (radios[i].checked) {
			//get the checked vlaue
			var reason = radios[i].value;

			// only one radio can be logically checked, don't check the rest
			break;
		}
	}
	
	if(password == "")
	{
		document.getElementById('pass1').innerHTML = "Must fill required field";
	}
	if(reason == "Other" && document.getElementById('otherReason').value == "")
	{
		document.getElementById('other').innerHTML = "Please indicate your reason";
	}
	else{
		reason = document.getElementById('otherReason').value;
	}
	
	if(document.getElementById('pass1').innerHTML == document.getElementById('other').innerHTML)
	{
		jQuery.ajax({
			url: "scripts/deleteAccount.php",
			data: {password : password, reason : reason},
			type: "POST",
			success:function(data){
				if(data < 0){
					//if the password was incorrect as user to try again.
					$("#pass1").html("Incorrect password. Try again.");
				}
				else{
					window.location.replace("scripts/logout.php");
				}
			},
			error:function (){}
		});
	}
	return false;
	
}