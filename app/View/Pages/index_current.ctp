<style>
    #frameHome {
        background: none;
    }
    #frameHome .frHome-txt {
        margin-top: 0;
        margin-left: 0;
        text-align: center;
    }
    .feature-box {
        min-height: 135px;
    }
    .app-features .phone-image {
        top: -15px;
    }
    .feature-box-text > h3 {
        margin-bottom: 5px;
    }
    ul.style-disc {
        padding-left: 50px;
    }
    ul.style-disc > li {
        list-style-type: disc;
        font-size: 15.5px;
        line-height: 27px;
        padding-left: 16px;
        color: #01236B;
        font-weight: 500;
    }
    @media (max-width: 640px) {
        .padding-15-mb-imp {
            padding: 15px !important;
        }
        #frameHome {
            padding-top: 35px;
            height: 405px;
        }
        #frameHome .v-height-standard {
            height: 20px !important;
        }
        #frameHome .space-between {
            margin-top: 10px;
        }
    }
    @media (max-width: 480px) {
        #frameHome {
            padding-top: 35px;
            height: 335px;
        }
        #frameHome .frHome-txt1 {
            font-size: 25px;
            line-height: 42px;
        }
        #frameHome .frHome-txt2 {
            font-size: 19px;
            line-height: 35px;
        }
        #frameHome .v-height-standard {
            height: 16px !important;
        }
        #frameHome .space-between {
            margin-top: 10px;
        }
    }
    @media (max-width: 360px) {
        #frameHome {
            padding-top: 30px;
            height: 340px;
        }
    }
    @media (max-width: 320px) {
        #frameHome {
            padding-top: 24px;
            height: 335px;
        }
    }
</style>

<!--Frame 1-->
<div class="no-bottom-spacing frame-home-1" id="frameHome">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="v-animation frHome-txt frHome-txt1 no-margin-mb" data-animation="fade-from-left" data-delay="300">
                    <img style="width: 500px;" src="<?php echo $this->webroot; ?>images/ic_logo_login.png" />
                </div>
                
                <div class="v-spacer col-sm-12 v-height-standard"></div>

                <div class="frHome-txt no-margin-mb" style="text-align: center;">
                    <div class="v-animation btn-app-frHome" data-animation="fade-from-left" data-delay="1200" style="display: inline-block; height: 59px; margin-right: 10px;">
                        <a target="_blank" href= "https://play.google.com/store/apps/details?id=com.carzapp.australia" class="btn-kb-01 btn-app">
                            <img style="width: 220px; height: 76px;" class="ic-normal" src="<?php echo $this->webroot; ?>images/ic_store_android.png" />
                            <img style="width: 220px; height: 76px;" class="ic-hover" src="<?php echo $this->webroot; ?>images/ic_store_android.png" />
                        </a>
                    </div>
                    <div class="v-animation btn-app-frHome" data-animation="fade-from-left" data-delay="1400" style="display: inline-block; height: 59px;">
                        <a target="_blank" href="https://itunes.apple.com/au/app/carzapp/id1033050312?mt=8" class="btn-kb-01 btn-app">
                            <img style="width: 220px; height: 76px; margin-top: -2px;" class="ic-normal" src="<?php echo $this->webroot; ?>images/ic_store_ios.png" />
                            <img style="width: 220px; height: 76px; margin-top: -2px;" class="ic-hover" src="<?php echo $this->webroot; ?>images/ic_store_ios.png" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12 hide-on-640">
                <img style="width: 260px; height: 490px; margin: 0" class="img-responsive phone-image v-animation" data-animation="fade-from-left" data-delay="1400" src="<?php echo $this->webroot; ?>images/iPhone_1.png" />
            </div>
        </div>
    </div>
