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
<div id="<?php echo $car->_id; ?>" class="car-detail-01 kb-animate-right col-md-12 mg-bottom-20 <?php echo ($view->is_follow)? 'dis_follow' : 'follow' ?>" data-car-id="<?php echo $car->_id; ?>">
    <div class="wg-car-list">
        <div class="wg-car-img" >
            <img src="<?php echo (isset($car->image_url)  && $car->image_url) ? $car->image_url : $this->webroot . 'images/no_car.png' ?>" onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
<!--            <img src="--><?php //echo (isset($car->image_url)  && $car->image_url) ? $car->image_url : $this->webroot . 'images/no_car.png' ?><!--">-->
            <?php if (trim($car->video_url)) : ?>
            <a class="wg-car-btnvideo" data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
            <?php endif; ?>
            <?php if(isset($user->company_id) && $user->company_id != CakeSession::read('Auth.User.company_id') && !isset($hide_btn_follow)) : ?>
            <div class="wg-follow clickfollow <?php echo ($view->is_follow)? 'dis_follow' : 'follow'?>" car_id="<?php echo $car->_id?>">
                <?php echo ($view->is_follow)? '<i title="Unfollow this car" class="fa fa-star star-yellow"></i>' : '<i title="Follow this car" class="fa fa-star"></i>'?>
            </div>
            <?php endif; ?>
        </div>
        
        <?php if (isset($view->is_setforget) && $view->is_setforget) : ?>
        <div class="dis-none-min-641 text-center">
            <div class="clearfix mg-bottom-8"></div>
            <?php if ($user->company_id == CakeSession::read('Auth.User.company_id')) : ?>
                <a href="javascript:;" class="match-setforget color-bg-orange no-decoration color-white-imp">Match your Set & Forget</a>
<!--            --><?php //else : ?>
<!--                <a href="javascript:;" class="match-setforget color-bg-site no-decoration color-white-imp">Match another Set & Forget</a>-->
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <div class="wg-car-info-box">
            <header class="wg-info-header">
                <div class="wg-name-ridbon color-bg-site"></div>
                <h2 class="wg-name font-txt-header truncate" title="<?php echo $carName ?>"><?php echo $carName ?></h2>
                <span class="wg-car-price  dis-none-max-768 dis-none-768-980">
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
            <div class="wg-car-info">
                <div class="car-info-item col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding">
                    <span class="car-info-title">Body Style:</span>
                    <span class="car-info-content color-txt-grey"><?php echo ($car->body) ? $car->body : 'Not set' ?></span>
                </div>
                <div class="car-info-item col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding">
                    <span class="car-info-title">Engine:</span>
                    <span class="car-info-content color-txt-grey"><?php echo ($car->engine_type) ? $car->engine_type : 'Not set' ?></span>
                </div>
                <div class="car-info-item col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding">
                    <span class="car-info-title">Mileage:</span>
                    <span class="car-info-content color-txt-grey"><?php echo ($car->odometer) ? number_format($car->odometer,0,',',',') . ' kms' : 'Not set' ?></span>
                </div>
                <div class="car-info-item col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding">
                    <span class="car-info-title">Color:</span>
                    <span class="car-info-content color-txt-grey"><?php echo ($car->body_colour) ? $car->body_colour : 'Not set' ?></span>
                </div>
                <div class="car-info-item col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding">
                    <span class="car-info-title">Make:</span>
                    <span class="car-info-content color-txt-grey"><?php echo ($car->make) ? $car->make : 'Not set' ?></span>
                </div>
                <div class="car-info-item col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding">
                    <span class="car-info-title">Series:</span>
                    <span class="car-info-content color-txt-grey"><?php echo (trim($car->series)) ? $car->series : 'Not set' ?></span>
                </div>
                <div class="dis-none-min-801 car-price-mb">
                    <span class="car-info-content"><?php echo ($price != '0')? '$'.$price : '' ?></span>
                </div>
                
                <?php if ($user->company_id == CakeSession::read('Auth.User.company_id')) : ?>
                <div class="mg-top-15">
                    <img style="margin-right: 8px; height: 25px; margin-top: -6px;" src="<?php echo $this->webroot . 'images/followed_number.png' ?>" /><?php echo $car->count_follow?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="clearfix"></div>
            <?php if (isset($view->is_setforget) && $view->is_setforget) : ?>
                <?php if ($user->company_id == CakeSession::read('Auth.User.company_id')) : ?>
                    <a href="javascript:;" class="match-setforget color-bg-orange dis-none-max-640-imp no-decoration color-white-imp">Match your Set & Forget</a>
                <?php else : ?>
                    <a class="match-setforget color-bg-site dis-none-max-640-imp no-decoration color-white-imp">Match another Set & Forget</a>
                <?php endif; ?>
            <?php endif; ?>
            <div class="btn-view-car-detail-container">
                <a href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="btn-view-car-detail color-bg-btn-hover">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
            </div>
        </div>
    </div>
</div>