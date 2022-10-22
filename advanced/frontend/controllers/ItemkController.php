<?php

namespace frontend\controllers;

use Yii;
use app\models\Itemkardus;
use app\models\ItemkardusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use frontend\models\Csv2;
use app\models\Itemk;
use app\models\Itemkd;
use app\models\Jobs;
use app\models\Line;
use app\models\Machine;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;
use app\models\Scanlogcarton;
use app\models\Scanlog;
use app\models\Kardusitem;
use app\models\Item;
/**
 * ItemkController implements the CRUD actions for Itemkardus model.
 */
class ItemkController extends Controller
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
     * Lists all Itemkardus models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ItemkardusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(isset($searchModel->numlimit)){
            $dataProvider->pagination = ['pageSize' =>intval($searchModel->numlimit)];
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Itemkardus model.
     * @param integer $id
     * @return mixed
     */
     public function actionPrint($id)
    {
        $model=$this->findModel($id);
        $cc=Kardusitem::find()->where(['idkardus'=>$id])->count();
        if($model->var_8==$cc){

        if(isset($model)){
            $this->layout=false;
            return $this->render('viewpr', [
                'model' => $model,
//                'searchModel' => $searchModel,
//                'dataProvider' => $dataProvider,
            ]);

        }
        } else {
            return $this->redirect(['site/about','pesan'=>'Target not finish']);
        }
    }

    public function actionScanusb($id){
        $item=$this->findModel($id);
        $model= new Scanlog();
        if (Yii::$app->request->isAjax) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->post()) {
            $resp="";
            //$hasil = explode(PHP_EOL,$_POST['Inputan']['barcode']);
            $hasil = explode("\n",$_POST['Inputan']['barcode']);
            foreach($hasil as $value){
            if($value<>" " or $value<>""){
                $value = preg_replace("/\r|\n/", "", $value);
                $value =trim($value);
                if($value<>""){
                $jj=new Scanlogcarton();
                $jj->scan=$value;
                $jj->machine =$item->master->job->machine;
                if($jj->save()) {
                    //$resp.=$value." berhasil diinput <br/>";
                    //$item=$value;
                    $data=explode("(", $value);
                    $kondisi=false;
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
                        //cek scan
                        $ini=$this->findModel($id);
                        $cc=Kardusitem::find()->where(['idkardus'=>$id])->count();
                        if($ini->var_8==$cc){
                            return "<div class='alert-danger alert'>Target Already Finish<br/></div>";
                            break;
                        }
                        $ii=Item::find()->where(['var_5'=>$var5])->one();
                        if(isset($ii)) {
                            $cek=Kardusitem::find()->where(['iddetail'=>$ii->id])->one();
                            if(isset($cek)){
                                return "<div class='alert-danger alert'>".$value." gagal karena Data sudah pernah dimasukkan ke karton lain <br/></div>";
                                break;
                            } else {
                                $kk=new Kardusitem();
                                $kk->idkardus=$item->id;
                                $kk->iddetail=$ii->id;
                                if($kk->save()) {
                                    $kondisi=true;
                                } else {
                                    $kondisi=false;
                                }
                            }

                        }
                        if($kondisi==true){
                        $gabung ="(90)".$var1."(01)".$var2."(10)".$var3."(17)".$var4."(21)".$var5;
                        $qrCode = (new QrCode($gabung))
                            ->setSize(170)
                            ->setMargin(5)
                            ->useForegroundColor(13, 13, 13);
                        $qrCode->writeFile('code.png'); // writer defaults to PNG when none is specified
                        header('Content-Type: '.$qrCode->getContentType());
                        //$resp.=$value." berhasil diinput <br/>";
                        $resp.='<div class="row alert-success alert">
                        <div class="col-4" style="white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;   white-space: -o-pre-wrap;word-wrap: break-word;">'.$value.' berhasil diinput </div>
                        <div class="col-4">
                        <img src="' . $qrCode->writeDataUri() . '">
                        </div>
                        <div class="col-4">
                        <table id="w0" class="table table-striped table-bordered detail-view"><tbody><tr><th>NIE</th><td>'.$var1.'</td></tr>
<tr><th>GTIN</th><td>'.$var2.'</td></tr>
<tr><th>LOT NO</th><td>'.$var3.'</td></tr>
<tr><th>EXP DATE</th><td>'.$var4.'</td></tr>
<tr><th>S / N</th><td>'.$var5.'</td></tr></tbody></table>
                        </div></div>';
                        } else {
                        $resp.="<div class='alert-danger alert'>".$value." gagal diinput <br/></div>";                            
                        }
                    }
                } else {
                    $resp."<div class='alert-danger alert'>".$value." gagal diinput <br/></div>";                            
                }
                }
                
            }
            }
            return $resp;
            
        } else {
            return "data tidak berhasil diinput";
        }
        }
        return $this->render('createscanm2', [
        'model' => $model,
        'id'=>$id,
        'item'=>$item,
        ]);
    } 

    public function actionTable($id){
        $res='<table class="table table-hover table-striped" >
            <thead  class="thead-dark">
                <th>NO</th>
                <th>QR DATA</th>
                <th>TIME STAMP</th>
                <th>S/N Product</th>
            </thead>';
        $detail = Kardusitem::find()->where(['idkardus'=>$id])->all();
        $i=1;
        foreach($detail as $vie){
            $res .="<tr>";
            $res .="<td>".$i."</td>";
            $res .="<td>".$vie->itemd->scan."</td>";
            $res .="<td>".$vie->tanggal."</td>";
            $res .="<td>".$vie->itemd->var_5."</td>";
            $res .="</tr>";
            $i++;
        }
        $res .="</table>";
        return $res;
    }

    public function actionReset($id){
        $job=$this->findModel($id);
        if(isset($job)) {
        $sql=Yii::$app->db->createCommand("delete from kardusitem where idkardus=".$job->id)->execute();
        return 'reset';
        }
    }    
    public function actionScanhitung($id){
        $detail = Kardusitem::find()->where(['idkardus'=>$id])->count();
        return '<h5 id="scan" style="color:red">Scan :'.$detail.'</h5>';        
    }
    public function actionTarget($id){
        $job=$this->findModel($id);
        if($job){

            return '<h5 id="target" style="color:blue;">Target :'.$job->var_8.'</h5>';
        }
        
    }

    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Itemkardus #".$id,
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
    public function actionUploadcsv()
    {
        $model= new Csv2();
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
                $cekserial=Itemkardus::find()->where(['var_5'=>$serial.substr("0000001",-5)])->one();
                if($cekserial){
                     Yii::$app->session->setFlash('danger', 'S/N sudah pernah diinput');
                     return $this->redirect(['itemk/uploadcsv']);
                     die();
                }
                $mulai2=intval($model->jumlah);
                $job =new Itemk();
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
                $kodesn=$serial. substr("000000".$mulai1,-5);
                $barang = New Itemkardus();
                $barang->var_1 = $nie;
                $barang->var_2 = $gtin;
                $barang->var_3 = $model->lot;
                $barang->var_4 = $model->expired;
                $barang->var_5 = $kodesn;
                $barang->var_6 = $model->company;
                $barang->var_7 = $model->varian;
                $barang->var_8 = $model->qty;
                $barang->var_9 = $model->berat;
                $barang->ulang = 1;
                    $barang->save();
                    $mdet= new Itemkd();
                    $mdet->idmaster=$idmaster;
                    $mdet->iddetail=$barang->id;
                    $mdet->save();
                }
                    $mulai1=$mulai1-1;
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', $mulai1.' rows Generate Success ');
                }
                catch(Exception $e)
                {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('danger', 'Failed import '.$e.getMessage());

                }
            return $this->redirect(['jobkardus/index']); 
        }
        // Yii::$app->session->setFlash('success', ' rows Success ');
        return $this->render('uploadcsva', [
        'model' => $model,
        ]);

    }
    /**
     * Creates a new Itemkardus model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Itemkardus();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemkardus",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->validate() && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemkardus",
                    'content'=>'<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' Itemkardus '.Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemkardus",
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
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            */
        }
       
    }

    /**
     * Updates an existing Itemkardus model.
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
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Itemkardus #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Itemkardus #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Itemkardus #".$id,
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
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            */
        }
    }

    /**
     * Delete an existing Itemkardus model.
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
     * Delete multiple existing Itemkardus model.
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

    /**
     * Finds the Itemkardus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Itemkardus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itemkardus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
