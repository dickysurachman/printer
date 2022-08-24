<?php

namespace frontend\controllers;

use Yii;
use app\models\Item;
use app\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

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
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
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
                    $satuj=$lsatu;
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
                    $duaj=$ldua;
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
                        $tigaj=$ltiga;
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
                        $empatj=$lempat;
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
                        $limaj=$llima;
                    }
                    $x="";
                    $y=str_split($dlima,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $limaj=" ".$limaj .$x." ";
                }

                $jum2=dechex($angka1);
                $jum1=dechex($angka2);
                $jadi1="00 00 00 00 00";
                $jadi1a="00 64 00";
                $jadi2="00 cf 00 00 00 00";
                $jadi3="";
                for($i=0;$i<=17;$i++){
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
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Create New')." Item",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
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
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
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
                    $satuj=$lsatu;
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
                    $duaj=$ldua;
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
                        $tigaj=$ltiga;
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
                        $empatj=$lempat;
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
                        $limaj=$llima;
                    }
                    $x="";
                    $y=str_split($dlima,2);
                    foreach($y as $z){
                        $x=$x." ".$z;
                    }
                    $limaj=" ".$limaj .$x." ";
                }

                $jum2=dechex($angka1);
                $jum1=dechex($angka2);
                $jadi1="00 00 00 00 00";
                $jadi1a="00 64 00";
                $jadi2="00 cf 00 00 00 00";
                $jadi3="";
                for($i=0;$i<=17;$i++){
                    $jadi3=$jadi3."00 ";
                }
                $jadi3=" ".$jadi3;
                //$jadi3="00 00 00 00 00 00 00 00 00 00 00 00 00 00 00";
                //$jadi3="00 00 00 00 00 00 00 00 00 00 00 00 00 00 00";
                //$jadi=$jadi1." ".$jum1." ".$jadi1a." ".$jum2." ".$jadi2." ".$satuj.$duaj.$tigaj.$empatj.$limaj.$jadi3;
                $jadi=$jadi1." ".$jum1." ".$jadi1a." ".$jum2." ".$jadi2." ".$satuj.$duaj.$tigaj.$empatj.$limaj.$jadi3;
                $model->biner=$jadi;
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Item #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('yii2-ajaxcrud', 'Update')." Item #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
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
