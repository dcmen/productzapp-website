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
                'menu',
                'style',
                'style_1',
                'alert',
                'chosen',
                'jquery-ui.custom.min.css',
                'bootstrap-datepicker3',
                'jquery.fancybox.css',
                'cz/easy-autocomplete'
            )
        );
        echo $this->Html->script(
            array(
                'jquery-2.1.4.min',
                'jquery-ui',
                'formValidation.min',
                'validate/bootstrap.min.js',
                'bootstrap.min',
                'jquery.validate.min',
                'cz/carzapp',
                'alert',
                'jquery.slimscroll',
                'chosen.jquery',
                'price_format',
                'bootstrap-datepicker',
                'jquery.cookie',
                'jquery.fancybox',
                'jquery.bootpag.min',
                'bootstrap-notify',
                'cz/jquery.easy-autocomplete'
            )
        );
    ?>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
</head>
<body data-spy=scroll data-target=.navbar-menu>
    <div id="ajaxModal"></div>
    <div id="loading-body"></div>
    <!--<div id="loading">
        <div class="loader"></div>
        <div id="msg">Loading...</div>
    </div>-->
    
<!--    <div class="col-xs-11 col-sm-4 kb-alert-message" data-type="0">-->
<!--        <span class="kb-message"></span>-->
<!--    </div>-->
    <?php echo $this->element('cz_message_popup_new')?>
    <div class="page">
        <div class="container">
            <?php echo $this->fetch('content'); ?>

        </div>    
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php echo $this->element('cz_message_popup_new')?>
    </div>
    <script type="text/javascript">
        setTimeout(function () {
            $('#flashMessage').hide();
        }, 2000);
    </script>
    
</body>
</html>
