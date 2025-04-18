<?php
?>
<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05"> 
            <!--btn back-->
            <div class="flt-menu pull-left">
                <a href="<?php echo $this->html->url('/offerboard') ?>" class="btn-back color-black no-underline-hover" style="max-width: 250px;"><i class="fa fa-angle-left font-size-17" style="margin-right: 5px;"></i> <span>BACK OFFER BOARD</span></a>
            </div>

            <!--button email-->
            <div class="pull-right flt-menu mg-left-40">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content content-right btn" href="<?php echo $this->Html->Url('/car_detail_action_page?company_id='. $companyId .'&car_id='. $carId . '&openfrom=offerbuy') ?>">
                        <i class="ace-icon fa fa-envelope"></i>
                        <span class="dis-none-max-640">Send Email To Owner</span>
                    </a>
                </div>
            </div>
        </div>

        <!--select filter-->
        <div class="pull-right flt-menu mg-left-40 dis-none-max-800">
            <span class="flt-menu-txt">Filter By</span>
            <div class="btn-group mg-bottom-4">
                <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span>
                            <?php
                            if ($filter == 0) {
                                echo 'All Offers';
                            }
                            else if ($filter == 1) {
                                echo 'General Offers';
                            }
                            else if ($filter == 2) {
                                echo 'Tender Offers';
                            }
                            ?>
                        </span>
                    <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                </button>
                <ul class="dropdown-menu">
                    <?php
                    $paras = $this->params['url'];
                    ?>
                    <li><a href="<?php $paras['filter'] = 0; echo $this->Common->createLink($paras, $this->request->here); ?>">All Offers</a></li>
                    <li><a href="<?php $paras['filter'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">General Offers</a></li>
                    <li><a href="<?php $paras['filter'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">Tender Offers</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>