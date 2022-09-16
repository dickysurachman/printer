<?php
use app\models\Item;
use yii\helpers\Html;
use yii\web\View;
use app\models\Itemmaster;
use app\models\Itemmasterd;
$this->title = 'Dashboard';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$job=Itemmaster::find()->count();

$sukses=Itemmasterd::find()->where(['statusc'=>1])->count();
$gagal=Itemmasterd::find()->where(['statusc'=>2])->count();
$run=Itemmasterd::find()->count();
    if($run==0) $run=1;
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

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Congratulations!</h3>',
            ]) ?>
          
        </div>
    </div>
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
    <div class="count purple"><?php  echo $run//custom_echo($readrate,5); ?></div>
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
    <div class="row">
          <div class="col-md-6">

            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Stacked Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           

          </div>
          <!-- /.col (RIGHT) -->
        </div>
</div>


<script src="<?=Yii::$app->homeUrl?>/chart.js/Chart.min.js"></script>
<script>
  
</script>
