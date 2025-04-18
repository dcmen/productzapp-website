<?php
$url = $this->params->url;
?>
<style>
    /*BEGIN effect hover menu item*/
    .menu-left-icon {
        animation-duration: .7s;
    }
    .nav-menu-left li > a:hover .menu-left-icon {
        animation-name: swing;
    }
    @keyframes swing {
        20% {
            transform:rotate3d(0,0,1,15deg)
        }
        40% {
            transform:rotate3d(0,0,1,-10deg)
        }
        60% {
            transform:rotate3d(0,0,1,5deg)
        }
        80% {
            transform:rotate3d(0,0,1,-5deg)
        }
        100% {
            transform:rotate3d(0,0,1,0deg)
        }
    }
    .swing {
        transform-origin:top center;
        animation-name:swing
    }
    /*END effect hover menu item*/
    
    /*BEGIN Scrollbar custom*/
    #side-menu {
        overflow: auto;
        width: 100% !important;
        height: 100%;
        padding: 0px !important;
        padding-left: 5px;
    }
    .track {
        width: 10px;
        background: rgba(0, 0, 0, 0);
        margin-right: 2px;
        border-radius: 10px;
        transition: background 250ms linear;
        right: -3px;
    }
    .handle {
        width: 7px;
        right: 0;
        background: #999;
        background: rgba(0, 0, 0, 0.4);
        border-radius: 7px;
        -webkit-transition: width 250ms;
        transition: width 250ms;
    }
    .track:hover .handle, .track.dragging .handle {
        width: 10px;
    }
    /*END Scrollbar custom*/
