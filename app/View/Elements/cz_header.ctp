<div class="sticky-header header-section z-index-header">
    <div id="headerLogo" class="pull-left height-header">
        <!--img logo-->
        <div id="logo" class="pull-left text-center width-menu-left height-full menu-header-border-right-2">
            <a class="line-height-header" href="javascript:;">
                <img class="logo-site-header" src="<?php echo $this->webroot; ?>images/ic_logo_login.png">
            </a>
        </div>
        <div id="showLeftPush" class="show-inbl text-center color-site-hover height-full text-center color-site color-site-hover cursor-pointer width-55"style="z-index: 9999;">
            <i class="fa fa-bars font-size-24 line-height-header"></i>
        </div>

        <span class="line-height-header txt-title-page color-site pd-left-35"><?php echo $title_for_layout ?></span>
    </div>

    <div class="header-right">
        <div class="profile_details_left"><!--notifications of menu start -->
            <ul class="nofitications-dropdown">
                <li id="btn-view-notify" class="dropdown head-dpdn menu-header-border-right height-header line-height-header width-item-header text-center item-header-notify">
                    <a href="#" class="dropdown-toggle color-site-hover" data-toggle="dropdown" aria-expanded="false" style="z-index:9999;">
                        <i class="fa fa-bell item-icon-header-size"></i>
                        <span id="num_notify" class="badge new-notify-badge color-bg-red hidden">0</span>
                    </a>
                    <ul class="dropdown-menu" style="width: 310px;">
                        <li>
                            <div class="notification_header">
                                <h3>You have <span class="new-notify-count">0</span> new notification(s)</h3>
                            </div>
                        </li>
                        <li class="line-height-35 notification-bottom">
                            <div class="notification_bottom" style="z-index:9999;">
                                <a href="<?php echo $this->Html->Url("/notifications") ?>">See all notifications</a>
                            </div>
                        </li>
                    </ul>
                </li>

                <script>
                    $(document).ready(function () {
                        $.post(root + 'othernotifications/get_new_notify_ajax', {}, function(data){
                            if (data.count_notification > 0) {
                                notifyHeaderBadge = $('.new-notify-badge');
                                notifyHeaderCount = $('.new-notify-count');
                                //
                                notifyHeaderBadge.text(data.count_notification);
                                notifyHeaderBadge.removeClass('hidden');
                                //
                                notifyHeaderCount.text(data.count_notification);
                                //
                                for(i = 0; i < data.count_notification; i++) {
                                    dataItem = data.list_notification[i];
                                    item =   '<li id="li-notify">' +
                                                '<a title="'+dataItem.message+'" href="' + root + 'other_notifications?status=' + dataItem.notification_id + '">' +
                                                    '<div class="user_img" style="width: 35px; height: 35px;"><img style="height: 35px;" src="' + ((dataItem.user_sender.avatar)? dataItem.user_sender.avatar : '<?php echo $this->webroot . 'images/no-avatar.png' ?>' ) + '" alt=""></div>' +
                                                    '<div class="notification_desc tr" style="margin-left: 10px;">' +
                                                        '<p class="truncate">' + dataItem.message + '</p>' +
                                                        '<p><span>' + dataItem.created_at + '</span></p>' +
                                                    '</div>' +
                                                    '<div class="clearfix"></div>' +
                                                '</a>' +
                                            '</li>';

                                    $('.notification-bottom').before(item);
                                    if (i > 3) {
                                        $('.notification-bottom').before('<li><div class="text-center" style="height: 10px; line-height: 0px;">. . .</div></li>');
                                        break;
                                    }
                                }
                            }
                        },'json');
                    });
                </script>
            </ul>
            <div class="clearfix"> </div>
        </div>

        <div class="profile_details">
            <ul>
                <!--user profile-->
                <li class="dropdown profile_details_drop show-inbl height-header vertical-align-top menu-header-border-right">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <div class="profile_img">
                            <span class="prfil-img">
                                <img class="avatar-header-size img-circle" src="<?php echo (CakeSession::read('Auth.User.avatar'))? CakeSession::read('Auth.User.avatar') : $this->webroot . 'images/no-avatar.png'?>"onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no-avatar.png';" />


                            </span>
                            <div class="user-name">
                                <p class="color-site-01"><?php echo CakeSession::read('Auth.User.name')?></p>
                                <span class="font-size-12 color-text">Dealer</span>
                            </div>
                            <i class="fa fa-angle-down kb color-site-02"></i>
                            <i class="fa fa-angle-up kb color-site-02"></i>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                    <ul class="dropdown-menu drp-mnu" style="z-index:9999;">
                        <li> <a href="<?php echo $this->Html->Url("/myprofile") ?>"><i class="fa fa-user"></i> Profile</a> </li>
                        <li> <a href="javascript:;" data-toggle="modal" data-target="#changepassword"><i class="fa fa-key"></i> Change password</a> </li>
                        <!--<li> <a href="<?php // echo $this->Html->Url("/logout")?>" onclick="localStorage.clear();"><i class="fa fa-sign-out"></i> Logout</a> </li>-->
                    </ul>
                </li>
                <!--button logout-->
                <li class="show-inbl width-item-header text-center line-height-header vertical-align-top item-header-logout">
                    <a href="javascript:;" class="color-site-02 color-site-hover btn-logout" title="Logout">
                        <i class="fa fa-sign-out font-size-24"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>
