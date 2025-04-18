<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05">
            <!--select view by-->
            <div class="pull-right flt-menu">
                <span class="flt-menu-txt dis-none-max-800">View By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span><?php echo ($this->params->url == 'set_forget_view') ? 'Set & Forget' : 'Customer'; ?></span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->Url('/') . 'set_forget_manage_current' ?>">Customer</a></li>
                        <li><a href="<?php echo $this->Html->Url('/') . 'set_forget_view' ?>">Set & Forget</a></li>
                    </ul>
                </div>
            </div>
            
            <!--input search-->
            <?php if(isset($set4getview)) : ?>
            <div class="flt-menu pull-left">
                <div class="btn-group mg-bottom-4">
                    <input type="text" class="flt-menu-content submit_search_input" placeholder="Search" autocomplete="off" id="key" name="key"/>
                    <i class="fa fa-search pos-abs submit_search" style="line-height: 66px; left: 15px; cursor: pointer; top: 0"></i>
                </div>
            </div>
            <?php else : ?>
            <div class="flt-menu pull-left">
                <div class="btn-group mg-bottom-4">
                    <input type="text" class="flt-menu-content submit_search_customer_input" placeholder="Search" autocomplete="off" id="key" name="key"/>
                    <i class="fa fa-search pos-abs submit_search_customer" style="line-height: 66px; left: 15px; cursor: pointer; top: 0"></i>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>