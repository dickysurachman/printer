<?php

use yii\widgets\DetailView;
use Da\QrCode\QrCode;
use app\models\itemd;
use app\models\Itemkardus;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<link rel='stylesheet' href='<?=\yii\helpers\Url::home()?>css/bootstrap.css'>

<style type="text/css">
    body{
        font-family: "Swis721 BT";
    }
    .pages {
        height: 550px !important;
    }
     @media print {
        body{
            font-family: "Swis721 BT";
        }
        .pages {
        height: 550px !important;
        }
      }
      @media screen, print {
        body{
            font-family: "Swis721 BT";
        }
        .pages {
            height: 550px !important;
        }
      }
</style>
<?php 

foreach($model->detail as $value){
//$sampai=3;
//for($ulang=0;$ulang<=$sampai;$ulang++)
//{


?>
<div class="pages" >
<div class="item-view" style="padding: 15px;border:solid 1px black;margin-left: 10px;width: 55%;margin-top:25px;">
    
    <div class="row">
        <div class="col-8">
            <h4><?=$value->itemd->perusahaan->nama?></h4>
            <h5><?=$value->itemd->perusahaan->alamat?></h5>
            <h2><?=$value->itemd->var_7?></h2>


        </div>

        <div class="col-4">
            <?php 
            

            $gabung ="(90)".$value->itemd->var_1."(01)".$value->itemd->var_2."(10)".$value->itemd->var_3."(17)".$value->itemd->var_4."(21)".$value->itemd->var_5;
            $qrCode = (new QrCode($gabung))
                ->setSize(150)
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
        <div class="col-10" style="font-size: 16pt;">
            <span style="margin-left:10px;">
            Lot : <b><?=$value->itemd->var_3?></b> QTY : <b><?=$value->itemd->var_8?></b>
            </span>
            <br>
            <img alt="barcode <?=$value->itemd->var_4?>" src="<?=str_replace("index.php","",Yii::$app->homeUrl) .'/barcode.php?size=70&text=(17)'.$value->itemd->var_4.'(10)'.$value->itemd->var_3.'(30)'.$value->itemd->var_8?>">
            <br>
            <span style="margin-left:10px;">
            (17)<?=$value->itemd->var_4?>(10)<?=$value->itemd->var_3?>(30)<?=$value->itemd->var_8?>
            </span>
            <br>
            <img alt="barcode <?=$value->itemd->var_2?>" src="<?=str_replace("index.php","",Yii::$app->homeUrl) .'/barcode.php?size=70&text=(00)'.$value->itemd->var_2?>">
            <br>
            <span style="margin-left:10px;">
            (00)<?=$value->itemd->var_2?>
            </span>
        </div>
        <div class="col-2">
        </div>

    </div>

</div>
</div>
<?php 
}

?>
