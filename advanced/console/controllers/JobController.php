
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


class JobController extends Controller
{

    public function actionData(){
        echo "Worker started...\n";
        date_default_timezone_set('Asia/Jakarta');
        while (true) {

        usleep(100000); // Delay 100ms
        }

      }

}