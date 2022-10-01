<?php
use app\models\Item;
use yii\helpers\Html;
use yii\web\View;
use app\models\Itemmaster;
use app\models\Itemmasterd;
use app\models\Itemkardus;
use app\models\Itempallet;
use app\models\Kardusitem;
use app\models\Palletkardus;
use hscstudio\mimin\components\Mimin;
use scotthuangzl\googlechart\GoogleChart;
$this->title = 'Dashboard';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$job=Itemmaster::find()->count();

$sukses=Itemmasterd::find()->where(['statusc'=>1])->count();
$gagal=Itemmasterd::find()->where(['statusc'=>2])->count();
$run=Itemmasterd::find()->count();

$karton=Itemkardus::find()->count();
$pallet=Itempallet::find()->count();
$itemkarton=Kardusitem::find()->count();
$kartonpallet=Palletkardus::find()->count();


$kartonall=Itemkardus::find()->all();
$kartonfinish=0;
$kartonprogress=0;
foreach($kartonall as $val){
  if($val->statusjob=='Done') {
    $kartonfinish++;
  } else {
    $kartonprogress++;
  }
}

$palletall=Itempallet::find()->all();
$palletfinish=0;
$palletprogress=0;
foreach($palletall as $vall){
  if($vall->statusjob=='Done') {
    $palletfinish++;
  } else {
    $palletprogress++;
  }
}


//$script = <<< JS JS;
$script= "$(document).ready(function(){
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.


    var areaChartData = {
      labels  : ['Total', 'PASS', 'FAIL'],
      datasets: [
        {
          label               : 'Bar Grafik',
          backgroundColor     : '#28a745',
          borderColor         : '#28a745',
          pointRadius          : false,
          pointColor          : '#28a745',
          pointStrokeColor    : '#28a745',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: '#28a745',
          data                : [".$run.", ".$sukses.", ".$gagal."]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
  

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
 

    var donutData1 = {
      labels: [
          'Total Count',
          'PASS',
          'FAIL',
      ],
      datasets: [
        {
          data: [".$run.",".$sukses.",".$gagal."],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
      ]
    }
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData1;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0
 
    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }
    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })  
})"; 
//JS;
$this->registerJs($script, View::POS_END);
if($run==0) $run=1;
?>
<style type="text/css">
    .tile_count {
    margin-bottom: 20px;
    margin-top: 20px
}
.tile_count .tile_stats_count {
    border-bottom: 1px solid #D9DEE4;
    padding: 0 10px 0 20px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    position: relative
}
@media (min-width: 992px) {
    footer {
        margin-left: 230px
    }
}
@media (min-width: 992px) {
    .tile_count .tile_stats_count {
        margin-bottom: 10px;
        border-bottom: 0;
        padding-bottom: 10px
    }
}
.tile_count .tile_stats_count:before {
    content: "";
    position: absolute;
    left: 0;
    height: 65px;
    border-left: 2px solid #ADB2B5;
    margin-top: 10px
}
@media (min-width: 992px) {
    .tile_count .tile_stats_count:first-child:before {
        border-left: 0
    }
}
.tile_count .tile_stats_count .count {
    font-size: 30px;
    line-height: 47px;
    font-weight: 600
}
@media (min-width: 768px) {
    .tile_count .tile_stats_count .count {
        font-size: 40px
    }
}
@media (min-width: 992px) and (max-width: 1100px) {
    .tile_count .tile_stats_count .count {
        font-size: 30px
    }
}
.tile_count .tile_stats_count span {
    font-size: 12px
}
@media (min-width: 768px) {
    .tile_count .tile_stats_count span {
        font-size: 13px
    }
}
.tile_count .tile_stats_count .count_bottom i {
    width: 12px
}
.x_panel {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
    padding: 10px 17px;
    display: inline-block;
    background: #fff;
    border: 1px solid #E6E9ED;
    -webkit-column-break-inside: avoid;
    -moz-column-break-inside: avoid;
    column-break-inside: avoid;
    opacity: 1;
    transition: all .2s ease
}
.x_content {
    padding: 0 5px 6px;
    position: relative;
    width: 100%;
    float: left;
    clear: both;
    margin-top: 5px
}
.blue {
    color: #3498DB
}
.purple {
    color: #9B59B6
}
.green {
    color: #1ABB9C
}
.aero {
    color: #9CC2CB
}
.red {
    color: #E74C3C
}
.dark {
    color: #34495E
}
</style>
<?php 
if(Mimin::checkRoute('job/index'))
{
  ?>
<div class="container-fluid">
    <h4>Serialization and Inspection</h4>
    <?php 
    
    date_default_timezone_set("Asia/Bangkok");

    $time=date("Y-m-d h:i");
    ?>
    <div class="row">
    <div class="x_panel x_content">
    <div class="tile_count row">
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-check"></i> Total Job</span>
    <div class="count green"><?php echo $job//echo $totalread; ?></div>
    <span class="count_bottom">Updated: <?php echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-remove"></i> PASS</span>
    <div class="count red"><?php echo $sukses //echo $totalreject; ?></div>
    <span class="count_bottom">Updated: <?php echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-camera"></i> FAIL</span>
    <div class="count blue"><?php echo $gagal//echo $totaltrigger; ?></div>
    <span class="count_bottom">Updated: <?php echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-check"></i> TOTAL ITEM</span>
    <div class="count purple"><?php  
    $run1=Itemmasterd::find()->count();
    echo $run1;
          ?></div>
    <span class="count_bottom">Updated: <?php echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-remove"></i> Success Presentation</span>
    <div class="count aero"><?php echo number_format(($sukses/$run)*100)//custom_echo($rejectrate,5); ?>%</div>
    <span class="count_bottom">Updated: <?php echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-bullseye"></i> Failure Presentation </span>
    <div class="count red"><?php echo number_format(($gagal/$run)*100)//echo $sensorreject; ?>%</div>
    <span class="count_bottom">Updated: <?php echo $time; ?></span>
    </div>
    </div>
    </div>
    </div>
    
</div>
<div class="card-body card card-primary card-outline">
            <h4>Serialization and Inspection Graph </h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Pie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Line</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Bar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-gauge-tab" data-toggle="pill" href="#custom-content-gauge-messages" role="tab" aria-controls="custom-content-gauge-messages" aria-selected="false">Gauge</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                      <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="tab-pane fade" id="custom-content-gauge-messages" role="tabpanel" aria-labelledby="custom-content-below-gauge-tab">
              <?php 
                echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
                    'data' => array(
                        array('Label', 'Value'),
                        array('TOTAL', intval($run)),
                        array('PASS', intval($sukses)),
                        array('FAIL', intval($gagal)),
                    ),
                    'options' => array(
                        'width' => '100%',
                        'height' => 250,
                        'redFrom' => 90,
                        'redTo' => 100,
                        'yellowFrom' => 75,
                        'yellowTo' => 90,
                        'minorTicks' => 5
                    )
                ));           
                ?>

              </div>
             
            </div>
           
           
            
          </div>
