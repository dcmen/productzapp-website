<?php 
if($this->Session->read('Auth.User.is_admin') != 1){
    header("Location: ".  $this->Html->Url("/admin"));
    die();
}
?>
<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="<?php echo $this->webroot; ?>images/ic_logo_login.png" />
        <title>ProductZapp</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <?php
        echo $this->Html->css(
            array(
                'bootstrap.min',
                'font-awesome.min',
                'themes.min',
                'pixel-admin.min',
                'alert',
                'widgets.min',
                'pages.min',
                'rtl.min',
                'themes.min',
                'tablesort',
                'bootstrap-tagsinput',
                'cz/nprogress/nprogress',
                'cz/iCheck/skins/flat/green',
                'cz/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min',
                'cz/jqvmap/dist/jqvmap.min',
                'cz/bootstrap-daterangepicker/daterangepicker',
                'cz/custom1.min'
            )
        );
        echo $this->Html->script(
            array(
                'jquery-2.1.4.min',
                'jquery-ui',
                'bootstrap.min',
                'bootstrapValidator.min',
                'jquery.validate.min',
                'pixel-admin.min',
                'alert',
                'dashboard',
                'jquery.bootpag.min',
                'jquery.tablesorter',
                'bootstrap-tagsinput',
                'cz/fastclick/lib/fastclick',
                'cz/nprogress/nprogress.js',
                'cz/Chart.js/dist/Chart.min',
                'cz/gauge.js/dist/gauge.min',
                'cz/bootstrap-progressbar/bootstrap-progressbar.min',
                'cz/iCheck/icheck.min',
//                'cz/skycons/skycons',
//                'cz/Flot/jquery.flot',
//                'cz/Flot/jquery.flot.pie',
//                'cz/Flot/jquery.flot.time',
//                'cz/Flot/jquery.flot.stack',
//                'cz/Flot/jquery.flot.resize',
//                'cz/flot.orderbars/js/jquery.flot.orderBars',
//                'cz/flot-spline/js/jquery.flot.spline.min',
//                'cz/flot.curvedlines/curvedLines',
//                'cz/DateJS/build/date',
//                'cz/jqvmap/dist/jquery.vmap',
//                'cz/jqvmap/dist/maps/jquery.vmap.world',
//                'cz/jqvmap/examples/js/jquery.vmap.sampledata',
//                'cz/moment/min/moment.min',
//                'cz/bootstrap-daterangepicker/daterangepicker',
                'cz/morris.js/morris.min',
                'cz/custom1.min',
                'cz/metisMenu.min'
            )
        );
    ?>
        <script type="">
            var root = '<?php echo $this->Html->Url('/') ?>';
            var linkCurPage = '<?php echo $this->request->here ?>';
            var linkAndParams = '<?php echo $this->request->here(); ?>';
            var parasOnLink = <?php echo (sizeof($this->params['url']) == 0) ? json_encode(new Object()) : json_encode($this->params['url']) ?>;
            var init = [];
        </script>
    </head>
    
    <body class="theme-default main-menu-animated page-search">
        <div id="loading-body"></div>
        <div id="loading">
            <div class="loader"></div>
            <div id="msg">Loading...</div>
        </div>
        <div id="main-wrapper">
            <?php echo $this->element('menubar')?>
            <?php echo $this->element('col_left')?>
            ')?>
            <div id="content-wrapper">
                <div id="page-title">
                    <h1 class="page-header text-overflow">ProductZapp</h1>
                </div>
                <br>
                <?php if(($this->Session->check('Message.flash'))){?>
                    <div class="signin-with">
                        <div class="alert alert-info alert-dark" id="msg">
                            <button data-dismiss="alert" class="close"><span>×</span></button>
                            <?php echo $this->Session->flash(); ?>
                        </div>
                    </div>
                <?php }?>
                <?php echo $this->fetch('content'); ?>
            </div>

            <div id="main-menu-bg"></div>
        </div> 
        <script type="text/javascript">
            init.push(function () {
                $('.add-tooltip').tooltip();
            });
            window.PixelAdmin.start(init);
        </script>
        
    </body>
    
</html>

