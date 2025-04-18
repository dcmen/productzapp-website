<style>
    #sign_up h5.payment-header {
        color: #00BBB0;
        padding: 9px;
        font-family: 'Roboto-Regular';
        font-size: 28px;
    }
    #sign_up .step.pos-abs {
        position: absolute;
    }
    .box-shadow-content {
        margin: 5px 7px;
        padding: 7px 8px;
        background-color: #f2f2f2;
        font-size: 12px;
    }
    .box-blue-content {
        margin: 5px 7px;
        padding: 7px 8px;
        background-color: #dae5f1;
        font-size: 16px;
    }
    .box-benefit-content {
        margin: 5px 7px;
        padding: 7px 8px;
        font-size: 12px;
    }
    .benefit-item {
        padding-left: 20px;
        position: relative;
    }
    .benefit-item > label {
        position: absolute;
        top: 3px;
        left: 0;
    }
    .benefit-item > .benefit-content {
        font-size: 13px;
        background-color: #f2f2f2;
        padding: 3px 9px;
    }
    .btn-submit-card {
        background-color: #82a33b;
        text-transform: initial;
        background-image: -moz-linear-gradient(center top , #82a33b 0%, #8eba31 50%, #8eba31 50%, #82a33b 100%);
        border-radius: 8px;
        box-shadow: 1px 3px 10px -4px #82a33b;
        width: 100%;
    }
    .frame-1 h5, .frame-1 p {
        text-align: center !important;
    }
    @media (min-width:768px) {
        .card-info-item {
            position: relative;
            padding-left: 75px;
        }
        .input-car-info {
            width: 100px;
            display: inline-block;
        }
        .card-info-label {
            position: absolute;
            top: 0px;
            left: 0;
        }
        .card-info-label.cvv-info {
            position: relative;
            padding-left: 75px;
        }
    }
    @media (max-width:767px) {
        .card-info-item {
            position: relative;
            padding-left: 59px;
        }
        .input-car-info {
            width: 55px;
            display: inline-block;
            padding-left: 7px;
            padding-right: 3px;
        }
        .card-info-label {
            position: absolute;
            top: 2px;
            left: 0;
        }
        .card-info-label.cvv-info {
            position: relative;
            padding-left: 35px;
            margin-top: -2px;
        }
        #sign_up h5 {
            font-size: 17px;
            font-weight: 600;
            margin: 16px 0 7px;
        }
        #sign_up h5.payment-header {
            border: 0;
            text-align: center;
        }
        .wrapper_regis #CarInfoForm .form-group label {
            font-size: 12.5px;
            margin-top: 6px;
        }
        #CarInfoForm input[type="text"]::-webkit-input-placeholder ,textarea[type="text"]::-webkit-input-placeholder {
            color:#aaa;
            font-size: 11.5px;
        }
        #CarInfoForm input[type="text"]:-moz-placeholder,textarea[type="text"]:-moz-placeholder {
            color:#aaa;
            font-size: 11.5px;
        }
        #CarInfoForm input[type="text"]::-moz-placeholder,textarea[type="text"]::-moz-placeholder {
            color:#aaa;
            font-size: 11.5px;
        }
        #CarInfoForm input[type="text"]:-ms-input-placeholder ,textarea[type="text"]:-ms-input-placeholder {
            color:#aaa;
            font-size: 11.5px;
        }
    }
</style>

