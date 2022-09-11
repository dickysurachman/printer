<?php

use yii\widgets\DetailView;
use Da\QrCode\QrCode;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<style type="text/css">
    .cenn{
    width: 80%;
    padding: 10px;
    margin: auto;
    }
    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }
</style>

<link rel='stylesheet' href='<?=\yii\helpers\Url::home()?>css/bootstrap.css'>

<style type="text/css">
    body{
        font-family: "Swis721 BT";
    }
    .pages {
        height: 560px !important;
    }
     @media print {
        body{
            font-family: "Swis721 BT";
        }
        .pages {
        height: 560px !important;
        }
      }
      @media screen, print {
        body{
            font-family: "Swis721 BT";
        }
        .pages {
            height: 560px !important;
        }
      }
</style>
<?php 
$i=0;
foreach($model->detail as $value){

if($i>=1){
    $batass=-15;
    $c="<br/>";
} else {
    $batass=20;
    $c="";
}

$i++;
?>
<?=$c?>
<div class="item-view" style="align-content: center;border: solid 3px black;width: 45%;margin-left:15px;margin-top:<?=$batass?>px;">
    <div class="cenn" style="border-bottom: solid 2px black; width: 100% !important;font-size: 14pt;padding: 0px !important;">
           <p align="center" style="margin:0px !important"> <?=$value->itemd->perusahaan->nama?><br/>            
            <?=$value->itemd->perusahaan->alamat?><br/>
            <?=$value->itemd->perusahaan->telp?></p>
    </div>
    <div class="row" style="padding:10px;border-bottom: solid 3px black;margin: 0px !important;">
        <div class="col-6"  style="font-size: 11pt;">
            SSCC
            <br>
            <b><?=$value->itemd->var_7?></b>
            <br>
            CONTENT<br>
            <b><?=$value->itemd->var_1?></b>
            <br>
            USE BY (DD.MM.YYYY)
            <br>
            <b><?=$value->itemd->var_4?></b>
        </div>

        <div class="col-6" style="font-size: 11pt;">
            COUNT
            <br>
            <b><?=$value->itemd->var_8?></b>
            <br>
            BATCH / LOT
            <br>
            <b><?=$value->itemd->var_3?></b>
            <br>
            NET WEIGHT (kg)
            <br>
            <b><?=$value->itemd->var_9?></b>

        </div>


    </div>


    <div class="cenn" style="font-size: 13pt;">
            <?php 

            $gabung ="(90)".$value->itemd->var_1."(01)".$value->itemd->var_2."(10)".$value->itemd->var_3."(17)".$value->itemd->var_4."(21)".$value->itemd->var_5;
            $qrCode = (new QrCode($gabung))
                ->setSize(140)
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
            echo '<img src="' . $qrCode->writeDataUri() . '" class="center" >';
            ?>

            
            <img class="center" style="width:200px !important;" alt="barcode <?=$value->itemd->var_7?>" src="<?=str_replace("index.php","",Yii::$app->homeUrl) .'/barcode.php?size=70&text=(00)'.$value->itemd->var_2?>">
            <br>
            <h6 align="center" style="margin-top:-25px">(00)<?=$value->itemd->var_1?></h6>
            
        
    </div>
</div>

<?php 
}
?>