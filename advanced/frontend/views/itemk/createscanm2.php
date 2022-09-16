<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Perusahaan;
$this->title="Scan Barcode USB";
$url = Yii::$app->homeUrl.'/itemk/table.html?id='.$id;

$durasi=1000;
$batas=10;
$this->registerJs(
'
$.ajax({
        type: "POST",
        url: "'.$url.'",
        success: function(data) {
          $("#tableantrian").html(data);   
        }
        });
var formURL = $("#formSubmit").attr("action");
var pertama=setInterval(
function cekdata(){ 
	clearInterval(pertama);
	var msg=$("#scanlog-scan").val();	
	if((msg.length>'.$batas.')){
        var check =0;
		var hit=0;
		$.each(msg.split("\n"), function(e, element) {
			hit=hit+1;
			if((element.length==0)) {
				check=1;
			} else {
				check=0;				
			}
          });
		  if((check==1)&&(hit>1)){
			 var formData = new FormData();
			 var message = $("#scanlog-scan").val();
			 formData.append( "Inputan[barcode]", message);
             $.ajax({
					url : formURL,
					type: "POST",
					data : formData,
					contentType: false,
					processData: false,
					success: function(res){
						$("#room_type").html(res);
					   $("#scanlog-scan").val("");
					   $("#scanlog-scan").focus();
					},
					error: function(res){
						$("#room_type").text("Error!");					
					}
                });
        $.ajax({
        type: "POST",
        url: "'.$url.'",
        success: function(data) {
          $("#tableantrian").html(data);   
        }
        });
            setTimeout(function(){}, '.$durasi.');
			var pertama=setInterval(cekdata,'.$durasi.');
			clearInterval(pertama);
			}
	}},'.$durasi.');'
);
?>
<div class="scan-create">

<?php

/* @var $this yii\web\View */
/* @var $model app\models\Scan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scan-form">

   
   
		
    <div class="row">
    <div class="col-8">
    <?php $form = ActiveForm::begin(['id'=>'formSubmit']); ?>
    <?= $form->field($model, 'scan')->textarea(['rows' => '10']) ?>
   
    <?php ActiveForm::end(); ?>
    	
  	</div>
  	<div id="tableantrian" class="col-4">
  		<table class="table table-hover table-striped">
  			<thead class="thead-dark">
  				<th>NIE</th>
  				<th>LOT</th>
  				<th>S/N Item</th>
  			</thead>
  		</table>
  	</div>
    </div>

    <div id="room_type" class="alert-success alert">Notifikasi</div>
</div>
</div>
<script>
  document.getElementById("scanlog-scan").focus();
</script>