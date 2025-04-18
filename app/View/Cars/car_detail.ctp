
<style xmlns="http://www.w3.org/1999/html">
    /*button pre, next*/
    .car-img-group-mb .bx-wrapper .bx-controls-direction a,
    .car-img-group-mb .bx-wrapper:hover .bx-controls-direction a.disabled {
        display: none;
    }
    .car-img-group-mb .bx-wrapper:hover .bx-controls-direction a {
        display: block;
        text-decoration: none;
    }
    .car-img-group-mb .bx-wrapper .bx-controls-direction a span {
        color: #fff;
        display: block;
        font-size: 29px;
        text-align: center;
        text-indent: 0;
        line-height: 140px;
    }
    .car-img-group-mb .bx-wrapper .bx-controls-direction a.bx-next {
        background: rgba(85, 85, 85, 0.8) none repeat scroll 0% 0%;
        margin: 0px;
        top: auto;
        z-index: 80;
        bottom: 0px;
        right: 0px;
        height: 100%;
    }
    .car-img-group-mb .bx-wrapper .bx-controls-direction a.bx-prev {
        background: rgba(85, 85, 85, 0.8) none repeat scroll 0% 0%;
        margin: 0px;
        top: auto;
        z-index: 80;
        bottom: 0px;
        left: 0px;
        height: 100%;
    }
    /*END button pre, next*/
    .content-item lable input {
        margin-right: 10px; 
    }

