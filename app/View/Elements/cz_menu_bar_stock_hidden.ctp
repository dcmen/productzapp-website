<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-03">
            <!--select number view-->
            <div class="pull-right flt-menu mg-left-40">
                <span class="flt-menu-txt">Show On Page</span>
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
            <div class="flt-menu pull-right mg-left-40">
                <span class="flt-menu-txt">Sort By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span>
                        <?php
                        if (isset($sort)) {
                            if ($sort == 1) {
                                echo 'Prices (low to high)';
                            } else if ($sort == 2) {
                                echo 'Prices (high to low)';
                            } else if ($sort == 3) {
                                echo 'Kms (low to high)';
                            } else if ($sort == 4) {
                                echo 'Kms (high to low)';
                            } else if ($sort == 5) {
                                echo 'Year (oldest to newest)';
                            } else if ($sort == 6) {
                                echo 'Year (newest to oldest)';
                            } else if ($sort == 7) {
                                echo 'Make - Model (Z-A)';
                            } else if ($sort == 8) {
                                echo 'Make - Model (A-Z)';
                            } else if ($sort == 8) {
                                echo 'Make - Model (A-Z)';
                            } else if ($sort == 9) {
                                echo 'DIS (newest to oldest)';
                            } else if ($sort == 10) {
                                echo 'DIS (oldest to newest)';
                            } else if ($sort == 11) {
                                echo 'Followed (least to most)';
                            } else if ($sort == 12) {
                                echo 'Followed (most to least)';
                            }
                        }else {
                            echo 'DIS (newest to oldest)';
                        }
                        ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        $paras = $this->params['url'];
                        ?>
                        <li><a href="<?php $paras['sort'] = 10; echo $this->Common->createLink($paras, $this->request->here); ?>">DIS (oldest to newest)</a></li>
                        <li><a href="<?php $paras['sort'] = 9; echo $this->Common->createLink($paras, $this->request->here); ?>">DIS (newest to oldest)</a></li>
                        <li><a href="<?php $paras['sort'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">Prices (low to high)</a></li>
                        <li><a href="<?php $paras['sort'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">Prices (high to low)</a></li>
                        <li><a href="<?php $paras['sort'] = 3; echo $this->Common->createLink($paras, $this->request->here); ?>">Kms (low to high)</a></li>
                        <li><a href="<?php $paras['sort'] = 4; echo $this->Common->createLink($paras, $this->request->here); ?>">Kms (high to low)</a></li>
                        <li><a href="<?php $paras['sort'] = 5; echo $this->Common->createLink($paras, $this->request->here); ?>">Year (oldest to newest)</a></li>
                        <li><a href="<?php $paras['sort'] = 6; echo $this->Common->createLink($paras, $this->request->here); ?>">Year (newest to oldest)</a></li>
                        <li><a href="<?php $paras['sort'] = 7; echo $this->Common->createLink($paras, $this->request->here); ?>">Make - Model (Z-A)</a></li>
                        <li><a href="<?php $paras['sort'] = 8; echo $this->Common->createLink($paras, $this->request->here); ?>">Make - Model (A-Z)</a></li>
                        <li><a href="<?php $paras['sort'] = 12; echo $this->Common->createLink($paras, $this->request->here); ?>">Followed (most to least)</a></li>
                        <li><a href="<?php $paras['sort'] = 11; echo $this->Common->createLink($paras, $this->request->here); ?>">Followed (least to most)</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="flt-menu pull-left mg-right-40">
                <a href="<?php echo $this->Html->Url('/my_stock') ?>" class="color-black no-underline-hover"><i class="fa fa-angle-left font-size-17"></i> <span> BACK</span></a>
            </div>
            
            <div class="flt-menu pull-left">
                <span class="flt-menu-txt"><span class="count-car"><?php echo $total ?></span> RESULT(S)</span>
            </div>
        </div>
    </div>
</div>