<?php
    //debug($data);die();
    $type_analysis = isset($data->type_analysis) ? $data->type_analysis : null;
    $is_car_sold = isset($type_analysis->is_car_sold) ? $type_analysis->is_car_sold : null;
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
            <div class=" <?php echo (isset($user->company_id) && $user->company_id == CakeSession::read('Auth.User.company_id')) ?>">
                <?php  if (isset($car->is_sold) && $car->is_sold == 1) { ?>
                    <div class="hidden-car-item wg-follow"><img title="Sold" style="height: 30px;padding-top:10px; vertical-align: top;" src="<?php echo $this->webroot . 'images/ic_sold.png' ?>" /></div>
                <?php } else if(isset($car->is_active) && $car->is_active == 0){ ?>
                    <div class="hidden-car-item wg-follow"><img title="Romeved" style="height: 38px; vertical-align: top;" src="<?php echo $this->webroot . 'images/ic_car_remove.png' ?>" /></div>
                <?php }?>
            </div>
        </div>
        <div class="wg-car-info-box">
            <header class="wg-info-header">
                <!--Car name-->
                <div class="wg-name-ridbon color-bg-site"></div>
                <h2 class="wg-name font-txt-header truncate" title="<?php echo $carName ?>"><?php echo $carName ?></h2>
                <!--Car price-->
                <?php  if(isset($type_analysis->buyer_info) && $type_analysis->buyer_info && $is_car_sold == 1){ ?>
                <span style="width:200px;" class="wg-car-price  dis-none-max-640">
                        <?php $price = number_format($type_analysis->buyer_info->price_sold,0,',',',');
                        if($price != '0') {
                            echo ' Price sold: $'.$price;
                        }
                        else {
                            echo '<div style="color:#777;">'.'Send Offer'.'</div>';
                        }
                        ?>
                </span>
                 <?php }else if($is_car_sold == 0){?>
                <span  class="wg-car-price dis-none-max-640">
                    <?php
                        $price = number_format($car->price,0,',',',');
                            if($price != '0') {?>
                        <?php
                            echo '$'.$price;
                            }
                            else {
                                echo '<div style="color:#777;">'.'Send Offer'.'</div>';
                            }
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
                <?php if ($is_car_sold == 2) : ?>
                <div class="mg-top-15" style="color: #777">
                    <?php echo $user->company_name?>
                </div>
                <?php endif; ?>
                <!--view information car,buyer of car is deleted or is_sold-->
                <?php if ($is_car_sold == 0) : ?>
                    <div class="mg-top-15">
                        <?php echo isset($type_analysis->latest_update) && $type_analysis->latest_update ? 'Last seen: '.$type_analysis->latest_update : null; ;?>
                    </div>
                <?php endif; ?>
                <?php if ($is_car_sold == 1) :  ?>
                <div>
                    <?php
                    if(isset($type_analysis->buyer_info) && $type_analysis->buyer_info){
                        $buyer_info = $type_analysis->buyer_info;
                        $str = '';
                        if ($buyer_info->name) {?>
                        <div><h4>Buyer information</h4></div>
                        <div>

                            <span>Name: </span>
                            <?php echo $buyer_info->name;?>
                        </div>

                        <?php } ?>
                        <?php if ($buyer_info->email) {?>
                            <div>
                                <span>Email:</span>
                                <?php echo $buyer_info->email; ?>
                            </div>
                        <?php }?>
                        <?php if ($buyer_info->date_sold) {?>
                           <div>
                               <span>Date sold:</span>
                               <?php  echo  $buyer_info->date_sold; ?>

                           </div>
                        <?php } ?>
                        <?php if ($buyer_info->price_sold) { ?>
                            <div>
                                <span>Price sold:</span>
                                <?php   echo $buyer_info->price_sold.' $';?>
                            </div>

                        <?php } ?>
                    <?php } ?>
                </div>

                <?php endif;?>

                <!--view number follow-->
                <!--my stock page-->
                <?php if($is_car_sold != 2 && isset($user->company_id) && $user->company_id == CakeSession::read('Auth.User.company_id')) : ?>
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
            <div class="btn-view-detail" style="position: absolute; bottom: 0px; right: 0px;">
                <a href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="btn-view-car-detail color-bg-btn-hover">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
            </div>
        </div>
    </div>
</div>
