<?php

namespace frontend\controllers;


use Yii;
use app\models\Jobs;
use app\models\Itemmaster;
use app\models\Item;
use app\models\ItemSearch;

class LapController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReport(){
        $job = new Itemmaster;
        $request = Yii::$app->request;
        if($job->load($request->post()) && $job->validate()){
            //echo "ini di post";
            //die();
        }
        return $this->render('lap',['model'=>$job]);
    }

    public function actionReportsi(){
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reportsi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReportca(){
        
    }
    public function actionReportpl(){
        
    }

}
