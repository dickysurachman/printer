<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemmasterpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Pallet Job List');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
$st=['20'=>'20','50'=>'50','100'=>'100','200'=>'200'];
?>
<style type="text/css">
    
    .table-info, .table-info>td, .table-info>th {
        background-color: white !important;
    }
</style>
<div class="itemmasterp-index">
     <?= Html::a(Yii::t('yii', 'Generate Job'), ['itemp/uploadcsv'], ['class' => 'btn btn-success']) ?>
    <?php  echo $this->render('_searchd', ['model' => $searchModel]); ?>
<?php                         
$form =ActiveForm::begin(['method' => 'get',]);
//echo Html::activeDropDownList($searchModel, 'numlimit',$st,['onChange'=>'this.form.submit()','data-pjax'=>1]);
//ActiveForm::end();

?>
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    //$form->field($model, 'status')->dropDownList($st).
                    //ActiveForm::begin(['method' => 'get',]).
                    //ActiveForm::end().
                    Html::activeDropDownList($searchModel, 'numlimit',$st,['onChange'=>'this.form.submit()','data-pjax'=>1]).
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
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="fa fa-trash"></i>&nbsp; '.Yii::t('yii2-ajaxcrud', 'Delete All'),
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
                                    'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm')
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php 

ActiveForm::end();
Modal::begin([
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
