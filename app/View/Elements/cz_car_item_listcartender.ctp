<?php
    $car = $data->cars;
    $view = $data->views;
    $carName = trim($car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox);
    $IdTender = $tender_id;
?>
<div id="<?php echo $car->_id ?>" data-car-id="<?php echo $car->_id ?>" data-tender-id="<?php echo $IdTender ?>" class="tender-item col-md-12 mg-bottom-20">
    <div class="wg-car-list">
        <div class="wg-car-img">
            <!--car image-->
            <img src="<?php echo (isset($car->image_url)  && $car->image_url) ? $car->image_url : $this->webroot . 'images/no_car.png' ?>" onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
            <!--button video-->
            <?php if (trim($car->video_url)) : ?>
            <a class="wg-car-btnvideo" data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
            <?php endif; ?>

            <div class=" <?php echo (isset($user->company_id) && $user->company_id == CakeSession::read('Auth.User.company_id') && isset($car->is_active) && $car->is_active == 2)? hidden : '' ?>">
                <?php  if (isset($car->is_active) && $car->is_active == 2) { ?>
                    <div class="hidden-car-item wg-follow"><img title="Hidden" style="height: 38px; vertical-align: top;" src="<?php echo $this->webroot . 'images/ic_hidden_hover.png' ?>" /></div>
                <?php } if(isset($car->is_sold) && $car->is_sold == 1){ ?>
                    <div class="hidden-car-item wg-follow"><img title="Sold" style="height: 38px; vertical-align: top;" src="<?php echo $this->webroot . 'images/ic_sold.png' ?>" /></div>
                <?php }?>
            </div>
        </div>
        <div class="wg-car-info-box">
            <header class="wg-info-header">
                <!--Car name-->
                <div class="wg-name-ridbon color-bg-site"></div>
                <h2 class="wg-name font-txt-header truncate" title="<?php echo $carName ?>"><?php echo $carName ?></h2>
                <!--Offer price-->
                <?php if($tender_type == 2 && $in_progress == 1 && $car->is_active == 1 && $car->is_sold != 1) : ?>
                    <span class="btn-offer wg-car-price " style="cursor: pointer;" data-car-id="<?php echo $car->_id ?>" data-price="<?php echo (isset($view->offer_info->make_on_offer) && $view->offer_info->make_on_offer)? $view->offer_info->make_on_offer : '0' ?>">
                        <?php if(isset($view->offer_info->make_on_offer) && $view->offer_info->make_on_offer) {
                            echo number_format($view->offer_info->make_on_offer,0,',',',');
                        } else {
                            echo '<div style="color:#337ab7;">'.'Send Offer'.'</div>';
                        }?>
                    </span>
                <?php endif; ?>
            </header>
            <div class="wg-car-info tender">
                <div style="font-size: 17px;">
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
                
                <!--view price-->
                <div class="col-lg-6 no-padding mg-top-30 font-size-17" style="">
                    <?php 
                    $price = number_format($car->price,0,',',',');
                    if($price != '0') {
                        echo '<div style="color:#064b86">'.'$'.$price.'</div>';
                    }
                    else {
                        echo '<div style="color:#777!important;">'.'Send Offer'.'</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class=" btn-view-tender-detail" style="position: absolute; bottom: 0px; right: 0px;">
                <a style="display: inline-block; width: 165px;height:37px;" href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="btn-view-car-detail  color-bg-btn-hover mg-left-10">VIEW CAR DETAILS<span class="fa fa-angle-right"></span></a>
            </div>

        </div>
    </div>
</div>
