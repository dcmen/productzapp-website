<?php
if(!CakeSession::read('Auth.User.session_id')){
    header("Location: ".  url("/home_current"));
    die();
}
$url = $this->params->url;
?>
<script type="text/javascript">
    $( window ).resize(function() {
        var h = $(window).width();
        var h = $(window).width();
        if(h < 768){
            $("#navbar_menu").addClass('collapse');
            $("#navbar_notifi").addClass('collapse');

        }else{
            $("#navbar_menu").removeClass('collapse');
            $("#navbar_notifi").removeClass('collapse');
        }
    });
    $(document).ready(function(){
        if($( window ).resize()){
            var h = $(window).width();
            if(h < 768){
                $("#navbar_menu").addClass('collapse');
                $("#navbar_notifi").addClass('collapse');

            }else{
                $("#navbar_menu").removeClass('collapse');
                $("#navbar_notifi").removeClass('collapse');
            }
        }

        $("button").click(function(){
            var bt = $(this).attr("data-target");
            if(bt == '#navbar_menu'){
                $("#navbar_notifi").removeClass("in");
            }else if(bt == '#navbar_notifi'){
                $("#navbar_menu").removeClass("in");
            }
        })

    })
</script>
<div role="navigation" class="navbar navbar-default navbar-fixed-top" id="menu_home">
    <div class="container">
        <div class="col-xs-12 no-padding">
           <!-- navbar-mobile -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_menu">
                <i class="material-icons icon-menu">&#xE5D2;</i>
            </button>
            <button type="button" class="navbar-toggle collapsed navbar-mobile" data-toggle="collapse" data-target="#navbar_notifi">
                <i class="fa fa-comment-o"></i>
            </button>
            <div class="logo col-lg-9 col-xs-6 no-padding">
                <a href="<?php echo $this->Html->Url('/')?>">
                    <?php echo $this->Html->image('/images/logo2.png',array('class' =>'img-responsive','width' => '175px'))?>
                </a>
            </div>
            <div class="acc_login col-lg-3 col-xs-6 hidden-xs no-padding">
                <?php echo ($this->Session->read('Auth.User.avatar'))? '<img src="'.CakeSession::read('Auth.User.avatar').'">':$this->Html->image('/images/no-avatar.png')?>
                <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">
                    <i class="ace-icon fa fa-caret-down"></i>
                    <span>Welcome: <?php echo CakeSession::read('Auth.User.name')?></span>
                </a>
                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                    <li>
                        <a href="<?php echo $this->Html->Url('/myprofile')?>">
                            <i class="ace-icon fa fa-user"></i>
                            Change profiler
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="modal" data-target="#changepassword">
                            <i class="ace-icon fa fa-cog"></i>
                            Change password
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $this->Html->Url('/logout')?>">
                            <i class="ace-icon fa fa-power-off"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="hidden-xs" id="cssmenu">
            <ul class="nav nav-list navbar-left navbar-nav">
                <li class="hover <?php echo (in_array( $url, array('','home')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/home')?>">
                       <div class="img">
                           <i class="fa fa-home <?php echo (in_array( $url, array('','home'))) ? 'fa_select':''?>"></i>
                       </div>
                       Home
                    </a>
                    <b class="<?php echo (in_array( $url, array('','home')))? 'arrow':''?>"></b>
                </li>
                <li class="hover <?php echo (in_array( $url, array('flicka','flicka_grid')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/flicka')?>">
                        <div class="img">
                            <span class="<?php echo (in_array( $url, array('flicka','flicka_grid')))? 'img_flicka_1':'img_flicka'?>"></span>
                        </div>
                        Flicka
                    </a>
                    <b class="<?php echo (in_array( $url, array('flicka','flicka_grid')))? 'arrow':''?>"></b>
                </li>
                <li class="hover <?php echo (in_array( $url, array('carsforsale','resultcarsforsale')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/carsforsale')?>">
                        <div class="img">
                            <i class="fa fa-search fa_18 <?php echo (in_array( $url, array('carsforsale','resultcarsforsale'))) ? 'fa_select':''?>"></i>
                        </div>
                        Cars for Sale
                    </a>
                    <b class="<?php echo (in_array( $url, array('carsforsale','resultcarsforsale')))? 'arrow':''?>"></b>
                </li>

                <li class="hover has-sub <?php echo (in_array( $url, array('set_forget','set_forget_manage_current','set_forget_view')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/set_forget')?>">
                        <div class="img">
                            <i class="fa fa-search-plus fa_18 <?php echo (in_array( $url, array('set_forget','set_forget_manage_current','set_forget_view'))) ? 'fa_select':''?>"></i>
                        </div>
                        Set & Forget
                    </a>
                    <b class="<?php echo (in_array( $url, array('set_forget','set_forget_manage_current','set_forget_view')))? 'arrow':''?>"></b>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->Url('/set_forget')?>">Set & Forget</a>
                        </li>
                        <li><a href="<?php echo $this->Html->Url('/set_forget_manage_current')?>">Manage current</a></li>
                    </ul>
                </li>

                <li class="hover <?php echo (in_array( $url, array('followed')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/followed')?>">
                        <div class="img">
                            <i class="fa fa-random fa_18 <?php echo (in_array( $url, array('','followed'))) ? 'fa_select':''?>"></i>
                        </div>
                        Followed
                    </a>
                    <b class="hover <?php echo (in_array( $url, array('followed')))? 'arrow':''?>"></b>
                </li>
                <li class="hover <?php echo (in_array( $url, array('my_stock','add_stock_by_manual','add_stock_by_vin')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/my_stock')?>">
                        <div class="img">
                            <i class="fa fa-cubes <?php echo (in_array( $url, array('my_stock','add_stock_by_manual','add_stock_by_vin'))) ? 'fa_select':''?>"></i>
                        </div>
                        My Stock
                    </a>
                    <b class="<?php echo (in_array( $url, array('my_stock','add_stock_by_manual','add_stock_by_vin')))? 'arrow':''?>"></b>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->Url('/my_stock')?>">Published stock</a>
                        </li>
                        <li class="has-sub">
                            <a href="<?php echo $this->Html->Url('/add_stock_by_manual')?>">Add stock</a>
                            <ul>
                                <li><a href="<?php echo $this->Html->Url('/add_stock_by_manual')?>">By manual</a></li>
                                <li><a href="<?php echo $this->Html->Url('/add_stock_by_vin')?>">By VIN</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="hover <?php echo (in_array( $url, array('pulse','share')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/pulse')?>">
                        <div class="img icon-hover">
                            <?php if (in_array( $url, array('pulse','share'))) : ?>
                            <img class="menu-header-icon" src="<?php echo $this->webroot; ?>images/ic_pulse_active.png" />
                            <?php else : ?>
                            <img class="menu-header-icon icon-hover-none" src="<?php echo $this->webroot; ?>images/ic_pulse.png" />
                            <img class="menu-header-icon icon-hover-display" src="<?php echo $this->webroot; ?>images/ic_pulse_active.png" />
                            <?php endif ?>
                        </div>
                        News & Posts
                    </a>
                    <b class="<?php echo (in_array( $url, array('pulse','my_pulse','share')))? 'arrow':''?>"></b>
                    <ul>
                        <li>
