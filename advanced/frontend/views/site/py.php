<?php

$this->title=Yii::t('yii', 'Connection to Printer Log');
$myfile = fopen("setting.txt", "r") or die("Unable to open file!");
        // Output one line until end-of-file
        $i=0;
        $satu=[];
        $block =1024*1024;
        while(!feof($myfile)) {
            $satu[$i]=fread($myfile,$block);
            $i++;
            echo fread($myfile,$block) . "<br>";
        }
        fclose($myfile);
$dua=explode("\n", $satu[0]);
$timer=(intval($dua[2]))*1000;
?>

<script src="<?=Yii::$app->homeUrl?>/js/jquery.js"></script>
<script>
$(document).ready(function() {
		var counter = 0;
	  	var pertama=setInterval(function update() {
		  clearInterval(pertama);
		  counter++;
		  $.ajax({
			type: 'POST',
			url: '<?=Yii::$app->homeUrl?>prog1.py',
			success: function(data) {
			  $("#servertime").append(data); 
			}
		  });
		setTimeout(function() {
		        }, <?=$timer?>);
		var pertama=setInterval(update,<?=$timer?>);
		console.log(counter);
		clearInterval(pertama);
		},<?=$timer?>);
	});
</script>


<span id="servertime"></span>