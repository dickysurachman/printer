<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
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
    <div class="row">
    <div class="x_panel x_content">
    <div class="tile_count row">
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-check"></i> Total Read</span>
    <div class="count green">0<?php //echo $totalread; ?></div>
    <span class="count_bottom">Updated: <?php //echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-remove"></i> Total Reject</span>
    <div class="count red">0<?php //echo $totalreject; ?></div>
    <span class="count_bottom">Updated: <?php //echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-camera"></i> Total Trigger</span>
    <div class="count blue">0<?php //echo $totaltrigger; ?></div>
    <span class="count_bottom">Updated: <?php //echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-check"></i> Read Rate</span>
    <div class="count purple">0<?php //custom_echo($readrate,5); ?>%</div>
    <span class="count_bottom">Updated: <?php //echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-remove"></i> Reject Rate</span>
    <div class="count aero">0<?php //custom_echo($rejectrate,5); ?>%</div>
    <span class="count_bottom">Updated: <?php //echo $time; ?></span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
    <span class="count_top"><i class="fa fa-bullseye"></i> Sensor Reject</span>
    <div class="count red">0<?php //echo $sensorreject; ?></div>
    <span class="count_bottom">Updated: <?php //echo $time; ?></span>
    </div>
    </div>
    </div>
    </div>

</div>