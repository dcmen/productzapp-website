<style>
    @media (max-width:640px) {
        .wg-car-list {
            padding: 12px;
            padding-bottom: 64px;
        }
        .wg-car-list > .wg-car-img {
            float: none;
        }
        .wg-car-list > .wg-car-info-box {
            margin: 0;
            position: relative;
            top: auto;
        }
        .wg-info-header {
            margin-top: 10px;
            padding-bottom: 3px;
            margin-bottom: 19px;
        }
        .wg-info-header > .wg-name {
            min-width: auto;
            font-size: 17px;
            margin-bottom: 3px;
        }
        .wg-car-info.mystock {
            font-size: 14px;
        }
        .wg-car-info.tenderitem {
            font-size: 14px;
        }
        .wg-car-info.mystock img {
            height: 19px !important;
        }
        .group-info-for-mystock {
            margin-top: 5px;
        }
        .btn-view-detail {
            bottom: -52px !important;
        }
        .wg-car-price {
            bottom: -51px;
            top: auto;
            left: 0;
            text-align: left;
        }
        .wg-info-header > .wg-name {
            max-width: 83%;
        }
    }
</style>
<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-03">
            <!--select number view-->
            <div class="pull-right flt-menu mg-left-40">
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
            

            
            <!--select filter-->
            <?php if (isset($my_stock) && $my_stock == 1) : ?>
            <div class="flt-menu pull-right mg-left-40">
                <span class="flt-menu-txt dis-none-max-1024">Filter By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle btn-image" data-toggle="dropdown">
                        <i class="btn-image-icon fa fa-filter dis-none-min-801"></i>
                        <span class="dis-none-max-800">
                        <?php
                        if (isset($filter)) {
                            if ($sort == 0) {
                                echo 'All Cars';
                            } else if ($filter == 1) {
                                echo 'Come Off Cars';
                            } else if ($filter == 2) {
                                echo 'Sold Cars';
                            } else {
                                echo 'All Cars';
                            }
                        }else {
                            echo 'All cars';
                        }
                        ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        $paras = $this->params['url'];
                        ?>
                        <li class="<?php echo ($filter == 0)? 'active' : '' ?>" ><a href="<?php $paras['filter'] = 0; echo $this->Common->createLink($paras, $this->request->here); ?>">All Cars</a></li>
                        <li class="<?php echo ($filter == 1)? 'active' : '' ?>" ><a href="<?php $paras['filter'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">Come Off Cars</a></li>
                        <li class="<?php echo ($filter == 2)? 'active' : '' ?>" ><a href="<?php $paras['filter'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">Sold Cars</a></li>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <div class="flt-menu pull-left">
                <span class="flt-menu-txt"><span class="count-car"><?php echo $total ?></span> RESULT(S)</span>
            </div>
        </div>
    </div>
</div>