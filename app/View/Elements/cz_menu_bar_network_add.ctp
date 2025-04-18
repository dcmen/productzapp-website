<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05">
            <!--back button-->
            <div class="flt-menu pull-left flt-menu-back" style="display: none;">
                <a href="<?php echo $this->Html->Url('/mynetwork') ?>" class="color-black no-underline-hover"><i class="fa fa-angle-left font-size-17"></i> <span> BACK</span></a>
            </div>
            
            <!--input search-->
            <div class="flt-menu pull-left flt-menu-search">
                <div class="btn-group mg-bottom-4">
                    <div id="SearchDealer" method="get">
                        <input type="text" class="flt-menu-content submit_search_input" placeholder="Search" autocomplete="off" id="key" name="key" value=""/>
                        <i class="fa fa-search pos-abs search_mynetwork" style="line-height: 66px; left: 15px; cursor: pointer; top: 0px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>