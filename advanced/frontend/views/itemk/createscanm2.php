<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Perusahaan;
$this->title="Scan Barcode USB";
$url = Yii::$app->homeUrl.'/itemk/table.html?id='.$id;
$url1 = Yii::$app->homeUrl.'/itemk/scanhitung.html?id='.$id;
$url2 = Yii::$app->homeUrl.'/itemk/target.html?id='.$id;
$urlreset = Yii::$app->homeUrl.'/itemk/reset.html?id='.$id;
$durasi=1000;
$batas=10;
$this->registerJs(
'
function resetall(){
					$.ajax({
        type: "POST",
        url: "'.$url.'",
        success: function(data) {
          $("#tableantrian").html(data);   
        }
        });
        $.ajax({
        type: "POST",
        url: "'.$url1.'",
        success: function(data) {
          $("#scan").html(data);   
        }
        });
        $.ajax({
        type: "POST",
        url: "'.$url2.'",
        success: function(data) {
          $("#target").html(data);   
        }
        });
        $("#scanlog-scan").focus();

}
				$.ajax({
        type: "POST",
        url: "'.$url.'",
        success: function(data) {
          $("#tableantrian").html(data);   
        }
        });
        $.ajax({
        type: "POST",
        url: "'.$url1.'",
        success: function(data) {
          $("#scan").html(data);   
        }
        });
        $.ajax({
        type: "POST",
        url: "'.$url2.'",
        success: function(data) {
          $("#target").html(data);   
        }
        });
$("#reset").click(function(){
        if(confirm("Are you sure you want to reset this job?")){
        $("#servertime").html("");
        $.ajax({
        type: "POST",
        url: "'.$urlreset.'",
        success: function(data) {
          console.log(data); 
        }
        });
       	resetall();
       	$("#room_type").html("");
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
					   resetall();
					},
					error: function(res){
						$("#room_type").text("Error!");					
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
    <?= $form->field($model, 'scan')->textarea(['rows' => '3']) ?>
   
    <?php ActiveForm::end(); ?>
    	
  	</div>
  	<div class="col-4">
  		<h5 id="target" style="color:blue;">Target</h5>
  		<h5 id="scan" style="color:red">Scan</h5>
  		 <?=Html::a('<span class="fas fa-print" style="font-size:10pt;" title="Print Label"></span> '.\Yii::t('yii', 'Print Label'), ['itemk/print', 'id' => $item->id], ['class'=>'btn btn-info','target'=>"_blank"])?>
  		 <button id="reset" class="btn btn-danger"><i class="fas fa-circle"></i>&nbsp;RESET</button>
  	</div>
    </div>
  	<div id="tableantrian" class="col-12">
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

<script>
  document.getElementById("scanlog-scan").focus();
</script>