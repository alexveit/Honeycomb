
function is_valid_spsu_email(email)
{ 	
	var n = email.split("@");
	
	if(n.length != 2)
		return false;
		
	if(n[1] != "spsu.edu")
		return false;
		
	return true;
}

function isWhitespaceNotEmpty(text)
{
	return ((text.length > 0 && !/[^\s]/.test(text)) || text==null || text=="");
}

function has_selection()
{
	
	return true;
}

function validateForm()
{
	if(isWhitespaceNotEmpty(document.getElementById('fname').value))
	{
		alert("Input First Name");
		document.getElementById('fname').focus();
		return false;
	}
	
	if(isWhitespaceNotEmpty(document.getElementById('lname').value))
	{
		alert("Input Last Name");
		document.getElementById('lname').focus();
		return false;
	}
	
	if(isWhitespaceNotEmpty(document.getElementById('email').value))
	{
		alert("Input Email");
		document.getElementById('email').focus();
		return false;
	}
	
	/*if(!is_valid_spsu_email(document.getElementById('email').value))
	{
		alert("Invalid Email\nMust be @spsu.edu email");
		document.getElementById('email').focus();
		return false;
	}*/
	
	if(isWhitespaceNotEmpty(document.getElementById('pass').value))
	{
		alert("Input Password");
		document.getElementById('pass').focus();
		return false;
	}
	
	return true;
}

function validateLogin()
{
	if(isWhitespaceNotEmpty(document.getElementById('username').value))
	{
		alert("Input Email");
		document.getElementById('username').focus();
		return false;
	}
	
	/*if(!is_valid_spsu_email(document.getElementById('username').value))
	{
		alert("Invalid Email\nMust be @spsu.edu email");
		document.getElementById('username').focus();
		return false;
	}*/
	
	if(isWhitespaceNotEmpty(document.getElementById('password').value))
	{
		alert("Input Password");
		document.getElementById('password').focus();
		return false;
	}
	
	return true;
}
