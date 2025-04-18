<!DOCTYPE html>
<html> 
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>title of page</title>
        <link rel="shortcut icon" href="ulr/icon-180.png" />
        
        <!-- ===========================================     css    =========================================== -->
        <!--require-->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        
        <!--custom-->
        <link href="<?php echo $this->webroot; ?>css/effect/cars.css" rel="stylesheet" />
        
        <!-- =========================================== javascript =========================================== -->
        <!--require-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
        <!--custom-->
        <script src="<?php echo $this->webroot; ?>css/effect/cars.js"></script>
    </head>
    <body>
        <div class="kb-loading">
            <div class="bg-cover"></div>
            <div class="loading-content">
                <div class="loading-icon"></div>
                <div class="loading-msg">Loading...</div>
            </div>
        </div>
        
        <div class="col-xs-11 col-sm-4 kb-alert-message" data-type="0">
            <span class="kb-message"></span>
        </div>
        <div class="page">
            <?php echo $this->element('head_home') ?>
            <div class="container">
                <div class="wrapper col-xs-12 no-padding">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>    
            <?php echo $this->element('footer_login') ?>
        </div>
    </body>
</html>