<!--                            <span class="top_ul_li"></span>-->
                            <a href="<?php echo $this->Html->Url('/pulse?type=all')?>">News & Posts</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/pulse?type=mypulse')?>">My Posts</a>
                        </li>
                    </ul>
                </li>
                <li class="hover <?php echo (in_array( $url, array('offerboard')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/offerboard')?>">
                        <span id="count_transaction" class="noti_top" style="display: none;"></span>
                        <div class="img">
                            <span class="<?php echo (in_array( $url, array('offerboard')))? 'img_trans_1':'img_trans'?>"></span>
                        </div>
                        Offer Board
                    </a>
<!--                    <b class="<?php echo (in_array( $url, array('transaction')))? 'arrow':''?>"></b>
                    <ul>
                        <li>
                            <span class="top_ul_li"></span>
                            <a href="<?php echo $this->Html->Url('/transaction?action=buy')?>">Cars I'm buying</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/transaction?action=sell')?>">Cars I'm selling</a>
                        </li>
                    </ul>-->
                </li>
                <li class="hover <?php echo (in_array( $url, array('customer')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/customer')?>">
                        <div class="img">
                            <i class="fa fa-user fa_18 <?php echo (in_array( $url, array('','customer'))) ? 'fa_select':''?>"></i>
                        </div>
                        Customers
                    </a>
                    <b class="<?php echo (in_array( $url, array('customer')))? 'arrow':''?>"></b>
                </li>

                <li class="hover <?php echo (in_array( $url, array('mynetwork','view_stock','network_info_user')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/mynetwork')?>">
                        <span id="count_dealer_network" class="noti_top" style="display: none;"></span>
                        <div class="img">
                            <i class="fa fa-users fa_18 <?php echo (in_array( $url, array('mynetwork','view_stock','network_info_user'))) ? 'fa_select':''?>"></i>
                        </div>
                        Network
                    </a>
                    <b class="<?php echo (in_array( $url, array('mynetwork','view_stock','network_info_user')))? 'arrow':''?>"></b>
                </li>
                <li class="hover <?php echo (in_array( $url, array('invite_dealer')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/invite_dealer')?>">
                        <div class="img">
                            <i class="fa fa-exchange fa_18 <?php echo (in_array( $url, array('','invite_dealer'))) ? 'fa_select':''?>"></i>
                        </div>
                        Invite
                        <b class="<?php echo (in_array( $url, array('invite_dealer')))? 'arrow':''?>"></b>
                    </a>
                </li>

                <li class="hover has-sub <?php echo (in_array( $url, array('myprofile')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/myprofile')?>">
                        <div class="img">
                            <i class="fa fa-gear <?php echo (in_array( $url, array('','myprofile'))) ? 'fa_select':''?>"></i>
                        </div>
                        Settings
                    </a>
                    <b class="<?php echo (in_array( $url, array('myprofile')))? 'arrow':''?>"></b>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->Url('/myprofile')?>">My profile</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/notifications')?>">Notifications</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/transfer')?>">Transfer</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/in_app_purchase')?>">In-app purchase</a>
                        </li>
                    </ul>
                </li>
                <li class="hover <?php echo (in_array( $url, array('auction')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/auction')?>">
                        <div class="img">
                            <i class="fa fa-exchange fa_18 <?php echo (in_array( $url, array('','auction'))) ? 'fa_select':''?>"></i>
                        </div>
                        Auction
                        <b class="<?php echo (in_array( $url, array('auction')))? 'arrow':''?>"></b>
                    </a>
                </li>
                <li class="hover <?php echo (in_array( $url, array('auction')))? 'active':''?>">
                    <a href="<?php echo $this->Html->Url('/auction')?>">
                        <div class="img">
                            <i class="fa fa-exchange fa_18 <?php echo (in_array( $url, array('','auction'))) ? 'fa_select':''?>"></i>
                        </div>
                        Tender
                        <b class="<?php echo (in_array( $url, array('auction')))? 'arrow':''?>"></b>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-collapse hidden-sm hidden-md hidden-lg" id="navbar_menu">
            <ul class="nav nav-list navbar-left navbar-nav">
                <li class="acc_mobi col-xs-12">
                    <ul class="infouser">
                        <li class="grey">
                            <a class="name_acc" href="">
                                <?php echo ($this->Session->read('Auth.User.avatar'))? '<img src="'.$this->Session->read('Auth.User.avatar').'">':$this->Html->image('/images/no-avatar.png')?>
                                <span>Welcome: <?php echo $this->Session->read('Auth.User.name')?></span>
                            </a>
                        </li>
                        <li class="purple"><a href="<?php echo $this->Html->Url('/myprofile')?>" class="name_acc"><i class="ace-icon fa fa-user"></i></a></li>
                        <li class="green"><a href="<?php echo $this->Html->Url('/changepassword')?>" class="name_acc"><i class="ace-icon fa fa-cog"></i></a></li>
                        <li class="purple"><a href="<?php echo $this->Html->Url('/logout')?>" class="name_acc"><i class="ace-icon fa fa-power-off"></i></a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/home')?>">
                       <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/flicka')?>">
                        <i class="img_flicka"></i> Flicka
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/carsforsale')?>">
                        <i class="fa fa-search fa_18"></i> Cars for Sale
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-search-plus"></i> <span>Set & Forget</span> <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo $this->Html->Url('/set_forget')?>">Set & Forget</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/set_forget_manage_current')?>">Manage current</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo $this->Html->Url('/followed')?>">
                        <i class="fa fa-random fa_18"></i> Followed
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-cubes"></i> <span>My Stock</span> <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->Url('/my_stock')?>">Published stock</a></li>
                        <li><a href="<?php echo $this->Html->Url('/add_stock_by_manual')?>">By manual</a></li>
                        <li><a href="<?php echo $this->Html->Url('/add_stock_by_vin')?>">By VIN</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="img_trans"></i> <span>Transactions</span> <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo $this->Html->Url('/transaction?type=buy')?>">Cars I'm buying</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/transaction?type=sell')?>">Cars I'm selling</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo $this->Html->Url('/customer')?>"><i class="fa fa-user fa_18"></i> Customers</a>
                </li>

                <li>
                    <a href="<?php echo $this->Html->Url('/mynetwork')?>"><i class="fa fa-users fa_18"></i> Network</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/invite_dealer')?>">
                        <i class="fa fa-exchange fa_18"></i> <span>Invite</span> <b class="arrow fa fa-angle-down"></b>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-exchange"></i> Settings</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo $this->Html->Url('/myprofile')?>">My profile</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/notifications')?>">Notifications</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/transfer')?>">Transfer</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->Url('/in_app_purchase')?>">In-app purchase</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo $this->Html->Url('/auction')?>"><i class="fa fa-exchange fa_18"></i> Auction</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->Url('/auction')?>">
                        <i class="fa fa-exchange fa_18"></i> Tender
                    </a>
                </li>
            </ul>
        </div>

        <div class="hidden-xs">
            <?php echo $this->element('notification')?>
        </div>
    </div>
