<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05">
            <!--button add group-->
            <div class="pull-right flt-menu mg-left-40">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content content-right btn" href="<?php echo $this->Html->Url('/add_group') ?>">
                        <i class="ace-icon fa fa-plus"></i>
                        <span>Add Group</span>
                    </a>
                </div>
            </div>
            
            <!--select number view-->
            <div class="pull-right flt-menu">
                <span class="flt-menu-txt dis-none-max-1024">Show On Page</span>
                <div class="btn-group mg-bottom-4 dis-none-max-480">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span><?php echo isset($limit) ? $limit . ' items' : '12 items'; ?></span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php 
                        $paras = $this->params['url'];
                        ?>
                        <li><a href="<?php $paras['limit'] = 12; echo $this->Common->createLink($paras, $this->request->here); ?>">12 items</a></li>
                        <li><a href="<?php $paras['limit'] = 16; echo $this->Common->createLink($paras, $this->request->here); ?>">16 items</a></li>
                        <li><a href="<?php $paras['limit'] = 20; echo $this->Common->createLink($paras, $this->request->here); ?>">20 items</a></li>
                        <li><a href="<?php $paras['limit'] = 24; echo $this->Common->createLink($paras, $this->request->here); ?>">24 items</a></li>
                    </ul>
                </div>
            </div>
            
            <!--input search-->
            <div class="flt-menu pull-left">
                <div class="btn-group mg-bottom-4 dis-none-max-480">
                    <form id="SearchCustomer" method="get">
                        <input type="text" class="flt-menu-content submit_search_input" placeholder="Search" autocomplete="off" id="key" name="key" value="<?php echo $key; ?>"/>
                        <i class="fa fa-search pos-abs search_group" style="line-height: 66px; left: 15px; cursor: pointer; top: 0px;"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>