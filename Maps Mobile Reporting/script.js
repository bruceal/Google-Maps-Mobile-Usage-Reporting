function getUsage(){
	var app = document.getElementById('app');
	var start = document.getElementById('start');
	var end = document.getElementById('end');

	window.location.href='http://quickaccess.orgfree.com/getUsage.php?app='+app.value + '&start='+start.value+'&end='+end.value;
}
