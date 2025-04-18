<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
<style>
@font-face {
    font-family: brochure-font;
    src:url('<?php echo $this->webroot; ?>fonts/brochure.woff') format('woff');
    font-weight:normal;
    font-style:normal;
}
html {
    overflow-y: auto;
    overflow-x: hidden;
}
body {
    background: #f1f1f1 none repeat scroll 0 0;
    font-family: brochure-font;
    font-size: 14px;
}
.help-block {
    position: absolute;
    margin-top: -2px;
}
.form-group {
    margin-bottom: 34px;
}
.t_bro img, .f_bro img {
    height: 30px;
    width: 30px;
}
video.loading {
    background: black url('<?php echo $this->webroot; ?>images/pic_waiting_loading.png') center center no-repeat;
}
.fot_brochure {
    z-index: 9999;
}
#popup_message {
    
}
.btn-kb-01 {
    padding: 0px !important;
    border-color: transparent;
    background-color: transparent;
    display: inline-block;
}
.btn-kb-01 > img {
    width: 100%;
}
.btn-kb-01 .ic-normal {
    display: block;
}
.btn-kb-01:hover .ic-normal {
    display: none;
}
.btn-kb-01 .ic-hover {
    display: none;
}
.btn-kb-01:hover .ic-hover {
    display: block;
}
.btn-kb-01.btn-app {
    width: 140px;
}
@media (max-width:640px) {
    .dis-none-max-640 {
        display: none !important;
    }
}
</style>
<script type="text/javascript">
    function resetsize() {
        var h = $('.brochure-video').height();
        $("#Brochure .bg_brochure").css('min-height',h);

        //.brochure-video-content
        w1 = $(window).width();
        hwindow = $(window).height();
        
        if (w1 < 375) {
            $(".brochure-video-content").css('left', (w1 - 900)/2);

            $(".form-content").css('margin-left', $(".form-input-brochure .form-content").width()/2 * (-1));

            var h = $('.brochure-video').height() - $('.fot_brochure').height() - 26 + 110;
            if (h > hwindow) {
                $("#Brochure .bg_brochure").css('min-height', h);
            }
            else {
                $("#Brochure .bg_brochure").css('min-height',hwindow);
            }
        }
        else if (w1 < 900) {
            $(".brochure-video-content").css('left', (w1 - 900)/2);

            $(".form-content").css('margin-left', $(".form-input-brochure .form-content").width()/2 * (-1));

            var h = $('.brochure-video').height() - $('.fot_brochure').height() - 26 + 110;
            if (h > hwindow) {
                $("#Brochure .bg_brochure").css('min-height', h);
            }
            else {
                $("#Brochure .bg_brochure").css('min-height', hwindow);
            }
        }
        else if (w1 < 1250) {
            $(".brochure-video-content").css('left', 0);

            var h = $('.brochure_control').height() - 80;
            if (h > hwindow) {
                $("#Brochure .bg_brochure").css('min-height', h);
            }
            else {
                $("#Brochure .bg_brochure").css('min-height',hwindow);
            }
        }
        else {
            $(".brochure-video-content").css('left', 0);

            var h = $('.brochure_control').height() - 110;
            if (h > hwindow) {
                $("#Brochure .bg_brochure").css('min-height', h);
            }
            else {
                $("#Brochure .bg_brochure").css('min-height', hwindow);
            }
        }
        
        ratio1 = $(window).width() / $(window).height();
        ratio2 = $('.brochure-video').width() / $('.brochure-video').height();
        
        if (ratio1 > ratio2) {
            $('.brochure-video').css({
                width: '100%',
                top: 0,
                height: 'auto'
            });
        }
        else {
            $('.brochure-video').css({
                top: 0,
                height: $(window).height(),
                width: 'auto'
            });
        }
        
        if ($('.brochure_control').css('display') == 'none' ) {
            $("#Brochure .bg_brochure").css('min-height',$(window).height());
        }
    }

    $('.brochure-video').on('loadstart', function (event) {
        $(this).addClass('loading');
    });
    $('.brochure-video').on('canplay', function (event) {
        $(this).removeClass('loading');
        $(this).attr('poster', '');
    });
    
    $( window ).resize(function() {
        resetsize();
    });
