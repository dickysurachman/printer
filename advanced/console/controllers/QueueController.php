
<?php 
namespace console\controllers;

use yii\console\Controller;
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
use app\models\Paramsys;


class QueueController extends Controller
{

    public function actionData(){
        echo "Worker started...\n";
        date_default_timezone_set('Asia/Jakarta');
        while (true) {
$urlst = Yii::$app->homeUrl.'/item/status.html?id='.$models->id;
$url2 = Yii::$app->homeUrl.'/item/tablexx.html?id='.$models->id;
$url3 = Yii::$app->homeUrl.'/item/getjob.html?id='.$models->id;
$urlpass = Yii::$app->homeUrl.'/item/pass.html?id='.$models->id;
$urlfail = Yii::$app->homeUrl.'/item/fail.html?id='.$models->id;
$urltotal = Yii::$app->homeUrl.'/item/total.html?id='.$models->id;
$urlresume = Yii::$app->homeUrl.'/item/resume.html?id='.$models->id;
$urlprogress = Yii::$app->homeUrl.'/item/progress.html?id='.$models->id;
$urlstop = Yii::$app->homeUrl.'/item/stop.html?id='.$models->id;
$urlstopx = Yii::$app->homeUrl.'/item/stopx.html?id='.$models->id;
$urlreset = Yii::$app->homeUrl.'/item/reset.html?id='.$models->id;
$urlfailed = Yii::$app->homeUrl.'/item/failed.html?id='.$models->id;



        usleep(100000); // Delay 100ms
        }

      }

}