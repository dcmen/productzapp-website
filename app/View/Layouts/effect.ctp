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
                    'style',
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
                )
            );
        ?>
        <!-- Web Fonts  -->
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
    
        <!-- Current Page CSS -->
        <link href="<?php echo $this->webroot; ?>plugins/rs-plugin/css/settings.css" rel="stylesheet" />
        <link href="<?php echo $this->webroot; ?>plugins/rs-plugin/css/custom-captions.css" rel="stylesheet" />

        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/effect/custom.css">
        
        <!-- Libs -->
        <script src="<?php echo $this->webroot; ?>js/effect/jquery.flexslider-min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/effect/jquery.easing.js"></script>
        <script src="<?php echo $this->webroot; ?>js/effect/jquery.fitvids.js"></script>
        <script src="<?php echo $this->webroot; ?>js/effect/jquery.carouFredSel.min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/effect/theme-plugins.js"></script>
        <script src="<?php echo $this->webroot; ?>js/effect/jquery.isotope.min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/effect/imagesloaded.js"></script>

        <script src="<?php echo $this->webroot; ?>js/effect/view.min.js?auto"></script>

        <script src="<?php echo $this->webroot; ?>plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?php echo $this->webroot; ?>plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        
        <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
    </head>
    
    <body class="no-page-top">
        <div id="ajaxModal"></div>
        <div id="loading-body"></div>
        <!--<div id="loading">
            <div class="loader"></div>
            <div id="msg">Loading...</div>
        </div>-->
        
        <div class="col-xs-11 col-sm-4 kb-alert-message" data-type="0">
            <span class="kb-message"></span>
        </div>
        <?php echo $this->element('head_new', array('isHomePage' => true)) ?>
        <div id="container">
            <?php echo $this->fetch('content'); ?>
            <?php echo $this->element('footer_new') ?>
        </div>
        <!--// BACK TO TOP //-->
        <div id="back-to-top" class="animate-top"><i class="fa fa-angle-up"></i></div>
        
        <?php echo $this->element('cz_loading')?>
        
    </body>
    
    <script src="<?php echo $this->webroot; ?>js/effect/theme-core.js"></script>
</html>