<?php 

} 

iif(Mimin::checkRoute('jobkardus/index')){
?>


<h3>Carton Aggregation</h3>
<div class="row">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bolt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Carton Aggregation</span>
                <span class="info-box-number">
                  <?=$karton?>
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-code"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Item on Carton</span>
                <span class="info-box-number"><?=$itemkarton?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
         
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Carton Finish</span>
                <span class="info-box-number">
                  <?=$kartonfinish?>
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-eye"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Carton On Progress</span>
                <span class="info-box-number"><?=$kartonprogress?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <!-- /.col -->
        </div>





<div class="card-body card card-primary card-outline">
            <h4>Aggregation Carton Graph </h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab1" data-toggle="pill" href="#custom-content-below-home1" role="tab" aria-controls="custom-content-below-home1" aria-selected="true">Pie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab1" data-toggle="pill" href="#custom-content-below-profile1" role="tab" aria-controls="custom-content-below-profile1" aria-selected="false">Line</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab1a" data-toggle="pill" href="#custom-content-below-profile1a" role="tab" aria-controls="custom-content-below-profile1a" aria-selected="false">Bar Chart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-gauge-tab1" data-toggle="pill" href="#custom-content-gauge-messages1" role="tab" aria-controls="custom-content-gauge-messages1" aria-selected="false">Gauge</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home1" role="tabpanel" aria-labelledby="custom-content-below-home-tab1">
                <?php
                echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => array(
                    array('Label', 'Value'),
                    array('Total', intval($karton)),
                    array('Finish', intval($kartonfinish)),
                    array('On Progress', intval($kartonprogress))
                ),
                'options' => array('title' => 'Pie Chart Carton Aggregation','height'=>350)));
                ?>


              </div>
              <div class="tab-pane fade" id="custom-content-below-profile1" role="tabpanel" aria-labelledby="custom-content-below-profile-tab1">
                   <?php 

                echo GoogleChart::widget(array('visualization' => 'LineChart',
                                'data' => array(
                                    array('Label', 'Value',['role'=>'style']),
                                    array('Aggregation', intval($karton),"#28a745"),
                                    array('Finish', intval($kartonfinish),"#28a745"),
                                    array('On Progress', intval($kartonprogress),"#28a745")
                                ),
                                'options' => array('title' => 'Line Chart Carton Aggregation','height'=>350,'legend'=>['position'=>'none'])));
                    


                   ?>
              </div>  
              <div class="tab-pane fade" id="custom-content-below-profile1a" role="tabpanel" aria-labelledby="custom-content-below-profile-tab1a">
                   <?php 
                    echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                'data' =>  array(
                                    array('Label', 'Value',['role'=>'style']),
                                    array('Total', intval($karton),"#28a745"),
                                    array('Finish', intval($kartonfinish),"#28a745 "),
                                    array('On Progress', intval($kartonprogress),"#28a745")
                                ),
                'options' => array('title' => 'Bar Chart Carton Aggregation','height'=>350,'legend'=>['position'=>'none']))); 


                   ?>
              </div>
             
              <div class="tab-pane fade" id="custom-content-gauge-messages1" role="tabpanel" aria-labelledby="custom-content-below-gauge-tab1">
              <?php 
                echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
                    'data' => array(
                        array('Label', 'Value'),
                        array('Total', intval($karton)),
                        array('Finish', intval($kartonfinish)),
                        array('On Progress', intval($kartonprogress)),
                    ),
                    'options' => array(
                        'width' => '100%',
                        'height' => 250,
                        'redFrom' => 90,
                        'redTo' => 100,
                        'yellowFrom' => 75,
                        'yellowTo' => 90,
                        'minorTicks' => 5
                    )
                ));           
                ?>

              </div>
             
            </div>
          </div>