</style>
<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow" style="padding: 15px 20px 40px;">
                <?php
                if(isset($custom_zooper) && $custom_zooper){
                    $is_cusstom_zooper = 1;
                    if ($custom_zooper && $price) {
                        if ($custom_zooper->price_cheaper_type == 1) {
                            $price_type_1 = $price - $custom_zooper->price_cheaper_value;
                        } else {
                            $price_type_1 = 0;
                        }
                    }
                    if ($custom_zooper && $price) {
                        if ($custom_zooper->price_cheaper_type == 2) {
                            $price_type_2 = $price - ($price * $custom_zooper->price_cheaper_value) / 100;
                        } else {
                            $price_type_2 = '';
                        }
                    }
                }
                else{
                    $price_type_1 = 0;
                    $price_type_2 = 0;
                    $is_cusstom_zooper = null;
                }
                ?>
                <?php if (isset($car) && $car) :?>

                    <header class="wg-info-header big-header">
                        <div class="wg-name-ridbon color-bg-site"></div>
                        <?php
                        $carName = trim($car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox);
                        ?>
                        <h2 class="wg-name font-txt-header truncate" title="<?php echo $carName ?>"><?php echo $carName ?></h2>
                        <?php if ($car->is_active == 1 && $car->is_sold == 0) : ?>
                        <span class="wg-car-price">
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
                        <?php endif; ?>
                    </header>

                    <div class="clearfix mg-bottom-50"></div>

                    <div class="row">
                        <div class="col-md-7 col-xs-12">
                            <div class="car-img-group">
                                <div class="car-img-group-container col-md-9 no-padding">
                                    <ul class="bxslider enable-bx-slider" data-pager-custom="#bx-pager" data-mode="horizontal" data-pager-slide="true" data-mode-pager="vertical" data-pager-qty="4">
                                        <?php if(isset($images) && sizeof($images) > 0) : ?>
                                            <?php foreach($images as $img) : ?>
                                            <li class="pos-rel img-view">
                                                <?php if (trim($car->video_url)) : ?>
                                                <a class="wg-car-btnvideo " data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
                                                <?php endif; ?>
                                                <img src="<?php if(isset($img->image_file_name)  && $img->image_file_name) {echo $img->image_file_name;} else{echo $this->webroot.'images/no_car.png';}?>" onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">

                                                <div class=" <?php echo (isset($user->company_id) && $user->company_id == CakeSession::read('Auth.User.company_id') && isset($car->is_active) && $car->is_active == 2)? hidden : '' ?>">
                                                    <?php  if (isset($car->is_active) && $car->is_active == 2) { ?>
                                                        <div class="hidden-car-item wg-follow"><img title="Hidden" style="height: 38px; vertical-align: top;" src="<?php echo $this->webroot . 'images/ic_hidden_hover.png' ?>" /></div>
                                                    <?php } if(isset($car->is_sold) && $car->is_sold == 1){ ?>
                                                        <div class="hidden-car-item wg-follow"><img title="Sold" style="height: 38px; vertical-align: top;" src="<?php echo $this->webroot . 'images/ic_sold.png' ?>" /></div>
                                                    <?php }?>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <li class="pos-rel img-view">
                                                <?php if (trim($car->video_url)) : ?>
                                                <a class="wg-car-btnvideo" data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
                                                <?php endif; ?>
                                                <img src="<?php echo $this->webroot; ?>images/no_car.png"/>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                                <div class="col-md-3 group-img-review no-padding-right dis-none-max-1024" style="height: 360px; overflow: hidden;">
                                    <div class="group-img-review-container" style="float: right;">
                                        <div id="bx-pager" class="">
                                            <?php if (isset($images) && sizeof($images) > 0) : ?>
                                                <?php for($i = 0; $i < sizeof($images); $i++) : ?>
                                                <a href="#" data-slide-index="<?php echo $i ?>" class="img-review">
                                                    <img class="img-responsive" src="<?php echo (isset($images[$i]->image_file_name)  && $images[$i]->image_file_name) ?$images[$i]->image_file_name : $this->webroot . 'images/no_car.png' ?>"onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
                                                </a>
                                                <?php endfor; ?>
                                            <?php else : ?>
                                                <a href="#" data-slide-index="0" class="img-review">
                                                    <img class="img-responsive" src="<?php echo $this->webroot; ?>images/no_car.png"/>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!--check buying and selling true or false-->
                            <!--check buying if buying is true display review btn-->
                            <?php if($is_buying==1) :?>
                                <div class="car-review-btn">
                                    <div class="" style="display:block;margin-top:5px">
                                        <a style="display: inline-block; width:70px;height:33px;" href="javascript:;" id="btn-review-car" class="btn-review-car-detail">REVIEW</a>
                                    </div>
                                </div>
                            <?php endif;?>
                            <!--check selling if selling is true display view btn-->
                            <?php if($is_selling==1) :?>
                            <div class="car-review-btn">
                                <div class="" style="display:block;margin-top:5px">
                                    <a style="display: inline-block; width:70px;height:33px;" href="<?php echo $this->Html->Url('/offerboard?type=2') ?>" class="btn-view-car-indetail">VIEW</a>
                                </div>
                            </div>
                            <?php endif;?>
                            <div class="clearfix"></div>
                            <div class="group-action-in-car">
                                <?php
                                if ($info_client_no->company_id != CakeSession::read('Auth.User.company_id') && $car->is_active == 1 && $car->is_sold == 0 && $is_tender_offer == 0) : ?>
                                    <a href="javascript:;" class="btn-action-in-car btn-make-offer" title="Make Offer">
                                        <div class="btn-action-in-car-top">
                                            <div>
                                                <img src="<?php echo $this->webroot; ?>images/transaction_white.png"/>
                                            </div>
                                            <p></p>
                                        </div>
                                        <div class="btn-action-in-car-bottom">
                                            MAKE OFFER
                                        </div>
                                    </a>
                                <?php endif; ?>

                                <?php if ($info_client_no->company_id == CakeSession::read('Auth.User.company_id') && $car->is_active == 1 && !$car->is_sold): ?>
                                <a href="javascript:;" class="btn-action-in-car btn-request-offer" title="Request Offer">
                                    <div class="btn-action-in-car-top">
                                        <div>
                                            <img src="<?php echo $this->webroot; ?>images/transaction_white.png"/>
                                        </div>
                                        <p></p>
                                    </div>
                                    <div class="btn-action-in-car-bottom">
                                        REQUEST OFFER
                                    </div>
                                </a>
                                <?php endif; ?>
                                <?php if(isset($info_client_no->company_id) && $info_client_no->company_id != CakeSession::read('Auth.User.company_id') && $car->is_active == 1 && $car->is_sold == 0){?>

                               <form id="followSubmit">
                                   <input type="hidden" name="car_id" value="<?php echo $car->_id ?>"/>
                                   <input type="hidden" name="is_custom_zooper" value="<?php echo $is_cusstom_zooper; ?>"/>
                                   <input type="hidden" name="comments" value= "User followed this car.">
                                   <input type="hidden" name="is_follow" value="<?php echo $follow; ?>"/>
                                   <a href="javascript:;" class="btn-action-in-car clickfollow <?php  echo ($is_follow  > 0) ? 'dis_follow' : 'follow' ?>" user_id="<?php echo $user_session ?>" car_id="<?php echo $id ?>" title="<?php echo ($is_follow  > 0) ? 'Unfollow' : 'Follow' ?> this car">
                                       <div class="btn-action-in-car-top">
                                           <div><span class="fa fa-star <?php  echo ($is_follow > 0) ? 'star-yellow' : '' ?> a_<?php echo $id ?>"></span></div>
                                           <p></p>
                                       </div>
                                       <div id="text-follow" class="btn-action-in-car-bottom">
                                           <?php echo ($is_follow > 0) ? 'UNFOLLOW' : 'FOLLOW' ?>
                                       </div>
                                   </a>
                               </form>


                                <a href="<?php echo $this->Html->Url('/other_stock?car=' . $id) ?>" class="btn-action-in-car" title="View Other Stock">
                                    <div class="btn-action-in-car-top">
                                        <div><span class="fa fa-cubes"></span></div>
                                        <p></p>
                                    </div>
                                    <div class="btn-action-in-car-bottom">
                                        OTHER STOCK
                                    </div>
                                </a>

<!--                                <a href="--><?php //echo $this->Html->Url('/car_detail_action_page?company_id='.$info_client_no->company_id.'&car_id='.$car->_id) ?><!--" class="btn-action-in-car" title="Add My Network">-->
<!--                                    <div class="btn-action-in-car-top">-->
<!--                                        <div><span class="fa fa-group"></span></div>-->
<!--                                        <p></p>-->
<!--                                    </div>-->
<!--                                    <div class="btn-action-in-car-bottom">-->
<!--                                        ADD MY NETWORK-->
<!--                                    </div>-->
<!--                                </a>-->
<!---->
<!--                                <a href="--><?php //echo $this->Html->Url('/car_detail_action_page?company_id='.$info_client_no->company_id.'&car_id='.$car->_id) ?><!--" class="btn-action-in-car btn-send-inbox" title="Send Email">-->
<!--                                    <div class="btn-action-in-car-top">-->
<!--                                        <div><span class="fa fa-envelope"></span></div>-->
<!--                                        <p></p>-->
<!--                                    </div>-->
<!--                                    <div class="btn-action-in-car-bottom">-->
<!--                                        MAIL-->
<!--                                    </div>-->
<!--                                </a>-->
                                <?php } ?>

                                <?php if ($car->is_active == 1 && $car->is_sold == 0 && ((isset($view_info_car->allow_share_car) && $view_info_car->allow_share_car) || (isset($info_client_no->company_id) && $info_client_no->company_id == CakeSession::read('Auth.User.company_id')))) : ?>
                                <a href="<?php echo $this->Html->Url('/share/'.$car->_id)?>" class="btn-action-in-car" title="Share This Car">
                                    <div class="btn-action-in-car-top">
                                        <div><span class="fa fa-share-alt"></span></div>
                                        <p></p>
                                    </div>
                                    <div class="btn-action-in-car-bottom">
                                        SHARE
                                    </div>
                                </a>
                                <?php endif; ?>

                                <a href="javascript:;" class="btn-action-in-car btn-dealership"  title="Show Dealership Detail">
                                    <form id="ContactDealerForm" class="form-horizontal">
                                     <input type="hidden" name="branch_address_id" value="<?php echo $car->branch_address_id;?>"/>
                                     </form>
                                    <div class="btn-action-in-car-top">
                                        <div><span class="fa fa-user"></span></div>
                                        <p><?php echo $info_client_no->company_name?></p>
                                    </div>
                                    <div class="btn-action-in-car-bottom">
                                        DEALERSHIP
                                    </div>
                                </a>

                                <?php if(isset($info_client_no->company_id) && $info_client_no->company_id == CakeSession::read('Auth.User.company_id')) : ?>
                                <a href="javascript:;" class="btn-action-in-car" title="Following">
                                    <div class="btn-action-in-car-top">
                                        <div><span><?php echo $car->count_follow?></span></div>
                                    </div>
                                    <div class="btn-action-in-car-bottom">
                                        FOLLOWING
                                    </div>
                                </a>
                                <?php if (isset($car->dis)) : ?>
                                <a href="javascript:;" class="btn-action-in-car" title="DIS">
                                    <div class="btn-action-in-car-top">
                                        <div><span><?php echo $car->dis?></span></div>
                                    </div>
                                    <div class="btn-action-in-car-bottom">
                                        DIS
                                    </div>
                                </a>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <div class="section-text">
                                <ul id="myTab4" class="nav nav-tabs padding-12 tab-color-blue background-blue">
                                    <li class="active">
                                        <a href="#comment" data-toggle="tab" aria-expanded="false"><b>COMMENTS</b></a>
                                    </li>
                                    <li class="">
                                        <a href="#notes" data-toggle="tab" aria-expanded="false"><b>NOTES</b></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="comment">
                                        <?php if($car->client_no == $user_session) { ?>
                                        <form action="<?php echo $this->Html->Url('/Cars/update_comment')?>" method="post">
                                            <input type="hidden" name="id" value="<?php echo $car->_id?>">
                                            <div class="form-group line-form">
                                                <textarea class="form-control kb-tbox-item" rows="5" id="comment" name="comments" placeholder="Write additional comments"><?php echo $car->comments ?></textarea>
                                            </div>
                                            <div class="form-group line-form" style="text-align: right">
                                                <button type="submit" class="kb-btn-02 color-bg-site pull-right">SAVE<span class="fa fa-angle-right"></span></button>
                                            </div>
                                        </form>
                                        <?php } else {
                                            if (!$car->comments && $car->options) {
                                                echo $car->options;
                                            } else {
                                                echo ($car->comments)? $car->comments : '<i class="mg-left-10">No comment</i>';
                                            }
                                        } ?>
                                    </div>
                                    <div class="tab-pane" id="notes">
                                        <form action="<?php echo $this->Html->Url('/Cars/update_notes')?>" method="post">
                                            <input type="hidden" name="car_id" value="<?php echo $car->_id?>">
                                            <input type="hidden" name="user_id" value="<?php echo $user_session?>">
                                            <?php if($notes){?>
                                            <div class="form-group line-form">
                                                <textarea class="form-control kb-tbox-item" rows="5" id="comment" name="comment" placeholder="Write additional notes"><?php echo $notes?></textarea>
                                            </div>
                                            <?php }else{?>
                                            <div class="form-group line-form">
                                                <textarea class="form-control kb-tbox-item" rows="5" id="comment" name="comment" placeholder="Write additional notes"></textarea>
                                            </div>
                                            <?php }?>
                                            <div class="form-group line-form" style="text-align: right">
                                                <button type="submit" class="kb-btn-02 color-bg-site btn-submit pull-right">SAVE<span class="fa fa-angle-right"></span></button>
                                                <!--<input type="submit" class="btn btn-view" value="Save">-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-5 col-xs-12">
                            <div class="b-detail__main-aside">
                                <div class="car-desc-main">
                                    <h2 class="txt-title">Description</h2>
                                    <?php if(!empty($car->vin_number) && $car->vin_number) : ?>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">VIN</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->vin_number; ?></p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty($car->make) && $car->make):?>
                                         <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Make</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo  $car->make; ?></p>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <?php if(!empty($car->model) && $car->model):?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Model</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->model; ?></p>
                                            </div>
                                        </div>

                                    <?php endif;?>
                                    <?php if(!empty($car->series) && $car->series) :?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Series</h4>
                                        </div>

                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->series;?></p>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <?php if(!empty($car->manu_year) && $car->manu_year):?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Year</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->manu_year; ?></p>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if(!empty($car->body) && $car->body):?>
                                       <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Body</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->body;?></p>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if(!empty($car->doors) && $car->doors):?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Doors</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->doors ; ?></p>
                                            </div>
                                        </div>

                                    <?php endif ?>

                                    <?php if(!empty($car->seats) && $car->seats):?>
                                         <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Seats</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->seats; ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($car->body_colour) && $car->body_colour):?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Body Colour</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->body_colour; ?></p>
                                            </div>
                                        </div>
                                    <?php endif;?>

                                    <?php if(!empty($car->gears) && $car->gears):?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Gear</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo  $car->gears;?></p>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                 <!--   --><?php /*debug($car->fuel_type);die(); */?>
                                    <?php if(empty($car->fuel_type) && $car->fuel_type) :?>

                                    <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Fuel type</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->fuel_type ?></p>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                    <?php if(!empty($car->odometer) && $car->odometer): ?>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Odometers</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo  number_format($car->odometer,0,',',',') . ' kms';?></p>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <?php if (!empty($car->cylinders) && $car->cylinders):?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Cylinders</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->cylinders .' cyl'; ?></p>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!empty($car->engine_capacity) && $car->engine_capacity):?>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Engine capacity</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->engine_capacity;?></p>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                    <?php if(!empty($car->manu_month) && $car->manu_month):?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Month made</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo $car->manu_month; ?></p>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if((!empty($car->gearbox) && $car->gearbox)):?>
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Gearbox</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo  $car->gearbox; ?></p>
                                            </div>
                                        </div>
                                    <?php endif?>
                                    <?php if ($car->comments && $car->options) : ?>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <h4 class="car-desc-main-title">Option</h4>
                                        </div>
                                        <div class="col-xs-8">
                                            <p class="car-desc-main-value"><?php echo (strlen($car->options) > 104)? substr($car->options, 0, 104) . '...' : $car->options ?></p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <?php else : ?>
                    <div class="text-center" style="margin-top: 27px; font-size: 16px;">Oops, this car is not available!</div>
                <?php endif; ?>
            </div>    
        </div>
    </div>
    <div class="mg-bottom-50"></div>
