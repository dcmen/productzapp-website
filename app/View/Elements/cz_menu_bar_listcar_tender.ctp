<div class="flt-menu-bar">
    <div class="flt-menu-ridbon color-bg-site"></div>
    <div class="pd-content-05"> 
        <!--btn back-->
        <div class="flt-menu pull-left">
            <a href="<?php echo $this->html->url('/tenderoffer?type='.$type) ?>" class="btn-back color-black no-underline-hover" style="max-width: 250px;"><i class="fa fa-angle-left font-size-17" style="margin-right: 5px;"></i> <span><?php echo ($type == 1)? 'MY TENDERS' : 'OTHER TENDER' ?></span></a>
        </div>

        <?php if($inProgress == 0 && $type == 1) : ?>
            <?php if ($viewBy  == 0) : ?>
                <div class="pull-right flt-menu mg-left-40  ">
                    <div class="btn-group mg-bottom-4">
                        <a class="flt-menu-content content-right btn btn-add-dealer-tender" href="javascript:;">
                            <i class="ace-icon fa fa-plus"></i>
                            <span>Add Dealers</span>
                        </a>
                    </div>
                </div>
            <?php elseif ($viewBy == 1) : ?>
                <div class="pull-right flt-menu mg-left-30  ">
                    <div class="btn-group mg-bottom-4">
                        <a class="flt-menu-content content-right btn btn-add-car-tender" href="javascript:;">
                            <i class="ace-icon fa fa-plus"></i>
                            <span>Add Cars</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if($type == 1) : ?>
            <div class="pull-right flt-menu mg-left-30 dis-none-max-800">
                <span class="flt-menu-txt">View By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span>
                        <?php 
                            if (isset($viewBy)) {
                                if ($viewBy == 0) {
                                    echo 'Dealers ('.$totalDealers.')';
                                }
                                else if ($viewBy == 1) {
                                    echo 'Cars ('.$totalCars.')';
                                } 
                            }
                            else {
                                echo 'Dealers';
                            }
                        ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        $paras = $this->params['url'];
                        ?>
                        <li><a href="<?php $paras['view_by'] = 0; echo $this->Common->createLink($paras, $this->request->here); ?>">Dealers (<?php echo $totalDealers ?>)</a></li>
                        <li><a href="<?php $paras['view_by'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">Cars (<?php echo $totalCars ?>)</a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if($type == 2 && $inProgress == 1) : ?>
        <div class="pull-right flt-menu mg-left-40  ">
            <div class="btn-group mg-bottom-4">
                <a class="flt-menu-content btn btn-send-offer-list" href="javascript:;" style="padding: 8px 25px 8px 25px; font-size: 14px;">
                    <span>SEND</span>
                </a>
            </div>
        </div>
        <div class="pull-right flt-menu mg-left-40  ">
            <div class="btn-group mg-bottom-4">
                <span>Total: </span>
                <strong class="total-offer">
                    <?php 
                    $total = 0;
                    foreach($list as $data) {
                        $total += (isset($data->views->offer_info->make_on_offer) && $data->views->offer_info->make_on_offer)? $data->views->offer_info->make_on_offer : 0;
                    }
                    echo number_format($total,0,',',',');
                    ?>
                </strong>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>