</script>
<div id="Brochure">
    <div class="bg_brochure">
        <div>
            <div class="brochure-video-content">
                <video class="brochure-video" autoplay preload="true">
                    <source src="<?php echo $this->webroot; ?>carzapp_video.mp4" type='video/mp4'/>
                </video>
            </div>
        </div>

        <div class="brochure_control">
            <div class="background-slide-video"></div>
            <div class="brochure_content">
                <div class="brochure-touch">
                    <h1 class="brochure-header">
                        <div class="brochure-header-title">Website coming soon</div>
                        <div class="brochure-header-content">For more info on what's about to hit the car market, watch the CarZapp video,</div>
                        <div class="brochure-header-content">register to download the CarZapp brochure and receive news and updates.</div>
                    </h1>
                    <div>
                        <div class="text-center col-lg-12 col-md-6 col-sm-6 col-xs-12 ">
                            <a class="brochure-btn brochure-btn-watch btn-watch" href="javascript:;"><i class="fa fa-play" aria-hidden="true"></i> Watch now</a>
                            <a class="brochure-btn brochure-btn-watch btn-resume" href="javascript:;"><i class="fa fa-repeat" aria-hidden="true"></i> Resume video</a>
                        </div>
                        <div class="text-center col-lg-12 col-md-6 col-sm-6 col-xs-12 ">
                            <a class="brochure-btn brochure-btn-download" href="javascript:;">Download Brochure</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div style="margin-top: 25px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div style="display: inline-block">
                                <label class="dis-none-max-640" style="display: block; color: #fff; font-size: 16px; font-weight: 500;">Download from App Store</label>
                                <a target="_blank" href="https://itunes.apple.com/au/app/carzapp/id1033050312?mt=8" class="btn-kb-01 btn-app">
                                    <img class="ic-normal" src="<?php echo $this->webroot; ?>images/ic-AppStore.png" />
                                    <img class="ic-hover" src="<?php echo $this->webroot; ?>images/ic-AppStore_hover.png" />
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div style="display: inline-block">
                                <label class="dis-none-max-640" style="display: block; color: #fff; font-size: 16px; font-weight: 500;">Download from Google Store</label>
                                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.carzapp.australia" class="btn-kb-01 btn-app">
                                    <img class="ic-normal" src="<?php echo $this->webroot; ?>images/ic-GooglePlay.png" />
                                    <img class="ic-hover" src="<?php echo $this->webroot; ?>images/ic-GooglePlay_hover.png" />
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:none;" class="form-input-brochure">
            <div class="form-content">
                <a class="close-form-brochure-btn" href="javascript:;"></a>
                <div>
                    <div class="logo_home" style="text-align: center;"><img src="<?php echo $this->webroot ?>images/ic_logo_login.png" class="img-responsive img-logo-brochure"></div>
                </div>
                <form id="RegisBrochure" action="<?php echo $this->Html->Url('/Pages/regis_brochure')?>" method="post" class="form-horizontal">
                    <div class="form-group">
                        <input class="form-brochure" type="text" name="first_name" required placeholder="First name" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-brochure" type="text" name="last_name" required placeholder="Last name" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-brochure" type="text" name="email" required placeholder="Email" value="">
                    </div>
                    <div class="form-group">
                        <textarea class="form-brochure" name="messages" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="send-brochure-btn" type="submit">Send</button>
                    </div>
                </form>  
            </div>
        </div>

        <div class="brochure-logo-carzapp">
            <img src="<?php echo $this->webroot; ?>images/ic_logo_login.png" />
        </div>
        
        <div id="mute-video" class="sound-ic" style="position: absolute; top: 30px; right: 26px; cursor: pointer;">
            <img style="width: 30px; height: 30px;" class="sound-on" src="<?php echo $this->webroot; ?>images/loud_speaker_volume_on.png" />
            <img style="width: 30px; height: 30px; display: none;" class="sound-off" src="<?php echo $this->webroot; ?>images/loud_speaker_volume_off.png" />
        </div>
    </div>
    <div class="fot_brochure col-xs-12" style="position:fixed;">
        <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6 text-center" style="padding-top: 6px;">
            © CarZapp Pty Ltd (Australia) 2016. Coming soon.
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6 text-center">
            <a href="https://twitter.com/carzappAU" class="t_bro"><img src="<?php echo $this->webroot ?>images/twiter_brochure.png"></a>
            <a href="https://www.facebook.com/CarZappGlobal/" class="f_bro"><img src="<?php echo $this->webroot ?>images/face_brochure.png"></a>
        </div>
    </div>
