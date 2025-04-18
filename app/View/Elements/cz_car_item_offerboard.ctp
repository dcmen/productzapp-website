<?php

    $car = $data->cars;
    $view = $data->views;
    if (isset($data->company_info)) {
        $user = $data->company_info;
    }
    if (isset($data->users)) {
        $user = $data->users;
    }
    $carName = trim($car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox);
?>
<div id="<?php echo $view->offer_id ?>" data-buyer-id="<?php if ($view_type == 3) {echo $data->buyer_info->_id;}  ?>" data-car-id="<?php echo $car->_id ?>" data-offer-price="<?php echo $view->make_on_offer ?>" data-offer-valid="<?php echo $view->offer_valid ?>" class="offer-item col-md-12 mg-bottom-20">
    <div class="wg-car-list wg-car-offerboard">
        <div class="wg-car-img" >
            <!--car image-->
            <img src="<?php echo (isset($car->image_url)  && $car->image_url) ? $car->image_url : $this->webroot . 'images/no_car.png' ?>"  onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
            <!--button video-->
            <?php if (trim($car->video_url)) : ?>
            <a class="wg-car-btnvideo" data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
            <?php endif; ?>
            <!--show buy, sell-->
            <?php if ($view_type == 3) : $companyInfo = $data->buyer_info->buyer_company_info; ?>
            <div class="hidden-car-item wg-follow" style="border-radius: 0;">
                <!--bought car-->
                <?php if ($companyInfo->company_id == CakeSession::read('Auth.User.company_id')) : ?>
                <img style="height: 40px; vertical-align: top;" src="<?php echo $this->webroot . 'images/ic_bought.png' ?>" />
                <?php else : ?>
                    <!--sold car-->
                <img style="height: 40px; vertical-align: top;" src="<?php echo $this->webroot . 'images/ic_sold_car.png' ?>" />
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="wg-car-info-box">
            <header class="wg-info-header">
                <!--Car name-->
                <div class="wg-name-ridbon color-bg-site"></div>
                <h2 class="wg-name font-txt-header truncate" title="<?php echo $carName ?>"><?php echo $carName ?></h2>
                <!--Car price-->
                <span class="wg-car-price  dis-none-max-640">
                    <?php 
                    $price = number_format($car->price,0,',',',');
                    if($price != '0') {
                        echo '$'.$price;
                    }
                    else {
                        echo '<div style="color:#777;">'.'Send Offer'.'</div>';
                    }
                    ?>
                </span>
            </header>
            <div class="wg-car-info mystock">
                <div>
                <?php 
                $str = '';
                if ($car->doors) {
                    $str .= $car->doors . ' doors, ';
                }
                if ($car->seats) {
                    $str .= $car->seats . ' seats, ';
                }
                if ($car->body_colour) {
                    $str .= $car->body_colour . ' colour, ';
                }
                if ($car->cylinders) {
                    $str .= $car->cylinders . ' cylinder, ';
                }
                if ($car->odometer) {
                    $str .= 'odometer ' . $car->odometer . ', ';
                }
                if ($car->engine_capacity) {
                    $str .= 'engine capacity ' . $car->engine_capacity;
                }
                if ($str) {
                    echo trim($str, ', ');
                }
                else {
                    echo 'Not set';
                }
                ?>
                </div>
                
                <!--view company name-->
                <div class="mg-top-15" style="color: #777">
                    <?php echo $user->company_name?>
                </div>
            </div>
            <div class="clearfix"></div>
            <span class="wg-car-price dis-none-max-640">
                <?php 
                    $price = number_format($car->price,0,',',',');
                    if($price != '0') {
                        echo '$'.$price;
                    }
                    else {
                        echo'<div style="color:#777;">'.'Send Offer'.'</div>';
                    }
                ?>
            </span>
            
            <?php if ($view_type == 1) : ?>
            <div class="btn-view-detail" style="position: absolute; bottom: 0px; right: 0px;">
                <a style="display: inline-block; width: 165px;height:37px;" href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="btn-view-car-detail color-bg-btn-hover">VIEW CAR DETAILS<span class="fa fa-angle-right"></span></a>
                <a style="display: inline-block; width: 140px;height:37px; margin-left: 8px;" href="<?php echo $this->Html->Url('/cars/listofferbuying?car_id=' . $car->_id . '&company_id=' . $data->company_info->company_id) ?>" class="btn-offer-buy btn-view-car-detail color-bg-btn-hover">VIEW OFFERS<span class="fa fa-angle-right"></span></a>
            </div>
            <?php elseif ($view_type == 2) : ?>
            <div class="btn-view-detail" style="position: absolute; bottom: 0px; right: 0px;">
                <a style="display: inline-block; width: 165px;height:37px;" href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="btn-view-car-detail color-bg-btn-hover">VIEW CAR DETAILS<span class="fa fa-angle-right"></span></a>
                <a style="display: inline-block; width: 140px;height:37px; margin-left: 8px;" href="<?php echo $this->html->url('/cars/listdealersentoffer?car_id=' . $car->_id) ?>" class="btn-offer-sell btn-view-car-detail color-bg-btn-hover">VIEW OFFERS<span class="fa fa-angle-right"></span></a>
            </div>
            <?php elseif ($view_type == 3) : ?>
            <div class="btn-view-detail" style="position: absolute; bottom: 0px; right: 0px;">
                <a  style="display: inline-block; width: 104px;" href="javascript:;" data-type="<?php echo ($companyInfo->company_id != CakeSession::read('Auth.User.company_id'))? '1' : '2' ?>" data-offer-id="<?php echo $view->offer_id ?>" data-is-zooper="<?php echo $view->is_custom_zooper; ?>" class="btn-offer-cancel btn-view-car-detail color-bg-btn-hover">CANCEL<span class="fa fa-angle-right"></span></a>
                <?php if ($companyInfo->company_id != CakeSession::read('Auth.User.company_id')) : ?>
                <a  style="display: inline-block; width: 130px; margin-left: 10px;" href="<?php echo $this->html->url('/users/userprofile?user_id=' . $data->buyer_info->_id) ?>" class="btn-view-car-detail color-bg-btn-hover">VIEW BUYER<span class="fa fa-angle-right"></span></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
