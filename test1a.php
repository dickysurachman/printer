
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Bootstrap core CSS -->
<script src="js/jquery.js"></script>
<script>
$(document).ready(function() {
	let statusx = false;
	let status = false;
	$("#setar").click(function(){
		status=setInterval(update,2000);
		statusx=true;
		$('#recum').removeAttr('disabled');
	});
	$("#setop").click(function(){
		statusx=false;
		$("#recum").attr('disabled','disabled');
		$('#recum').text("PAUSE");
		clearInterval(status);
		$("#servertime").html(''); 
	});
	$("#reset").click(function(){
		$("#servertime").html(''); 
	});
	$("#recum").click(function(){
		var title=$("#recum").text();
		if (statusx === false) {
        status = setInterval(update,2000);
        statusx=true;
    	} else {
        statusx=false;
    		clearInterval(status);
    	}
		if(title=="RESUME") {
			$('#recum').text("PAUSE");
		} else {
			$('#recum').text("RESUME");

		}
	});
	});
	function update() {
	  $.ajax({
		type: 'POST',
		url: 'ipc.py',
		success: function(data) {
		  $("#servertime").append(data); 
		  
		}
	  });
	}
</script>

</head>
<body>

<div class="container">
   
	<center>
	<h2>
	<h2><span id="servertime"></span></h2>
	<span id="clock"></span></h2>
	</center>

	<button id="setar">START</button>
	<button id="setop">STOP</button>
	<button id="reset">RESET</button>
	<button id="recum" disabled>PAUSE</button>
</div> 
</body>
</html>
