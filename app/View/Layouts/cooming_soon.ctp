<!DOCTYPE html>
<html> 
<head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title_for_layout?></title>
    <link rel="shortcut icon" href="<?php echo $this->webroot; ?>images/icon-180.png" />
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
                'jquery.fancybox.css'
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
                'bootstrap-datepicker.min',
                'jquery.fancybox.js'
            )
        );
    ?>

</head>
<body data-spy=scroll data-target=.navbar-menu>
    <div id="ajaxModal"></div>
    <div id="loading-body"></div>
    <div id="loading">
        <div class="loader"></div>
        <div id="msg">Loading...</div>
    </div>
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
</body>
</html>
