<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Perusahaan;
$this->title="Scan Barcode USB";

/*$timerr=Perusahaan::findOne(['id'=>Yii::$app->user->identity->id_perusahaan]);
$batas=11;
if(isset($timerr)){
	$durasi =$timerr->timer1;
	$batas=$timerr->batas - 1;
} else {
	$durasi=5000;
}*/
$durasi=5000;
$batas=10;
$this->registerJs(
'
var formURL = $("#formSubmit").attr("action");
setInterval(cekdata,'.$durasi.');
function cekdata(){
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
			 kirim();
		  }
	}
};
function kirim(){
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
					   $("#scanlog-scan").val("");
					   $("#scanlog-scan").focus();
					},
					error: function(res){
						$("#scanlog-scan").text("Error!");
						
					}
                });
};
$("#formSubmit").on("submit",function(e){
        var formData = new FormData(this);
        var formURL = $("#formSubmit").attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : formData,
            contentType: false,
            processData: false,
            success: function(res){
               $("#scanlog-scan").val("");
               $("#scanlog-scan").focus();
            },
            error: function(res){
                $("#scanlog-scan").text("Error!");
                
            }
        });
        e.preventDefault();
       
    });'
);
?>
<div class="scan-create">

<?php

/* @var $this yii\web\View */
/* @var $model app\models\Scan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scan-form">

    <?php $form = ActiveForm::begin(['id'=>'formSubmit']); ?>

     <?= $form->field($model, 'scan')->textarea(['rows' => '10']) ?>
   
		
    

    <?php ActiveForm::end(); ?>
    <div id="room_type" class="alert-success alert">Notifikasi</div>
</div>
</div>
<script>
  document.getElementById("scanlog-scan").focus();
</script>