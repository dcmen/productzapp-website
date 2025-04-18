<style>
    /*button pre, next*/
    .car-slider-container .bx-wrapper .bx-controls-direction a,
    .car-slider-container .bx-wrapper:hover .bx-controls-direction a.disabled {
        display: none;
    }
    .car-slider-container .bx-wrapper:hover .bx-controls-direction a {
        display: block;
        text-decoration: none;
    }
    .car-slider-container .bx-wrapper .bx-controls-direction a span {
        color: #fff;
        display: block;
        font-size: 29px;
        text-align: center;
        text-indent: 0;
        line-height: 207px;
    }
    .car-slider-container .bx-wrapper .bx-controls-direction a.bx-next {
        background: rgba(85, 85, 85, 0.8) none repeat scroll 0% 0%;
        margin: 0px;
        top: auto;
        z-index: 80;
        bottom: 0px;
        right: 0px;
        height: 100%;
    }
    .car-slider-container .bx-wrapper .bx-controls-direction a.bx-prev {
        background: rgba(85, 85, 85, 0.8) none repeat scroll 0% 0%;
        margin: 0px;
        top: auto;
        z-index: 80;
        bottom: 0px;
        left: 0px;
        height: 100%;
    }
    /*END button pre, next*/
    .car-slider-container .bx-wrapper .bx-viewport {
        border: 0;
        background-color: transparent;
        box-shadow: none;
    }
    .car-slider-item {
        height: 207px;
    }
    .car-slider-item:hover, .car-slider-item:focus, .car-slider-item:active {
        text-decoration: none;
    }
    .car-slider-item-container {
        height: 100%;
        background-color: #fff;
        border: 5px solid #fff;
    }
    .car-slider-item-container > .car-slider-img {
        width: 100%;
        height: 180px;
    }
    .car-slider-img > img {
        height: 100%;
        width: 100%;
    }
    .slider-car-name {
        color: #444;
        width: 100%;
        padding: 0px 3px;
    }
    .bx-loading {
        display: none !important;
    }
</style>

<div class="main-page">
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12 car-slider-container">
            <div class="car-slider">
                <?php foreach ($listcars as $car) : ?>
                <?php $carName = $car->cars->manu_year . ' ' . $car->cars->make . ' ' . $car->cars->model . ' ' . $car->cars->series . ' ' . $car->cars->gearbox; ?>
                <a href="<?php echo $this->Html->Url('/cardetails/' . $car->cars->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="car-slider-item" title="<?php echo $carName ?>">
                    <div class="car-slider-item-container">
                        <div class="car-slider-img">
                            <img class="img-cover" src="<?php echo ($car->cars->image_url)? $car->cars->image_url : $this->webroot .'images/no_car.png' ?>" onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';"/>
                        </div>
                        <div class="slider-car-name truncate">
                            <span><?php echo $carName ?></span>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="clearfix" style="margin-bottom: 30px;"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <div class="wg-statics car_for_sale">
                <a href="<?php echo $this->Html->Url('/carsforsale') ?>">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic_cars_sold64x64.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number"><?php echo $cars_sold ?></div>
                        <div class="title">Cars For Sale</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center-min-768 text-center-max-767">
            <div class="wg-statics car_followed">
                <a href="<?php echo $this->Html->Url('/followed') ?>">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic_cars_follow64x64.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number"><?php echo $cars_follow ?></div>
                        <div class="title">Cars Followed</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center">
            <div class="wg-statics car_set_forget">
                <a href="<?php echo $this->Html->Url('/set_forget') ?>">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic_cars_forget.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number"><?php echo $cars_set_and_forget ?></div>
                        <div class="title">Set & Forget</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center">
            <div class="wg-statics car_app_chat">
                <a href="javascript:;" onclick="showMessage('Coming soon', 0);">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic_chats.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number">0</div>
                        <div class="title">Chat</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center-min-768 text-center-max-767">
            <div class="wg-statics car_carlendar">
                <a href="<?php echo $this->Html->Url('/pulse') ?>">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic_pulse_normal.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number"><?php echo $count_pulse ?></div>
                        <div class="title">News & Posts</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center">
            <div class="wg-statics car_my_network">
                <a href="<?php echo $this->Html->Url('/mynetwork') ?>">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic_dealer.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number"><?php echo $network_cars ?></div>
                        <div class="title">My Network</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center">
            <div class="wg-statics car_offerboard car_Flicka">
                <a href="<?php echo $this->Html->Url('/offerboard') ?>">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic_offer_board.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number"><?php echo $count_offer ?></div>
                        <div class="title">Offer Board</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center-min-768 text-center-max-767">
            <div class="wg-statics car_my_customer">
                <a href="<?php echo $this->Html->Url('/customer') ?>">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic-mycustomer.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number"><?php echo $customer_count ?></div>
                        <div class="title">My Customers</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-center">
            <div class="wg-statics car_my_stock">
                <a href="<?php echo $this->Html->Url('/my_stock') ?>">
                    <div class="ic-type col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img class="bg_i" src="<?php echo $this->webroot ?>images/ic_cars_network.png">
                        <div class="divi"></div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 no-padding-768-980">
                        <div class="number"><?php echo $my_stock ?></div>
                        <div class="title">My Stock</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    var slider;
    var numberSlideViewPerPage = 3;
    var limitCarsGetFromAPI = 20;
