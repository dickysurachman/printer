<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<div class="item-view">
    
    <div class="row">
        <div class="col-8">
            <h4><?=$model->perusahaan->nama?></h4>
            <h5><?=$model->perusahaan->alamat?></h5>
            <h2><?=$model->var_7?></h2>


        </div>

        <div class="col-4">
            <?php 
            use Da\QrCode\QrCode;
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
            ?>

        </div>


    </div>


    <div class="row">
        <div class="col-10" style="font-size: 13pt;">
            Lot : <b><?=$model->var_3?></b> QTY : <b><?=$model->var_8?></b>
            <br>
            <img alt="barcode <?=$model->var_7?>" src="<?=str_replace("index.php","",Yii::$app->homeUrl) .'/barcode.php?size=70&text=(17)'.$model->var_1.'(10)'.$model->var_3.'(30)'.$model->var_5?>">
            <br>
            (17)<?=$model->var_1?>(10)<?=$model->var_1?>(30)<?=$model->var_1?>
            <br>
            <img alt="barcode <?=$model->var_7?>" src="<?=str_replace("index.php","",Yii::$app->homeUrl) .'/barcode.php?size=70&text=(00)'.$model->var_2?>">
            <br>
            (00)<?=$model->var_1?>
        </div>
        <div class="col-2">
        </div>

    </div>

</div>
