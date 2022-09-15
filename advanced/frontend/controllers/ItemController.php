<?php

namespace frontend\controllers;

use Yii;
use app\models\Item;
use app\models\ItemSearch;
use frontend\models\Csv;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\models\Itemmaster;
use app\models\Itemmasterd;
use app\models\Jobs;
use app\models\Line;
use app\models\Machine;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;
use app\models\Scanlog;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Item #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Item model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTable($id){
    $tab='<table class="table table-hover table-striped">
               <thead class="thead-dark">
                <th>No</th>
                <th>Log Scan</th>
                <th>Database</th>
                <th>Time Stamp</th>
                <th>Status</th>
            </thead>';
    $i=1;
    $master=Itemmaster::findOne($id);
    $models=Scanlog::find()->where(['machine'=>$master->machine,'status'=>'0'])->orderBy(['id'=>SORT_ASC])->all();
    foreach($models as $value){
        if($value->process==0) {
        $data=explode("(", $value->scan);
        $ver="False";
        $ver1="FAIL";
        if(count($data)==6){
            $ver="True";
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
            $sc=Item::find()->where(['var_5'=>$var5,'status'=>1])->one();
            if(isset($sc)){
                $sc->status=2;
                $sc->save();
                $det=Itemmasterd::find()->where(['iddetail'=>$sc->id])->one();
                $det->status=1;
                $det->save();
            }
            $ver1="PASS";
            $value->process=1;
            $value->save();
        } else {
            $itemd=Itemmasterd::find()->where(['idmaster'=>$id])->orderBy(['id'=>SORT_ASC])->all();
            $j=1;
            foreach($itemd as $vall){
                if($i==$j){
                    $vall->status=2;
                    $vall->save();
                }
                $j++:
            }
            $value->process=1;
            $value->save();

        }
        }
        $tab.="<tr><td>".$i."</td>";
        $tab.= "<td>".$value->scan."</td>";
        $tab.= "<td>".$ver."</td>";
        $tab.= "<td>".date('d-m-Y H:i:s',strtotime($value->tanggal))."</td>";
        $tab.= "<td>".$ver1."</td></tr>";
        $i++;
     }
        $tab.="</table>";
        return $tab;

    }

    public function actionTotal($id){
        $id=Itemmasterd::find()->where(['idmaster'=>$id])->count();
        return 'TOTAL '.$id;
    }  
    public function actionStatus($id){
        $id=Itemmasterd::find()->where(['idmaster'=>$id,'status'=>0])->orderBy(['id'=>SORT_ASC])->One();
        $model=$this->findModel($id->iddetail);
        if($model->status<>1){
            $model->status=1;
            $model->save();            
        }
        return 'jalan';
    }
    public function actionStop($id){
        $job=Itemmaster::findOne($id);
        if(isset($job)) {
            $job->status=1;
            $job->save();
        $sql=Yii::$app->db->createCommand("update Scanlog set status=1 where machine=".$job->machine." and status=0")->execute();
        $id=Itemmasterd::find()->where(['idmaster'=>$id])->orderBy(['id'=>SORT_ASC])->all();
        foreach ($id as $value){
            $model=$this->findModel($value->iddetail);
            if(isset($model))
            {
                $model->status=2;
                $model->save();
            }
            $value->status=1;
            $value->save();
        }
        return 'stop';
        }
    }
    public function actionReset($id){
        $job=Itemmaster::findOne($id);
        if(isset($job)) {
        $sql=Yii::$app->db->createCommand("delete from Scanlog where machine=".$job->machine." and status=0")->execute();
        return 'resume';
        }
    }

    public function actionPass($id){
        $id=Itemmasterd::find()->where(['idmaster'=>$id,'status'=>1])->count();
        return 'PASS    :'.$id;
    }
    public function actionFail($id){
        $id=Itemmasterd::find()->where(['idmaster'=>$id,'status'=>2])->count();
        return 'FAIL    :'.$id;
    }
    public function actionProgress($id){
        $id=Itemmasterd::find()->where(['idmaster'=>$id,'status'=>0])->count();
        return 'PROGRESS :'.$id;
    }


    public function actionGetjob($id){
        $job=Itemmasterd::find()->where(['idmaster'=>$id,'status'=>1])->limit(1)->orderBy(['id'=>SORT_DESC])->one();
        if(isset($job)){
        $model=Item::findOne($job->iddetail);
        $gabung ="(90)".$model->var_1."(01)".$model->var_2."(10)".$model->var_3."(17)".$model->var_4."(21)".$model->var_5;
         $resp='<div class="col-5">';
            $qrCode = (new QrCode($gabung))
                ->setSize(170)
                ->setMargin(5)
                ->useForegroundColor(13, 13, 13);
            $qrCode->writeFile('code.png'); 
            header('Content-Type: '.$qrCode->getContentType());
            $resp.='<img src="' . $qrCode->writeDataUri() . '">';
            $resp.='<div class="row" style="text-align: center; margin: auto;border:solid 1px black;background-color: white;">
               <span style="text-align: center; margin: auto;">'. $gabung.'</span>
            </div>
        </div>
        <div class="col-7">';
        $resp.= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'var_1',
                'var_2',
                'var_3',
                'var_4',
                'var_5',
            ],
        ]); 
        $resp.='</div>';
        return $resp;
        } else {
            return '';
        }
    }

      public function actionUploadcsv()
    {
        $model= new Csv();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $i=0;
                $j=0;
                $transaction = Yii::$app->db->beginTransaction();
                try
                {
                $jobini=Jobs::findOne($model->namav);
                $namapr=$jobini->nama;
                $nie=$jobini->nie;
                $gtin=$jobini->gtin;
                $i++;
                $line=Line::findOne($model->linenm);
                $machine=Machine::findOne($model->machine);
                $lot=$model->lot;
                $expire=$model->expired;
                $serial=substr($nie, 5,6).substr($lot,3,3);
                $mulai2=intval($model->jumlah);
                $job =new Itemmaster();
                $job->nama=$model->nama;
                $job->job_id=$model->namav;
                $job->var_1=$nie;
                $job->var_2=$gtin;
                $job->var_3=$model->expired;
                $job->var_4=$model->lot;
                $job->shift=$model->shift;
                $job->var_5=$namapr;
                $job->linenm=$line->nama;
                $job->id_line=$model->linenm;
                $job->machine=$model->machine;
                $job->save();
                $idmaster=$job->id;
                $belakang=-1*$mulai2;
                for($mulai1=1;$mulai1<=$mulai2;$mulai1++)
                {
                $kodesn=$serial. substr("000000".$mulai1,-3);
                $barang = New Item();
                $barang->machine=$model->machine;
                $barang->var_1 = $nie;
                $barang->var_2 = $gtin;
                $barang->var_3 = $model->lot;
                $barang->var_4 = $model->expired;
                $barang->var_5 = $kodesn;
                $barang->ulang = 1;
                $jadi="";
                $satu="";
                $dua="";
                $tiga="";
                $empat="";
                $lima="";
                $lsatu="";
                $ldua="";
                $ltiga="";
                $lempat="";
                $llima="";
                $dsatu="";
                $ddua="";
                $dtiga="";
                $dempat="";
                $dlima="";
                $satuj="";$duaj="";$tigaj="";$empatj="";$limaj="";
                $satu=$barang->var_1;
                $lsatu=strlen($satu);
                $dsatu=bin2hex($satu);
                if($lsatu<10){
                    $satuj="0".$lsatu;
                } else {
                    $satuj="0".dechex($lsatu);
                }
                $x="";
                $y=str_split($dsatu,2);
                foreach($y as $z){
                    $x=$x." ".$z;
                }
                $satuj=$satuj .$x;
                $angka1=$lsatu+1+24;
                $angka2=$angka1+4;
                if(is_null($barang->var_2)==false and trim($barang->var_2)<>"")
                {
                    $dua=$barang->var_2;
                    $ldua=strlen($dua);
                    $ddua=bin2hex($dua);                    
                    $angka1=$lsatu+$ldua+2+24;
                    $angka2=$angka1+4;
                if($ldua<10){
                    $duaj="0".$ldua;
                } else {
                    $duaj="0".dechex($ldua);
                }
                $x="";
                $y=str_split($ddua,2);
                foreach($y as $z){
                    $x=$x." ".$z;
                }
                $duaj=" ".$duaj .$x;
                }

                if(is_null($barang->var_3)==false and trim($barang->var_3)<>"")
                {                
                    $tiga=$barang->var_3;
                    $ltiga=strlen($tiga);
                    $dtiga=bin2hex($tiga);
                    $angka1=$lsatu+$ldua+$ltiga+3+24;
                    $angka2=$angka1+4;
                    if($ltiga<10){
                        $tigaj="0".$ltiga;
                    } else {
                        $tigaj="0".dechex($ltiga);
                    }
                    $x="";
                    $y=str_split($dtiga,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $tigaj=" ".$tigaj .$x;
                }

                if(is_null($barang->var_4)==false and trim($barang->var_4)<>"")
                {                
                    $empat=$barang->var_4;
                    $lempat=strlen($empat);
                    $dempat=bin2hex($empat);
                    $angka1=$lsatu+$ldua+$ltiga+$lempat+3+24;
                    $angka2=$angka1+4;
                    if($lempat<10){
                        $empatj="0".$lempat;
                    } else {
                        $empatj="0".dechex($lempat);
                    }
                    $x="";
                    $y=str_split($dempat,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $empatj=" ".$empatj .$x;
                }

                if(is_null($barang->var_5)==false and trim($barang->var_5)<>"")
                {                
                    $lima=$barang->var_5;
                    $llima=strlen($lima);
                    $dlima=bin2hex($lima);
                    $angka1=$lsatu+$ldua+$ltiga+$lempat+$llima+3+24;
                    $angka2=$angka1+4;
                    if($llima<10){
                        $limaj="0".$llima;
                    } else {
                        $limaj="0".dechex($llima);
                    }
                    $x="";
                    $y=str_split($dlima,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $limaj=" ".$limaj .$x." ";
                }

                $jum2=dechex($angka1+1);
                $jum1=dechex($angka2+1);
                $jadi1="00 00 00 00 00";
                $jadi1a="00 64 00";
                $jadi2="00 cf 00 00 00 00";
                $jadi3="";
                $bil=18;
                if(is_null($barang->var_2)==false and trim($barang->var_2)<>"")
                {
                    $jum2=dechex($angka1);
                    $jum1=dechex($angka2);
                    $bil=17;
                }
                if(is_null($barang->var_3)==false and trim($barang->var_3)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=16;
                }
                if(is_null($barang->var_4)==false and trim($barang->var_4)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=15;
                }
                if(is_null($barang->var_5)==false and trim($barang->var_5)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=14;
                }

                for($i=0;$i<=$bil;$i++){
                    $jadi3=$jadi3."00 ";
                }
                $jadi3=" ".$jadi3;
                $jadi=$jadi1." ".$jum1." ".$jadi1a." ".$jum2." ".$jadi2." ".$satuj.$duaj.$tigaj.$empatj.$limaj.$jadi3;
                $barang->biner=$jadi;
                    $barang->save();
                    $mdet= new Itemmasterd;
                    $mdet->idmaster=$idmaster;
                    $mdet->iddetail=$barang->id;
                    $mdet->save();
                }
                    $transaction->commit();
                    $mulai1 = $mulai1-1;
                    Yii::$app->session->setFlash('success', $mulai1.' rows Generate Success ');
                }
                catch(Exception $e)
                {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('danger', 'Failed import '.$e.getMessage());

                }
            return $this->redirect(['item/index']); 
        }
        // Yii::$app->session->setFlash('success', ' rows Success ');
        return $this->render('uploadcsva', [
        'model' => $model,
        ]);

    }
     
    public function actionUploadcsv1()
    {
        $model= new Csv();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->csv = UploadedFile::getInstance($model, 'csv');
            if(isset($model->csv)){
                $namafile=rand(1000, 99999999);
                $file1= $namafile . '.' . $model->csv->extension;
                $model->csv->saveAs('images/' . $namafile . '.' . $model->csv->extension,TRUE);
                $csvFilePath = "images/".$file1;
                $file = fopen($csvFilePath, "r");
                $i=0;
                $j=0;
                $transaction = Yii::$app->db->beginTransaction();
                try
                {
               // if(isset($model->alamat) and trim($model->alamat)<>"" and is_null($model->alamat)==false) {
               //     $fileee=fgetcsv($file,0,$model->alamat);
               // } else {
               //     $fileee=fgetcsv($file,0,"\t");
               // }
                //while (($row = fgetcsv($file)) !== FALSE) {  fgetcsv($fh, 0, "\t"
                //while (($row = fgetcsv($file,0,"\t")) !== FALSE) {
                while (($row = fgetcsv($file,0,"\t")) !== FALSE) {
                        //var_dump($row);
                        //die();
                        $i++;
                        $lot=$model->lot;
                        $expire=$model->expired;
                        $serial=substr($row[1], 3,6).substr($lot,2,3);
                        $mulai2=intval($model->jumlah);
                        $job =new Itemmaster();
                        $job->nama=$model->nama;
                        $job->save();
                        $idmaster=$job->id;
                        for($mulai1=1;$mulai1<=$mulai2;$mulai1++)
                        {
                        $kodesn=$serial. substr("0000000000".$mulai1, -1 * intval($mulai2));
                        $barang = New Item();
                        $str = preg_replace('/[[:^print:]]/', '',$row[0]);
                        $str = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str);
                        $str = str_replace("\"", "", $str);
                        $barang->var_1 = $str;
                        $barang->var_2 = $row[1];
                        $barang->var_3 = $model->lot;
                        $barang->var_4 = $model->expired;
                        $barang->var_5 = $kodesn;
                        $barang->ulang = 1;
                        //$barang->biner="kfljsafsaf";
                        //$barang->save();
                        //}
                        //var_dump($row);
                        //var_dump($barang);
                        //die();
                $jadi="";
                $satu="";
                $dua="";
                $tiga="";
                $empat="";
                $lima="";
                $lsatu="";
                $ldua="";
                $ltiga="";
                $lempat="";
                $llima="";
                $dsatu="";
                $ddua="";
                $dtiga="";
                $dempat="";
                $dlima="";
                $satuj="";$duaj="";$tigaj="";$empatj="";$limaj="";
                $satu=$barang->var_1;
                $lsatu=strlen($satu);
                $dsatu=bin2hex($satu);
                if($lsatu<10){
                    $satuj="0".$lsatu;
                } else {
                    $satuj="0".dechex($lsatu);
                }
                $x="";
                $y=str_split($dsatu,2);
                foreach($y as $z){
                    $x=$x." ".$z;
                }
                $satuj=$satuj .$x;
                $angka1=$lsatu+1+24;
                $angka2=$angka1+4;
                if(is_null($barang->var_2)==false and trim($barang->var_2)<>"")
                {
                    $dua=$barang->var_2;
                    $ldua=strlen($dua);
                    $ddua=bin2hex($dua);                    
                    $angka1=$lsatu+$ldua+2+24;
                    $angka2=$angka1+4;
                if($ldua<10){
                    $duaj="0".$ldua;
                } else {
                    $duaj="0".dechex($ldua);
                }
                $x="";
                $y=str_split($ddua,2);
                foreach($y as $z){
                    $x=$x." ".$z;
                }
                $duaj=" ".$duaj .$x;
                }

                if(is_null($barang->var_3)==false and trim($barang->var_3)<>"")
                {                
                    $tiga=$barang->var_3;
                    $ltiga=strlen($tiga);
                    $dtiga=bin2hex($tiga);
                    $angka1=$lsatu+$ldua+$ltiga+3+24;
                    $angka2=$angka1+4;
                    if($ltiga<10){
                        $tigaj="0".$ltiga;
                    } else {
                        $tigaj="0".dechex($ltiga);
                    }
                    $x="";
                    $y=str_split($dtiga,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $tigaj=" ".$tigaj .$x;
                }

                if(is_null($barang->var_4)==false and trim($barang->var_4)<>"")
                {                
                    $empat=$barang->var_4;
                    $lempat=strlen($empat);
                    $dempat=bin2hex($empat);
                    $angka1=$lsatu+$ldua+$ltiga+$lempat+3+24;
                    $angka2=$angka1+4;
                    if($lempat<10){
                        $empatj="0".$lempat;
                    } else {
                        $empatj="0".dechex($lempat);
                    }
                    $x="";
                    $y=str_split($dempat,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $empatj=" ".$empatj .$x;
                }

                if(is_null($barang->var_5)==false and trim($barang->var_5)<>"")
                {                
                    $lima=$barang->var_5;
                    $llima=strlen($lima);
                    $dlima=bin2hex($lima);
                    $angka1=$lsatu+$ldua+$ltiga+$lempat+$llima+3+24;
                    $angka2=$angka1+4;
                    if($llima<10){
                        $limaj="0".$llima;
                    } else {
                        $limaj="0".dechex($llima);
                    }
                    $x="";
                    $y=str_split($dlima,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $limaj=" ".$limaj .$x." ";
                }

                $jum2=dechex($angka1+1);
                $jum1=dechex($angka2+1);
                $jadi1="00 00 00 00 00";
                $jadi1a="00 64 00";
                $jadi2="00 cf 00 00 00 00";
                $jadi3="";
                $bil=18;
                if(is_null($barang->var_2)==false and trim($barang->var_2)<>"")
                {
                    $jum2=dechex($angka1);
                    $jum1=dechex($angka2);
                    $bil=17;
                }
                if(is_null($barang->var_3)==false and trim($barang->var_3)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=16;
                }
                if(is_null($barang->var_4)==false and trim($barang->var_4)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=15;
                }
                if(is_null($barang->var_5)==false and trim($barang->var_5)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=14;
                }

                for($i=0;$i<=$bil;$i++){
                    $jadi3=$jadi3."00 ";
                }
                $jadi3=" ".$jadi3;
                $jadi=$jadi1." ".$jum1." ".$jadi1a." ".$jum2." ".$jadi2." ".$satuj.$duaj.$tigaj.$empatj.$limaj.$jadi3;
                $barang->biner=$jadi;
                    $barang->save();
                    $mdet= new Itemmasterd;
                    $mdet->idmaster=$idmaster;
                    $mdet->iddetail=$barang->id;
                    $mdet->save();
                }//$barang->save();    
                }
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', $i.' rows Success ');
                }
                catch(Exception $e)
                {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('danger', 'Failed import '.$e.getMessage());

                }

              }
            return $this->redirect(['item/index']); 
        }
        // Yii::$app->session->setFlash('success', ' rows Success ');
        return $this->render('uploadcsv', [
        'model' => $model,
        ]);

    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Item();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Item",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->validate()){
                $jadi="";
                $satu="";
                $dua="";
                $tiga="";
                $empat="";
                $lima="";
                $lsatu="";
                $ldua="";
                $ltiga="";
                $lempat="";
                $llima="";
                $dsatu="";
                $ddua="";
                $dtiga="";
                $dempat="";
                $dlima="";
                $satuj="";$duaj="";$tigaj="";$empatj="";$limaj="";
                $satu=$model->var_1;
                $lsatu=strlen($satu);
                $dsatu=bin2hex($satu);
                if($lsatu<10){
                    $satuj="0".$lsatu;
                } else {
                    $satuj="0".dechex($lsatu);
                }
                $x="";
                $y=str_split($dsatu,2);
                foreach($y as $z){
                    $x=$x." ".$z;
                }
                $satuj=$satuj .$x;
                $angka1=$lsatu+1+24;
                $angka2=$angka1+4;
                if(is_null($model->var_2)==false and trim($model->var_2)<>"")
                {
                    $dua=$model->var_2;
                    $ldua=strlen($dua);
                    $ddua=bin2hex($dua);                    
                    $angka1=$lsatu+$ldua+2+24;
                    $angka2=$angka1+4;
                if($ldua<10){
                    $duaj="0".$ldua;
                } else {
                    $duaj="0".dechex($ldua);
                }
                $x="";
                $y=str_split($ddua,2);
                foreach($y as $z){
                    $x=$x." ".$z;
                }
                $duaj=" ".$duaj .$x;
                }

                if(is_null($model->var_3)==false and trim($model->var_3)<>"")
                {                
                    $tiga=$model->var_3;
                    $ltiga=strlen($tiga);
                    $dtiga=bin2hex($tiga);
                    $angka1=$lsatu+$ldua+$ltiga+3+24;
                    $angka2=$angka1+4;
                    if($ltiga<10){
                        $tigaj="0".$ltiga;
                    } else {
                        $tigaj="0".dechex($ltiga);
                    }
                    $x="";
                    $y=str_split($dtiga,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $tigaj=" ".$tigaj .$x;
                }

                if(is_null($model->var_4)==false and trim($model->var_4)<>"")
                {                
                    $empat=$model->var_4;
                    $lempat=strlen($empat);
                    $dempat=bin2hex($empat);
                    $angka1=$lsatu+$ldua+$ltiga+$lempat+3+24;
                    $angka2=$angka1+4;
                    if($lempat<10){
                        $empatj="0".$lempat;
                    } else {
                        $empatj="0".dechex($lempat);
                    }
                    $x="";
                    $y=str_split($dempat,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $empatj=" ".$empatj .$x;
                }

                if(is_null($model->var_5)==false and trim($model->var_5)<>"")
                {                
                    $lima=$model->var_5;
                    $llima=strlen($lima);
                    $dlima=bin2hex($lima);
                    $angka1=$lsatu+$ldua+$ltiga+$lempat+$llima+3+24;
                    $angka2=$angka1+4;
                    if($llima<10){
                        $limaj="0".$llima;
                    } else {
                        $limaj="0".dechex($llima);
                    }
                    $x="";
                    $y=str_split($dlima,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $limaj=" ".$limaj .$x." ";
                }

                $jum2=dechex($angka1+1);
                $jum1=dechex($angka2+1);
                $jadi1="00 00 00 00 00";
                $jadi1a="00 64 00";
                $jadi2="00 cf 00 00 00 00";
                $jadi3="";
                $bil=18;
                if(is_null($model->var_2)==false and trim($model->var_2)<>"")
                {
                    $jum2=dechex($angka1);
                    $jum1=dechex($angka2);
                    $bil=17;
                }
                if(is_null($model->var_3)==false and trim($model->var_3)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=16;
                }
                if(is_null($model->var_4)==false and trim($model->var_4)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=15;
                }
                if(is_null($model->var_5)==false and trim($model->var_5)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=14;
                }

                for($i=0;$i<=$bil;$i++){
                    $jadi3=$jadi3."00 ";
                }
                $jadi3=" ".$jadi3;
                $jadi=$jadi1." ".$jum1." ".$jadi1a." ".$jum2." ".$jadi2." ".$satuj.$duaj.$tigaj.$empatj.$limaj.$jadi3;
                $model->biner=$jadi;
                $model->save();

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Item",
                    'content'=>'<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' Item '.Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Item",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Item model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Item #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->validate()){
                $jadi="";
                $satu="";
                $dua="";
                $tiga="";
                $empat="";
                $lima="";
                $lsatu="";
                $ldua="";
                $ltiga="";
                $lempat="";
                $llima="";
                $dsatu="";
                $ddua="";
                $dtiga="";
                $dempat="";
                $dlima="";
                $satuj="";$duaj="";$tigaj="";$empatj="";$limaj="";
                $satu=$model->var_1;
                $lsatu=strlen($satu);
                $dsatu=bin2hex($satu);
                if($lsatu<10){
                    $satuj="0".$lsatu;
                } else {
                    $satuj="0".dechex($lsatu);
                }
                $x="";
                $y=str_split($dsatu,2);
                foreach($y as $z){
                    $x=$x." ".$z;
                }
                $satuj=$satuj .$x;
                $angka1=$lsatu+1+24;
                $angka2=$angka1+4;
                if(is_null($model->var_2)==false and trim($model->var_2)<>"")
                {
                    $dua=$model->var_2;
                    $ldua=strlen($dua);
                    $ddua=bin2hex($dua);                    
                    $angka1=$lsatu+$ldua+2+24;
                    $angka2=$angka1+4;
                if($ldua<10){
                    $duaj="0".$ldua;
                } else {
                    $duaj="0".dechex($ldua);
                }
                $x="";
                $y=str_split($ddua,2);
                foreach($y as $z){
                    $x=$x." ".$z;
                }
                $duaj=" ".$duaj .$x;
                }

                if(is_null($model->var_3)==false and trim($model->var_3)<>"")
                {                
                    $tiga=$model->var_3;
                    $ltiga=strlen($tiga);
                    $dtiga=bin2hex($tiga);
                    $angka1=$lsatu+$ldua+$ltiga+3+24;
                    $angka2=$angka1+4;
                    if($ltiga<10){
                        $tigaj="0".$ltiga;
                    } else {
                        $tigaj="0".dechex($ltiga);
                    }
                    $x="";
                    $y=str_split($dtiga,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $tigaj=" ".$tigaj .$x;
                }

                if(is_null($model->var_4)==false and trim($model->var_4)<>"")
                {                
                    $empat=$model->var_4;
                    $lempat=strlen($empat);
                    $dempat=bin2hex($empat);
                    $angka1=$lsatu+$ldua+$ltiga+$lempat+3+24;
                    $angka2=$angka1+4;
                    if($lempat<10){
                        $empatj="0".$lempat;
                    } else {
                        $empatj="0".dechex($lempat);
                    }
                    $x="";
                    $y=str_split($dempat,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $empatj=" ".$empatj .$x;
                }

                if(is_null($model->var_5)==false and trim($model->var_5)<>"")
                {                
                    $lima=$model->var_5;
                    $llima=strlen($lima);
                    $dlima=bin2hex($lima);
                    $angka1=$lsatu+$ldua+$ltiga+$lempat+$llima+3+24;
                    $angka2=$angka1+4;
                    if($llima<10){
                        $limaj="0".$llima;
                    } else {
                        $limaj="0".dechex($llima);
                    }
                    $x="";
                    $y=str_split($dlima,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $limaj=" ".$limaj .$x." ";
                }

                $jum2=dechex($angka1+1);
                $jum1=dechex($angka2+1);
                $jadi1="00 00 00 00 00";
                $jadi1a="00 64 00";
                $jadi2="00 cf 00 00 00 00";
                $jadi3="";
                $bil=18;
                if(is_null($model->var_2)==false and trim($model->var_2)<>"")
                {
                    $jum2=dechex($angka1);
                    $jum1=dechex($angka2);
                    $bil=17;
                }
                if(is_null($model->var_3)==false and trim($model->var_3)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=16;
                }
                if(is_null($model->var_4)==false and trim($model->var_4)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=15;
                }
                if(is_null($model->var_5)==false and trim($model->var_5)<>"")
                {
                    $jum2=dechex($angka1-1);
                    $jum1=dechex($angka2-1);
                    $bil=14;
                }

                for($i=0;$i<=$bil;$i++){
                    $jadi3=$jadi3."00 ";
                }
                $jadi3=" ".$jadi3;
                $jadi=$jadi1." ".$jum1." ".$jadi1a." ".$jum2." ".$jadi2." ".$satuj.$duaj.$tigaj.$empatj.$limaj.$jadi3;
                $model->biner=$jadi;
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Item #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Item #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Item model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Item model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }
    public function actionRunningdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->status=1;
            $model->save();
            //$model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
