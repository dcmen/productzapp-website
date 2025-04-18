<style>
    #Regis .agree-checkbox {
        padding-left: 0px;
    }
    .btn-next-step {
        float: right;
    }
    .form-group.has-success .help-block-custom {
        display: none !important;
    }
    @media (max-width: 767px) {
        .agree-checkbox {
            padding-left: 0px;
            margin: 5px 0px 0px;
        }
    }
</style>
<div class="wrapper_regis">
    <div class="col-xs-12 pull-left col-xs-offset-2 col-lg-10 col-lg-offset-1">
        <div style="margin: 30px 0">
            <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
        </div>
    </div>
    <div id="sign_up">
        <form id="Regis" action="facebooks/register_step_1" method="post" class="form-horizontal">
            <div class="step" style="position: absolute; width: 100%;">
                <ul>
                    <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                    <li><?php echo $this->Html->image('/images/radio_off.png')?></li>
                    <li><?php echo $this->Html->image('/images/radio_off.png')?></li>
                    <li><?php echo $this->Html->image('/images/radio_off.png')?></li>
                </ul>
            </div>
            <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 no-padding">
                <h5 class="no-padding">Step 1</h5>

                <div class="col-lg-6 col-xs-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                           <input type="text" placeholder="First name" autocomplete="off" name="name" class="form-control input-custom" required value="<?php echo $this->Session->read('first_name_rg')?>">
                        </div>
                    </div> 
                </div>
                
                <div class="col-lg-6 col-xs-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" placeholder="Last name" autocomplete="off" name="last_name" class="form-control input-custom" value="<?php echo $this->Session->read('last_name_rg') ?>">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-lg-6 col-xs-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="email" placeholder="Email address" autocomplete="off" name="email" class="form-control input-custom" required value="<?php echo $this->Session->read('email_rg') ?>">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-xs-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="email" placeholder="Confirm email address" autocomplete="off" name="re_email" class="form-control input-custom" required value="<?php echo $this->Session->read('email_rg') ?>">
                            <small data-bv-result="VALID" data-bv-validator="identical" class="help-block help-block-custom" style="display: none;">The email and its confirm are not the same</small>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-lg-6 col-xs-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" placeholder="Mobile" name="phone" autocomplete="off" class="form-control input-custom" value="<?php echo $this->Session->read('phone_rg') ?>">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12 col-xs-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="checkbox agree-checkbox">
                                <label class="border-checkbox control-checkbox">
                                    <input style="outline: 0;" type="checkbox" name="agree" <?php echo ($this->Session->read('agree_rg'))?'checked = checked':''?> value="1" required>
                                    <div class="j-check-confirm control_indicator"></div>
                                    &nbsp;&nbsp;I agree to the <a href="<?php echo $this->Html->Url("/terms")?>" target="_blank">Terms and Conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-xs-12" style="margin: 0 0 10px">
                    <div class="btn-next-step">
                        <button type="submit" class="btn btn-custom">Next</button>
                    </div>
                   <!--  <div class="col-lg-4 col-xs-12 no-padding" style="margin: 9px 0 0px">
                        <a href="javascript:;" data-toggle="modal" data-target="#my_login">
                        Already have an account?
                        </a>
                    </div> -->
<!--                    <div class="col-lg-4 col-xs-12 text-right">
                        Sign up with 
                        <a class="no-decoration" href="<?php // echo $this->Html->Url("/loginfb")?>">
                            <img src="images/face.png">
                        </a>
                        or 
                        <a class="no-decoration" href="<?php // echo $this->Html->Url('/logintw')?>">
                            <img src="images/twitter.png">
                        </a>
                    </div>-->
                </div>
            </div>
        </form> 
    </div>
</div>

<?php echo $this->element('login');?>

<script type="text/javascript">
    Vcore.Home.SubmitSignIn();
    
    $(document).ready(function() {
        $('#Regis').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                name: {
                    message: 'The name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'This field is required and can\'t be empty'
                        }

                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'This field is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                re_email: {
                    validators: {
                        notEmpty: {
                            message: 'This field is required and can\'t be empty'
                        },
//                        identical: {
//                            field: 'email',
//                            message: 'The email and its confirm are not the same'
//                        }
                    }
                },
                phone: {
                    message: 'The phone is not valid',
                    validators: {
                        notEmpty: {
                            message: 'This field is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[0-9+]+$/,
                            message: "Please enter the number"
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Phone number must be between 6-20 characters in length'
                        }
                    }
                },
                agree: {
                    message: 'The agree is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Please tick the box to confirm you have read our terms and conditions before proceeding to register'
                        }

                    }
                }
            }
        }).on('success.form.bv', function (e) {
            load_show();
            e.preventDefault();
            
            if ($('input[name="re_email"]').val().toLowerCase() != $('input[name="email"]').val().toLowerCase()) {
                $('small[data-bv-validator="identical"]').attr('data-bv-result', 'INVALID');
                $('small[data-bv-validator="identical"]').show();
                $('input[name="re_email"]').closest('.form-group').removeClass('has-success');
                $('input[name="re_email"]').closest('.form-group').addClass('has-error');
                
                return false;
            }
            
            var $form = $(e.target);
            $.post($('#Regis').attr('action'), $form.serialize(),function(data){
                load_hide();
                if(data.error == 0){
                    window.location.href = root + 'sign_up';
                }else{
                    showMessage(data.msg, 1);
                }
            },'json');
        });
    });
</script>