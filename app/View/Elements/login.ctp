<style>
.fixMoveLeftOnShowModal[style] {
    padding-right:0 !important;
}
.fixMoveLeftOnShowModal.modal-open {
    overflow: auto;
}
</style>

<script type="text/javascript">
    Vcore.Home.SubmitSignIn();
</script>

<div id="option_app" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row_op">
                        <a href="javascript:;" class="view_code"> 
                        Enter redeem code for using free 30 days.
                        </a>
                    </div>
                    
                    <div class="enter_code post_code" style="display: none"> 
                        <form id="Entercode" action="RedeemCodes/add_code" method="post">
                            <div class="form-group line-form">
                               <label>Please enter this code: </label>
                               <span class="base_code"></span>
                            </div>
                            <div class="form-group line-form">
                               <input type="text" name="code" class="form-control" style="width: 94%">
                            </div>
                            <div class="form-group line-form">
                               <button type="submit"  class="btn bt_login">
                                   OK
                               </button>
                            </div>
                        </form>    
                    </div> 
                    
                    <?php 
                    /*$paid = ClassRegistry::init('OptionPaypal')->find('all');
                    foreach($paid as $rs):*/?>
                    <div class="row_op">
                        <a href="<?php //echo $this->Html->Url("/payment/".$rs['OptionPaypal']['id'])?>" > 
                        <?php //echo $rs['OptionPaypal']['title']?>
                        </a>
                    </div>
                    <?php //endforeach;?>
                </div>
            </div>
        </div>
   </div>
</div>
<div id="option_app_2" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <?php 
                    //$url_paid = Configure::read('api.api_url').'api/user/getoptionpaypal';
                    //$paid = json_decode($this->CurlApi->to($url_paid)->post())->option_paypals;
                    //foreach($paid as $rs):?>
                    <div class="row_op">
                        <a href="<?php //echo $this->Html->Url("/payment/".$rs->_id)?>" > 
                        <?php //echo $rs->title?>
                        </a>
                    </div>
                    <?php //endforeach;?>
                </div>
            </div>
        </div>
   </div>
</div>
<div class="modal fade" id="my_login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mg-top-50-fixed">
                    <img width="200" src="<?php echo $this->webroot ?>images/ic_logo_login.png" alt="">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mg-top-50-fixed">
                    <form id="Login" action="users/ajaxlogin" method="post" class="form-horizontal">
                        <div class="form-group mg-bottom-20">
                            <input autocomplete="off" placeholder="Email address" type="text" name="email" class="form-control input-login" id="email_input">
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" placeholder="Password" type="password" name="password" class="form-control input-login" id="pass_input">
                        </div>
                        <div class="form-group mg-top-30">
                            <div class="col-xs-6 no-padding text-left">
                                <label class="border-checkbox control-checkbox">
                                    <input name="agree" id="agree" data-bv-field="agree" value="1" type="checkbox"/>
                                    <div class="j-check-confirm control_indicator"></div>
                                    Remember me
                                </label>
                            </div>
                            <div class="col-xs-6 no-padding text-right">
                                <a class="forgot-password" data-toggle="modal" data-target="#resetpassword" data-dismiss="modal" href="javascript:void(0)">Forgot password?</a>
                            </div>
                        </div>
                        <input id="client_ip" type="hidden" name="clientip"">
                        <input id="browser_name" type="hidden" name="browsername"">
                        <div class="form-group mg-top-50-fixed">
                            <a href="<?php echo $this->Html->Url('/sign_up')?>" class="btn-register">Register</a>
                            <a href="javascript:void(0)" class="btn-login j-submit-login">Login</a>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div id="enter_code_device" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog active_dialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    Activation code
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="EnterDevicecode">
                            <div class="col-xs-12">
                                <div class="form-group">
                                   <label>Input your code:</label>
                                   <span class="base_code"></span>
                                </div>
                                <div class="form-group">
                                   <input type="text" name="code" class="form-control">
                                </div>
                            </div>
                            <div>
                               <button type="submit" class="btn_100">
                                   Activate
                               </button>
                            </div>
                        </form>  
                    </div>   
                </div>
            </div>
        </div>
   </div>
</div>
<div id="resetpassword" class="modal fade" role="dialog">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div> -->
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <form id="Reset_password" >
                    <div style="overflow: hidden; margin: 0 10px">
                        <div class="line-form" style="margin: 10px 0;">
                            <h4>Reset password</h4>
                        </div>
                        <div class="line-form notice" style="margin: 10px 0;">
                            Please enter you email to receive your new password.
                        </div>
                        <div class="line-form" style="margin: 10px 0">
                            <input type="text" name="email" value="" class="form-control" placeholder="Email address" style="width: 95%;">
                        </div>
                        <div class="line-form text-center" style="margin: 20px 0;padding-bottom: 5px;">
                            <button type="submit" class="btn custom-btn">
                                Send
                            </button>
                         </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getBrowserName() {
        var nVer = navigator.appVersion;
        var nAgt = navigator.userAgent;
        var browserName  = navigator.appName;
        var nameOffset,verOffset,ix;
// In Opera, the true version is after "Opera" or after "Version"
        if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
            browserName = "Opera";
        }
