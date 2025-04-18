<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProductZappp</title>
    <link rel="shortcut icon" href="<?php echo $this->webroot; ?>images/ic_logo_login.png"/>

    <script type="">
        var root = '<?php echo $this->Html->Url('/') ?>';
        var linkCurPage = '<?php echo $this->request->here(); ?>';
        var parasOnLink = <?php echo (sizeof($this->params['url']) == 0) ? json_encode(new Object()) : json_encode($this->params['url']) ?>;
        var userId = '<?php echo $this->Session->read('Auth.User._id') ?>';

        // check payment
        //            var userId = '<?php // echo $this->Session->read('Auth.User._id') ?>';
        //            var token = '<?php // echo $this->Session->read('Auth.User.session_id') ?>';
        //            var email = '<?php // echo $this->Session->read('Auth.User.email') ?>';
        //            var is_remain_time = '<?php // $this->Session->read('is_remain_time') ?>';
        //
        //            //if (is_remain_time == false) {
        //            if (true) {
        //                window.location.href = root + 'login_payment_web?token='+token+'&email='+email+'&userId='+userId;
        //            }
    </script>

    <?php
    echo $this->Html->css([
        'cz/bootstrap',
        'cz/font-awesome.min',
        'cz/jquery-ui.custom.min',
        'cz/alert',
        'cz/bootstrap-datetimepicker.min',
        'cz/jquery.bxslider',
        'cz/chosen',
        'cz/style',
        'cz/animate',
        'cz/table-card'
    ]);

    echo $this->Html->script([
        'cz/jquery-2.2.4.min',
        'cz/jquery-ui',
        'cz/bootstrap',
        'cz/jquery.slimscroll',
        'cz/jquery.carouFredSel-6.2.1',
        'cz/metisMenu.min',
        'cz/alert',
        'cz/bootstrap-datetimepicker.min',
        'cz/chosen.jquery',
        'cz/jquery.bxslider',
        'cz/jquery.bootpag.min',
        'cz/formValidation.min',
        'cz/kb-effect',
        'cz/carzapp',
        'cz/table-card',
        'cz/enscroll-0.6.2.min',
        'cz/jquery.cookie'
    ]);
    ?>

    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
</head>
<body>

<?php

if (!isset($_SESSION['analytic'])) {
    $date = new DateTime();
    $_SESSION['analytic'] = $date->getTimestamp();
    $sessionexpired = 1;
} else {
    if (time() - $_SESSION['analytic'] > 300) {
        $sessionexpired = 0;
        $date = new DateTime();
        $_SESSION['analytic'] = $date->getTimestamp();  // update creation time
    } else {
        $date = new DateTime();
        $_SESSION['analytic'] = $date->getTimestamp();
        $sessionexpired = 1;
    }
}



?>
<div class="main-content expanded-menu">
    <?php echo $this->element('cz_menu_left') ?>
    <?php echo $this->element('cz_header') ?>
    <div id="page-wrapper">
        <?php echo $this->fetch('content') ?>
        <div class="clearfix"></div>
        <?php echo $this->element('cz_footer') ?>
    </div>
</div>

<?php echo $this->element('cz_btn_scrolltop') ?>

<?php echo $this->element('cz_modals') ?>

<div class="bg-cover-transparent" style="display: none;"></div>

<?php echo $this->element('cz_message_popup_new') ?>

<?php echo $this->element('cz_loading') ?>

<?php echo $this->Session->flash(); ?>
</body>

<script>
    var dt = new Date();
    var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    var seconds = dt.getSeconds() / 1000;
    //alert(seconds);
    var counter = 0;
    var a = setInterval(function () {
        counter + 5000;
    }, 5000);
    //alert(a);
    // to stop the counter
    // clearInterval(myInterval);
    $(document).ready(function () {
        // check if is first login then reset password
        <?php $firstLogin = $this->Session->read('first_login');?>
        <?php if ($firstLogin) : ?>
        var checkFirstLogin = '<?php echo $firstLogin ?>';
        if (checkFirstLogin) {
            $('#changepassword .modal-body').css('height', '100%');
            $('#changepassword .modal-title').text('Reset Password');
            $('#changepassword .close').hide();
            $('#changepassword .btn-view').text('RESET');
            $('#changepassword .current-pass-group').hide();
            $('#changepassword input[name="currentpassword"]').val('');
            $('#changepassword').modal('show');
        }
        <?php endif; ?>
    });
    //check close tab,f5,ctrl+f5
    $(window).on('mouseover', (function () {
        window.onbeforeunload = null;
    }));
    $(window).on('mouseout', (function () {
        window.onbeforeunload = ConfirmLeave;
    }));
    function ConfirmLeave() {
        return "";
    }
    var prevKey = "";
    $(document).keydown(function (e) {
        if (e.key == "F5") {
            window.onbeforeunload = ConfirmLeave;
        }
        else if (e.key.toUpperCase() == "W" && prevKey == "CONTROL") {
            window.onbeforeunload = ConfirmLeave;
        }
        else if (e.key.toUpperCase() == "R" && prevKey == "CONTROL") {
            window.onbeforeunload = ConfirmLeave;
        }
        else if (e.key.toUpperCase() == "F4" && (prevKey == "ALT" || prevKey == "CONTROL")) {
            window.onbeforeunload = ConfirmLeave;
        }

        prevKey = e.key.toUpperCase();
    });
    
    // 
    //Anlytic 
    function getBrowserName() {
        var nVer = navigator.appVersion;
        var nAgt = navigator.userAgent;
        var browserName  = navigator.appName;
        var nameOffset,verOffset,ix;
// In Opera, the true version is after "Opera" or after "Version"
        if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
            browserName = "Opera";
        }
// In MSIE, the true version is after "MSIE" in userAgent
        else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
            browserName = "Microsoft Internet Explorer";
        }
// In Chrome, the true version is after "Chrome"
        else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
            browserName = "Chrome";

        }
// In Safari, the true version is after "Safari" or after "Version"
        else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
            browserName = "Safari";
        }
// In Firefox, the true version is after "Firefox"
        else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
            browserName = "Firefox";
        }
// In most other browsers, "name/version" is at the end of userAgent
        else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
            (verOffset=nAgt.lastIndexOf('/')) )
        {
            browserName = nAgt.substring(nameOffset,verOffset);
        }
        return browserName;
    }
    
    var sesionid = "";
    var sessionexpired = "<?php echo $sessionexpired; ?>";
    var checkcreatesession = parseInt(sessionexpired);
    if (!checkcreatesession) {
        var browsername =  getBrowserName();
       var  ipaddress = "";
        $.getJSON("http://jsonip.com/?callback=?", function (dataaddress) {
        $.post(root + 'analytics/createanalyticssession',{browsername:browsername,client_ip:dataaddress.ip}, function (data) {
            if (data.error == 0) {
                sesionid = data.new_analytics_session_id;// "<?php echo $this->Session->read('new_analytics_session_id'); ?>";
            } else {
                sesionid = "";
            }
        }, 'json');
        });
    } else {
        sesionid = "<?php echo $this->Session->read('new_analytics_session_id'); ?>";
    }

 var interval =  setInterval(function () {
        var check = "<?php echo $_SESSION['analytic']; ?>";
        var timestamp = Math.floor(new Date().valueOf() / 1000);
        var rs = timestamp - parseInt(check);
        if (rs < 310) {
            if (sesionid != "") {
                $.post(root + 'Analytics/autoupdateanalyticsession', {analytics_session_id: sesionid}, function (data) {
                });
            }
        }else{
            clearInterval(interval);
        }
    }, 20000);


</script>
</html>