</div>

<script type="text/javascript">
var w = $(window).width();
if (w < 768) {
    $('html').css('overflow-y', 'auto');
    
    $("video").each(function(){
            $(this).get(0).pause();
        });
    $('.brochure_control').show();
    $('.btn-watch').show();
    $('.btn-resume').hide();
}

$(document).ready(function() {
    //var h = $('.brochure-video').height() - $('.fot_brochure').height() - 26;
    var h = $(window).height();
    $("#Brochure .bg_brochure").css('min-height',h);

    $('.brochure-video').bind('ended', function() {
        this.currentTime = 0;
        $("video").each(function(){
            $(this).get(0).pause();
        });
        $('.brochure_control').show();
        resetsize();
        
        $('.btn-watch').show();
        $('.btn-resume').hide();
    });

    $('.brochure-video').bind('pause', function() {
        $('.brochure_control').show();
        resetsize();
        
        $('.btn-watch').hide();
        $('.btn-resume').show();
    });
    
    $('.brochure-btn-download').click(function () {
        $('#RegisBrochure').trigger('reset');
        $('.brochure_control').hide();
        $("#Brochure .bg_brochure").css('min-height',$(window).height());
        $('.form-input-brochure').show();
        $(".form-content").css('margin-left', $(".form-input-brochure .form-content").width()/2 * (-1));
    });

    $('.close-form-brochure-btn').click(function () {
        $('.form-input-brochure').hide();
        $('.brochure_control').show();
        resetsize();
        
    });
    
    $('.brochure-video').click(function () {
        $("video").each(function(){
            $(this).get(0).pause();
        });
        $('.brochure_control').show();
        $('.btn-watch').hide();
        $('.btn-resume').show();
    });

    $('.brochure-btn-watch').click(function () {
        $("video").each(function(){
            $(this).get(0).play();
        });
        $('.brochure_control').hide();
        $("#Brochure .bg_brochure").css('min-height',$(window).height());
    });

    $('#RegisBrochure').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            first_name: {
                message: 'The first_name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }
                }
            },
            last_name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    }

                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        load_show();
        $('.form-input-brochure').hide();
        e.preventDefault();
        var $form = $(e.target),
        validator = $form.data('bootstrapValidator');
        $.post($('#RegisBrochure').attr('action'), $form.serialize(),function(data){
            load_hide();
            jAlert('Thank you for your request.<br>A link to download the brochure has been sent to you by email.');
            $("input[name='first_name']").val('');
            $("input[name='last_name']").val('');
            $("input[name='email']").val('');
            $("textarea[name='messages']").val('');
            $('.brochure_control').show();
        });
            
    });
    
    $("#RegisBrochure").submit(function(){
        var h = $("#Brochure .content_all").height();
        //$("#Brochure .bg_brochure").css('min-height',h + 50);
    })
    setTimeout(function () {
        $('.message').hide();
    }, 300);
    
    
    $("#mute-video").click( function (){
        if( $("video").prop('muted') ) {
              $("video").prop('muted', false);
              $('.sound-on').show();
              $('.sound-off').hide();
        } else {
          $("video").prop('muted', true);
          $('.sound-on').hide();
            $('.sound-off').show();
        }
      });
      
    //resetsize();
});
</script>
