<?php

namespace frontend\controllers;

use Yii;
use app\models\Itemcamera;
use app\models\ItemcameraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ItemcController implements the CRUD actions for Itemcamera model.
 */
class ItemcController extends Controller
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
     * Lists all Itemcamera models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ItemcameraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Itemcamera model.
     * @param integer $id
     * @return mixed
     */
     public function actionPrint($id)
    {
        $model=$this->findModel($id);
        if(isset($model)){
            $this->layout=false;
            return $this->render('viewpr', [
                'model' => $model,
//                'searchModel' => $searchModel,
//                'dataProvider' => $dataProvider,
            ]);

        }
    }
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Itemcamera #".$id,
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
     * Creates a new Itemcamera model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

     public function actionTable($id){
    $tab='<table class="table table-hover table-striped">
               <thead class="thead-dark">
                <th>No</th>
                <th>NIE</th>
                <th>GTIN</th>
                <th>LOT</th>
                <th>EXP DATE</th>
                <th>S/N</th>
                <th>Time Stamp</th>
                <th>status</th>
            </thead>';
        $i=1;
    $models=Itemmaster::findOne($id);
    foreach($models->detail as $value){
        $tab.="<tr><td>".$i."</td>";
        $tab.= "<td>".$value->itemd->var_1."</td>";
        $tab.= "<td>".$value->itemd->var_2."</td>";
        $tab.= "<td>".$value->itemd->var_3."</td>";
        $tab.= "<td>".$value->itemd->var_4."</td>";
        $tab.= "<td>".$value->itemd->var_5."</td>";
        $tab.= "<td>".$value->itemd->edit_date."</td>";
        $tab.= "<td>".$value->itemd->statusname."</td></tr>";
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
        $id=Itemmasterd::find()->where(['idmaster'=>$id])->orderBy(['id'=>SORT_ASC])->all();
        foreach ($id as $value){
            $model=$this->findModel($value->iddetail);
            if(isset($model))
            {
                $model->hitung=0;
                $model->gagal=0;
                $model->status=0;
                $model->save();
            }
            $value->status=0;
            $value->save();
        }
        return 'stop';
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


    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Itemcamera();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemcamera",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemcamera",
                    'content'=>'<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' Itemcamera '.Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Itemcamera",
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
     * Updates an existing Itemcamera model.
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
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Itemcamera #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Itemcamera #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Itemcamera #".$id,
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
     * Delete an existing Itemcamera model.
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
     * Delete multiple existing Itemcamera model.
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
     * Finds the Itemcamera model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Itemcamera the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itemcamera::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
