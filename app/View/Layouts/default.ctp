<!DOCTYPE html>
<html> 
<head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProductZappp</title>
    <link rel="shortcut icon" href="<?php echo $this->webroot; ?>images/ic_logo_login.png"/>
    <script type="">
        var root = '<?php echo $this->Html->Url('/') ?>';
    </script>
    <?php

        echo $this->Html->css(
            array(
                'bootstrap.min',
                'font-awesome.min',
                'style',
                'style_1',
                'alert',
                'chosen',
                'jquery-ui.custom.min.css',
                'bootstrap-datepicker3',
                'jquery.fancybox.css',
                'perfect-scrollbar'
            )
        );
        echo $this->Html->script(
            array(
                'jquery-2.1.4.min',
                'jquery-ui',
                'bootstrap.min',
                'bootstrapValidator.min',
                'jquery.validate.min',
                'carzapp',
                'alert',
                'jquery.slimscroll',
                'chosen.jquery',
                'price_format',
                'bootstrap-datepicker',
                'jquery.fancybox',
                
            )
        );
    ?>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,700,800,900" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    
    <!-- Libs CSS -->
    <link href="<?php echo $this->webroot; ?>css/style.css" rel="stylesheet" />

    <link href="<?php echo $this->webroot; ?>css/effect/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/style.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/v-nav-menu.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/v-animation.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/v-bg-stylish.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/v-shortcodes.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/theme-responsive.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/plugins/owl-carousel/owl.theme.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/effect/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/effect/custom.css">

</head>
<body>
    <div id="ajaxModal"></div>
<!--    <div id="loading-body"></div>
    <div id="loading">
        <div class="loader"></div>
        <div id="msg">Loading...</div>
    </div>-->
    <?php echo $this->element('cz_message')?>
    
    <?php echo $this->element('head_new') ?>
    <div id="container" class="mg-top-navtop">
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->element('footer_new') ?>
    </div>
    
    <?php echo $this->element('cz_loading')?>
    
    <script type="text/javascript">
    $(document).ready(function () {
        $('#my_regis .modal-content').slimscroll({
            size: '4px',
            height: 450
        });
    })
    
     
    </script>
    
    <?php echo $this->Session->flash(); ?>
</body>
</html>
