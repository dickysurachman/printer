<style type="text/css">
   .disabled {
      display: none !important;
   }
</style>

<?php
   use yii\widgets\ListView;
   echo $this->render('_searchd', ['model' => $searchModel]); 
   echo ListView::widget([
      'dataProvider' => $dataProvider,
      'itemView' => 'view',
      'pager' => [
            'linkContainerOptions'=>['class'=>'page-item'],
            'linkOptions' => ['class' => 'page-link'],
            'lastPageCssClass'=>'last',
                  ], 
   ]);
   
?>
