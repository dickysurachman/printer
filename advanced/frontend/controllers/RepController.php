<?php

namespace frontend\controllers;

use Yii;
use app\models\Machine;
use app\models\MachineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;


class RepController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMachine(){
        $searchModel = new MachineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexmachine', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionManager(){

    }
    public function actionEventlog(){
        
    }
    public function actionPassword(){
        
    }

}