//    var new_analytics_session_id = "<?php //echo $this->Session->read('new_analytics_session_id')?>//";
    function setNumberSlide() {
        var widthWindow = $(window).width();
        if (widthWindow > 640) {
            numberSlideViewPerPage = 3;
        }
        if (widthWindow <= 640) {
            numberSlideViewPerPage = 3;
        }
        if (widthWindow <= 480) {
            numberSlideViewPerPage = 2;
        }
        if (widthWindow <= 360) {
            numberSlideViewPerPage = 1;
        }
    }
    
    $(document).ready(function () {
        setNumberSlide();
        slider = $('.car-slider').bxSlider({
            slideWidth: 500,
            minSlides: numberSlideViewPerPage,
            maxSlides: numberSlideViewPerPage,
            moveSlides: 1,
            slideMargin: 10,
            pager: false,
            infiniteLoop:false,
            startSlide: 5,
            hideControlOnEnd:false,
            preloadImages: 'visible',
            onSliderLoad: function(){
                $('.bx-loading').hide();
            },
            nextText:'<span class="fa fa-angle-right"></span>',
            prevText:'<span class="fa fa-angle-left"></span>',
            onSlideNext: function(slideEl, oldSlide, newSlide){
                currentSlide = slider.getCurrentSlide();
                if((slider.getSlideCount() - (numberSlideViewPerPage+3)) == newSlide){
                    $.ajax({
                        url:'cars/get_cars_random_ajax?limit=' + limitCarsGetFromAPI,
                        success:function(data){
                            $('.car-slider').append(data);
                            slider.reloadSlider();
                            slider.goToSlideNotFade(currentSlide);
                        }
                    });
                }
            },
            onSlidePrev: function(slideEl, oldSlide, newSlide) {
                currentSlide = slider.getCurrentSlide();
                console.log(currentSlide);
                console.log(limitCarsGetFromAPI + currentSlide);
                if(newSlide == 3){
                    $.ajax({
                        url:'cars/get_cars_random_ajax?limit=' + limitCarsGetFromAPI,
                        success:function(data){
                            $('.car-slider').prepend(data);
                            slider.reloadSlider();
                            slider.goToSlideNotFade(limitCarsGetFromAPI + currentSlide);
                        }
                    });
                }
            }
        });
        
        setTimeout(function () {
            $('.bx-loading').hide();
            slider.redrawSlider();
        }, 300);
        
        $('#showLeftPush').click(function () {
            setTimeout(function () {
                slider.redrawSlider();
            }, 300);
        });
        
        $(window).resize(function(){
            setNumberSlide();
            slider.reloadSlider({
                slideWidth: 500,
                minSlides: numberSlideViewPerPage,
                maxSlides: numberSlideViewPerPage,
                moveSlides: 1,
                slideMargin: 10,
                pager: false,
                infiniteLoop:false,
                hideControlOnEnd:true,
                preloadImages: 'visible',
                onSliderLoad: function() {
                    console.log('slider complete');
                    load_hide();
                },
                nextText:'<span class="fa fa-angle-right"></span>',
                prevText:'<span class="fa fa-angle-left"></span>'
            });
        });
        //update
        function updatecount(screen){
                $.post(root + 'Pages/updateanalyticsviewscreenbysession',{keyscreen:screen},function(data) {
                    if(data.error == 0)
                    {

                    }else{

                    }
                return false;
                });
        }
        $('.car_for_sale').click(function(){
            var screen = 'count_carforsale';
            updatecount(screen);
        });
        $('.car_followed').click(function(){
            var screen = 'count_followcar';
            updatecount(screen);
        });
        $('.car_my_stock').click(function(){
            var screen = 'count_mystock';
            updatecount(screen);
        });
        $('.car_my_network').click(function(){
            var screen = 'count_mynetwork';
            updatecount(screen);
        });
        $('.car_offerboard').click(function(){
            var screen = 'count_offerboard';
            updatecount(screen);
        });
    });

</script>