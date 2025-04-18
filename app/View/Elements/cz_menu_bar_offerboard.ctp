<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-03">
            <!--select number view-->
            <div class="pull-right flt-menu mg-left-40">
                <span class="flt-menu-txt  dis-none-max-800">Show On Page</span>
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
             
            <!--select view by-->
            <div class="pull-right flt-menu mg-left-40">
                <span class="flt-menu-txt dis-none-max-800">View By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span>
                            <?php 
                            if ($type == 1) {
                                echo 'Buying';
                            }
                            else if ($type == 2) {
                                echo 'Selling';
                            }
                            else if ($type == 3) {
                                echo 'History';
                            }
                            ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php 
                        $paras = $this->params['url'];
                        ?>
                        <li><a href="<?php $paras['type'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">Buying</a></li>
                        <li><a href="<?php $paras['type'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">Selling</a></li>
                        <li><a href="<?php $paras['type'] = 3; echo $this->Common->createLink($paras, $this->request->here); ?>">History</a></li>
                    </ul>
                </div>
            </div>
            <div class="flt-menu pull-left">
                <span class="flt-menu-txt"><span class="count-data"><?php echo $total ?></span> RESULT(S)</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>