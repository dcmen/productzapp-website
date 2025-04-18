<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05"> 
            <!--btn back-->
            <div class="flt-menu pull-left">
                <a href="<?php echo $this->html->url('/offerboard?type=2') ?>" class="btn-back color-black no-underline-hover dis-inlblock truncate" style="max-width: 250px;"><i class="fa fa-angle-left font-size-17" style="margin-right: 5px;"></i> <span>BACK OFFER BOARD</span></a>
            </div>
            
            <!--select sort by-->
            <div class="flt-menu pull-right mg-left-40">
                <span class="flt-menu-txt dis-none-max-800">Sort By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle btn-image" data-toggle="dropdown">
                        <img class="dis-none-min-801" style="width: 18px; height: 18px;" src="<?php echo $this->webroot . 'images/ic_short.png' ?>" />
                        <span class="dis-none-max-800">
                        <?php
                        if (isset($sort)) {
                            if ($sort == 0) {
                                echo 'Highest offer to top';
                            } else if ($sort == 1) {
                                echo 'Most recent to top';
                            } else if ($sort == 2) {
                                echo 'Group by buyer';
                            }
                        }else {
                            echo 'Highest offer to top';
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
                        <li class="<?php echo ($sortdata == 0)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 0; echo $this->Common->createLink($paras, $this->request->here); ?>">Highest offer to top</a></li>
                        <li class="<?php echo ($sortdata == 1)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">Most recent to top</a></li>
                        <li class="<?php echo ($sortdata == 2)? 'active' : '' ?>" ><a href="<?php $paras['sort'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">Group by buyer</a></li>
                    </ul>
                </div>
            </div>
            
            <!--select filter by-->
            <div class="flt-menu pull-right mg-left-40">
                <span class="flt-menu-txt dis-none-max-800">Filter By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle btn-image" data-toggle="dropdown">
                        <img class="dis-none-min-801" style="width: 18px; height: 18px;" src="<?php echo $this->webroot . 'images/ic_short.png' ?>" />
                        <span class="dis-none-max-800">
                        <?php
                        if (isset($filter)) {
                            if ($filter == 0) {
                                echo 'All Offers';
                            } else if ($filter == 1) {
                                echo 'Pending Offers';
                            }else if ($filter == 2) {
                                echo 'General Offers';
                            }else if ($filter == 3) {
                                echo 'Tender Offers';
                            }

                        }else {
                            echo 'All Offers';
                        }
                        ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        $paras = $this->params['url'];
                        $filterdata = (isset($paras['filter'])? $paras['filter'] : '');
                        ?>
                        <li class="<?php echo ($filterdata == 0)? 'active' : '' ?>" ><a href="<?php $paras['filter'] = 0; echo $this->Common->createLink($paras, $this->request->here); ?>">All Offers</a></li>
                        <li class="<?php echo ($filterdata == 1)? 'active' : '' ?>" ><a href="<?php $paras['filter'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">Pending Offers</a></li>
                        <li class="<?php echo ($filterdata == 1)? 'active' : '' ?>" ><a href="<?php $paras['filter'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">General Offers</a></li>
                        <li class="<?php echo ($filterdata == 1)? 'active' : '' ?>" ><a href="<?php $paras['filter'] = 3; echo $this->Common->createLink($paras, $this->request->here); ?>">Tender Offers</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>