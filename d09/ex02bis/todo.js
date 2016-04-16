function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+";";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function	destroy(time){
	$('#' + time).remove();	
	createCookie('div', $('#ft_list').html(), 365);
}

function	add_todo(){

	var	todo = prompt("Describe your todo !", "My Awesome ToDo")
		if (todo != "")
		{
			var	date = new Date();
			var	time = date.getTime();
			$('#ft_list').prepend('<div id="' + time + '" onclick="destroy(' + time +')"><p>'+ todo +'</p></div>');
			createCookie('div', $('#ft_list').html(), 365);
		}
}

$('#ft_list').append(readCookie('div'));
