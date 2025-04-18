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
<div id="<?php echo $car->_id; ?>" class="col-md-12 mg-bottom-20 no-padding">
    <div class="wg-car-detail">
        <div class="wg-car-img" >
            <!--car image-->
            <a href="<?php echo $this->html->url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" target="_blank">
                <img src="<?php echo (isset($car->image_url)  && $car->image_url) ? $car->image_url : $this->webroot . 'images/no_car.png' ?>"  onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
            </a>
            <!--button video-->
            <?php if (trim($car->video_url)) : ?>
            <a class="wg-car-btnvideo" data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
            <?php endif; ?>
        </div>
        <div class="wg-car-info-box">
            <header class="wg-info-header">
                <!--Car name-->
                <div class="wg-name-ridbon color-bg-site"></div>
                <h2 class="wg-name font-txt-header truncate" title="<?php echo $carName ?>"><a href="<?php echo $this->html->url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" target="_blank"><?php echo $carName ?></a></h2>
                <!--Car price-->
                <span class="wg-car-price  dis-none-max-640">
                    <?php 
                    $price = number_format($car->price,0,',',',');
                    if($price != '0') {
                        echo '$'.$price;
                    }
                    else {
                        echo '<div style="color:#777;" >'.'Send Offer'.'</div>';
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
            <span class="wg-car-price color-site-imp dis-none-min-641">
                <?php
                    if($price != '0') {
                        echo '$'.$price;
                    }
                    else {
                        echo '<div style="color:#777;" >'.'Send Offer'.'</div>';
                    }
                ?>
            </span>
        </div>
    </div>
</div>
