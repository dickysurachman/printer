<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<style type="text/css">
    .cenn{
    width: 80%;
    padding: 5px;
    
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
<div class="item-view" style="align-content: center;border: solid 3px black;width: 30%;margin-left:5px;margin-top:15px;">
    
    <div class="cenn" style="border-bottom: solid 2px black; width: 100% !important;font-size: 12pt;padding: 0px !important;">
           <p align="center" style="margin:0px !important"> <?=$model->perusahaan->nama?><br/>            
            <?=$model->perusahaan->alamat?><br/>
            <?=$model->perusahaan->telp?></p>
    </div>
    <div class="row" style="padding:10px;border-bottom: solid 3px black;margin: 0px !important;">
        <div class="col-12"  style="font-size: 11pt;">
            SSCC :
            <b><?=$model->var_7?></b>:
            <br>
            
            CONTENT:
            <b><?=$model->var_1?></b>:
            <br/>
            USE BY (DD.MM.YYYY) :
            <b><?=$model->var_4?></b>
            <br>
              COUNT:
            
            <b><?=$model->var_8?></b>
            <br>
            BATCH / LOT :
            
            <b><?=$model->var_3?></b>
            <br>
            NET WEIGHT (kg) :
            
            <b><?=$model->var_9?></b>
        </div>

       


    </div>


    <div class="cenn" style="font-size: 13pt;">
            <?php 
            /*
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
            echo '<img src="' . $qrCode->writeDataUri() . '" class="center" >';*/
            ?>

            
            <img class="center" style="width:270px !important;" alt="barcode <?=$model->var_7?>" src="<?=str_replace("index.php","",Yii::$app->homeUrl) .'/barcode.php?size=70&text=(00)'.$model->var_2?>">
            <br>
            <h6 align="center" style="margin-top:-25px">(00)<?=$model->var_1?></h6>
            
        
    </div>

</div>
<script type="text/javascript">
    window.print();
</script>