</style>
<div class="sidebar" role="navigation">
    <div id="menuLeft" class="menu-header-border-right-2 navbar-collapse pos-fixed width-menu-left z-index-100 height-full no-padding show-flex">
        <nav class="nav-menu-left cbp-spmenu-vertical cbp-spmenu-left height-full">
            <ul class="nav color-white" id="side-menu">
                <!--OVERVIEW-->
                <li class="menu-left-header">OVERVIEW</li>
                <li class="dashboard1">
                    <a class="<?php echo (in_array( $url, array('','home')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/home')?>" title="Dashboard">
                        <div class="menu-left-icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <span class="menu-left-text ">Dashboard</span>
                    </a>
                </li>
                <!--SEARCH FOR CARS-->
                <li class="menu-left-header">SEARCH FOR CARS</li>
                <li class="car_Flicka1">
                    <a href="<?php echo $this->Html->Url('/flicka')?>" class="kb-btn-2-img <?php echo (in_array( $url, array('flicka','flicka_grid')))? 'active':''?>" title="Flicka">
                        <div class="menu-left-icon">
                            <img class="kb-icon-normal" src="<?php echo $this->webroot; ?>images/ic_circarr25.png" />
                            <img class="kb-icon-active" src="<?php echo $this->webroot; ?>images/ic_circarr25.png" />
                        </div>
                        <span class="menu-left-text ">Flicka</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/carsforsale')?>" class="<?php echo (in_array( $url, array('carsforsale','resultcarsforsale')))? 'active':''?>" title="Cars For Sale">
                        <div class="menu-left-icon">
                            <i class="fa fa-search"></i>
                        </div>
                        <span class="menu-left-text car_for_sale1">Cars For Sale</span>
                    </a>
                </li>
                <li class="<?php echo (in_array( $url, array('set_forget','set_forget_manage_current','set_forget_view')))? 'active':'' ?>">
                    <a href="<?php echo $this->Html->Url('/set_forget')?>" title="Set & Forget">
                        <div class="menu-left-icon">
                            <i class="fa fa-search-plus"></i>
                        </div>
                        <span class="menu-left-text">Set & Forget</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level <?php echo (in_array( $url, array('set_forget','set_forget_manage_current','set_forget_view')))? 'in':'collapse' ?>">
                        <li>
                            <a class="<?php echo (in_array( $url, array('set_forget')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/set_forget')?>">Set & Forget</a>
                        </li>
                        <li>
                            <a class="<?php echo (in_array( $url, array('set_forget_manage_current', 'set_forget_view')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/set_forget_view')?>">Manage Current</a>
                        </li>
                    </ul>
                </li>
                <li class="car_followed1">
                    <a class="<?php echo (in_array( $url, array('followed')))? 'active':''?>" href="<?php echo $this->Html->Url('/followed')?>" title="Cars Followed">
                        <div class="menu-left-icon">
                            <i class="fa fa-random"></i>
                        </div>
                        <span class="menu-left-text ">Cars Followed</span>
                    </a>
                </li>
                <li class="car_my_stock1 <?php echo (in_array( $url, array('my_stock','add_stock_by_manual','add_stock_by_vin')))? 'active' : '' ?>">
                    <a href="<?php echo $this->Html->Url('/my_stock')?>" title="My Stock">
                        <div class="menu-left-icon">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <span class="menu-left-text ">My Stock</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level <?php echo (in_array( $url, array('my_stock','add_stock_by_manual','add_stock_by_vin')))? 'in':'collapse' ?>">
                        <li>
                            <a href="<?php echo $this->Html->Url('/my_stock')?>" class="<?php echo (in_array( $url, array('my_stock')))? 'active':'' ?>">My Stock</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/add_stock_by_manual')?>" class="<?php echo (in_array( $url, array('add_stock_by_manual')))? 'active':'' ?>">Add Stock</a>
                        </li>
                    </ul>
                </li>
                <!--CONNECT-->
                <li class="menu-left-header">CONNECT</li>
                <li class="car_my_network1">
                    <a href="<?php echo $this->Html->Url('/mynetwork')?>" class="<?php echo (in_array( $url, array('mynetwork', 'view_stock')))? 'active':''?>" title="My Network">
                        <div class="menu-left-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <span class="menu-left-text ">My Network</span>
                        <span class="fa fa-circle color-red menu-notify-badge hidden">
                            <span class="menu-count-notify menu-count-invite">0</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="<?php echo (in_array( $url, array('invite_dealer')))? 'active':''?>" href="<?php echo $this->Html->Url('/invite_dealer')?>" title="Invite a Dealer">
                        <div class="menu-left-icon">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <span class="menu-left-text">Invite a Dealer</span>
                    </a>
                </li>
                <li class="<?php echo (in_array( $url, array('pulse','share', 'pulse_detail')))? 'active':'' ?>">
                    <a href="<?php echo $this->Html->Url('/pulse')?>" title="News & Posts">
                        <div class="menu-left-icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <span class="menu-left-text">News & Posts</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level <?php echo (in_array( $url, array('pulse','share')))? 'in':'collapse' ?>">
                        <li>
                            <a class="<?php echo (isset($this->params['url']['type']) && in_array($this->params['url']['type'], array('all')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/pulse?type=all')?>">News & Posts</a>
                        </li>
                        <li>
                            <a class="<?php echo (isset($this->params['url']['type']) && in_array($this->params['url']['type'], array('mypulse')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/pulse?type=mypulse')?>">My Posts</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/notifications')?>" class="<?php echo (in_array( $url, array('notifications', 'other_notifications')))? 'active':''?>" title="Notifications">
                        <div class="menu-left-icon">
                            <i class="fa fa-bell"></i>
                        </div>
                        <span class="menu-left-text">Notifications</span>
                        <span id="menu-count-other-notify" class="fa fa-circle color-red menu-notify-badge hidden">
                            <span class="menu-count-notify menu-count-other-notification">0</span>
                        </span>
                    </a>
                </li>
                <!--TRADE-->
                <li class="menu-left-header">TRADE</li>
                <li class="car_offerboard1">
                    <a href="<?php echo $this->Html->Url('/offerboard')?>" class="kb-btn-2-img <?php echo (in_array( $url, array('offerboard')))? 'active':''?>" title="Offer Board">
                        <div class="menu-left-icon">
                            <img class="kb-icon-normal" src="<?php echo $this->webroot; ?>images/transaction22.png" />
                            <img class="kb-icon-active" src="<?php echo $this->webroot; ?>images/transaction22.png" />
                        </div>
                        <span class="menu-left-text ">Offer Board</span>
                    </a>
                </li>
                <?php if($this->Session->read('custom_zooper')) : ?>
                <li>
                    <a href="<?php echo $this->Html->Url('/analysis')?>" class="kb-btn-2-img <?php echo (in_array( $url, array('analysis')))? 'active':''?>" title="Analysis">
                        <div class="menu-left-icon">
                            <img class="kb-icon-normal" src="<?php echo $this->webroot; ?>images/transaction22.png" />
                            <img class="kb-icon-active" src="<?php echo $this->webroot; ?>images/transaction22.png" />
                        </div>
                        <span class="menu-left-text">Analysis</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo $this->Html->Url('/customer')?>" class="<?php echo (in_array( $url, array('customer')))? 'active':''?>" title="My Customers">
                        <div class="menu-left-icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <span class="menu-left-text">My Customers</span>
                        <span class="fa fa-circle color-red menu-notify-badge hidden">
                            <span class="menu-count-notify menu-count-customer">0</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/tenderoffer')?>" class="kb-btn-2-img <?php echo (in_array( $url, array('tenderoffer')))? 'active':''?>" title="Tenders">
                        <div class="menu-left-icon">
                            <img class="kb-icon-normal" src="<?php echo $this->webroot; ?>images/ic_menu_tender1.png" />
                            <img class="kb-icon-active" src="<?php echo $this->webroot; ?>images/ic_menu_tender1.png" />
                        </div>
                        <span class="menu-left-text">Tenders</span>
                    </a>
                </li>
                <!--COMING SOON-->
                <li class="menu-left-header">COMING SOON</li>
                <li>
                    <a href="javascript:;" class="kb-btn-2-img" title="Job Finder">
                        <div class="menu-left-icon">
                            <img class="kb-icon-normal" src="<?php echo $this->webroot; ?>images/ic_menu_jobfinder.png" />
                            <img class="kb-icon-active" src="<?php echo $this->webroot; ?>images/ic_menu_jobfinder.png" />
                        </div>
                        <span class="menu-left-text">Job Finder</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" title="Auctions">
                        <div class="menu-left-icon">
                            <i class="fa fa-gavel"></i>
                        </div>
                        <span class="menu-left-text">Auctions</span>
                    </a>
                </li>
                <!--SYSTEM & HELP-->
                <li class="menu-left-header">SYSTEM & HELP</li>
                <li class="<?php echo (in_array( $url, array('myprofile', 'notification_setting')))? 'active':'' ?>">
                    <a href="javascript:;" title="Setting">
                        <div class="menu-left-icon">
                            <i class="fa fa-cog"></i>
                        </div>
                        <span class="menu-left-text">Settings</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level <?php echo (in_array( $url, array('myprofile', 'notification_setting', 'share_car_setting')))? 'in':'collapse' ?>">
                        <li>
                            <a class="<?php echo (in_array( $url, array('myprofile')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/myprofile')?>">My profile</a>
                        </li>
                        <li>
                            <a class="<?php echo (in_array( $url, array('notification_setting')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/notification_setting')?>" title="Notifications" >Notifications</a>
                        </li>
                        <li>
                            <a class="<?php echo (in_array( $url, array('share_car_setting')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/share_car_setting')?>" title="Notifications" >Sharing</a>
                        </li>
                        <?php if($this->Session->read('custom_zooper')) : ?>
                        <li>
                            <a class="<?php echo (in_array( $url, array('setting_make_offer')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/setting_make_offer?zopper_id='.$this->Session->read('Auth.User._id'))?>" title="Offer" >Offer rules</a>
                        </li>
                        <li>
                            <a class="<?php echo (in_array( $url, array('setting_make_offer')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/setting_tender')?>" title="Offer" >Tender</a>
                        </li>
                        <?php endif?>
                        <li>
                            <a class="<?php echo (in_array( $url, array('email_send_tender')))? 'active':'' ?>" href="<?php echo $this->Html->Url('/email_send_tender')?>" title="Email send tender" >Email send tender</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/support-v212')?>" title="Help">
                        <div class="menu-left-icon">
                            <i class="fa fa-life-ring"></i>
                        </div>
                        <span class="menu-left-text">Help</span>
                    </a>
                </li>
                <li class="dis-none-min-801-imp">
                    <a class="btn-logout" href="javascript:;" title="Logout">
                        <div class="menu-left-icon">
                            <i class="fa fa-sign-out"></i>
                        </div>
                        <span class="menu-left-text">Logout</span>
                    </a>
                </li>
            </ul>
            <div class="clearfix"> </div>
        </nav>
    </div>
