<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05">
            <!--button add customer-->
            <div class="pull-right flt-menu mg-left-40">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content content-right btn" href="javascript:;" data-toggle="modal" data-target="#addcustomer">
                        <i class="ace-icon fa fa-plus"></i>
                        <span>Add Customer</span>
                    </a>
                </div>
            </div>
            
            <!--button delete customer-->
            <div class="pull-right flt-menu mg-left-40 dis-none-max-768">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content content-right btn del_all_customer" href="javascript:;">
                        <i class="ace-icon fa fa-times"></i>
                        <span>Delete Customer</span>
                    </a>
                </div>
            </div>
            
            <!--input search-->
            <div class="flt-menu pull-left dis-none-max-368">
                <div class="btn-group mg-bottom-4">
                    <form id="SearchCustomer" method="get" action="customer">
                        <input type="text" class="flt-menu-content submit_search_input" placeholder="Search" autocomplete="off" id="key" name="keyword" value="<?php echo $keyword; ?>"/>
                        <i class="fa fa-search pos-abs submit_search_customer" style="line-height: 66px; left: 15px; cursor: pointer; top: 0px;"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>