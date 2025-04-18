<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05">
            <!--button add customer-->
            <div class="pull-right flt-menu mg-left-40">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content content-right btn" href="<?php echo $this->Html->Url('/networks/add_network')?>">
                        <i class="ace-icon fa fa-plus"></i>
                        <span>Add Network</span>
                    </a>
                </div>
            </div>
            
            <!--button view request-->
            <div class="pull-right flt-menu mg-left-40 dis-none-max-768">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content btn val_request" href="<?php echo $this->Html->Url('request_network')?>" style="padding-right: 25px;">
                        <span>View Request<i class="fa fa-circle"><span class="count-request"><?php echo $count_invite?></span></i></span>
                    </a>
                </div>
            </div>
            
            <!--input search-->
            <div class="flt-menu pull-left dis-none-max-360">
                <div class="btn-group mg-bottom-4">
                    <form id="SearchMynetwork" method="get">
                        <input type="text" class="flt-menu-content submit_search_input" placeholder="Search" autocomplete="off" id="key" name="key" value="<?php echo $key; ?>"/>
                        <i class="fa fa-search pos-abs search_mynetwork" style="line-height: 66px; left: 15px; cursor: pointer; top: 0px;"></i>
                    </form>
                </div>
            </div>
            
            <!--<div class="flt-menu pull-left">
                <span class="flt-menu-txt"><span class="count-dealer"><?php echo $total ?></span> RESULT(S)</span>
            </div>-->
        </div>
    </div>
</div>