<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow" style="padding: 15px 40px 74px;">
                <div id="Purchase" class="col-xs-12 col-lg-10 col-lg-offset-1 text-center">
                    <div class="text-center">
                        <?php if ($remainTime->trial) : ?>
                            You are using free trial app. Remaining Time:
                        <?php else : ?>
                            You have already purchased this app. Remaining Time:
                        <?php endif; ?>

                        <?php if ($remainTime->expire_date->d < 0) : ?>
                            0 day. Please upgrade to use our app without limitation.
                        <?php else : ?>
                            <?php 
                                echo ($remainTime->expire_date->d) ? $remainTime->expire_date->d . ' day(s) ' : ''; 
                                echo ($remainTime->expire_date->h) ? $remainTime->expire_date->h . ' hour(s) ' : ''; 
                                echo ($remainTime->expire_date->m) ? $remainTime->expire_date->m . ' minute(s) ' : ''; 
                            ?>
                        <?php endif; ?>
                    </div>

                    <div class="col-xs-12 col-lg-8 col-lg-offset-2 text-center">
                        <div class="row_op">
                            <a href="javascript:;" onclick="showFormPurchase('1.00');"> 
                                Paid 1-month subscription
                            </a>
                        </div>
                        <div class="row_op">
                            <a href="javascript:;" onclick="showFormPurchase('10.00');"> 
                                Paid 1-year subscription
                            </a>
                        </div>
                    </div>    

                    <!-- <div class="col-xs-12 col-lg-8 col-lg-offset-2 text-center">
                        <div class="row_op">
                            <a href="<?php // echo $this->Html->Url("/payment/57199318a677439ab683b674")?>" > 
                                Paid 1-month subscription
                            </a>
                        </div>
                        <div class="row_op">
                            <a href="<?php // echo $this->Html->Url("/payment/57199319a677439ab683b675")?>" > 
                                Paid 1-year subscription
                            </a>
                        </div>
                    </div>    -->
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div id="PurchaseModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="ShareForm" action="<?php echo $this->Html->Url('/ajaxpurchase')?>" method="post" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-4">Price (dollars)</div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" class="form-control" name="orderAmount" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-4">Card Number</div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" class="form-control" name="cardNumber" maxlength="20" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-4">Card Verification Number</div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" class="form-control" name="cardVerificationNumber" maxlength="4" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-4">Card Expiry (mm/yy)</div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" name="cardExpiryMonth" maxlength="2" size="3" value=""/> /
                                <input type="text" name="cardExpiryYear" maxlength="2" size="3" value="" />
                            </div>
                        </div>
                        
                        <div class="form-group" style="text-align: right; margin-top: 10px;">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-view">Purchase</button>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
   </div>
</div>

<script type="text/javascript">
    function showFormPurchase(price) {   
        $('input[name="orderAmount"]').val(price);
        $('#PurchaseModal').modal('show');
    }
    
    $(document).ready(function(){
        $('button.close').click(function () {
            $('#ShareForm').trigger('reset');
            $("#ShareForm").formValidation('updateStatus', 'cardNumber', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'cardVerificationNumber', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'cardExpiryMonth', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'cardExpiryYear', 'NOT_VALIDATED');
        });
        
        $('#ShareForm').formValidation({
            message: 'This value is not valid',
            fields: {
                cardNumber: {
                    validators: {
                        notEmpty: {
                            message: 'The Card Number is required and can\'t be empty'
                        },
                        numeric: {
                            message: 'Please enter number'
                        }
                    }
                },
                cardVerificationNumber: {
                    validators: {
                        notEmpty: {
                            message: 'The Card Verification Number is required and can\'t be empty'
                        },
                        numeric: {
                            message: 'Please enter number'
                        }
                    }
                },
                cardExpiryMonth: {
                    validators: {
                        notEmpty: {
                            message: 'The Card Expiry Month is required and can\'t be empty'
                        },
                        numeric: {
                            message: 'Please enter number'
                        }
                    }
                },
                cardExpiryYear: {
                    validators: {
                        notEmpty: {
                            message: 'The Card Expiry Year is required and can\'t be empty'
                        },
                        numeric: {
                            message: 'Please enter number'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();

            var $form = $(e.target);

            load_show('Please wait');
            $.post($('#ShareForm').attr('action'), $form.serialize(), function (data) {
                load_hide();
                if(data.error == 0){
                    showMessage(data.msg, 0, function () {
                        window.location.href = root + 'in_app_purchase';
                    });
                }else{
                    showMessage(data.msg, 1);
                }
            },'json');
        });

        $(".view_code").click(function(){
            load_show();
            
            $.post(root + 'RedeemCodes/view_code',function(data){
                if(data.code != ''){
                    $(".buy_app").css('display','none');
                    $(".view_code").parent(".row_op").css('display','none');
                    $(".base_code").html(data.code);
                    $(".enter_code").css('display','block');
                }
                
                load_hide();
            },'json');
            
        });
        
        $('#Entercode').formValidation({
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
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            $.post($('#Entercode').attr('action'), $form.serialize(), function (data) {
                if(data.error == 0){
                    jAlert('You have to register to use CarZapp 30 days success!');
                    window.location.href = root + 'in_app_purchase';
                }else{
                    jAlert(data.msg);
                }
            },'json');
        });
    });
</script>