// In MSIE, the true version is after "MSIE" in userAgent
        else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
            browserName = "Microsoft Internet Explorer";
        }
// In Chrome, the true version is after "Chrome"
        else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
            browserName = "Chrome";

        }
// In Safari, the true version is after "Safari" or after "Version"
        else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
            browserName = "Safari";
        }
// In Firefox, the true version is after "Firefox"
        else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
            browserName = "Firefox";
        }
// In most other browsers, "name/version" is at the end of userAgent
        else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
            (verOffset=nAgt.lastIndexOf('/')) )
        {
            browserName = nAgt.substring(nameOffset,verOffset);
        }
        return browserName;
    }
    var browserName = document.getElementById("browser_name"); // Get text field
    browserName.value = getBrowserName();

    $(document).ready(function() {
        var ipaddress = document.getElementById("client_ip"); // Get text field
        $.getJSON("http://jsonip.com/?callback=?", function (data) {
            ipaddress.value = data.ip;
        });
        $('.j-submit-login').click(function(e) {
            $('#Login').submit();
        });
        $('#my_login').on('show.bs.modal', function (e) {
            $('body').addClass('fixMoveLeftOnShowModal');
        });
        $('#resetpassword').on('show.bs.modal', function (e) {
            $('body').addClass('fixMoveLeftOnShowModal');
        });
        $('#EnterDevicecode').validate({
                errorElement: "div",
                errorClass: "error",
                rules: {
                    'code':{
                        required: true
                    }           
                },
                messages: {
                    'code':{
                        required: 'The code is required and can\'t be empty'
                    }
                },

                wrapper: "div",
                errorLabelContainer: ".message"
                ,submitHandler: function(form) {
                    dataString = $("#EnterDevicecode").serialize();
                    $.ajax({
                        type: "POST",
                        url: root+'users/activate_device_code',
                        data: dataString,
                        dataType: "json",
                        success: function(data) {
                            if(data.error == 0){
                                window.location.href = root + 'home';
                            }else{
                                jAlert(data.msg);
                            }
                        }
                    });
                    return false;
                } 
        }); 
        $('#Entercode').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                code: {
                    validators: {
                        notEmpty: {
                            message: 'The code is required and can\'t be empty'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target),
            validator = $form.data('bootstrapValidator');
            $.post($('#Entercode').attr('action'), $form.serialize(), function (data) {
                if(data.error == 0){
                    jAlert('You have to register to use CarZapp 30 days success!');
                    window.location.href = root + 'home';
                }else{
                    jAlert(data.msg);
                }
            },'json');
        });
        $('#Reset_password').validate({
                errorElement: "div",
                errorClass: "error",
                rules: {
                    'email':{
                        required: true
                    }           
                },
                messages: {
                    'email':{
                        required: 'The email address is required and can\'t be empty'
                    }
                },

                wrapper: "div",
                errorLabelContainer: ".message"
                ,submitHandler: function(form) {
                    dataString = $("#Reset_password").serialize();
                    load_show();
                    $.ajax({
                        type: "POST",
                        url: root+'forgot',
                        data: dataString,
                        dataType: "json",
                        success: function(data) {
                            load_hide();
                            if(data.error == 0){
                                //window.location.href = root + '/home_current';
                                $("#resetpassword").modal('hide');
                                showMessage(data.msg, 0);
                            }else{
                                //jAlert(data.msg);
                                showMessage(data.msg, 1);
                            }
                        }
                    });
                    return false;
                } 
        });
    });
    $(".bt_back").click(function(){
        $('#my_regis button').prop('disabled', false);
    });
    $(".btn_check_code").on("click",function(){
        var codef = $('input[name="code"]').val();
        $.post(root + 'users/check_code',{'codef':codef},function(data){
            $(".data_source").removeAttr("checked");
            if(data.error == 0){
                $("input[name='companyname']").val(data.companyname);
                $("input[name='dealernumber']").val(data.dealernumber);
                $(".login").prop('disabled', false);
                $('.login').removeAttr("disabled");
                $(".data_source").each(function(){
                    var data_id = parseInt($(this).attr("data_id"));
                    for(i = 0; i < data.list.length; i++){
                        var id = parseInt(data.list[i]);
                        if(id == data_id){
                            $(this).prop("checked","checked");
                            console.log(id+" - check");
                        }
                    }
                });
            }else{
                $(".login").prop('disabled', 'disabled');
                alert('Not exits code');
            }
        },'json');
    });
  
</script>