</div>

<div id="MakeOfferModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Make an Offer</h4>
                </div>
                <div class="modal-body">
                    <form id="MakeOfferForm" class="form-horizontal">
                        <input type="hidden" name="car_id" value="<?php echo $car->_id ?>"/>
                        <input type="hidden" name="comments" value="User sent an Offer on this car."/>
                        <input type="hidden" name="is_custom_zooper" value="<?php echo $is_cusstom_zooper; ?>"/>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 7px;">Send to</label></div>
                            <div class="col-xs-12 col-md-9">
                                <select class="form-control choose-send-offer" name="option_offer">
                                    <option  value="1">All dealers</option>
                                    <option class="op_select_dealer" value="2">Selected dealers</option>
                                    <option class="op_select_group" value="3">Principals</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group dealer-container">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 7px;">Dealer(s)</label></div>
                            <div class="col-xs-12 col-md-9">
                                <div class="content-item">
                                    <div class="scroll-loading" ><label>Loading...</label></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 7px;">Price ($)</label></div>
                            <div class="col-xs-12 col-md-9">
                                <input style="font-weight: bold;" class="form-control" name="make_on_offer">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 7px;">Offer valid</label> <span style="font-size: 12px;">(Option)</span></div>
                            <div class="col-xs-9 col-md-8">
                                <input class="form-control" name="offer_valid" />
                            </div>
                            <div class="col-xs-3 col-md-1 no-padding"><label style="font-weight: 500; margin-top: 7px;">day(s)</label></div>
                        </div>
                        
                        <div class="form-group" style="text-align: center; margin-top: 10px;">
                            <div class="col-xs-12">
                                <button class="btn btn-view">Send</button>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
   </div>
