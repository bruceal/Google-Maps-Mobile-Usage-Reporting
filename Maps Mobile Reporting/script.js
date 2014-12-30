function getUsage(){
	var app = document.getElementById('app');
	var start = document.getElementById('start');
	var end = document.getElementById('end');
	//Add the path to the get_usage.php file
	var Path = "";
	window.location.href=Path'/get_usage.php?app='+app.value + '&start='+start.value+'&end='+end.value;
}
