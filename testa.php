
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
	  update();	  
	  setInterval(update,5000);
	});
	function update() {
	  $.ajax({
		type: 'POST',
		url: 'ipc.py',
		success: function(data) {
		  $("#servertime").html(data); 
		  
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
</div> 
</body>
</html>