</div>
<!--Frame 2-->
<div class="v-page-wrap no-bottom-spacing" id="frameFeatures" style="background-color: #F7F8FA;">
    
    <div class="container">
        <div class="v-spacer col-sm-12 v-height-small"></div>
    </div>

    <!--Features-->
    <div class="container" id="features">
        <div class="row center">

            <div class="col-sm-12">
                <p class="v-smash-text-large-2x text-center">
                    <span>Amazing Features</span>
                </p>
                <div class="color-line"><div></div></div>
                <p class="lead mg-top-30 mg-top-30-mb text-center" style="color: #999;">
                    Buy &amp; Selling cars has<br>
                    never been easier!
                </p>
            </div>
            <div class="v-spacer col-sm-12 v-height-standard"></div>
        </div>

        <div class="row app-features">
            <div class="col-md-4 col-sm-4 no-padding padding-15-mb-imp">
                <div class="feature-box left-icon v-animation" data-animation="fade-from-left" data-delay="200">
                    <div class="feature-box-icon small">
                        <img class="img-over hide-on-hover" src="<?php echo $this->webroot; ?>images/round_drop.png"/>
                        <img class="img-over show-on-hover" src="<?php echo $this->webroot; ?>images/round_drop_hover.png"/>
                        <i class="fa fa-users v-icon"></i>
                    </div>
                    <div class="feature-box-text">
                        <h3>Network with Dealers and Customers </h3>
                        <div class="feature-box-text-inner">
                            Grow your network of Dealers to buy and sell your cars quickly. Build a customer database and manage relationships in "My Network"
                        </div>
                    </div>
                </div>
                
                <div class="clearfix"></div>

                <div class="feature-box left-icon v-animation pull-top" data-animation="fade-from-left" data-delay="400">
                    <div class="feature-box-icon small">
                        <img class="img-over hide-on-hover" src="<?php echo $this->webroot; ?>images/round_drop.png"/>
                        <img class="img-over show-on-hover" src="<?php echo $this->webroot; ?>images/round_drop_hover.png"/>
                        <i class="fa fa-car v-icon"></i>
                    </div>
                    <div class="feature-box-text">
                        <h3>Search for cars</h3>
                        <div class="feature-box-text-inner">
                            Search for cars or flick through customised filters on "Flicka". Tag and follow cars.
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="feature-box left-icon v-animation" data-animation="fade-from-left" data-delay="600">
                    <div class="feature-box-icon small">
                        <img class="img-over hide-on-hover" src="<?php echo $this->webroot; ?>images/round_drop.png"/>
                        <img class="img-over show-on-hover" src="<?php echo $this->webroot; ?>images/round_drop_hover.png"/>
                        <i class="fa fa-comments v-icon" style="margin-left: 2px;"></i>
                    </div>
                    <div class="feature-box-text">
                        <h3>Chat, SMS, Call, Email</h3>
                        <div class="feature-box-text-inner">
                            Instant communication with your network using online chat, SMS, email and phone calls.
                        </div>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                
                <div class="feature-box left-icon v-animation" data-animation="fade-from-left" data-delay="600">
                    <div class="feature-box-icon small">
                        <img class="img-over hide-on-hover" src="<?php echo $this->webroot; ?>images/round_drop.png"/>
                        <img class="img-over show-on-hover" src="<?php echo $this->webroot; ?>images/round_drop_hover.png"/>
                        <i class="fa fa-star v-icon" style="margin-left: 3px;"></i>
                    </div>
                    <div class="feature-box-text">
                        <h3>Save favourites</h3>
                        <div class="feature-box-text-inner">
                            Save favourites and view other Dealers who are following yours cars.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <img class="img-responsive phone-image v-animation img-phone-feature" data-animation="fade-from-bottom" data-delay="250" src="<?php echo $this->webroot; ?>images/iPhone_2.png" />
            </div>

            <div class="col-md-4 col-sm-4 no-padding padding-15-mb-imp">
                <div class="feature-box left-icon v-animation" data-animation="fade-from-right" data-delay="200">
                    <div class="feature-box-icon small">
                        <img class="img-over hide-on-hover" src="<?php echo $this->webroot; ?>images/round_drop.png"/>
                        <img class="img-over show-on-hover" src="<?php echo $this->webroot; ?>images/round_drop_hover.png"/>
                        <i class="fa fa-university v-icon"></i>
                    </div>
                    <div class="feature-box-text">
                        <h3>Buying and Selling</h3>
                        <div class="feature-box-text-inner">
                            Make Offers, Request Offers and keep a record of cars bought and sold
                        </div>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                
                <div class="feature-box left-icon v-animation" data-animation="fade-from-right" data-delay="400">
                    <div class="feature-box-icon small">
                        <img class="img-over hide-on-hover" src="<?php echo $this->webroot; ?>images/round_drop.png"/>
                        <img class="img-over show-on-hover" src="<?php echo $this->webroot; ?>images/round_drop_hover.png"/>
                        <i class="fa fa-cube v-icon" style="left: 21px;"></i>
                    </div>
                    <div class="feature-box-text">
                        <h3>Fast Inventory</h3>
                        <div class="feature-box-text-inner">
                            Add cars to your inventory easily while on the road.
                        </div>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                
                <div class="feature-box left-icon v-animation" data-animation="fade-from-right" data-delay="600">
                    <div class="feature-box-icon small">
                        <img class="img-over hide-on-hover" src="<?php echo $this->webroot; ?>images/round_drop.png"/>
                        <img class="img-over show-on-hover" src="<?php echo $this->webroot; ?>images/round_drop_hover.png"/>
                        <i class="fa fa-bell v-icon" style="left: 20px;"></i>
                    </div>
                    <div class="feature-box-text">
                        <h3>Notifications and Reminders</h3>
                        <div class="feature-box-text-inner">
                            Get instant notifications. Maintain customer lists and requests using the "Set&Forget" function.
                        </div>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                
                <div class="feature-box left-icon v-animation" data-animation="fade-from-right" data-delay="600">
                    <div class="feature-box-icon small">
                        <img class="img-over hide-on-hover" src="<?php echo $this->webroot; ?>images/round_drop.png"/>
                        <img class="img-over show-on-hover" src="<?php echo $this->webroot; ?>images/round_drop_hover.png"/>
                        <i class="fa fa-newspaper-o v-icon"></i>
                    </div>
                    <div class="feature-box-text">
                        <h3>Industry Data</h3>
                        <div class="feature-box-text-inner">
                            Have up-to-the-minute, reliable industry data in your hands via News & Posts.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Features-->

    <div class="container">
        <div class="v-spacer col-sm-12 v-height-small"></div>
    </div>