<div class="wrapper_regis">
    <?php if (!$mobile) : ?>
    <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1">
        <div class="container-logo" style="margin: 30px 0">
            <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
        </div>
    </div>
    <?php endif; ?>
    <div id="sign_up" <?php echo ($mobile)? 'style="padding-bottom: 0px;"' : '' ?> >
        <?php if (!$mobile) : ?>
        <div class="step pos-abs" <?php echo isset($login)? 'hidden' : '' ?>>
            <ul>
                <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                <li><?php echo $this->Html->image('/images/radio_off.png')?></li>
            </ul>
        </div>

        <?php endif; ?>
        <!--frame 1-->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 no-padding frame-1 <?php echo isset($login)? 'hidden' : '' ?>">
                <div class="white-wrapper">
                    <h5 class="payment-header" style="border-bottom: 0; <?php echo ($mobile)? 'margin: 0px;' : '' ?>">Free Subscription Period</h5>
                    <div class="clearfix"></div>
                    <div class="col-lg-12">
                        <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 no-padding frame-1">
                            <div class="col-lg-12" style="margin-bottom: 13px; margin-top: 10px; text-align: center">
                                <div class="text-center line1" style="font-size: 14.5px; display: inline-block"><?php echo isset($line1) ? $line1 : '';?></div> <div class="date_1" style="display: inline-block;"><?php  echo date('dS F Y', strtotime($time_free_not_enter_payment)); ?> </div>
                            </div>
                            <div class="col-lg-12" style="margin-bottom: 13px; text-align: center">
                                <div class="text-center line2" style="display: inline-block;"><?php echo isset($line2) ? $line2 : '';?></div><div style="display: inline-block;"></div>
                            </div>
                            <div class="col-lg-12" style="margin-bottom: 13px; text-align: center">
                                <div class="text-center line3" style="display: inline-block;"><?php echo isset($line3) ? $line3 : '';?></div> <div class="date_2" style="display: inline-block;"><?php echo date('dS F Y', strtotime($time_free_not_enter_payment)); ?></div>
                            </div>
                            <div class="col-lg-12" style="margin-bottom: 13px; text-align: center">
                                <div class="text-center line5"><?php echo isset($line5) ? $line5 : '';?></div>
                            </div>
                            <div class="col-lg-12" style="margin-bottom: 13px;text-align:center ">
                                <div class="line6" style="text-align: center; display: inline-block;"><strong><?php echo isset($line6) ? $line6 : '';?></div> <div class="date_4" style="display: inline-block;"><?php echo date('dS F Y', strtotime($time_free_enter_payment)); ?></div> </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center" style="margin-top: 7px; margin-bottom: 7px;">
                        <div class="form-group">
                            <label style="padding: 0;color:black;font-size: 12px;">
                                <!-- <input type="checkbox" name="payment" value="1" style="outline: 0px none; margin-right: 5px;"> -->
                                Click here to enter your payment details today to receive your extended free period.
                            </label>
                        </div>
                        <a style="width:200px" class="btn btn-custom btn-enter-payment" type="button" href="javascript:;">Enter Payment Details</a>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <?php if (!$mobile) : ?>
                <div style="margin-top:30px" class="col-xs-12 text-center">
                    <a class="btn btn-custom-back btn-back" type="button" href="javascript:;">Previous</a>
                    <a class="btn btn-custom btn-proceed" type="button" href="javascript:;">Skip</a>
                </div>
                <?php else : ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div style="text-align: center; margin: 10px 0px 15px;">
                        <a class="btn btn-custom btn-proceed" type="button" href="javascript:;">Skip</a>
                    </div>
                </div>
                <?php endif; ?>

            </div>
            <div class="clearfix"></div>
            <!--frame 2-->
            <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 no-padding frame-2" <?php echo isset($login)? '' : 'style="display: none;"' ?>>
                <div class="white-wrapper">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <strong><i><span style="font-size: 15px;">Subscription: $385</span> <span style="font-size: 11px;">Incl. GST, per month.</span></i></strong>
                    </div>
                    <div class="clearfix" style="margin-bottom: 10px;"></div>
                    <div class="box-benefit-content">
                        <div>
                            <div class="benefit-item">
                                <label>
                                    <i class="fa fa-check"></i>
                                </label>
                                <div class="benefit-content">
                                    <span>Upload unlimited number of your cars by direct connection from  your DMS.</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <label>
                                    <i class="fa fa-check"></i>
                                </label>
                                <div class="benefit-content">
                                    <span>Buy and Sell cars fast.</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <label>
                                    <i class="fa fa-check"></i>
                                </label>
                                <div class="benefit-content">
                                    <span>Connect with dealers.</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <label>
                                    <i class="fa fa-check"></i>
                                </label>
                                <div class="benefit-content">
                                    <span>Grow your network.</span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix" style="margin-bottom: 10px;"></div>
                    <div class="col-lg-12 col-xs-12 text-left">
                        <img src="<?php echo $this->webroot; ?>images/img_master_visa_card.jpg" style="width: 120px;" />
                    </div>
                    <div class="clearfix" style="margin-bottom: 15px;"></div>
                    <form id="CarInfoForm" method="post" class="form-horizontal">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="clearfix"></div>
                                <div class="form-group card-info-item">
                                    <label class="card-info-label">Name</label>
                                    <input type="text" name="card_name" placeholder="(Name on card)" autocomplete="off" class="form-control">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group card-info-item">
                                    <label class="card-info-label">Number</label>
                                    <input type="text" name="card_number" placeholder="(Number on card)" autocomplete="off" class="form-control">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-9 col-xs-9 no-padding">
                                    <div class="clearfix"></div>
                                    <div class="form-group card-info-item">
                                        <label class="card-info-label">Expiry</label>
                                        <input class="form-control input-car-info" type="text" name="expiry_month" maxlength="2" size="3" value="" placeholder="(month)"/> /
                                        <input class="form-control input-car-info" type="text" name="expiry_year" maxlength="2" size="3" value="" placeholder="(year)"/>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-3 no-padding">
                                    <div class="clearfix"></div>
                                    <div class="form-group card-info-label cvv-info">
                                        <label class="card-info-label">CCV</label>
                                        <input type="text" maxlength="4" name="verification_number" autocomplete="off" class="form-control" placeholder="(ccv)">
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-12 col-md-12">
                            <div class="box-shadow-content" style="margin: 0;">
                                <span>I hereby authorise CarZapp to charge this credit card automatically every month with the subscription amount indicated on this page.</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12" <?php echo ($mobile)? 'style="margin-bottom: 20px;"' : '' ?> >
                            <a style="text-decoration: none; color: #555" href="javascript:;">
                                <span style="font-size: 12px; margin-right: 3px;">Having trouble using your credit card, please  contact us by email on admin@carzapp.com.au.</span>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php if (!isset($login)) : ?>
                    <div style="margin-top:30px" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="btn btn-custom-back btn-back" type="button" href="javascript:;">Previous</a>
                        <button class="btn btn-custom btn-proceed" type="submit" href="javascript:;">Next</button>
                    </div>
                    <?php else : ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div style="text-align: center; margin: 16px 0px;">
                            <button class="btn btn-custom btn-proceed" type="submit" href="javascript:;">Next</button>
                        </div>
                    </div>
                    <?php endif; ?>

                    
                </form>
            </div>
            <!--frame 3-->
            <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 no-padding frame-3" style="display: none;">
                <div class="white-wrapper">
                    <h5>Payment Details</h5>
                    <div class="col-lg-12" style="margin-bottom: 10px;">
                        <p>Confirm amount and payment method.</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-blue-content">
                        <div><span>Amount : $ 385.00</span> <span style="font-size: 11px;">(Inc. GST)</span></div>
                        <div><span>Period : Monthly</span></div>
                    </div>
                    <div class="col-lg-12" style="margin-bottom: 10px; margin-top: 40px;">
                        <p>Note: Monthly billing will commence on<br/><?php echo isset($time_free_enter_payment) ? date('dS F Y', strtotime($time_free_enter_payment)) : ''?></p><br/>
                    </div>
                    <div class="col-lg-12" style="margin-bottom: 10px;">
                        <p>Receipt will be sent to :<br/><?php echo isset($email)? $email : '' ?></p><br/>
                    </div>
                    <div class="col-lg-12" style="margin-bottom: 10px;">
                        <i>You may cancel your subscription at anytime via your App Settings.</i>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div style="margin-top:30px" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div style="text-align: center; margin: 16px 0px;">
                        <a class="btn btn-custom-back btn-back" type="button" href="javascript:;">Previous</a>
                        <button class="btn btn-custom btn-confirm" type="submit" href="javascript:;">CONFIRM</button>
                    </div>
                </div>
            </div>
            <!--frame 4-->
            <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 no-padding frame-4" style="display: none;">
                <div class="white-wrapper">
                    <h5>Confirmation: Exciting times ahead !</h5>
                    <div class="col-lg-12" style="margin-bottom: 10px;">
                        <p>Thank you for your payment.</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-blue-content">
                        <div><span>Amount  to be charged: $ 385.00</span> <span style="font-size: 11px;">(Inc. GST)</span></div>
                        <div><span>Period : Monthly</span></div>
                    </div>
                    <div class="col-lg-12" style="margin-bottom: 10px; margin-top: 40px;">
                        <p>Note: Monthly billing will commence on<br/><?php echo isset($time_free_enter_payment) ? date('dS F Y', strtotime($time_free_enter_payment)) : ''?></p><br/>
                    </div>
                    <div class="col-lg-12" style="margin-bottom: 10px;">
                        <i>You may cancel your subscription at anytime via your App Settings.</i>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div style="text-align: center; margin: 16px 0px;">
                        <a class="btn btn-custom btn-done" type="button" href="javascript:;">DONE</a>
                    </div>
                </div>
            </div>

            <div>
                <input type="hidden" id="Token" value="<?php echo isset($token)? $token : '' ?>" />
                <input type="hidden" id="Email" value="<?php echo isset($email)? $email : '' ?>" />
                <input type="hidden" id="UserId" value="<?php echo isset($userId)? $userId : '' ?>" />
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function fixSizeStepImage() {
        $('#sign_up .step').css('width', $('#sign_up').width());
    }
    fixSizeStepImage();

    $(document).ready(function() {
        fixSizeStepImage();
        $(window).resize(function(){
            fixSizeStepImage();
        });

        // handle frame 1
        $('.frame-1 .btn-back').click(function () {
            window.location.href = root + 'home_current';
        });
        $('.frame-1 .btn-enter-payment').click(function () {
            $('.frame-1').fadeOut('slow', function () {
                $('.frame-2').fadeIn('slow');
            });
            $('.frame-3').hide();
            $('.frame-4').hide();
        });
        $('.frame-1 .btn-proceed').click(function () {
            // if ($('input[name="payment"]').is(':checked')) {
            //     $('.frame-1').fadeOut('slow', function () {
            //         $('.frame-2').fadeIn('slow');
            //     });
            //     $('.frame-3').hide();
            //     $('.frame-4').hide();
            // }
            // else {
                window.location.href = root + 'finish_step_3?type=0';
            //}
        });

        // handle frame 2
        $('.frame-2 .btn-back').click(function () {
            $('.frame-2').fadeOut('slow', function () {
                $('.frame-1').fadeIn('slow');
            });
            $('.frame-3').hide();
            $('.frame-4').hide();
            resetForm();
        });

        $('#CarInfoForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                card_name: {
                    message: 'The name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Please enter Name on Card'
                        }
                    }
                },
                card_number: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Number of Card'
                        },
                        numeric: {
                            message: 'Please enter number'
                        }
                    }
                },
                verification_number: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter CCV'
                        },
                        cvv: {
                            message: 'The CCV number is not valid'
                        }
                    }
                },
                expiry_month: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Expiry Month'
                        },
                        numeric: {
                            message: 'Please enter number'
                        },
                        greaterThan: {
                            value: 1,
                            message: 'Expiry Month must be greater than or equal to 1'
                        },
                        lessThan: {
                            value: 12,
                            message: 'Expiry Month must be less than or equal to 12'
                        }
                    }
                },
                expiry_year: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Expiry Year'
                        },
                        numeric: {
                            message: 'Please enter number'
                        },
                        greaterThan: {
                            value: 16,
                            message: 'Expiry Year must be greater than or equal to 16'
                        },
                        lessThan: {
                            value: 36,
                            message: 'Expiry Year must be less than or equal to 36'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            $('.frame-2').fadeOut('slow', function () {
                $('.frame-3').fadeIn('slow');
            });
            $('.frame-1').hide();
            $('.frame-4').hide();

            return false;
        });

        // handle frame 3
        $('.frame-3 .btn-back').click(function () {
            $('.frame-3').fadeOut('slow', function () {
                $('.frame-2').fadeIn('slow');
            });
            $('.frame-1').hide();
            $('.frame-4').hide();
            resetForm();
        });

        $('.frame-3 .btn-confirm').click(function () {
            var quantity = 0;
            var payment_method = "credit_card";
            var card_name = $('input[name="card_name"]').val();
            var card_number = $('input[name="card_number"]').val();
            var card_verification_number = $('input[name="verification_number"]').val();
            var card_expiry_month = $('input[name="expiry_month"]').val();
            var card_expiry_year = $('input[name="expiry_year"]').val();
            var total_price = 385;

            var token = $('#Token').val();
            var email = $('#Email').val();
            var userId = $('#UserId').val();

            card_expiry_month = parseInt(card_expiry_month);
            if (card_expiry_month > 0 && card_expiry_month < 13) {
                card_expiry_month = (card_expiry_month < 10)? '0'+card_expiry_month : card_expiry_month;
            }

            load_show();
            $.post(root + 'facebooks/postRegisterPayment', {
                payment_type:'<?php echo (isset($login) && $login)? 1 : 0 ?>',
                quantity:quantity,
                payment_method:payment_method,
                card_name:card_name,
                card_number:card_number,
                card_verification_number:card_verification_number,
                card_expiry_month:card_expiry_month,
                card_expiry_year:card_expiry_year,
                total_price:total_price,
                token:token,
                email:email,
                userId:userId
            },
            function(data){
                load_hide();
                if(data.error == 0){
                    $('.frame-3').fadeOut('slow', function () {
                        $('.frame-4').fadeIn('slow');
                    });
                    $('.frame-1').hide();
                    $('.frame-2').hide();
                }else{
                    showMessage(data.msg, 1);
                }
            },'json');
        });

        // handle frame 3
        $('.frame-4 .btn-done').click(function () {
            load_show();
            window.location.href = root + 'finish_step_3?type=1';
        });

        //===============
        function resetForm() {
            $("#CarInfoForm").formValidation('updateStatus', 'card_name', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'card_number', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'verification_number', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'expiry_month', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'expiry_year', 'NOT_VALIDATED');

            $('.frame-2 .btn-proceed').removeClass('disabled');
            $('.frame-2 .btn-proceed').prop('disabled', false);
        }
    });
</script>