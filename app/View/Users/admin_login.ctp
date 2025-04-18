<script type="text/javascript">
    $( window ).resize(function() {
        var h = $(window).height();
        $("#Brochure .bg_brochure").css('min-height',h);
        $("#Brochure .content_all").css('min-height',h);
    });
    $(document).ready(function(){
        if($( window ).resize()){
            var h = $(window).height();
            if(h < 768){
                $("#Brochure .bg_brochure").css('min-height',h );
                $("#Brochure .content_all").css('min-height',h );
            }else{
                $("#Brochure .bg_brochure").css('min-height',h);
                $("#Brochure .content_all").css('min-height',h);
            }
        }else{
            var h = $(document).height();
            $("#Brochure .bg_brochure").css('min-height',h);
            $("#Brochure .content_all").css('min-height',h);
        }
    })
</script>
<div id="Brochure">
    <div class="bg_brochure">
        <div class="container">
            <div class="col-xs-12 content_all no-padding" >
                <div class="col-md-5 col-md-offset-1 col-xs-12" style="margin-top: 5%">
                    <div class="logo_home"><?php echo $this->Html->image('../images/ic_logo_login.png', array('class' => 'img-responsive','width' => '400'))?></div>
                    <div class="message" style="display: none; left: 0px; margin-top: 150px;">Thank you for your request, a link to download the brochure has been sent to your email.</div>
                </div>
                <div class="col-md-5 col-xs-12" style="margin-top: 17%">
                    <div class="content_right">
                        <div class="bg_login" >
                            <?php echo $this->Session->flash(); ?>
                            <form id="UserLoginForm" action="<?php echo $this->Html->Url('/Users/admin_login')?>" method="post" class="form-horizontal">
                                <input type="hidden" name="time_zones" value="" />
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="Email" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" value="">
                                </div>
                                <div class="form-group" style="text-align: right">
                                    <button type="submit">Login</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script type="text/javascript">
    $timezone = getTimeZoneBrowser();
    $('input[name="time_zones"]').val($timezone);
    
    $("#UserLoginForm").validate({
        errorElement: "em",
        errorClass: "error",
        rules: {
            'email': {
                required: true
            },
            'password': {
                required: true
            },
        },
        messages: {
            'email': {
                required: "Please enter email"
            },
            'password': {
                required: "Please enter password.",
            },
        }
    });
</script>
