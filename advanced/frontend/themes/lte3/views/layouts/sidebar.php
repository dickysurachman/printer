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
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

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
                        'label' => 'Serialization & Inspection',
                        'icon'=>'eye',
                        'items' => [
                        ['label' => \Yii::t('yii', 'Job List'), 'url' => ['/job/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('job/index')],
                        ['label' => \Yii::t('yii', 'Create Job'), 'url' => ['/item/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('job/index')],
                        ['label' => 'Item Barcode', 'url'=>['/item/index'],'icon' => 'th', 'visible' => Mimin::checkRoute('item/index')],
                        ]
                    ],
                    
                     [
                        'label' => 'Carton Aggregation',
                        'icon'=>'bolt',
                        'items' => [
                             ['label' => \Yii::t('yii', 'Box Job List'), 'url' => ['/jobkardus/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('job/index')],
                             ['label' => \Yii::t('yii', 'Aggregation Carton'), 'url' => ['/itemk/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('job/index')],
                            ['label' => 'Item Kardus', 'url'=>['/itemk/index'],'icon' => 'code', 'visible' => Mimin::checkRoute('itemk/index')],
                        
                        ]
                    ],
                    [
                        'label' => 'Pallet Aggregation',
                        'icon'=>'clipboard',
                        'items' => [
                             ['label' => \Yii::t('yii', 'Pallet Job List '), 'url' => ['/jobpaller/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('job/index')],
                             ['label' => \Yii::t('yii', 'Aggregation Pallet'), 'url' => ['/itemp/uploadcsv'], 'icon' => 'bolt','visible'=>Mimin::checkRoute('job/index')],
                            ['label' => 'Item Pallet', 'url'=>['/itemp/index'],'icon' => 'folder', 'visible' => Mimin::checkRoute('itemp/index')],
                        
                        ]
                    ],
                    
                    
                    ['label' => 'Printer Configuration', 'url'=>['/site/settingsave'],'icon' => 'link', 'visible' => !Yii::$app->user->isGuest],
                    //['label' => 'Connect to Printer', 'url'=>['/site/eksekusi'],'target'=>'_blank','icon' => 'print', 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Log Error Printer', 'url'=>['/loge/index'],'icon' => 'spinner', 'visible' => Mimin::checkRoute('loge/index')],
                     //['label' => \Yii::t('yii', 'Job Scan'), 'url' => ['/jobscan/index'], 'icon' => 'clipboard','visible'=>Mimin::checkRoute('job/index')],
                     //['label' => \Yii::t('yii', 'Aggregation Case Carton'), 'url' => ['/jobscan/aggregation'], 'icon' => 'file','visible'=>Mimin::checkRoute('job/index')],
                    ['label' => 'Camera Configuration', 'url'=>['/site/settingcamera'],'icon' => 'link', 'visible' => !Yii::$app->user->isGuest],
                    //['label' => 'Server Camera', 'url'=>Yii::$app->homeUrl.'/servercamera.py','target'=>'_blank','icon' => 'camera-retro', 'visible' => !Yii::$app->user->isGuest],
                    //['label' => 'Server Camera', 'url'=>['/site/scan'],'target'=>'_blank','icon' => 'camera-retro', 'visible' => !Yii::$app->user->isGuest],
                    //['label' => 'Input Barcode', 'url'=>['/site/scanm2'],'icon' => 'barcode', 'visible' => Mimin::checkRoute('site/scanm2')],
                    //['label' => 'Camera Monitoring', 'url'=>['/site/cameralive'],'icon' => 'eye', 'visible' => Mimin::checkRoute('site/cameralive')],
                    ['label' => 'Log Camera', 'url'=>['/log/index'],'icon' => 'download', 'visible' => Mimin::checkRoute('job/index')],
                    //['label' => 'Data Scan', 'url'=>['/itemc/index'],'icon' => 'book', 'visible' => Mimin::checkRoute('itemc/index')],
                    ['label' => \Yii::t('yii', 'Login'), 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => \Yii::t('yii', 'Change Password'), 'url' => ['site/password'], 'icon' => 'key', 'visible' => !Yii::$app->user->isGuest],
                    ['label' =>  \Yii::t('yii', 'Logout'),'url' => ['site/logout'],'template'=>'<a class="nav-link" href="{url}" data-method="post"><i class="nav-icon fas fa-sign-in-alt"></i>{label}</a>','icon' => 'sign-in-alt', 'visible' => !Yii::$app->user->isGuest]

                    /*
                    ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    ['label' => 'Level1'],
                    [
                        'label' => 'Level1',
                        'items' => [
                            ['label' => 'Level2', 'iconStyle' => 'far'],
                            [
                                'label' => 'Level2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Level2', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Level1'],
                    ['label' => 'LABELS', 'header' => true],
                    ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                    */
                ]
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>