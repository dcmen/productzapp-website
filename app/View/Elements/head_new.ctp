<?php 
$uri1 = $this->params['pass']?>

<div class="navbar cus-navbar" id="menu_top">
    <div class="container">
        <div class="navbar-header">
            <button style="margin-top: 10px;" type="button" class="navbar-toggle collapsed navbar-mobile" data-toggle="collapse" data-target="#navigation-bar">
                <i style="color: #aaa; font-size: 25px;" class="fa fa-bars"></i>
            </button>
            <div class="logo hidden-xs">
                <a href="<?php echo $this->Html->Url('/home_current')?>">
                    <img class="menu-logo" src="<?php echo $this->webroot ?>images/ic_logo_login.png">
                </a>
            </div> 
            <div class="logo_xs hidden-lg hidden-md hidden-sm" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;">
                <a href="javascript:;">
                    <img class="img-responsive" width="100px" src="<?php echo $this->webroot ?>images/ic_logo_login.png">
                </a>
            </div> 
        </div>    
        <div class="collapse navbar-collapse" id="navigation-bar"><!--collapse navbar-collapse navbar-menu -->
            <ul class="nav navbar-right navbar-nav">
                <?php if (!$this->Session->read('Auth.User._id')) : ?>
                    <?php if (isset($isHomePage)) : ?>
                    <li><a class="mn-top-item item1 active" data="#frameHome" href="javascript:;">HOME</a></li>
                    <li><a class="mn-top-item item2" data="#frameFeatures" href="javascript:;">FEATURES</a></li>
                    <li><a class="mn-top-item item3" data="#frameDescribe" href="javascript:;">DESCRIBE</a></li>
                    <!--<li><a class="mn-top-item item4" data="#frameBestDeals" href="javascript:;">BEST DEALS</a></li>-->
                    <?php else : ?>
                    <li><a class="mn-top-item item1" href="home_current">HOME</a></li>
                    <li><a class="mn-top-item item2" href="home_current#frameFeatures">FEATURES</a></li>
                    <li><a class="mn-top-item item3" href="home_current#frameDescribe">DESCRIBE</a></li>
                    <!--<li><a class="mn-top-item item4" href="home_current#frameBestDeals">BEST DEALS</a></li>-->
                    <?php endif; ?>
                    
                    <li><a class="mn-top-item item5 btn-signin" href="javascript:;" data-toggle="modal" data-target="#my_login">LOG IN</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<script>
    var player_video;
    
    function onYouTubeIframeAPIReady() {
        player_video = new YT.Player('iframe_video', {
            events: {
              'onReady': onPlayerReadyCTV
            }
        });
    }
    
    function onPlayerReadyCTV() {
        //console.log("hey Im ready ctv");
    }
    
    $('.mn-top-item').click(function () {
        item = $(this);
        target = item.attr('data');
        if (target) {
            $('html, body').animate({
                scrollTop: ($(target).offset().top - 60)
            }, 800);
        }
    });
</script>
<?php echo $this->element('login');?>