</div>
<script>
    // Scrollbar custom
    $('#side-menu').enscroll({
        showOnHover: true,
        verticalTrackClass: 'track',
        verticalHandleClass: 'handle'
    });
    
    $(document).ready(function () {
        $('#side-menu').metisMenu();
    
        $(document).on('click', '.nav-menu-left.colapse li > a', function() {
            window.location = $(this).attr('href');
        });
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
    //update
    function updatecount(screen){
        $.post(root + 'Pages/updateanalyticsviewscreenbysession',{keyscreen:screen},function(data) {
            if(data.error == 0)
            {

            }else{

            }
            return false;
        });
    }
    $('.dashboard1').click(function(){
        var screen = 'count_dashboard';
        updatecount(screen);
    });
    $('.car_Flicka1').click(function(){
        var screen = 'count_flickar';
        updatecount(screen);
    });
    $('.car_for_sale1').click(function(){
        var screen = 'count_carforsale';
        updatecount(screen);
    });
    $('.car_followed1').click(function(){
        var screen = 'count_followcar';
        updatecount(screen);
    });
    $('.car_my_stock1').click(function(){
        var screen = 'count_mystock';
        updatecount(screen);
    });
    $('.car_my_network1').click(function(){
        var screen = 'count_mynetwork';
        updatecount(screen);
    });
    $('.car_offerboard1').click(function(){
        var screen = 'count_offerboard';
        updatecount(screen);
    });
</script>