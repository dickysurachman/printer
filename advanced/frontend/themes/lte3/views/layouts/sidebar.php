<?php 
use hscstudio\mimin\components\Mimin;


?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=Yii::$app->homeUrl?>site/index.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php 
                if(!\Yii::$app->user->isGuest) echo \Yii::$app->user->identity->username;
                ?></a>
            </div>
        </div>

        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget(
                [
                'items' => [
                     [
                        'label' => 'Master Data',
                        'icon' => 'bookmark',
                        'items' => [
                    ['label' => \Yii::t('yii', 'Users'), 'url' => ['/userk/index'], 'icon' => 'user','visible'=>Mimin::checkRoute('userk/create')],
                     ['label' => \Yii::t('yii', 'Role'), 'url' => ['/mimin/role/index'], 'icon' => 'fas fa-bug','visible'=>Mimin::checkRoute('mimin/role')],
                    ['label' => \Yii::t('yii', 'Routes'), 'url' => ['/mimin/route/index'], 'icon' => 'fas fa-angle-double-right','visible'=>Mimin::checkRoute('mimin/route')],
                    ['label' => 'Master Machine', 'url'=>['/machine/index'],'icon' => 'microchip', 'visible' => Mimin::checkRoute('machine/index')],
                    ['label' => 'Master Line', 'url'=>['/line/index'],'icon' => 'bookmark', 'visible' => Mimin::checkRoute('machine/index')],
                    ['label' => 'Company', 'url'=>['/perusahaan/index'],'icon' => 'address-book', 'visible' => Mimin::checkRoute('perusahaan/index')],
                     ['label' => \Yii::t('yii', 'Master Product'), 'url' => ['/jobs/index'], 'icon' => 'file','visible'=>Mimin::checkRoute('jobs/index')],
                        ]
                    ],

                    [
                        'label' => 'Create Job',
                        'icon'=>'wrench',
                        'visible'=>Mimin::checkRoute('userk/delete'),
                        'items'=>[    
                        ['label' => \Yii::t('yii', 'Serialization & Inspection'), 'url' => ['/item/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('item/uploadcsv')],
                        ['label' => \Yii::t('yii', 'Carton Aggregation'), 'url' => ['/itemk/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('item/uploadcsv')],
                        ['label' => \Yii::t('yii', 'Pallet Aggregation'), 'url' => ['/itemp/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('item/uploadcsv')],

                        ]
                    ],
                    [
                        'label' => 'Send Job',
                        'icon'=>'folder',
                        'visible'=>Mimin::checkRoute('userk/delete'),
                        'items'=>[    
                        ['label' => \Yii::t('yii', 'Job Serialization & Inspection'), 'url' => ['/job/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('job/index')],
                        ['label' => \Yii::t('yii', 'Job Carton Aggregation'), 'url' => ['/jobkardus/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('jobkardus/index')],
                        ['label' => \Yii::t('yii', 'Job Pallet Aggregation'), 'url' => ['/jobpaller/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('jobpaller/index')],

                        ]
                    ],
                    [
                        'label' => 'Job List',
                        'icon'=>'wrench',
                        //'visible'=>(!Mimin::checkRoute('rep/manager') or !Mimin::checkRoute('userk/delete')),
                        'visible'=>Mimin::checkRoute('rep/manager') and !Mimin::checkRoute('userk/delete'),
                        'items'=>[    
                        ['label' => \Yii::t('yii', 'Job Serialization & Inspection'), 'url' => ['/job/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('job/index')],
                        ['label' => \Yii::t('yii', 'Job Carton Aggregation'), 'url' => ['/jobkardus/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('jobkardus/index')],
                        ['label' => \Yii::t('yii', 'Job Pallet Aggregation'), 'url' => ['/jobpaller/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('jobpaller/index')],

                        ]
                    ],
                    [
                        //'label' => 'Serialization & Inspection',
                        'label' => 'Job List',
                        'icon'=>'eye',
                        'visible'=>!Mimin::checkRoute('userk/delete') and !Mimin::checkRoute('rep/manager') ,
                        'items' => [
                        ['label' => \Yii::t('yii', 'Job List'), 'url' => ['/job/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('job/index')],
                        ['label' => \Yii::t('yii', 'Create Job'), 'url' => ['/item/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('item/uploadcsv')],
                        ['label' => 'Item Barcode', 'url'=>['/item/index'],'icon' => 'th', 'visible' => Mimin::checkRoute('item/index')],                    
                        ['label' => 'Printer Configuration', 'url'=>['/site/settingsave'],'icon' => 'link', 'visible' => !Yii::$app->user->isGuest],
                        ['label' => 'Camera Configuration', 'url'=>['/site/settingcamera'],'icon' => 'link', 'visible' => !Yii::$app->user->isGuest],
                        ]
                    ],
                    
                     [
                        //'label' => 'Carton Aggregation',
                        'label' => 'Job List',
                        'icon'=>'bolt',
                        'visible'=>!Mimin::checkRoute('userk/delete') and !Mimin::checkRoute('rep/manager') ,
                        'items' => [
                             ['label' => \Yii::t('yii', 'Box Job List'), 'url' => ['/jobkardus/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('jobkardus/index')],
                             ['label' => \Yii::t('yii', 'Aggregation Carton'), 'url' => ['/itemk/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('itemk/uploadcsv')],
                            ['label' => 'Item Kardus', 'url'=>['/itemk/index'],'icon' => 'code', 'visible' => Mimin::checkRoute('itemk/index')],
                        
                        ]
                    ],
                    [
                        //'label' => 'Pallet Aggregation',
                        'label' => 'Job List',
                        'icon'=>'clipboard',
                        'visible'=>!Mimin::checkRoute('userk/delete') and !Mimin::checkRoute('rep/manager') ,
                        'items' => [
                             ['label' => \Yii::t('yii', 'Pallet Job List '), 'url' => ['/jobpaller/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('jobpaller/index')],
                             ['label' => \Yii::t('yii', 'Aggregation Pallet'), 'url' => ['/itemp/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('itemp/uploadcsv')],
                            ['label' => 'Item Pallet', 'url'=>['/itemp/index'],'icon' => 'folder', 'visible' => Mimin::checkRoute('itemp/index')],
                        
                        ]
                    ],
                    ['label' => \Yii::t('yii', 'Status Machine'), 'url' => ['/rep/machine'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('rep/machine')],
                    ['label' => 'Report Log Job', 'url'=>'#','icon' => 'print', 
                        'items' => [
                            ['label' => \Yii::t('yii', 'Global by Line '), 'url' => ['/lap/report'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('lap/report')],
                            ['label' => \Yii::t('yii', 'Serialization & Inspection'), 'url' => ['/lap/reportsi'], 'icon' => 'eye','visible'=>Mimin::checkRoute('lap/reportsi')],
                            ['label' => \Yii::t('yii', 'Carton Aggregation '), 'url' => ['/lap/reportca'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('lap/reportca')],
                            ['label' => \Yii::t('yii', 'Pallet Aggregation'), 'url' => ['/lap/reportpl'], 'icon' => 'folder','visible'=>Mimin::checkRoute('lap/reportpl')],

                        ],
                    ],
                   
                    ['label' => 'Event Log', 'url'=>['/loge/index'],'icon' => 'spinner', 'visible' => !Mimin::checkRoute('rep/eventlog')
                        ,'items' => [
                            ['label' => 'Log Error Printer', 'url'=>['/loge/index'],'icon' => 'spinner', 'visible' => Mimin::checkRoute('loge/index')],
                             ['label' => 'Log Camera', 'url'=>['/log/index'],'icon' => 'download', 'visible' => Mimin::checkRoute('job/index')],
 
                        ]
                    ],
                    
                    ['label' => \Yii::t('yii', 'Login'), 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => \Yii::t('yii', 'Change Password'), 'url' => ['site/password'], 'icon' => 'key', 'visible' => !Yii::$app->user->isGuest],
                    ['label' =>  \Yii::t('yii', 'Logout'),'url' => ['site/logout'],'template'=>'<a class="nav-link" href="{url}" data-method="post"><i class="nav-icon fas fa-sign-in-alt"></i>{label}</a>','icon' => 'sign-in-alt', 'visible' => !Yii::$app->user->isGuest]

                ]
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>