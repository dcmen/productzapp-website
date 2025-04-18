<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-03">
            <!--select number view-->
            <div class="pull-right flt-menu mg-left-40 dis-none-max-950">
                <span class="flt-menu-txt dis-none-max-1024">Show On Page</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span><?php echo isset($limit) ? $limit . ' items' : '6 items'; ?></span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php 
                        $paras = $this->params['url'];
                        ?>
                        <li><a href="<?php $paras['limit'] = 6; echo $this->Common->createLink($paras, $this->request->here); ?>">6 items</a></li>
                        <li><a href="<?php $paras['limit'] = 9; echo $this->Common->createLink($paras, $this->request->here); ?>">9 items</a></li>
                        <li><a href="<?php $paras['limit'] = 12; echo $this->Common->createLink($paras, $this->request->here); ?>">12 items</a></li>
                        <li><a href="<?php $paras['limit'] = 15; echo $this->Common->createLink($paras, $this->request->here); ?>">15 items</a></li>
                    </ul>
                </div>
            </div>
            <!-- Add tender button -->
            <div class="pull-right flt-menu mg-left-40 ">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content content-right btn btn-send-offer"  href="<?php echo $this->html->url('/cars/add_tender') ?>">
                        <i class="ace-icon fa fa-plus"></i>
                        <span>Add Tender</span>
                    </a>
                </div>
            </div>
            <!--select view by-->
            <div class="pull-right flt-menu mg-left-40 viewby">
                <span class="flt-menu-txt dis-none-max-1024">View By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span>
                            <?php 
                            if ($type == 1) {
                                echo 'My Tenders';
                            }
                            else if ($type == 2) {
                                echo 'Other Tenders';
                            }
                            ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php 
                        $paras = $this->params['url'];
                        ?>
                        <li><a href="<?php $paras['type'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">My Tenders</a></li>
                        <li><a href="<?php $paras['type'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">Other Tender</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="flt-menu pull-left tender-result">
                <span class="flt-menu-txt"><span class="count-data"><?php echo $total ?></span> RESULT(S)</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>