<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-03">
            <!--select number view-->
            <div class="pull-right flt-menu mg-left-40 ">
                <span class="flt-menu-txt dis-none-max-1024">Show On Page</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span><?php echo isset($this->params['url']['limit']) ? $this->params['url']['limit'] . ' items' : '6 items'; ?></span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php 
                        $url = $this->request->here;
                        $paras = $this->params['url'];
                        ?>
                        <li><a href="<?php $paras['limit'] = 6; echo $this->Common->createLink($paras, $this->request->here); ?>">6 items</a></li>
                        <li><a href="<?php $paras['limit'] = 9; echo $this->Common->createLink($paras, $this->request->here); ?>">9 items</a></li>
                        <li><a href="<?php $paras['limit'] = 12; echo $this->Common->createLink($paras, $this->request->here); ?>">12 items</a></li>
                        <li><a href="<?php $paras['limit'] = 15; echo $this->Common->createLink($paras, $this->request->here); ?>">15 items</a></li>
                    </ul>
                </div>
            </div>
            
            <!--select sort by-->
            <div class="flt-menu pull-right">
                <span class="flt-menu-txt dis-none-max-800">Sort By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle btn-image" data-toggle="dropdown">
                        <i class="btn-image-icon fa fa-sort-amount-desc dis-none-min-801"></i>
                        <span class="dis-none-max-800">
                        <?php
                        $paras = $this->params['url'];
                        
                        if (isset($paras['sort'])) {
                            if ($paras['sort'] == 1) {
                                echo 'Prices (low to high)';
                            } else if ($paras['sort'] == 2) {
                                echo 'Prices (high to low)';
                            } else if ($paras['sort'] == 3) {
                                echo 'Kms (low to high)';
                            } else if ($paras['sort'] == 4) {
                                echo 'Kms (high to low)';
                            } else if ($paras['sort'] == 5) {
                                echo 'Year (oldest to newest)';
                            } else if ($paras['sort'] == 6) {
                                echo 'Year (newest to oldest)';
                            } else if ($paras['sort'] == 7) {
                                echo 'Make - Model (Z-A)';
                            } else if ($paras['sort'] == 8) {
                                echo 'Make - Model (A-Z)';
                            } else if ($paras['sort'] == 9) {
                                echo 'DIS (newest to oldest)';
                            } else if ($paras['sort'] == 10) {
                                echo 'DIS (oldest to newest)';
                            } else if ($paras['sort'] == 11) {
                                echo 'Followed (least to most)';
                            } else if ($paras['sort'] == 12) {
                                echo 'Followed (most to least)';
                            }
                        }else {
                            echo 'Make - Model (A-Z)';
                        }
                        ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        $paras = $this->params['url'];
                        $sortdata = (isset($paras['sort'])? $paras['sort'] : '');
                        ?>
                        <?php if (isset($my_stock) && $my_stock == 1) : ?>
                        <li class="<?php echo ($sortdata == 10)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 10; echo $this->Common->createLink($paras, $this->request->here); ?>">DIS (oldest to newest)</a></li>
                        <li class="<?php echo ($sortdata == 9)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 9; echo $this->Common->createLink($paras, $this->request->here); ?>">DIS (newest to oldest)</a></li>
                        <?php endif; ?>
                        <li class="<?php echo ($sortdata == 1)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">Prices (low to high)</a></li>
                        <li class="<?php echo ($sortdata == 2)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">Prices (high to low)</a></li>
                        <li class="<?php echo ($sortdata == 3)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 3; echo $this->Common->createLink($paras, $this->request->here); ?>">Kms (low to high)</a></li>
                        <li class="<?php echo ($sortdata == 4)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 4; echo $this->Common->createLink($paras, $this->request->here); ?>">Kms (high to low)</a></li>
                        <li class="<?php echo ($sortdata == 5)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 5; echo $this->Common->createLink($paras, $this->request->here); ?>">Year (oldest to newest)</a></li>
                        <li class="<?php echo ($sortdata == 6)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 6; echo $this->Common->createLink($paras, $this->request->here); ?>">Year (newest to oldest)</a></li>
                        <li class="<?php echo ($sortdata == 7)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 7; echo $this->Common->createLink($paras, $this->request->here); ?>">Make - Model (Z-A)</a></li>
                        <li class="<?php echo ($sortdata == 8)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 8; echo $this->Common->createLink($paras, $this->request->here); ?>">Make - Model (A-Z)</a></li>
                        <?php if (isset($my_stock) && $my_stock == 1) : ?>
                        <li class="<?php echo ($sortdata == 12)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 12; echo $this->Common->createLink($paras, $this->request->here); ?>">Followed (most to least)</a></li>
                        <li class="<?php echo ($sortdata == 11)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 11; echo $this->Common->createLink($paras, $this->request->here); ?>">Followed (least to most)</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            
            <div class="flt-menu pull-left">
                <span class="flt-menu-txt"><?php echo $total ?>  RESULT(S)</span>
            </div>
        </div>
    </div>
</div>