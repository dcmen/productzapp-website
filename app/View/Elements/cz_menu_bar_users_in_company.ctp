<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <?php
        $carName = trim($car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox);
        ?>
        <div class="pd-content-05">
            <!--btn back-->
            <?php if (!$openfrom) : ?>
            <div class="flt-menu pull-left">
                <a href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="color-black no-underline-hover dis-inlblock truncate" style="max-width: 250px;"><i class="fa fa-angle-left font-size-17" style="margin-right: 5px;"></i> <span> BACK</span></a>
            </div>
            <?php elseif ($openfrom == 'offerbuy') : ?>
            <div class="flt-menu pull-left">
                <a href="<?php echo $this->Html->Url('/cars/listofferbuying?car_id=' . $carId . '&company_id=' . $companyId) ?>" class="btn-back color-black no-underline-hover dis-inlblock truncate" style="max-width: 250px;"><i class="fa fa-angle-left font-size-17" style="margin-right: 5px;"></i> <span>BACK</span></a>
            </div>
            <?php endif; ?>
            
            <!--input search-->
            <div class="flt-menu pull-right">
                <div class="btn-group mg-bottom-4">
                    <form id="SearchMynetwork" method="get">
                        <?php 
                        $paras = $this->params['url'];
                        ?>
                        <input type="hidden" name="car_id" value="<?php echo $paras['car_id'] ?>" />
                        <input type="hidden" name="company_id" value="<?php echo $paras['company_id'] ?>" />
                        <input type="text" class="flt-menu-content submit_search_input" placeholder="Search" autocomplete="off" id="key" name="keyword" value="<?php echo $keyword ?>"/>
                        <i class="fa fa-search pos-abs search_usersincompany" style="line-height: 66px; right: 15px; cursor: pointer; top: 0px;"></i>
                    </form>
                </div>
                <script>
                    $(document).ready(function () {
                        $('.search_usersincompany').click(function () {
                           $('#SearchMynetwork').submit();
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>