<?php }?>
<script src="<?=Yii::$app->homeUrl?>/chart.js/Chart.min.js"></script>

<?php if(Mimin::checkRoute('jobpaller/index')) { ?>
<h3>Pallet Aggregation</h3>
<div class="row">

           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clipboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pallet Aggregation</span>
                <span class="info-box-number"><?=$pallet?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
         
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Carton In Pallet</span>
                <span class="info-box-number"><?=$kartonpallet?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pallet Finish</span>
                <span class="info-box-number"><?=$palletfinish?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-folder-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pallet on Progress</span>
                <span class="info-box-number"><?=$palletprogress?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
<div class="card-body card card-primary card-outline">
            <h4>Aggregation Pallet Graph </h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab2" data-toggle="pill" href="#custom-content-below-home2" role="tab" aria-controls="custom-content-below-home2" aria-selected="true">Pie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab2" data-toggle="pill" href="#custom-content-below-profile2" role="tab" aria-controls="custom-content-below-profile2" aria-selected="false">Line</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab2a" data-toggle="pill" href="#custom-content-below-profile2a" role="tab" aria-controls="custom-content-below-profile1a" aria-selected="false">Bar Chart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-gauge-tab2" data-toggle="pill" href="#custom-content-gauge-messages2" role="tab" aria-controls="custom-content-gauge-messages2" aria-selected="false">Gauge</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home2" role="tabpanel" aria-labelledby="custom-content-below-home-tab2">
                <?php
                echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => array(
                    array('Label', 'Value'),
                    array('Total', intval($pallet)),
                    array('Finish', intval($palletfinish)),
                    array('On Progress', intval($palletprogress))
                ),
                'options' => array('title' => 'Pie Chart Pallet Aggregation','height'=>350)));
                ?>


              </div>
              <div class="tab-pane fade" id="custom-content-below-profile2" role="tabpanel" aria-labelledby="custom-content-below-profile-tab2">
                   <?php 

                echo GoogleChart::widget(array('visualization' => 'LineChart',
                                'data' => array(
                                    array('Label', 'Value',['role'=>'style']),
                                    array('Total', intval($pallet),"#28a745"),
                                    array('Finish', intval($palletfinish),"#28a745"),
                                    array('On Progress', intval($palletprogress),"#28a745")
                                ),
                                'options' => array('title' => 'Line Chart Pallet Aggregation','height'=>350,'legend'=>['position'=>'none'])));
                    


                   ?>
              </div>  
              <div class="tab-pane fade" id="custom-content-below-profile2a" role="tabpanel" aria-labelledby="custom-content-below-profile-tab2a">
                   <?php 

                echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                                'data' => array(
                                    array('Label', 'Value',['role'=>'style']),
                                    array('Total', intval($pallet),"#28a745"),
                                    array('Finish', intval($palletfinish),"#28a745"),
                                    array('On Progress', intval($palletprogress),"#28a745")
                                ),
                                'options' => array('title' => 'Bar Chart Pallet Aggregation','height'=>350,'legend'=>['position'=>'none'])));
                    


                   ?>
              </div>
             
              <div class="tab-pane fade" id="custom-content-gauge-messages2" role="tabpanel" aria-labelledby="custom-content-below-gauge-tab2">
              <?php 
                echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
                    'data' => array(
                        array('Label', 'Value'),
                        array('Total', intval($pallet)),
                        array('Finish', intval($palletfinish)),
                        array('On Progress', intval($palletprogress)),
                    ),
                    'options' => array(
                        'width' => '100%',
                        'height' => 250,
                        'redFrom' => 90,
                        'redTo' => 100,
                        'yellowFrom' => 75,
                        'yellowTo' => 90,
                        'minorTicks' => 5
                    )
                ));           
                ?>

              </div>
             
            </div>
          </div>

          <?php } ?>