<script>
    $('#showLeftPush').click(function() {
        tatus =  $.cookie('status-menu-left');

        if (!tatus) {
            tatus = 'change';
        }

        displayMenuLeft(tatus);

        if (tatus === 'back') {
            $.cookie('status-menu-left', 'change');
        }
        else {
            $.cookie('status-menu-left', 'back');
        }

        $('.caroufredsel_wrapper').css('width', '100%');
        $('#special_offers').css('width', '100%');
    });

    function displayMenuLeft(tatus) {
        if (!tatus) {
            tatus = 'back';
        }

        if (tatus === 'back') {
            $('.main-content').removeClass('colapsed-menu');
            $('.main-content').addClass('expanded-menu');
        }
        else {
            $('.main-content').addClass('colapsed-menu');
            $('.main-content').removeClass('expanded-menu');
        }
    }

    $(document).ready(function () {
        tatus = $.cookie('status-menu-left');
        if (tatus === 'back') {
            displayMenuLeft('change');
        }
        else {
            displayMenuLeft('back');
        }
        $(document).on('click touchstart','#BTNChangePass,.clickable', function () {
            $('#changepassword').modal('show');
        });
        //read notification
        $('#btn-view-notify').click(function(){
            $.post(root + 'OtherNotifications/readallnotification',{},function(data)
            {
                if(data.error == 0){
                    $('#num_notify').addClass('hidden');
                    }else {
                    showMessage('Failure', 1);
                }
            },'json');
            $.post(root + 'ajaxgetcountmenunotify', {}, function(data){
                menuCountCustomer = $('.menu-count-customer');
                menuCountOtherNotification = $('.menu-count-other-notification');
                menuCountInvite = $('.menu-count-invite'); // my network

                if (data.count_customer > 0) {
                    menuCountCustomer.text(data.count_customer);
                    menuCountCustomer.closest('.menu-notify-badge').removeClass('hidden');
                }
                if (data.count_other_notification > 0) {
                    menuCountOtherNotification.text(data.count_other_notification);
                    menuCountOtherNotification.closest('.menu-notify-badge').removeClass('hidden');
                }
                if (data.count_invite > 0) {
                    menuCountInvite.text(data.count_invite);
                    menuCountInvite.closest('.menu-notify-badge').removeClass('hidden');
                }
            },'json');
        });
        //check read notify
        $(document).on('click','#li-notify',function(){
            $.post(root + 'OtherNotifications/get_new_notify_ajax1', {}, function(data){
                if (data.count_notification > 0) {
                    notifyHeaderBadge = $('.new-notify-badge');
                    notifyHeaderCount = $('.new-notify-count');
                    //
                    notifyHeaderBadge.text(data.count_notification);
                    notifyHeaderBadge.removeClass('hidden');
                    //
                    notifyHeaderCount.text(data.count_notification-1);
                }
            },'json');
        });
        //

    });
</script>