</div>

<div id="RequestOfferModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Request Offer</h4>
                </div>
                <div class="modal-body">
                    <form id="RequestOfferForm" class="form-horizontal">
                        <input type="hidden" name="car_id" value="<?php echo $car->_id ?>"/>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 7px;">Send to</label></div>
                            <div class="col-xs-12 col-md-9">
                                <select class="form-control choose-request-offer" name="type">
                                    <option value="0">My Network (all)</option>
                                    <option value="1">Selected Dealers</option>
                                    <option value="2">Selected Group</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group dealer-container">
                            <div class="col-xs-12 col-md-3"><label class="seleted-item-name" style="font-weight: 500; margin-top: 7px;">Dealer(s)</label></div>
                            <div class="col-xs-12 col-md-9">
                                <div class="content-item">
                                    <div class="scroll-loading" ><label>Loading...</label></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="form-group" style="text-align: center; margin-top: 10px;">
                            <div class="col-xs-12">
                                <button class="btn btn-view">Send</button>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
   </div>
</div>
<!--modal review car-->
<div id="review_car" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog">
            <div style="min-height:140px;width:50%;margin: 0 auto;"class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Carzapp</h4>
                </div>
                <div class="modal-body-dealer">
                    <div style="background-color: #ffffff; height:auto;text-align: center;" class=" col-xs-12 div-review-price">
                        <div style="margin: 20px 0"><label>Offer sumited.Value: </label><span> $<?php echo $car->price; ?></span>
                            <p>To review go to the offerboard</p>
                        </div>
                    </div>
                    <div class="btn-review-ok" style="text-align: center; height:40px;float: left;width:100%;background-color: #3b6a92;">
                        <div style="height:100%;border-right:1px solid #ffffff;padding:10px 0;" class="col-xs-6 div-review">
                            <a style="color:#ffffff;" href="<?php echo $this->Html->Url('/offerboard');?>">Review</a>
                        </div>
                        <div style="height:100%;padding:10px 0;" class="col-xs-6 div-ok">
                            <a style="color:#ffffff;" href="#">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal contact dealership-->
<div id="DealerShipModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Dealer in company</h4>
                </div>
                <div class="modal-body-dealer">
                    <div style="background-color: #ffffff;" id="UsersInCompanyTable" class=" col-xs-12">
                        <div  class="scroll-loading" ><label>Loading...</label></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal send email-->
