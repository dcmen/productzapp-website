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
<div id="<?php echo $car->_id; ?>" class="col-md-12 mg-bottom-20">
    <div class="wg-car-list">
        <div class="wg-car-img" >
            <!--car image-->
            <img src="<?php echo (isset($car->image_url)  && $car->image_url) ? $car->image_url : $this->webroot . 'images/no_car.png' ?>"  onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
            <!--button video-->
            <?php if (trim($car->video_url)) : ?>
            <a class="wg-car-btnvideo  data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
            <?php endif; ?>
            <!--button follow car-->
            <?php if(isset($user->company_id) && $user->company_id != CakeSession::read('Auth.User.company_id')) : ?>
            <div class="wg-follow clickfollow <?php echo ($view->is_follow)? 'dis_follow' : 'follow'?>" car_id="<?php echo $car->_id?>">
                <?php echo ($view->is_follow)? '<i title="Unfollow this car" class="fa fa-star star-yellow"></i>' : '<i title="Follow this car" class="fa fa-star"></i>'?>
            </div>
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
                <!--Button hide, unhide in stock-->
                <?php if($view_type != 2 && isset($user->company_id) && $user->company_id == CakeSession::read('Auth.User.company_id')) : ?>
                    <?php if (isset($car->is_sold) && $car->is_sold != 1) : ?>
                    <div title="Unhide this car" data-car-id="<?php echo $car->_id ?>" class="hidden-car-item btn-unhide-car <?php echo (isset($car->is_active) && $car->is_active == 2)? '' : 'hidden' ?>" style="display: inline-block; vertical-align: top; margin-top: 5px; cursor: pointer; margin-right: 8px;">
                        <i class="fa fa-eye" style="font-size: 22px; margin-top: 5px; margin-left: 8px;"></i>
                    </div>
                    <div title="Hide this car" data-car-id="<?php echo $car->_id ?>" class="btn-hide-car show-car-item <?php echo (!(isset($car->is_active) && $car->is_active == 2))? '' : 'hidden' ?>" style="display: inline-block; vertical-align: top; margin-top: 10px; cursor: pointer;">
                        <img style="height: 25px; margin-left: 8px;" src="<?php echo $this->webroot . 'images/ic_hidden.png' ?>" />
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
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
                <?php if ($view_type == 2) : ?>
                <div class="mg-top-15" style="color: #777">
                    <?php echo $user->company_name?>
                </div>
                <?php endif; ?>
                
                <!--view number follow-->
                <!--my stock page-->
                <?php if($view_type != 2 && isset($user->company_id) && $user->company_id == CakeSession::read('Auth.User.company_id')) : ?>
                <div class="group-info-for-mystock">
                    <!--my stock page-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 no-padding" style="margin-top: 5px;">
                        <img style="margin-right: 8px; height: 25px; margin-top: -6px;" src="<?php echo $this->webroot . 'images/followed_number.png' ?>" /><?php echo $car->count_follow?>
                    </div>
                    <?php if (isset($car->dis)) : ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 no-padding" style="font-size: 14px; margin-top: 5px;"><span>DIS <?php echo $car->dis ?></span></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <span class="wg-car-price color-site-imp dis-none-min-641">
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
            
            <div class="btn-view-detail" style="position: absolute; bottom: 0px; right: 0px;">
                <a href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="btn-view-car-detail color-bg-btn-hover">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
            </div>
        </div>
    </div>
</div>
