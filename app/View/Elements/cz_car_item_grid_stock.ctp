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
<div class="wg-car-grid">
    <div class="wg-car-img" >
        <img src="<?php echo (isset($car->image_url)  && $car->image_url) ? $car->image_url : $this->webroot . 'images/no_car.png' ?>"  onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
        <?php if (trim($car->video_url)) : ?>
        <a class="wg-car-btnvideo font-txt-small" data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
        <?php endif; ?>
        <?php if(isset($user->company_id) && $user->company_id != CakeSession::read('Auth.User.company_id')) : ?>
        <div class="wg-follow clickfollow <?php echo ($view->is_follow)? 'dis_follow' : 'follow'?>" car_id="<?php echo $car->_id?>">
            <?php echo ($view->is_follow)? '<i title="Unfollow this car" class="fa fa-star star-yellow"></i>' : '<i title="Follow this car" class="fa fa-star"></i>'?>
        </div>
        <?php endif; ?>
    </div>
    <div class="wg-car-info-box">
        <header class="wg-info-header">
            <div class="wg-name-ridbon color-bg-site"></div>
            <h2 class="wg-name font-size-17 truncate" title="<?php echo $carName ?>"><?php echo $carName ?></h2>
        </header>
        <div class="wg-car-info">
            <div class="car-info-item col-md-12 no-padding">
                <span class="car-info-title">Body Style:</span>
                <span class="car-info-content color-txt-grey"><?php echo ($car->body) ? $car->body : 'Not set' ?></span>
            </div>
            <div class="car-info-item col-md-12 no-padding">
                <span class="car-info-title">Engine:</span>
                <span class="car-info-content color-txt-grey"><?php echo ($car->engine_type) ? $car->engine_type : 'Not set' ?></span>
            </div>
            <div class="car-info-item col-md-12 no-padding">
                <span class="car-info-title">Mileage:</span>
                <span class="car-info-content color-txt-grey"><?php echo ($car->odometer) ? number_format($car->odometer,0,',',',') : 'Not set' ?></span>
            </div>
            <div class="car-info-item col-md-12 no-padding">
                <span class="car-info-title">Color:</span>
                <span class="car-info-content color-txt-grey"><?php echo ($car->body_colour) ? $car->body_colour : 'Not set' ?></span>
            </div>
            <div class="car-info-item col-md-12 no-padding">
                <span class="car-info-title">Make:</span>
                <span class="car-info-content color-txt-grey"><?php echo ($car->make) ? $car->make : 'Not set' ?></span>
            </div>
            <div class="car-info-item col-md-12 no-padding">
                <span class="car-info-title">Series:</span>
                <span class="car-info-content color-txt-grey"><?php echo ($car->series) ? $car->series : 'Not set' ?></span>
            </div>
            <?php if ($user->company_id == CakeSession::read('Auth.User.company_id')) : ?>
            <div class="mg-top-15">
                <img style="margin-right: 8px; height: 25px; margin-top: -6px;" src="<?php echo $this->webroot . 'images/followed_number.png' ?>" /><?php echo $car->count_follow?>
            </div>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <div style="position: relative; height: 50px;">
            <span class="wg-car-price color-site-imp">
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
            <div style="position: absolute; bottom: 0px; right: 0px;">
                <a href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="btn-view-car-detail color-bg-btn-hover">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
            </div>
        </div>
    </div>
</div>