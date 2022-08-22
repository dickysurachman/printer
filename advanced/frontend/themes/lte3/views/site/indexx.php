<?php
use app\models\Visit;
use app\models\Project;
use app\models\Costumer;
use app\models\User;
use scotthuangzl\googlechart\GoogleChart;

$chart=@vendor."/almasaeed2010/adminlte/plugins/chart.js/Chart.js";
$chartcss=@vendor."/almasaeed2010/adminlte/plugins/chart.js/Chart.css";


$this->title = 'Dashboard';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$tgls=date('Y',time());
$visit=Visit::find()->count();
$project=Project::find()->count();
$costumer=Costumer::find()->count();
$user=User::find()->count()-1;
$usera=User::find()->where(['status'=>10])->count()-1;
?>

<link rel='stylesheet' href='<?php echo $chartcss?>'>    
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Welcome '.Yii::$app->user->identity->username.' </h3>',
            ]) ?>
            
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Jumlah Costumer',
                'number' => $costumer,
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Jumlah Project',
                'number' => $project,
                 'theme' => 'success',
                'icon' => 'far fa-flag',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Visit',
                'number' => $visit,
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div>

    
    <div class="row">
  
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => $user,
                'text' => 'User Registered',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) ?>
             <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id.'-ribbon',
                'text' => 'Registered',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
  
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $usera,
                'text' => 'User Approve',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                //'loadingStyle' => true
            ]) ?>
        </div> 
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $user - $usera,
                'text' => 'User Waiting Approve',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>
    <div class="row">
        
        <?php 
         
  $haa=Yii::$app->db->createCommand("Select month(tanggal) as nama,sum(jumlah) as rns from project where year(tanggal)=".$tgls. " group by month(tanggal) order by nama ")->queryAll();
    $i=0;
    $itemx[$i][]="Nama";
    $itemx[$i][]="Revenue";
    $i=1;
    //$item=["Task","Hours per Day"];
    foreach ($haa as $keya) {
        $itemx[$i][]=$keya['nama'];
        $itemx[$i][]=(int)$keya['rns'];
        //$item[]=[$keya['nama'],intval($keya['rev'])];
        $i++;
    }
    echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                'data' => $itemx,
                'options' => array('title' => 'Revenue '.$tgls,'hAxis' => array('title' => 'Month'),))); 
    

    echo GoogleChart::widget(array('visualization' => 'BarChart',
                'data' => array(
                    array('Task', 'Hours per Day'),
                    array('Work', 11),
                    array('Eat', 2),
                    array('Commute', 2),
                    array('Watch TV', 2),
                    array('Sleep', 7)
                ),
                'options' => array('title' => 'My Daily Activity')));
    
          /*echo GoogleChart::widget(array('visualization' => 'LineChart',
                'data' => array(
                    array('Month', 'Amount'),
                    array( 'Jan 2022',1000000),
                    array( 'Feb 2022',2000000),
                    array( 'Mar 2022',1300000),
                    array( 'Apr 2022',1800000),
                        ),
                'options' => array('title' => 'Revenue '))); 
            */
              
        ?>

    </div>
</div>