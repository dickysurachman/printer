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
	  	var pertama=setInterval(update,<?=$timer?>);
		function update() {
		  clearInterval(pertama);
		  $.ajax({
			type: 'POST',
			url: '<?=Yii::$app->homeUrl?>prog1.py',
			success: function(data) {
			  $("#servertime").append(data); 
			  var pertama=setInterval(update,<?=$timer?>);
			}
		  });
		}
	});
</script>


<span id="servertime"></span>