</div>

<div id="changepassword" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change password</h4>
                </div>
                <div class="modal-body">
                    <form id="ChangePassword" action="changepassword" method="post" class="form-horizontal">
                        <div class="form-group">
                            <div style="font-size: 14px;" class="col-lg-5 col-xs-12">Current password</div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="password" name="currentpassword" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="font-size: 14px;" class="col-lg-5 col-xs-12">New password</div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="password" name="newpassword" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="font-size: 14px;" class="col-lg-5 col-xs-12">Confirm new password</div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="password" name="re_password" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-xs-offset-3 col-lg-3 col-lg-offset-5">
                                <button class="btn btn-view col-xs-12" type="submit">OK</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>
<script>
  $(document).ready(function() {
        $('#ChangePassword').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                currentpassword: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter current password'
                        }
                    }
                },
                newpassword: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter new password'
                        },
                        regexp: {
                            regexp: /^\S*$/,
                            message: 'New password cannot contain space character(s)'
                        }
                    }
                },
                re_password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter confirm new password'
                        },
                        identical: {
                            field: 'newpassword',
                            message: 'Confirm new password does not match'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target),
            validator = $form.data('bootstrapValidator');
            load_show();
            $.post($('#ChangePassword').attr('action'), $form.serialize(), function (data) {
                load_hide();
                if(data.error == 0){
                    showMessage('Change password sussesfull', 0);
                    $('#changepassword').modal('hide');
                    $('#ChangePassword').trigger('reset');
                }else{
                    showMessage(data.msg, 1);
                }
            },'json');
        });

        function GetCountMenuNotify() {
            $.post(root + 'ajaxgetcountmenunotify', {}, function(data){
                if (data.count_transaction) {
                    $('#count_transaction').html(data.count_transaction);
                    $('#count_transaction').show();
                }
            },'json');
        }

        function GetCountOtherMenuNotify() {
            $.post(root + 'ajaxgetcountothermenunotify', {}, function(data){
                if (data.count_dealer_network) {
                    $('#count_dealer_network').html(data.count_dealer_network);
                    $('#count_dealer_network').show();
                }
            },'json');
        }

        GetCountMenuNotify();
        GetCountOtherMenuNotify();
});
</script>