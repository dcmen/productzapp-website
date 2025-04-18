<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
<style>
    body {
        background: #f1f1f1 none repeat scroll 0 0;
        font-family: 'Open Sans Condensed', sans-serif;
        font-size: 14px;
    }
</style>
<script type="text/javascript">
    $( window ).resize(function() {
        var h = $(window).height();
        $("#Brochure .bg_brochure").css('min-height',h);
        $("#Brochure .content_all").css('min-height',h + 100);
    });
    $(document).ready(function(){
        if($( window ).resize()){
            var h = $(window).height();
            var h2 = $("#Brochure .content_all").height();
            if(h < 768){
                $("#Brochure .bg_brochure").css('min-height',h + 50);
                $("#Brochure .content_all").css('min-height',h + 50);
            }else{
                $("#Brochure .bg_brochure").css('min-height',h);
                $("#Brochure .content_all").css('min-height',h);
            }
        }else{
            var h = $(document).height();
            var h2 = $("#Brochure .content_right").height();
            $("#Brochure .bg_brochure").css('min-height',h);
            $("#Brochure .content_all").css('min-height',h);
        }
    })
</script>
<div id="Brochure">
    <div class="bg_brochure">
        <div class="col-xs-12 col-lg-10 col-lg-offset-1 no-padding">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="logo_home"><img src="images/logo_500.png" class="img-responsive" width="400px"></div>
                <div class="message" style="display: none; left: 0px; margin-top: 150px;">Thank you for your request, a link to download the brochure has been sent to your email.</div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="content_right">
                    <div class="row_bro">
                        <div>A little birdie told me that...</div>
                        <div class="color_sky">OUR SITE IS</div>
                        <div class="color_sky">ALMOST READY!</div>
                    </div>
                    <div class="row_bro" style="padding: 0 20px;font-weight: 700">GET BROCHURE <img src="images/hand.png"></div>
                    <form id="RegisBrochure" action="<?php echo $this->Html->Url('/Pages/regis_brochure')?>" method="post" class="form-horizontal">
                        <div class="form-group line-form">
                            <input type="text" name="first_name" required placeholder="First name" value="">
                        </div>
                        <div class="form-group line-form">
                            <input type="text" name="last_name" required placeholder="Last name" value="">
                        </div>
                        <div class="form-group line-form">
                            <input type="text" name="email" required placeholder="Email" value="">
                        </div>
                        <div class="form-group line-form">
                            <textarea name="messages" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group line-form" style="text-align: right">
                            <input type="submit" value="Send">
                        </div>
                    </form>    
                </div>    
            </div>
        </div>

        <div class="fot_brochure col-xs-12">
            <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6 text-center" style="padding-top: 6px;">
                © Carzapp Pty Ltd (Australia) 2015. Coming soon.
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6 text-center">
                <a href="" class="t_bro"><img src="images/twiter_brochure.png"></a>
                <a href="" class="f_bro"><img src="images/face_brochure.png"></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
        
    </div>
<script type="text/javascript">
$(document).ready(function() {
    $('#RegisBrochure').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            first_name: {
                message: 'The first_name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The first_name is required and can\'t be empty'
                    }
                }
            },
            last_name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The last name is required and can\'t be empty'
                    }

                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        load_show();
        e.preventDefault();
        var $form = $(e.target),
        validator = $form.data('bootstrapValidator');
        $.post($('#RegisBrochure').attr('action'), $form.serialize(),function(data){
            load_hide();
            jAlert('Thank you for your request, a link to download the brochure has been sent to your email.');
            $("input[name='first_name']").val('');
            $("input[name='last_name']").val('');
            $("input[name='email']").val('');
            $("textarea[name='messages']").val('');
        });
            
    });
    
    $("#RegisBrochure").submit(function(){
        var h = $("#Brochure .content_all").height();
        $("#Brochure .bg_brochure").css('min-height',h + 50);
    })
    setTimeout(function () {
        $('.message').hide();
    }, 300);
});
</script>
