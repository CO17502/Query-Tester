function makevisible() {
  var checked1 = document.getElementById('database_world').checked;
  if(checked1 == true)
  {
   document.getElementById('legend_world').style.display = "block";
   document.getElementById('username').value = "traveller";
   document.getElementById('password').value = "packmybags";
   var strTest=document.getElementById('database_world').value;
   document.cookie = "value=strTest";
  }
  else
   document.getElementById('legend_world').style.display = "none";

  var checked2 = document.getElementById('database_simpsons').checked;
  if(checked2 == true)
  {
   document.getElementById('legend_simpsons').style.display = "block";
   document.getElementById('username').value = "homer";
   document.getElementById('password').value = "d0ughnut";
   var strTest1=document.getElementById('database_simpsons').value;
   document.cookie = "value=strTest1";
  }
  else
   document.getElementById('legend_simpsons').style.display = "none";

  var checked3 = document.getElementById('database_imdb_small').checked;
  if(checked3 == true)
  {
   	document.getElementById('legend_imdb_small').style.display = "block";
   	document.getElementById('username').value = "siskel";
   	document.getElementById('password').value = "2thumbsup";
   	var strTest2=document.getElementById('database_imdb_small').value;
   	document.cookie = "value=strTest2";
  }
  else
   	document.getElementById('legend_imdb_small').style.display = "none";

  if(document.getElementById('database_other').checked == true)
  {
   	document.getElementById('username').value = "";
   	document.getElementById('password').value = "";
   	var strTest3=document.getElementById('database_other').value;
   	document.cookie = "value=strTest3";
  }
}

// function to get cookies and thier value
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
		while (c.charAt(0) == ' ') {
		c = c.substring(1);
	}
	if (c.indexOf(name) == 0) {
		return c.substring(name.length, c.length);
	}
}
return "";
}

// function to reload the page and maintain some selected properties.
function reload(){
	var x = document.cookie;
	var y = getCookie("value");
	console.log(y);
	if('strTest' == y)
	{document.getElementById('database_world').checked = true;
	makevisible();
	}
	if ('strTest1' == y) {
		document.getElementById('database_simpsons').checked = true;
		console.log("true1");
		makevisible();
	}
	if ('strTest2' == y) {
		document.getElementById('database_imdb_small').checked = true;
		makevisible();
	}
	if ('strTest3' == y) {
		document.getElementById('database_other').checked = true;
		makevisible();
	}
}
