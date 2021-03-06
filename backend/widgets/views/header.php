<header class="navbar navbar-default navbar-fixed-top">
    <!-- Right Header Navigation -->
    <ul class="nav header-nav pull-right">
        <li class="dropdown">
            <a href="<?= \Yii::$app->urlManagerBackend->createUrl('site/settings'); ?>">
                <i class="fa fa-cogs"></i>
            </a>
        </li>
        <li>
            <a href="<?= \Yii::$app->urlManagerBackend->createUrl('site/logout'); ?>" data-method="post">
                <i class="fa fa-power-off"></i>
            </a>
        </li>
    </ul>
    <!-- END Right Header Navigation -->

    <!-- Left Header Navigation -->
    <ul class="nav header-nav pull-left">
        <li>
            <a href="javascript:void(0)" id="sidebar-left-toggle">
                <i class="fa fa-bars"></i>
            </a>
        </li>
    </ul>
    <!-- END Left Header Navigation -->

    <!-- Header Brand -->
    <a href="<?= \Yii::$app->urlManagerBackend->createUrl('site/index'); ?>" class="navbar-brand">
        <img src="<?= Yii::$app->request->baseUrl ?>/img/drop.png" alt="Kato">
        <span><?= \Yii::$app->kato->setting('site_name'); ?></span>
    </a>
    <!-- END Header Brand -->
</header>
<!-- END Header -->