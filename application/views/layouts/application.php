<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->config->item('app_name_short'); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php echo link_tag('plugins/bootstrap/css/bootstrap.min.css'); ?>
    <?php echo link_tag('plugins/admin-lte/css/AdminLTE.min.css'); ?>
    <?php echo link_tag('plugins/admin-lte/css/skins/skin-red.min.css'); ?>
    <?php echo link_tag('plugins/font-awesome/css/font-awesome.min.css'); ?>
    <?php echo link_tag('plugins/ionicons/css/ionicons.min.css'); ?>
    <?php echo link_tag('plugins/bootstrap-table/bootstrap-table.min.css'); ?>
    <?php echo link_tag('plugins/bootstrap-table/extensions/sticky-header/bootstrap-table-sticky-header.css'); ?>
    <?php echo link_tag('plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'); ?>
    <?php echo link_tag('plugins/icheck/skins/square/_all.css'); ?>
    <?php echo link_tag('plugins/ekko-lightbox/ekko-lightbox.css'); ?>
    <?php echo link_tag('css/styles.min.css'); ?>
</head>

<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <a href="/" class="logo">
                <span class="logo-mini"><?php echo $this->config->item('app_name_short'); ?></span>
                <span class="logo-lg"><?php echo $this->config->item('app_name'); ?></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span id="notification_nums" class="label label-default">0</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header text-center"><b><span id="notification_nums2">0</span></b>
                                    <?php echo lang('Unread_notifications'); ?>
                                </li>
                                <li class="footer">
                                    <?php echo anchor('/', lang('View_all')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#">
                                <i class="fa fa-shopping-basket"></i>
                                <span class="label label-default">0</span>
                            </a>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo img('img/no-photo.jpg', false, ['alt' => 'User Image', 'class' => 'user-image']); ?>
                                <span class="hidden-xs">John Doe</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <?php echo img('img/no-photo.jpg', false, ['alt' => 'User Image', 'class' => 'img-circle']); ?>
                                    <p>John Doe <small>Admin</small></p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <?php echo anchor('/', '<i class="fa fa-user"></i> ' . lang('My_account'), 'class="btn btn-default btn-flat"'); ?>
                                    </div>
                                    <div class="pull-right">
                                        <?php echo anchor('/', '<i class="fa fa-sign-out"></i> ' . lang('Sign_out'), 'class="btn btn-default btn-flat"'); ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <?php echo form_open('search', 'method="get" class="sidebar-form"'); ?>
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="<?php echo lang('Search'); ?>...">
                    <span class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <?php echo form_close(); ?>
                <ul class="sidebar-menu">
                    <li class="header"><?php echo lang('MAIN_MENU'); ?></li>
                    <li><?php echo anchor('/', '<i class="fa fa-home fa-fw"></i> <span>' . lang('Home') . '</span>'); ?></li>
                    <li><?php echo anchor('/', '<i class="fa fa-shopping-basket fa-fw"></i> <span>' . lang('Products') . '</span>'); ?></li>
                    <li><?php echo anchor('/', '<i class="fa fa-shopping-cart fa-fw"></i> <span>' . lang('Orders') . '</span>'); ?></li>
                    <li class="header"><?php echo lang('DISTRIBUTION_CENTER'); ?></li>
                    <li><?php echo anchor('/', '<i class="fa fa-truck fa-fw"></i> <span>' . lang('Deliveries') . '</span>'); ?></li>
                    <li><?php echo anchor('/', '<i class="fa fa-plane fa-fw"></i> <span>' . lang('Shipments') . '</span>'); ?></li>
                    <li class="header"><?php echo lang('OTHER_MENU'); ?></li>
                    <li><?php echo anchor('/', '<i class="fa fa-users fa-fw"></i> <span>' . lang('Users') . '</span>'); ?></li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <?php echo $yield; ?>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                Created by
                <?php echo mailto('msx@csds.com', 'MSX'); ?>
            </div>
            <strong>Copyright &copy; <?php echo date('Y'); ?> <?php echo anchor('#', 'Name'); ?></strong> All rights reserved.
        </footer>
    </div>
    <script src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/admin-lte/js/adminlte.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bootstrap-notify/bootstrap-notify.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/ekko-lightbox/ekko-lightbox.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bootstrap-3-typeahead/bootstrap3-typeahead.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/moment/moment-with-locales.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bootstrap-table/bootstrap-table.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bootstrap-table/bootstrap-table-locale-all.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bootstrap-table/extensions/export/bootstrap-table-export.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bootstrap-table/extensions/cookie/bootstrap-table-cookie.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/bootstrap-table/extensions/sticky-header/bootstrap-table-sticky-header.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/tableexport.jquery.plugin/tableExport.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/icheck/icheck.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/application.min.js'); ?>"></script>
</body>

</html>