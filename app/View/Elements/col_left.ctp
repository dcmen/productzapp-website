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
<?php
$url = $this->params->url;
$action = $this->params['action'];
?>
<div id="main-menu" role="navigation">
    <div id="main-menu-inner">
        <ul class="navigation" id="side-menu">
            <li class="<?php echo (in_array($action, array('list_regis_brochures','result_search_brochures')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/list_regis_brochures')?>">
                    <i class="menu-icon fa fa-list" data-placement="bottom" title="Downloaded Brochure"></i>
                    <span class="mm-text">Downloaded Brochure</span>
                </a>
            </li>
            <li class="<?php echo (in_array($action, array('all_user','edit_info_user','view_info_user')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/all_user')?>">
                    <i class="menu-icon fa fa-users "  data-placement="bottom" title="All Users"></i>
                    <span class="mm-text all">All Users</span>
                </a>
            </li>
            <li class="<?php echo (in_array($url, array('inactivate_user')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/inactivate_user')?>">
                    <i class="menu-icon fa fa-user-times"  data-placement="bottom" title="Inactive Users"></i>
                    <span class="mm-text">Inactive Users</span>
                </a>
            </li>
            <li class="<?php echo (in_array($action, array('list_register')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/list_register')?>">
                    <i class="menu-icon fa fa-user-plus" data-placement="bottom" title="Registration Page 1"></i>
                    <span class="mm-text">Registration page 1</span>
                </a>
            </li>
            <li class="<?php echo (in_array($action, array('admin_pulse','admin_pulse_detail','admin_report_pulse','admin_add_pulse')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/admin_pulse')?>">
                    <i class="menu-icon fa fa-share-alt"data-placement="bottom" title="All Posts"></i>
                    <span class="mm-text">All Posts</span>
                </a>
            </li>
             <li class="<?php echo (in_array($action, array('pulse_report','pulse_report_detail')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/pulse_report')?>">
                    <i class="menu-icon fa fa-exclamation-triangle"data-placement="bottom" title="Post Reports"></i>
                    <span class="mm-text">Post Reports</span>
                </a>
            </li>
              <li class="<?php echo (in_array($action, array('connect_datafeed')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/connect_datafeed')?>">
                    <i class="menu-icon fa fa-code"data-placement="bottom" title="Datafeed" ></i>
                    <span class="mm-text">Datafeed</span>
                </a>
            </li>
            <li class="<?php echo (in_array($url, array('admin_company', 'admin_company_detail', 'admin_company_edit', 'recent_car_count')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/admin_company')?>">
                    <i class="menu-icon fa fa-bank" data-placement="bottom" title="Manage Dealerships" ></i>
                    <span class="mm-text">Manage Dealerships</span>
                </a>
            </li> 
            <li class="<?php echo (in_array($action, array('list_car', 'view_car', 'edit_car')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/list_car')?>">
                    <i class="menu-icon fa fa-car" data-placement="bottom" title="All Cars"></i>
                    <span class="mm-text">All Cars</span>
                </a>
            </li>
            <li class="<?php echo (in_array($action, array('list_car_analysis', 'view_car_analysis')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/list_car_analysis')?>">
                    <i class="menu-icon fa fa-car" data-placement="bottom" title="Analysis"></i>
                    <span class="mm-text">Analysis</span>
                </a>
            </li>
            <li class="<?php echo (in_array($action, array('dealer_message', 'edit_email')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/users/dealer_message')?>">
                    <i class="menu-icon fa fa-tty"data-placement="bottom" title="Dealer Message"></i>
                    <span class="mm-text">Dealer Messages</span>
                </a>
            </li>
            <li class="<?php echo (in_array($action, array('analytic', 'view_car_analysis')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/analytic')?>">
                    <i class="menu-icon fa fa-car" data-placement="bottom" title="Analytic"></i>
                    <span class="mm-text">Analytic</span>
                </a>
            </li>
            <li class="<?php echo (in_array($action, array('manage_email_content')))?'select':''?>">
                <a href="<?php echo $this->Html->Url('/emailcontents/list_email')?>">
                    <i class="menu-icon fa fa-envelope"data-placement="bottom" title="Manage Email Content"></i>
                    <span class="mm-text">Manage Email Content</span>
                </a>
            </li>
            
        </ul>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('#menu-setting').on('click',function(){

            if($(this).attr('data-click-state') == 1) {
                $(this).attr('data-click-state', 0)
                $('.menu-second-level').css('display','none');
                $('.arrow').removeClass('fa-angle-down').addClass('fa-angle-left');
            } else {
                $(this).attr('data-click-state', 1)
                $('.menu-second-level').css('display','block');
                $('.arrow').removeClass('fa-angle-left').addClass(' fa-angle-down');
            }

        });
    });
</script>