<?php

namespace frontend\controllers;

use Yii;
use app\models\Itemmasterscan;
use app\models\ItemmasterscanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use frontend\models\Csv;
use app\models\Jobs;
use app\models\Line;
use app\models\Machine;
use app\models\Item;
use app\models\Scanlog;
/**
 * JobscanController implements the CRUD actions for Itemmasterscan model.
 */
class JobscanController extends Controller
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
     * Lists all Itemmasterscan models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ItemmasterscanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Itemmasterscan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Itemmasterscan #".$id,
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

     public function actionAggregation()
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
                $job =new Itemmasterscan();
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
                
                    $transaction->commit();
                    //$mulai1 = $mulai1-1;
                    Yii::$app->session->setFlash('success', 'Generate Success ');
                }
                catch(Exception $e)
                {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('danger', 'Failed import '.$e.getMessage());

                }
            return $this->redirect(['jobscan/index']); 
        }
        // Yii::$app->session->setFlash('success', ' rows Success ');
        return $this->render('uploadcsva', [
        'model' => $model,
        ]);

    }


    public function actionStart($id)
    {
        $models=$this->findModel($id);
        $model=Item::find()->one();
        $barcode= new Scanlog();
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
                $jj=new Scanlog();
                $jj->scan=$value;
                if($jj->save()) {
                    $resp.=$value." berhasil diinput <br/>";
                    $item=$value;
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
        
        if(isset($model)){
            //$this->layout=false;
            return $this->render('serial', [
                'model' => $model,
                'models' => $models,
                'barcode'=>$barcode
            ]);

        }
    }

    /**
     * Creates a new Itemmasterscan model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Itemmasterscan();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemmasterscan",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemmasterscan",
                    'content'=>'<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' Itemmasterscan '.Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemmasterscan",
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
     * Updates an existing Itemmasterscan model.
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
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Itemmasterscan #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Itemmasterscan #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Itemmasterscan #".$id,
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
     * Delete an existing Itemmasterscan model.
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
     * Delete multiple existing Itemmasterscan model.
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
     * Finds the Itemmasterscan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Itemmasterscan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itemmasterscan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