<div id="SendMailModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send mail</h4>

                <div class="modal-body">
                    <div id="invite" class="col-lg-12">
                        <form id="FormSendMail" class="form-horizontal">
                            <div class="form-group">
                                <input type="hidden" name="car_id[]" value="<?php echo $car->_id ?>"/>
                                <input type="hidden" name="is_custom_zooper" value="<?php  echo (isset($is_cusstom_zooper) && ($is_cusstom_zooper)) ? $is_cusstom_zooper : null; ?>"/>
                                <div class="col-lg-2 col-md-2 no-padding-right"><label>Send to</label></div>
                                <div class="col-lg-10 col-md-10"><input readonly type="text" class="form-control" name="email" value="" placeholder="email"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-2 col-md-2 no-padding-right"><label>Subject</label></div>
                                <div class="col-lg-10 col-md-10"><input readonly type="text" class="form-control" name="subject" value="<?php echo trim(trim($car->manu_year).' '.trim($car->make).' '.trim($car->model).' '.trim($car->series).' '.trim($car->gearbox))?>" placeholder="subject"></div>
                            </div>
                            <div class="bg_cc">
                                <div style="margin-bottom: 11px; font-size: 15px;"><strong>Car informational</strong></div>
                                <?php
                                echo (isset($car->price) && $car->price) ? '<strong>Price: </strong> $' . ((number_format($car->price,0,',',',') != '0')? number_format($car->price,0,',',',')  . '<br/>' : 'Send Offer' . '<br/>') : '';
                                echo (isset($car->make) && $car->make) ? '<strong>Make: </strong> ' . $car->make . '<br/>' : '';
                                echo (isset($car->model) && $car->model) ? '<strong>Model: </strong> ' . $car->model . '<br/>' : '';
                                echo (isset($car->series) && $car->series) ? '<strong>Series: </strong> ' . $car->series . '<br/>' : '';
                                echo (isset($car->manu_year) && $car->manu_year) ? '<strong>Year: </strong> ' . $car->manu_year . '<br/>' : '';
                                echo (isset($car->body) && $car->body) ? '<strong>Body:</strong> ' . $car->body . '<br/>' : '';
                                echo (isset($car->doors) && $car->doors) ? '<strong>Doors: </strong> ' . $car->doors . '<br/>' : '';
                                echo (isset($car->seats) && $car->seats) ? '<strong>Seats: </strong> ' . $car->seats . '<br/>' : '';
                                echo (isset($car->body_colour) && $car->body_colour) ? '<strong>Body Colour: </strong> ' . $car->body_colour . '<br/>' : '';
                                echo (isset($car->gears) && $car->gears) ? '<strong>Seats: </strong> ' . $car->gears . '<br/>' : '';
                                echo (isset($car->fuel_type) && $car->fuel_type) ? '<strong>Fuel type: </strong> ' . $car->fuel_type . '<br/>' : '';
                                echo (isset($car->odometer) && $car->odometer) ? '<strong>Odometers: </strong> ' . number_format($car->odometer,0,',',',') . ' kms' . '<br/>' : '';
                                echo (isset($car->cylinders) && $car->cylinders) ? '<strong>Cylinders: </strong> ' . $car->cylinders . 'cyl' . '<br/>' : '';
                                echo (isset($car->engine_capacity) && $car->engine_capacity) ? '<strong>Engine capacity: </strong> ' . $car->engine_capacity . 'L' . '<br/>' : '';
                                echo (isset($car->manu_month) && $car->manu_month) ? '<strong>Month made: </strong> ' . $car->manu_month . '<br/>' : '';
                                echo (isset($car->gearbox) && $car->gearbox) ? '<strong>Gearbox: </strong> ' . $car->gearbox . '<br/>' : '';
                                ?>
                            </div>
                            <div style="margin-top: 15px;">
                                <button type="button" href="javascript:;" class="btn btn-view pull-right btn-send-email" style="width: 100px;">Send</button>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function update_size_group_review() {
        ratio = ($('.car-img-group-container').width() - 10) / 345;
        $('.group-img-review-container').css('width', ratio * (81 + 10));
    }
        
    Vcore.Flicka.Follow();
    Vcore.Addnetwork();
    $(".sellcar").click(function(){
        var id = $(this).attr("car-id");
        $(".car_id").val(id);
    });
    $(".buycar").click(function(){
        var id = $(this).attr("car-id");
        mess_id = $(this).attr("mess-id");
        $(".car_id").val(id);
        $("#buycar .message_car").html(mess_id);
    });
    $(".alert_sell").click(function(){
        var id = $(this).attr("car-id");
        mess_id = $(this).attr("mess-id");
        $(".car_id").val(id);
        $(".message_car").html(mess_id);
    });
    $(".accept").click(function(){
        var id = $(this).attr("car-id");
        mess_id = $(this).attr("mess-id");
        $(".car_id").val(id);
        $(".message_car").html(mess_id);
    });

    var slider;
    $(document).ready(function () {
        function linkRealSliders(bigS,thumbS,sliderId){
            $(sliderId).on("click","a",function(event){
                event.preventDefault();
                var newIndex=$(this).data("slide-index");
                bigS.goToSlide(newIndex);
            });
        }
        $(".enable-bx-slider").each(function(i) {
            var $bx = $(this);
            slider = $bx;
            var pagerCustomData = $bx.data('pager-custom');
            var modeData = $bx.data('mode');
            var pagerSlideData = $bx.data('pager-slide');
            var modePagerData = $bx.data('mode-pager');
            var pagerQtyData = $bx.data('pager-qty');

            var realSlider = $bx.bxSlider({
                pagerCustom: pagerCustomData,
                mode: modeData,
                preloadImages: 'visible'
            });
            if(pagerSlideData){
                var realThumbSlider=$(pagerCustomData).bxSlider({
                    mode: modePagerData,
                    minSlides: pagerQtyData,
                    maxSlides: pagerQtyData,
                    moveSlides: 1,
                    slideMargin: 7,
                    pager:false,
                    infiniteLoop:false,
                    hideControlOnEnd:true,
                    preloadImages: 'visible',
                    nextText:'<span class="fa fa-angle-down"></span>',
                    prevText:'<span class="fa fa-angle-up"></span>'
                });
                linkRealSliders(realSlider,realThumbSlider,pagerCustomData);
                if($(pagerCustomData+" a").length <= pagerQtyData ){
                    $(pagerCustomData+" .bx-next").hide();
                }
            }
        });
        
        update_size_group_review();
        
        setTimeout(function () {
            $('.bx-loading').hide();
            slider.redrawSlider();
            update_size_group_review();
        }, 500);
        
        $('#showLeftPush').click(function () {
            setTimeout(function () {
                $('.bx-loading').hide();
                update_size_group_review('test 2');
                slider.redrawSlider();
            }, 300);
        });
        //Click btn review car
        $('#btn-review-car').click(function(){
            $('#review_car').modal('show');
        });
        //Click div ok
        $('.div-ok').click(function(){
            $('#review_car').modal('hide');
        });
        $('.btn-make-offer').click(function () {
            $('#MakeOfferModal .content-item').html('<div class="scroll-loading" ><label>Loading...</label></div>');
            $('#MakeOfferModal .dealer-container').hide();
            $('#MakeOfferForm select[name="option_offer"]').val(1);
            $('#MakeOfferModal').modal('show');
        });
        $('.btn-dealership').click(function () {
            loadDealershipInCompanyAjax(root + 'cars/getDealershipInCompanyAjax');
            $('#DealerShipModal .content-item').html('<div class="scroll-loading" ><label>Loading...</label></div>');
            $('#DealerShipModal .dealer-container').hide();
            $('#ContactDealerForm input[name="branch_address_id "]').val();
            $('#DealerShipModal').modal('show');
        });
        $(document).on('click', '.btn-send-inbox', function() {
            email = $(this).attr('data-email');
            $('#SendMailModal input[name="email"]').val(email);
            $('#SendMailModal').modal('show');
        });
        $(document).on('click', '.is_my_network', function () {
            request_id = $(this).attr('request_id');
            user_id = $(this).attr('user_id');
            is_mynetwork = $(this).attr('is_mynetwork');
            if(is_mynetwork == 1){
                showMessage('This user realy in your network',1);
                return false;
            }
            if( $(this).find('i').hasClass('star-yellow') ) {
                jConfirm('Are you sure you want to remove this user from your network?', 'Message', function(r) {
                    if(r){
                        load_show();
                        $.post(root + 'network_del', {id:request_id}, function(data){
                            if(data.error == 0){
                                $("a.is_my_network").find('i').removeClass('star-yellow');
                            }
                            showMessage('Removed successfully', 0);
                            load_hide();
                        },'json');
                    }
                });
                $('.cancel').hide();
                return false;

            }else{
                jConfirm('Do you want to add this dealer to your network?','Message',function(r) {
                    if(r){
                        load_show();
                        $.post(root + 'InviteNetworks/add_network', {'request_id':request_id,'user_id':user_id},function(data){
                            if(data.error == 0){
                                //$(this).find('i').addClass('star-yellow');
                                showMessage('An invite to join your network have been sent',0);
                            }else{
                                showMessage(data.msg,1);
                            }
                            load_hide();
                        },'json');
                    }
                });
                $('.cancel').hide();
                return false;

            }
        });
        Vcore.Addnetwork();

        $(document).on('click','.btn-send-email',function () {
            email = $('#SendMailModal input[name="email"]').val();
            subject = $('#SendMailModal input[name="subject"]').val();
            content = $('#SendMailModal .bg_cc').html();
            carId   = $('#SendMailModal input[name="car_id[]"]').val();
            var isCustomZooper  = $('#SendMailModal input[name="is_custom_zooper"]').val();
            if(isCustomZooper){
                $.post(root + 'cars/ajaxsendmailattachlistfileadf', {car_id:carId},function(data){
                    if(data.error == 0){
                        $('#SendMailModal').modal('hide');
                        showMessage('Offer sent successfully', 0);
                    }else{
                        showMessage('Failure', 1);
                    }
                },'json');
            }
            load_show();
            $.post(root + 'ajaxsendmail', {email:email, subject: subject, content: content},function(data){
                showMessage('Sent mail successfully', 0);
                $('#SendMailModal').modal('hide');
                load_hide();
            });

        });

        $('.btn-request-offer').click(function () {
            $('#RequestOfferModal .content-item').html('<div class="scroll-loading" ><label>Loading...</label></div>');
            $('#RequestOfferModal .dealer-container').hide();
            $('#RequestOfferModal select[name="type"]').val(0);
            $('#RequestOfferModal').modal('show');
        });
    });

    /* BEGIN make offer */
    var scrollLimitLoad = 10;
    var scrollPage = 0;
    var scrollIsLoading = false;
    var checkAvatar='';
    var price_type_1 = <?php if(isset($price_type_1) && $price_type_1){echo $price_type_1;}else{  echo 0;} ?>;
    var price_type_2 = <?php if(isset($price_type_2) && $price_type_2){echo $price_type_2;}else{  echo 0;} ?>;

    //scroll to show dealership
    $('#DealerShipModal .content-item').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            resetScrollLoading();
            loadDealershipInCompanyAjax(root + 'cars/getDealershipInCompanyAjax');
        }
    });
        var  is_custom_zooper  = <?php if(isset( $is_cusstom_zooper ) &&  $is_cusstom_zooper ){echo  $is_cusstom_zooper ;}else{ echo 0 ;}?>;
    if(is_custom_zooper ){
        $('#MakeOfferForm .dealer-container').hide();
        $('.op_select_dealer').css('display','none');
        $('.op_select_group').css('display','none');
    }
        // Change type make offer
        $('.choose-send-offer').change(function() {

            type = $(this).val();
            if (type == 1) {
                $('#MakeOfferForm .dealer-container').hide();

            }
            if (type == 2) { // send selected dealers
                $('#MakeOfferForm .dealer-container').show();
                $('#MakeOfferForm .content-item').html('<div class="scroll-loading" ><label>Loading...</label></div>');
                resetScrollLoading();
                loadDealersInCompanyAjax(root + 'cars/getDealersInCompanyAjax');
            }
            else if (type == 3) { // send princples
                $('.dealer-container').show();
                $('#MakeOfferForm .content-item').html('<div class="scroll-loading" ><label>Loading...</label></div>');
                resetScrollLoading();
                loadDealersInCompanyAjax(root + 'cars/getPrinciplesInCompanyAjax');
            }
        });
    // scroll to bottom
    $('#MakeOfferForm .content-item').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            type = $('.choose-send-offer').val();
            if (type == 2) { // load dealers
                loadDealersInCompanyAjax(root + 'cars/getDealersInCompanyAjax');
            }
            else if (type == 3) { // load princples
                loadDealersInCompanyAjax(root + 'cars/getPrinciplesInCompanyAjax');
            }
        }
    });

    $('#MakeOfferForm').submit(function () {
        var type = $("select[name='option_offer']").val();
        carId = $('input[name="car_id"]').val();
        var isCustomZooper =$('input[name="is_custom_zooper"]').val();

        // validate
        if (type != 1 && $('input[name="offer_to_dealers[]"]:checked').length <= 0) {
            showMessage('No dealer has been chosen', 1);
            return false;
        }
        if (!$('input[name="make_on_offer"]').val()) {
            showMessage('Please enter price', 1);
            return false;
        }
        if (!$.isNumeric($('input[name="make_on_offer"]').val())) {
            showMessage('Price must be number', 1);
            return false;
        }
        var make_on_offer = parseInt($('input[name="make_on_offer"]').val());
        if(make_on_offer <= 0 ){
            showMessage('Offer is too low,please make offers must be heighter than 0', 1);
            return false;
        }
        if(make_on_offer < price_type_1){
            showMessage('Offer is too low,please make offers with a min of '+price_type_1+'$', 1);
            return false;
        }
        if(make_on_offer < price_type_2){
            showMessage('Offer is too low,please make offers with a min of '+price_type_2+'$', 1);
            return false;
        }

        load_show();
        $.post(root + 'cars/sendOfferAjax', $(this).serialize(), function (data) {
            load_hide();
            if(data.error == 0){
                $('#MakeOfferModal').modal('hide');
                showMessage('Offer sent successfully', 0);
            }else{
                showMessage('Failure', 1);
            }
        },'json');

        if(isCustomZooper){
            var comments = $('#MakeOfferForm input[name="comments"]').val();
            $.post(root + 'cars/ajaxsendmailattachfileadf', {car_id:carId,comments:comments},function(data){
                if(data.error == 0){
                    $('#MakeOfferModal').modal('hide');
                    showMessage('Email sent successfully', 0);
                }else{
                    showMessage('Failure', 1);
                }
            },'json');
        }



        return false;
    });
    no_img= '<?php echo $this->webroot . 'images/no-avatar.png' ?>';
    function resetScrollLoading() {
        scrollPage = 0;
        scrollIsLoading = false;
    }
    function loadDealershipInCompanyAjax(url) {
        branch_address_id = $('input[name="branch_address_id"').val();
        if (!scrollIsLoading) {
            scrollIsLoading = true;
            scrollPage++;
            $('#DealerShipModal .scroll-loading').show();
            $.post(url,{limit:scrollLimitLoad, page:scrollPage, branch_address_id:branch_address_id}, function(data){
                if (data.error == 0) {
                    for(i = 0; i < data.list_dealer.length; i++) {
                        dataItem = data.list_dealer[i];
                        if(dataItem.avatar==null){
                            item ='<form id="DealerFormEmail"><input type="hidden" name="branch_address_id" value=' +dataItem.branch_address_id + '></form>' +
                                '<div style="padding:5px ;" class="row"><div class="col-xs-4"><img class="user-avatar img-circle img-dealer"  src="'+no_img+'"></div>' +
                                '<div style="padding:10px 0;"class="col-xs-6">' + dataItem.name + ' ' + dataItem.last_name + '</div>' +
                                '<div style="padding:10px 0;" class="col-xs-1"> <a href="javascript:;" class="btn-send-inbox" name="email" data-email=' + dataItem.email + '  title="Send email"><i class="fa fa-envelope"></i></a></div>' +
                                '<div style="padding:10px 0;" class="col-xs-1"> <a href="javascript:;"  class="btn-add-network is_my_network" user_id="" request_id=' + dataItem._id + '  title="Add my network"><i class="fa fa-users"></i></a></div></div>';

                            $('#DealerShipModal .scroll-loading').before(item);
                        }
                    }
                    $('#DealerShipModal .scroll-loading').hide();
                    scrollIsLoading = (data.list_dealer.length < scrollLimitLoad)? true : false;

                    if (!data.list_dealer.length && scrollPage == 1) {
                        $('#DealerShipModal .content-item').html('<div>No data</div>');
                    }
                }
                else {
                    jAlert('Failure');
                }
            },'json');
        }
    }

    /* END make offer */
    function loadDealersInCompanyAjax(url) {
        carId = '<?php echo $car->_id ?>';
        companyId = '<?php echo $info_client_no->company_id ?>';
        
        if (!scrollIsLoading) {
            scrollIsLoading = true;
            scrollPage++;
            $('#MakeOfferForm .scroll-loading').show();
            
            $.post(url,{car_id:carId, company_id:companyId, limit:scrollLimitLoad, page:scrollPage}, function(data){
                if (data.error == 0) {
                    for(i = 0; i < data.list_dealer.length; i++) {
                        dataItem = data.list_dealer[i];
                        item = '<div><label><input type="checkbox" name="offer_to_dealers[]" value="'+dataItem._id+'"><span style="margin-left: 10px;">' + dataItem.name + '</span></label></div>';

                        $('#MakeOfferForm .scroll-loading').before(item);
                    }
                    $('#MakeOfferForm .scroll-loading').hide();
                    scrollIsLoading = (data.list_dealer.length < scrollLimitLoad)? true : false;
                    
                    if (!data.list_dealer.length && scrollPage == 1) {
                        $('#MakeOfferModal .content-item').html('<div>No data</div>');
                    }
                }
                else {
                    jAlert('Failure');
                }
            },'json');
        }
    }
    /* END make offer */
    // Change type request offer
    $('.choose-request-offer').change(function() {
        type = $(this).val();
        if (type == 0) {
            $('#RequestOfferForm .dealer-container').hide();
        }
        if (type == 1) { // send selected dealers
            $('#RequestOfferForm .dealer-container').show();
            $('#RequestOfferForm .seleted-item-name').text('Dealer(s)');
            $('#RequestOfferForm .content-item').html('<div class="scroll-loading" ><label>Loading...</label></div>');
            resetScrollLoading();
            loadDealersInNetworkAjax(root + 'cars/getDealersInNetworkAjax');
        }
        else if (type == 2) { // send group
            $('#RequestOfferForm .dealer-container').show();
            $('#RequestOfferForm .seleted-item-name').text('Group(s)');
            $('#RequestOfferForm .content-item').html('<div class="scroll-loading" ><label>Loading...</label></div>');
            resetScrollLoading();
            loadDealersInNetworkAjax(root + 'cars/getGroupsInNetworkAjax');
        }
    });

    // scroll to bottom
    $('#RequestOfferForm .content-item').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            type = $('.choose-request-offer').val();
            if (type == 1) { // load dealers
                loadDealersInNetworkAjax(root + 'cars/getDealersInNetworkAjax');
            }
            else if (type == 2) { // load group
                loadDealersInNetworkAjax(root + 'cars/getGroupsInNetworkAjax');
            }
        }
    });

    $('#RequestOfferForm').submit(function () {
        var type = $("#RequestOfferForm select[name='type']").val();
        // validate
        if (type == 1 && $('input[name="arr_offer_dealer[]"]:checked').length <= 0) {
            showMessage('No dealer has been chosen', 1);
            return false;
        }
        
        if (type == 2 && $('input[name="arr_offer_dealer[]"]:checked').length <= 0) {
            showMessage('No group has checked', 1);
            return false;
        }
        load_show();
        $.post(root + 'cars/requestOfferAjax', $(this).serialize(), function (data) {
            load_hide();
            if(data.error == 0){
                $('#RequestOfferModal').modal('hide');
                showMessage('Offer sent successfully', 0);
            }else{
                showMessage('Failure', 1);
            }
        },'json');
        
        return false;
    });
    
    function loadDealersInNetworkAjax(url) {
        carId = '<?php echo $car->_id ?>';
        companyId = '<?php echo $info_client_no->company_id ?>';
        
        if (!scrollIsLoading) {
            scrollIsLoading = true;
            scrollPage++;
            $('#RequestOfferForm .scroll-loading').show();
            
            $.post(url,{car_id:carId, company_id:companyId, limit:scrollLimitLoad, page:scrollPage}, function(data){
                if (data.error == 0) {
                    for(i = 0; i < data.list_dealer.length; i++) {
                        dataItem = data.list_dealer[i];
                        item = '<div><label><input type="checkbox" name="arr_offer_dealer[]" value="'+dataItem._id+'"><span style="margin-left: 10px;">' + dataItem.name + '</span></label></div>';

                        $('#RequestOfferForm .scroll-loading').before(item);
                    }
                    $('#RequestOfferForm .scroll-loading').hide();
                    scrollIsLoading = (data.list_dealer.length < scrollLimitLoad)? true : false;
                    
                    if (!data.list_dealer.length && scrollPage == 1) {
                        $('#RequestOfferModal .content-item').html('<div>No data</div>');
                    }
                }
                else {
                    jAlert('Failure');
                }
            },'json');
        }
    }
    //send mail attach when click follow a car
    $('.clickfollow').click(function(){

    });
    $(document).on('click', '.clickfollow', function() {
        element = $(this);
        if (element.hasClass('dis_follow')) {
            //change text
            $('#text-follow').text('FOLLOW');
        }
        else{
            //change text
            $('#text-follow').text('UNFOLLOW');
            carId = $('input[name="car_id"]').val();
            var isCustomZooper =$('input[name="is_custom_zooper"]').val();
            var comments = $('input[name="comments"]').val();
            if( isCustomZooper){
                $.post(root + 'cars/ajaxsendmailattachfileadf', {car_id:carId,comments:comments},function(data){
                    if(data.error == 0){
                        $('#MakeOfferModal').modal('hide');
                        showMessage('Email sent successfully', 0);
                    }else{
                        showMessage('Failure', 1);
                    }
                },'json');
            }

        }
    });
        $(window).resize(function(){
        update_size_group_review('test 3'); 
    });
</script>