<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05"> 
            <!--btn back-->
            <div class="flt-menu pull-left">
                <a href="<?php echo $this->html->url('/cars/listofferbuying?car_id='.$this->params['url']['car_id'].'&filter='.$this->params['url']['filter']) ?>" class="btn-back color-black no-underline-hover dis-inlblock truncate" style="max-width: 250px;"><i class="fa fa-angle-left font-size-17" style="margin-right: 5px;"></i> <span>BACK BUYING OFFERS</span></a>
            </div>

            <!--button email-->
            <div class="pull-right flt-menu mg-left-40">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content content-right btn" href="<?php echo $this->Html->Url('/car_detail_action_page?company_id='. $companyId .'&car_id='. $carId . '&openfrom=offerbuy') ?>">
                        <i class="ace-icon fa fa-envelope"></i>
                        <span>Send Email To Owner</span>
                    </a>
                </div>
            </div>
            
            <!--button send offer-->
            <div class="pull-right flt-menu mg-left-40 hidden">
                <div class="btn-group mg-bottom-4">
                    <a class="flt-menu-content content-right btn btn-send-offer" data-car-id="<?php echo $carId ?>" href="javascript:;">
                        <i class="ace-icon fa fa-plus"></i>
                        <span>Send A New Offer</span>
                    </a>
                </div>
            </div>
        </div>
</div>