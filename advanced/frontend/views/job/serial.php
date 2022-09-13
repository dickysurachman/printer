<?php

use yii\widgets\DetailView;

$this->title="Serialization and Inspection";
/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<div class="item-view">
    <div class="row">
        <div class="col-5">
            <h3>Inspection Result</h3>
        </div>
        <div class="col-7">
            <h3 id="datess">Date Time : <?=date('d-m-Y H:i:s',time())?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
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
            <div class="row" style="text-align: center; margin: auto;border:solid 1px black;background-color: white;">
               <span style="text-align: center; margin: auto;"> <?=$gabung?></span>
            </div>
        </div>
        <div class="col-7">
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
        </div>

    </div>

    <div class="row">
        <div class="col-5">
            <h3 style="color:green;">PASS    :</h3>
            <h3 style="color:red;">FAIL    :</h3>
            <h3 style="color:black;">TOTAL    :</h3>
        </div>
        <div class="col-7">
            <button id="setar" class="btn btn-success"><i class="fas fa-play"></i>&nbsp;START</button>
            <button id="setop" class="btn btn-danger"><i class="fas fa-stop"></i>&nbsp;STOP</button>
            <button id="reset" class="btn btn-info"><i class="fas fa-circle"></i>&nbsp;RESET</button>
            <button id="recum"  class="btn btn-danger" disabled><i class="fas fa-pause"></i>&nbsp;PAUSE</button>
        </div>



    </div>

    <div class="row">
         <table class="table">
            <tr>
                <th>No</th>
                <th>NIE</th>
                <th>GTIN</th>
                <th>LOT</th>
                <th>EXP DATE</th>
                <th>S/N</th>
                <th>status</th>
            </tr>
        <?php
        $i=1;
    foreach($models->detail as $value){
        echo "<tr><td>".$i."</td>";
        echo "<td>".$value->itemd->var_1."</td>";
        echo "<td>".$value->itemd->var_2."</td>";
        echo "<td>".$value->itemd->var_3."</td>";
        echo "<td>".$value->itemd->var_4."</td>";
        echo "<td>".$value->itemd->var_5."</td>";
        echo "<td>".$value->itemd->statusname."</td></tr>";
        $i++;
    }
    ?>
        </table>
    </div>

</div>
