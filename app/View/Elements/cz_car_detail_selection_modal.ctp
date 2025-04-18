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
<div id="<?php echo $car->_id ?>" class="col-md-12 no-padding item-checkbox car-detail-selection-modal cursor-pointer" style="border-bottom: 1px solid #aaa; padding-bottom: 18px; padding-top: 10px; cursor: pointer;">
    <div class="wg-car-detail">
        <div class="wg-car-img" >
            <!--car image-->
            <img src="<?php echo (isset($car->image_url)  && $car->image_url) ? $car->image_url : $this->webroot . 'images/no_car.png' ?>"  onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
        </div>
        <div class="wg-car-info-box">
            <header class="wg-info-header">
                <!--Car name-->
                <h2 class="wg-name font-txt-header truncate" title="<?php echo $carName ?>"><a  href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>"><?php echo $carName ?></a> </h2>
                <!--Car price-->
                <?php if (!isset($hide_check_box)) : ?>
                <span class="wg-car-price dis-none-max-640 pos-rel" style="top: -10px;">
                    <input class="car-ids" type="checkbox" value="<?php echo $car->_id ?>" name="arr_tender_car[]" onclick="return false" />
                    <div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0"></div>
                </span>
                <?php endif; ?>
            </header>
            <div class="wg-car-info mystock">
                <div class="truncate">
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
                
                <!--car price-->
                <div style="margin-top: 8px;">
                    <div class="col-lg-6 no-padding" style="color: #444">
                        <?php 
                        $price = number_format($car->price,0,',',',');
                        if($price != '0') {
                            echo '$'.$price;
                        }
                        else {
                            echo 'Send Offer';
                        }
                        ?>
                    </div>
                    <?php if (!isset($hide_check_box)) : ?>
                    <div class="col-lg-6 no-padding">
                        <span>DIS <?php echo $car->dis ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
