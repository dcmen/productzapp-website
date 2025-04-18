<style>
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
    
    /*showmore*/
    .showmore-container {
        overflow-y: hidden;
        transition: height ease 1000ms;
    }
    .showmore-container.colapsed-content {
        height: 38px;
    }
    .showmore-container.expanded-content {
        height: auto;
    }
    .showmore-container + .group-btn-showmore > .btn-showmore {
        display: none;
    }
    .showmore-container.colapsed-content + .group-btn-showmore > .showmore, .showmore-container.expanded-content + .group-btn-showmore > .showless {
        display: block;
    }
    .btn-showmore {
        cursor: pointer;
    }
    /*End showmore*/
</style>
<?php 
$user_session = CakeSession::read('Auth.User.session_id'); 
$carName = trim((isset($car->manu_year)? $car->manu_year : '').' '.(isset($car->make)? $car->make : '').' '.(isset($car->model)? $car->model : '').' '.(isset($car->series)? $car->series : '').' '.(isset($car->gearbox)? $car->gearbox : ''));
?>
<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow" style="padding: 15px 20px 40px;">
                <header class="wg-info-header big-header">
                    <div class="col-md-12 no-padding">
                        <?php 
                        if ($rs->type != 2) {
                            if(isset($rs->avatar_file_name) && $rs->avatar_file_name != ''){
                                echo '<img src="'.$rs->avatar_file_name.'" class="pulse_avata pull-left">';
                            }else{
                                echo $this->Html->image('/images/profile.png', array('class' => 'pulse_avata pull-left'));
                            }
                        }
                        else {
                            echo '<img src="'.$rs->rss_info->url_image_company.'" class="pulse_avata pull-left">';
                        }
                        ?>
                        <?php if ($rs->type != 2) : ?>
                        <div style="margin-left: 5px; float: left;">
                            <a href="<?php echo $this->Html->Url('/pulse_user/' . $rs->user_id) ?>"><?php echo (isset($rs->full_name)) ? $rs->full_name : '' ?> </a><br>
                            <?php echo (isset($rs->company_name)) ? '<span>Company ' . $rs->company_name . '</span>' : '' ?>
                        </div>
                        <?php elseif (isset($rs->rss_info->url_image_company)) : ?>
                            <a href="<?php echo $rs->rss_info->link_company ?>"><?php echo $rs->rss_info->title_company ?> </a><br>
                        <?php endif; ?>
                            
                        <i class="pull-right"><?php echo $rs->created_at?></i>
                        <?php if ($rs->type != 2 && $rs->user_id && $rs->user_id != CakeSession::read('Auth.User._id')) : ?>
                        <a href="javascript:;" class="btn-post-report pull-right mg-right-8" data-post-id="<?php echo $rs->_id ?>" title="Report"><i class="fa fa-flag"></i></a>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                </header>
                <div class="clearfix mg-bottom-25"></div>
                
                <div class="row">
                    <div class="col-lg-12 showmore-container colapsed-content">
                        <div class="showmore-content">
                            <?php echo $rs->content?>
                        </div>
                    </div>
                    <div class="col-lg-12 group-btn-showmore">
                        <div class="btn-showmore showmore">Show more</div>
                        <div class="btn-showmore showless">Show less</div>
                    </div>
                </div>
                <div class="clearfix mg-bottom-30"></div>
                
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <div class="car-img-group ">
                            <div class="car-img-group-container col-md-9 no-padding">
                                <ul class="bxslider enable-bx-slider dis-none-max-800" data-pager-custom="#bx-pager" data-mode="horizontal" data-pager-slide="true" data-mode-pager="vertical" data-pager-qty="4">
                                    <?php if(isset($images) && sizeof($images) > 0) : ?>
                                        <?php foreach($images as $img) : ?>
                                        <li class="pos-rel img-view">
                                            <?php if (trim($car->video_url)) : ?>
                                            <a class="wg-car-btnvideo font-txt-small" data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
                                            <?php endif; ?>
                                            <img src="<?php echo $img->image_file_name ?>" />
                                        </li>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <li class="pos-rel img-view">
                                            <?php if (isset($car->video_url) && trim($car->video_url)) : ?>
                                            <a class="wg-car-btnvideo font-txt-small" data-video-url="<?php echo $car->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
                                            <?php endif; ?>
                                            <img src="<?php echo $this->webroot; ?>images/no_car.png"/>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                            <div class="col-md-3 group-img-review no-padding-right">
                                <div class="group-img-review-container" style="float: right;">
                                    <div id="bx-pager" class="">
                                        <?php if (isset($images) && sizeof($images) > 0) : ?>
                                            <?php for($i = 0; $i < sizeof($images); $i++) : ?>
                                            <a href="#" data-slide-index="<?php echo $i ?>" class="img-review">
                                                <img class="img-responsive" src="<?php echo $images[$i]->image_file_name ?>" />
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

                        <div class="car-img-group car-img-group-mb dis-none-min-801">

                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="pos-rel">
                            <div style="padding: 21px 6px 13px; font-size: 17px; width: 80%;" class="truncate" title="<?php echo $carName ?>"><?php echo $carName ?></div>
                            <div class="pos-abs" style="right: 15px; top: 18px; font-size: 20px;">
                                <?php 
                                if (isset($car->price)) {
                                    $price = number_format($car->price,0,',',',');
                                    if($price != '0') {
                                        echo '$'.$price;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
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
                                    <?php
                                    if ((!isset($car->comments) || !$car->comments) && isset($car->options) && $car->options) {
                                        echo $car->options;
                                    } else {
                                        echo (isset($car->comments) && $car->comments)? $car->comments : '<i class="mg-left-10">No comment</i>';
                                    }
                                    ?>
                                </div>
                                <div class="tab-pane" id="notes">
                                    <form action="<?php echo $this->Html->Url('/Cars/update_notes')?>" method="post">
                                        <input type="hidden" name="car_id" value="<?php echo isset($car->_id)? $car->_id : '' ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $user_session?>">
                                        <?php if(isset($car->notes) && $car->notes){?>
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
                    <div class="col-md-4 col-xs-12">
                        <div class="b-detail__main-aside">
                            <div class="car-desc-main">
                                <h2 class="txt-title">Description</h2>
                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">VIN</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->vin_number) && $car->vin_number) ? $car->vin_number : 'Not set' ?></p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Make</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->make) && $car->make) ? $car->make : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Model</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->model) && $car->model) ? $car->model : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Series</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->series) && $car->series) ? $car->series : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Year</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->manu_year) && $car->manu_year) ? $car->manu_year : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Body</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->body) && $car->body) ? $car->body : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Doors</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->doors) && $car->doors) ? $car->doors : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Seats</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->seats) && $car->seats) ? $car->seats : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Body Colour</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->body_colour) && $car->body_colour) ? $car->body_colour : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Gear</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->gears) && $car->gears) ? $car->gears : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Fuel type</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->fuel_type) && $car->fuel_type) ? $car->fuel_type : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Odometers</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->odometer) && $car->odometer) ? number_format($car->odometer,0,',',',') . ' kms' : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Cylinders</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->cylinders) && $car->cylinders) ? $car->cylinders . 'cyl' : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Engine capacity</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->engine_capacity) && $car->engine_capacity) ? $car->engine_capacity . 'L' : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Month made</h4>
                                    </div>
                                    <div class="col-xs-6">
                                        <p class="car-desc-main-value"><?php echo (isset($car->manu_month) && $car->manu_month) ? $car->manu_month : 'Not set' ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Gearbox</h4>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="car-desc-main-value"><?php echo (isset($car->gearbox) && $car->gearbox) ? $car->gearbox : 'Not set' ?></p>
                                    </div>
                                </div>

                                <?php if (isset($car->comments) && $car->comments && isset($car->options) && $car->options) : ?>
                                <div class="row">
                                    <div class="col-xs-5">
                                        <h4 class="car-desc-main-title">Option</h4>
                                    </div>
                                    <div class="col-xs-7">
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
            </div>    
        </div>
    </div>
    <div class="mg-bottom-50"></div>
</div>

<script>
    
    function update_size_group_review(test) {
        console.log(test);
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
        
        $('.bxslider-mb').bxSlider({
            //slideWidth: 300,
            minSlides: 1,
            maxSlides: 1,
            moveSlides: 1,
            slideMargin: 10,
            pager: false,
            infiniteLoop:false,
            hideControlOnEnd:true,
            preloadImages: 'visible',
            onSliderLoad: function() {
                load_hide();
            },
            nextText:'<span class="fa fa-angle-right"></span>',
            prevText:'<span class="fa fa-angle-left"></span>'
        });
        if($('.bxslider-mb li').length <= 5){
            $('.bxslider-mb .bx-next').hide();
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
                    onSliderLoad: function() {
                        console.log('slider complete');
                        load_hide();
                    },
                    nextText:'<span class="fa fa-angle-down"></span>',
                    prevText:'<span class="fa fa-angle-up"></span>'
                });
                linkRealSliders(realSlider,realThumbSlider,pagerCustomData);
                if($(pagerCustomData+" a").length <= pagerQtyData ){
                    $(pagerCustomData+" .bx-next").hide();
                }
            }
        });
        
        update_size_group_review('test 1');
        
        setTimeout(function () {
            $('.bx-loading').hide();
            slider.redrawSlider();
            update_size_group_review('test 1');
        }, 500);
        
        $('#showLeftPush').click(function () {
            setTimeout(function () {
                $('.bx-loading').hide();
                update_size_group_review('test 2');
                slider.redrawSlider();
            }, 300);
        });
        
        if ($('.showmore-content').height() < 38) {
            $('.group-btn-showmore').hide();
        }
        
        $('.btn-showmore').click(function () {
            if ($(this).hasClass('showmore')) {
                $('.showmore-container').removeClass('colapsed-content');
                $('.showmore-container').addClass('expanded-content');
            }
            else {
                $('.showmore-container').addClass('colapsed-content');
                $('.showmore-container').removeClass('expanded-content');
            }
        });
    });
    $(window).resize(function(){
        update_size_group_review('test 3'); 
    });
</script>