</div>
<!--frame 3-->
<div class="v-page-wrap no-bottom-spacing no-top-spacing frame-home-3" id="frameDescribe" style="background-color: #fff;">
    
    <div class="container">
        <div class="v-spacer col-sm-12 v-height-big"></div>
    </div>
    
    <div class="container" id="video">
        <div class="row video">
            <div class="col-md-6 col-sm-12 v-animation" data-animation="fade-from-left" data-delay="250">
                <iframe id="iframe_video" class="video-youtube" src="https://www.youtube.com/embed/EBj3QR9WaV4?autoplay=0&loop=1&enablejsapi=1&version=3&playlist=EBj3QR9WaV4" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-md-6 col-sm-12 v-animation" data-animation="fade-from-right" data-delay="250">
                <div>
                    <img style="width: 340px;" src="<?php echo $this->webroot; ?>images/ic_logo_login.png" />
                </div>
                <ul class="style-disc">
                    <li>
                        Connect with Dealers
                    </li>
                    <li>
                        Buy and Sell Cars Fast
                    </li>
                    <li>
                        Grow Your Network
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="v-spacer col-sm-12 v-height-big"></div>
    </div>
</div>
<script>
    function showLoggin(redirect) {
        boxLoggin = $('#my_login');
        boxLoggin.attr('data-redirect', redirect);
        boxLoggin.modal('show');
    }
    
    $(window).scroll( function() {
        var topItem1 = $('#frameHome').position().top;
        if (topItem1 >= 0) {
            var topItem2 = $('#frameFeatures').position().top;
            var topItem3 = $('#frameDescribe').position().top;
            var bottom_of_window = $(window).scrollTop() + $('#menu_top').height() ;

            if(topItem1 < bottom_of_window){
                $('.mn-top-item').removeClass('active');
                $('.mn-top-item.item1').addClass('active');
            }
            if(topItem2 <= bottom_of_window){
                $('.mn-top-item').removeClass('active');
                $('.mn-top-item.item2').addClass('active');
            }
            if(topItem3 <= bottom_of_window){
                $('.mn-top-item').removeClass('active');
                $('.mn-top-item.item3').addClass('active');
                //player_video.playVideo();
            }
        }
    });
</script>