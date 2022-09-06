<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use denkorolkov\ajaxcrud\CrudAsset;
use denkorolkov\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Items');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="item-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="fas fa-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=>Yii::t('yii', 'Create new Items'),'class'=>'btn btn-secondary']).
                    Html::a('<i class="fas fa-redo"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-secondary', 'title'=>Yii::t('yii', 'Reset Grid')]).
                    '{toggleData}'.
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="fas fa-list-alt"></i> '.Yii::t('yii', 'Items listing'),
                'before'=>'<em>'.Yii::t('yii', '* Resize table columns just like a spreadsheet by dragging the column edges.').'</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttonText'=>'<span class="fas fa-arrow-right"></span>&nbsp;&nbsp;'.Yii::t('yii', 'With selected').'&nbsp;&nbsp;',
                            'buttons'=>Html::a('<i class="fas fa-trash"></i>&nbsp;'.Yii::t('yii', 'Delete All'),
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>Yii::t('yii', 'Are you sure?'),
                                    'data-confirm-message'=>Yii::t('yii', 'Are you sure want to delete this item')                                ]),
                        ]),
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