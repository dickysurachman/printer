<?php

use yii\helpers\Html;
use app\models\Itemcamera;
use app\models\Scanlog;
use yii\widgets\ActiveForm;
use Da\QrCode\QrCode;
use yii\widgets\DetailView;
$timerr=1000;
$this->title="Monitoring Camera Input";
$cc=Scanlog::findOne(['status'=>0]);
if(isset($cc)){
    $item=$cc->scan;
    $data=explode("(", $item);
    if(count($data)==6){
        $dat1=explode(")",$data[1]);
        $var1=$dat1[1];
        $dat1=explode(")",$data[2]);
        $var2=$dat1[1];
        $dat1=explode(")",$data[3]);
        $var3=$dat1[1];
        $dat1=explode(")",$data[4]);
        $var4=$dat1[1];
        $dat1=explode(")",$data[5]);
        $var5=$dat1[1];
        $simpan= new Itemcamera();
        $simpan->var_1=$var1;
        $simpan->var_2=$var2;
        $simpan->var_3=$var3;
        $simpan->var_4=$var4;
        $simpan->var_5=$var5;
        $simpan->save();
    }
    $cc->status=1;
    $cc->save();
}


?>
<div class="scan-create">

<?php

/* @var $this yii\web\View */
/* @var $model app\models\Scan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scan-form">
    
    <div class="row">
        <div class="col-5">
            <?php 
            $model=Itemcamera::find()->limit(1)->orderBy(['id'=>'SORT_DESC'])->One();
            if($model){
            $gabung ="(90)".$model->var_1."(01)".$model->var_2."(10)".$model->var_3."(17)".$model->var_4."(21)".$model->var_5;
            $qrCode = (new QrCode($gabung))
                ->setSize(170)
                ->setMargin(5)
                //->useForegroundColor(51, 153, 255);
                ->useForegroundColor(13, 13, 13);

            // now we can display the qrcode in many ways
            // saving the result to a file:

            $qrCode->writeFile('code.png'); // writer defaults to PNG when none is specified

            // display directly to the browser 
            header('Content-Type: '.$qrCode->getContentType());
            //echo $qrCode->writeString();

            ?> 

            <?php 
            // or even as data:uri url
            echo '<img src="' . $qrCode->writeDataUri() . '">';
            }
            ?>
        </div>
        <div class="col-7">
            <?php if($model) { ?> 
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'var_1',
                'var_2',
                'var_3',
                'var_4',
                'var_5',
            ],
        ]) ?>
            <?php } ?>
        </div>

    </div>

    
</div>

<h4>5 Last Record Validation </h4>
<?php 

$command=Itemcamera::find()->limit(5)->orderBy(['id'=>'SORT_DESC'])->all();
if(isset($command)){
echo "<ul>";
foreach($command as $value){
	
    echo "<li class='keterangan'>NIE ".$value['var_1']."</li>";

}
echo "</ul>";
}


?>

<h4>List Queque</h4>
<?php 
$antri=Scanlog::find()->where(['status'=>0])->All();
if(isset($antri)){
echo "<ul>";
foreach($antri as $value){
	
	echo "<li>Barcode ".$value['scan']."</li>";
	
}
echo "</ul>";
}

?>



</div>
<?php 
if(isset($timerr)){
?>	
<script language="javascript">
setTimeout(function(){
   window.location.reload(1);
},3000);
</script>

<?php 	
} else { ?>

<script language="javascript">
setTimeout(function(){
   window.location.reload(1);
}, 3000);
</script>

<?php } ?>