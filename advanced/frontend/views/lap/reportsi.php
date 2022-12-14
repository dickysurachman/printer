<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Serialization & Inspection');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<style type="text/css">
    
    .table-info, .table-info>td, .table-info>th {
        background-color: white !important;
    }
</style>
<div class="item-index">
    

    <?php  echo $this->render('_searchdsi', ['model' => $searchModel]); ?>
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columnsi.php'),
            'toolbar'=> [
                ['content'=>
                    
                    Html::a('<i class="fa fa-redo"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-outline-success', 'title' => Yii::t('yii2-ajaxcrud', 'Reset Grid')]).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,    
            'responsiveWrap'=>false,      
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="fa fa-list"></i> <b>'.$this->title.'</b>',
                'before'=>'<em>* '.Yii::t('yii2-ajaxcrud', 'Resize Column').'</em>',
                'after'=>                      
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "clientOptions" => [
        "tabindex" => false,
        "backdrop" => "static",
        "keyboard" => false,
    ],
    "options" => [
        "tabindex" => false
    ]
])?>
<?php Modal::end(); ?>
<?php /*

BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="fa fa-trash"></i>&nbsp; '.Yii::t('yii2-ajaxcrud', 'Running All'),
                                ["runningdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Running'),
                                    'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Running Confirm')
                                ]),
                        ]). 


                        */ ?>