
function proc_submit()
{
	if(!is_valid_spsu_email(document.getElementById('email').value))
		alert("Invalid Email");
}

function is_valid_spsu_email(email)
{ 	
	var n = email.split("@");
	
	if(n.length != 2)
		return false;
		
	if(n[1] != "spsu.edu")
		return false;
		
	return true;
}