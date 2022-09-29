<?php

namespace frontend\controllers;

use Yii;
use app\models\Itempallet;
use app\models\ItempalletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use frontend\models\Csv3;
use app\models\Itemmasterp;
use app\models\Itemmasterpd;
use app\models\Jobs;
use app\models\Line;
use app\models\Machine;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;
use app\models\Scanlogpallet;
use app\models\Scanlog;
use app\models\Palletkardus;
use app\models\Itemkardus;
/**
 * ItempController implements the CRUD actions for Itempallet model.
 */
class ItempController extends Controller
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
     * Lists all Itempallet models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ItempalletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Itempallet model.
     * @param integer $id
     * @return mixed
     */
    public function actionPrint($id)
    {
        $model=$this->findModel($id);
        $cc=Palletkardus::find()->where(['idpallet'=>$id])->count();
        if($model->var_8==$cc){
        if(isset($model)){
            $this->layout=false;
            return $this->render('viewpr', [
                'model' => $model,
            ]);

        }
        } else {
            return $this->redirect(['site/about','pesan'=>'Target not finish']);
        }


    }

    public function actionReset($id){
        $job=$this->findModel($id);
        if(isset($job)) {
        $sql=Yii::$app->db->createCommand("delete from palletkardus where idpallet=".$job->id)->execute();
        return 'reset';
        }
    }    
    public function actionScanhitung($id){
        $detail = Palletkardus::find()->where(['idpallet'=>$id])->count();
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
                    'title'=> "Itempallet #".$id,
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
                $jj=new Scanlogpallet();
                $jj->scan=$value;
                $jj->machine =$item->master->job->machine;
                if($jj->save()) {
                    $resp.=$value." berhasil diinput <br/>";
                    //$item=$value;
                    $data=explode("(", $value);
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
                        $ini=$this->findModel($id);
                        $cc=Palletkardus::find()->where(['idpallet'=>$id])->count();
                        if($ini->var_8==$cc){
                            return 'Target Already Finish';
                            break;
                        }


                        $ii=Itemkardus::find()->where(['var_5'=>$var5])->one();
                        if(isset($ii)) {
                            $cek=Palletkardus::find()->where(['idkardus'=>$ii->id])->one();
                            if(isset($cek)){
                                return $value.' Data sudah pernah dimasukkan ke karton lain';
                                break;
                            } else {

                                $kk=new Palletkardus();
                                $kk->idpallet=$item->id;
                                $kk->idkardus=$ii->id;
                                $kk->save();
                            }

                        }
                        $gabung ="(90)".$var1."(01)".$var2."(10)".$var3."(17)".$var4."(21)".$var5;
                        $qrCode = (new QrCode($gabung))
                            ->setSize(170)
                            ->setMargin(5)
                            ->useForegroundColor(13, 13, 13);
                        $qrCode->writeFile('code.png'); // writer defaults to PNG when none is specified
                        header('Content-Type: '.$qrCode->getContentType());
                        $resp.='<div class="row">
                        <div class="col-3">
                        <img src="' . $qrCode->writeDataUri() . '">
                        </div>
                        <div class="col-4">
                        <table id="w0" class="table table-striped table-bordered detail-view"><tbody><tr><th>NIE</th><td>'.$var1.'</td></tr>
<tr><th>GTIN</th><td>'.$var2.'</td></tr>
<tr><th>LOT NO</th><td>'.$var3.'</td></tr>
<tr><th>EXP DATE</th><td>'.$var4.'</td></tr>
<tr><th>S / N</th><td>'.$var5.'</td></tr></tbody></table>
                        </div></div>';
                    }
                } else {
                    $resp.=$value." gagal diinput <br/>";
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
                <th>No</th>
                <th>QR DATA</th>
                <th>TIME STAMP</th>
            </thead>';
        $detail = Palletkardus::find()->where(['idpallet'=>$id])->all();
        $i=1;
        foreach($detail as $vie){
            $res .="<tr>";
            $res .="<td>".$i."</td>";
            $res .="<td>".$vie->carton->scan."</td>";
            $res .="<td>".$vie->tanggal."</td>";
            $res .="</tr>";
            $i++;
        }
        $res .="</table>";
        return $res;


    }

    /**
     * Creates a new Itempallet model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Itempallet();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itempallet",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itempallet",
                    'content'=>'<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' Itempallet '.Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itempallet",
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
     * Updates an existing Itempallet model.
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
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Itempallet #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Itempallet #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Itempallet #".$id,
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
     * Delete an existing Itempallet model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUploadcsv()
    {
        $model= new Csv3();
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
                $line=Line::findOne($model->linenm);
                $machine=Machine::findOne($model->machine);                
                $i++;
                $lot=$model->lot;
                $expire=$model->expired;
                $serial=substr($nie, 5,6).substr($lot,3,3);
                $cekserial=Itempallet::find()->where(['var_5'=>$serial.substr("0000001",-4)])->one();
                if($cekserial){
                     Yii::$app->session->setFlash('danger', 'S/N sudah pernah diinput');
                     return $this->redirect(['itemp/uploadcsv']);
                     die();
                }
                $mulai2=intval($model->jumlah);
                $job =new Itemmasterp();
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
                $kodesn=$serial. substr("000000".$mulai1,-4);
                $barang = New Itempallet();
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
                    $mdet= new Itemmasterpd();
                    $mdet->idmaster=$idmaster;
                    $mdet->iddetail=$barang->id;
                    $mdet->save();
                }
                    $transaction->commit();
                    $mulai1=$mulai1-1;
                    Yii::$app->session->setFlash('success', $mulai1.' rows Generate Success ');
                }
                catch(Exception $e)
                {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('danger', 'Failed import '.$e.getMessage());

                }
            return $this->redirect(['itemp/index']); 
        }
        // Yii::$app->session->setFlash('success', ' rows Success ');
        return $this->render('uploadcsva', [
        'model' => $model,
        ]);

    }
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
     * Delete multiple existing Itempallet model.
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
     * Finds the Itempallet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Itempallet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itempallet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
