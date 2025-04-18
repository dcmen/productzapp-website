<?php 
$uri1 = $this->params['pass']?>
<style>
    .gridlist {
        max-height: 200px;
        overflow-y: auto;
    }
    .btn-search-company {
        position: absolute;
        top: 10px;
        right: 25px;
        cursor: pointer;
    }
    .list-company-table {
        width: 100%;
    }
    .signup-input label {
        margin-top: 5px;
    }
</style>
<div class="wrapper_regis">
    <div class="col-xs-12 pull-left col-xs-offset-2 col-lg-10 col-lg-offset-1">
        <div style="margin: 20px 0">
            <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
        </div>
    </div>
    <div id="sign_up">
        <?php if($step == 1 || $step == ''){?>
        <form id="Regis" action="facebooks/register" method="post" class="form-horizontal">
            <div class="col-xs-12 step">
                <?php echo $this->Html->image('/images/step1.png')?>
            </div>
            <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1">
                <h5>Step 1</h5>

                <div class="col-lg-6 col-xs-12"> 
                    <div class="col-lg-12">
                        <div class="form-group">
                           <label>First Name</label><span class="sao">*</span>
                           <input type="text" autocomplete="off" name="name" class="form-control" required value="<?php echo $this->Session->read('first_name_rg')?>">
                        </div>
                    </div>   
                    <div class="col-lg-12">
                        <div class="form-group">
                           <label>Last Name</label>
                           <input type="text" autocomplete="off" name="last_name" class="form-control" value="<?php echo $this->Session->read('last_name_rg')?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                           <label>Email Address</label><span class="sao">*</span>
                           <input type="email" autocomplete="off" name="email" class="form-control" required value="<?php echo $this->Session->read('email_rg')?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                           <div class="checkbox" style="padding-left: 0px; margin: 0px;;" >
                               <label>
                                   <input type="checkbox" name="agree" <?php echo ($this->Session->read('agree_rg'))?'checked = checked':''?> value="1" required>
                                   Yes, I agree to Carzapp <a href="Terms" target="_blank">Terms of Use</a>
                               </label>
                           </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-6 col-xs-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Phone</label><span class="sao">*</span>
                            <input type="text" name="phone" autocomplete="off" class="form-control" value="<?php echo $this->Session->read('phone_rg')?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Password</label><span class="sao">*</span>
                            <input type="password" name="password" autocomplete="off" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Confirm Password</label><span class="sao">*</span>
                            <input type="password" name="re_password" autocomplete="off" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 text-center" style="margin: 20px 0">
                    <button type="submit" class="btn bt_login ">PROCEED</button>
                </div>
                <div class="col-xs-12">
                    <div class="col-lg-6 col-xs-12" style="margin: 0 0 20px">
                        <a href="javascript:;" data-toggle="modal" data-target="#my_login">
                        Already have an account?
                        </a>
                    </div>
                    <div class="col-lg-6 col-xs-12 text-right">
                        Sign up with 
                        <a class="no-decoration" href="<?php echo $this->Html->Url("/loginfb")?>">
                            <img src="images/face.png">
                        </a>
                        or 
                        <a class="no-decoration" href="<?php echo $this->Html->Url('/logintw')?>">
                            <img src="images/twitter.png">
                        </a>
                    </div>
                </div>
            </div>
        </form>    
        <?php }else if($step == 2){?>
        <!--step 2-->
        <form id="Regis_2" action="facebooks/register_2" method="post" class="form-horizontal">
            <div class="col-xs-12 step">
                <?php echo $this->Html->image('/images/step2.png')?>
            </div>

            <div class="form-group">
                <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 signup-input">
                    <h5>Step 2</h5>
                    <div class="col-xs-12">
                        <fieldset class="signup-box">
                            <div class="form-group">
                                <div class="col-lg-4"><label>Company Name</label><span class="sao">*</span></div>
                                <div class="col-lg-8">
                                    <input type="text" name="company_name" id="keychecker" autocomplete="off" class="form-control" placeholder="Input Company Name" value="<?php echo $this->Session->read('company_name_rg')?>">
                                    <i class="fa fa-search btn-search-company"></i>
                                    <img class="img-loading" src="<?php echo $this->webroot; ?>images/fancybox/fancybox_loading.gif"/>
                                    <div class="gridlist" id="gridlist" style="display: none"></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>   

                    <div class="col-xs-12">
                        <fieldset class="new_company scheduler-border">
                            <legend class="scheduler-border">New Company Setup</legend>
                            <div class="form-group">
                                <div class="col-lg-4"><label>Dealer License Number</label><span class="sao"></span></div>
                                <div class="col-lg-8">
                                    <input readonly="true" type="text" name="dealer_number_new" placeholder="Input License Number" autocomplete="off" class="form-control" value="<?php echo $this->Session->read('dealer_number_rg')?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox col-md-10 col-md-offset-4">
                                    <label>
                                        <input disabled="true" type="checkbox" <?php echo ($this->Session->read('is_principle_rg'))?'checked = checked':''?> name="is_principle" value="1">
                                        Principal of Dealership
                                    </label>
                                </div>
                             </div>
                        </fieldset>
                    </div>     
                    <div class="col-xs-12">
                        <fieldset class="old_company scheduler-border" style="display: none;">
                            <legend class="scheduler-border">Add User</legend>
                            <div class="form-group">
                                <div class="col-lg-4"><label>CarZapp Number</label><span class="sao"></span></div>
                                <div class="col-lg-8">
                                    <input readonly="true" type="text" name="carzapp_code" placeholder="Input Carzapp Number" autocomplete="off" class="form-control" value="<?php echo $this->Session->read('dealer_number_rg')?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4"><label>Dealer License Number</label></div>
                                <div class="col-lg-8">
                                    <input readonly="true" type="text" name="dealer_number" placeholder="Input License Number" autocomplete="off" class="form-control" value="<?php echo $this->Session->read('dealer_number_rg')?>">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                    <!--Company address-->
                    <div class="col-xs-12">
                        <fieldset class="company_address scheduler-border">
                            <legend class="scheduler-border">Company address</legend>
                            <div class="form-group">
                                <div class="col-lg-4"><label>Address</label><span class="sao"></span></div>
                                <div class="col-lg-8">
                                    <input readonly type="text" name="address" autocomplete="off" class="form-control company-address-field" placeholder="Address line 1">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4"><label></label><span class="sao"></span></div>
                                <div class="col-lg-8">
                                    <input readonly type="text" name="address2" autocomplete="off" class="form-control company-address-field" placeholder="Address line 2">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4"><label></label><span class="sao"></span></div>
                                <div class="col-lg-8">
                                    <input readonly type="text" name="address3" autocomplete="off" class="form-control company-address-field" placeholder="Address line 3">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-lg-4"><label>Suburb</label></div>
                                <div class="col-lg-8">
                                    <input readonly type="text" name="suburb" autocomplete="off" class="form-control company-address-field" placeholder="Suburb">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-lg-4"><label>Post Code</label></div>
                                <div class="col-lg-8">
                                    <input readonly type="text" name="post_code" autocomplete="off" class="form-control company-address-field" placeholder="Post Code">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-lg-4"><label>State</label></div>
                                <div class="col-lg-8">
                                    <input readonly type="text" name="state" autocomplete="off" class="form-control company-address-field" placeholder="State">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-lg-4"><label>Country</label></div>
                                <div class="col-lg-8">
                                    <input readonly type="text" name="country" autocomplete="off" class="form-control company-address-field" placeholder="Country">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="text-align: center; margin: 0px 0px 30px;">
                <a href="<?php echo $this->Html->Url('/facebooks/register_back')?>" class="btn bt_login bt_back">BACK</a>
                <button type="submit" class="btn bt_login">SIGN UP</button>
            </div>
        </form>
        <?php }else if($step == 3){?>
        <div class="col-xs-12 step">
            <?php echo $this->Html->image('/images/step3.png')?>
        </div>
        <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1">
            <h5>Registration complete</h5>
            <p>Thank you for registering with CarZapp.</p>
            <p>Your CarZapp code is: <span id="car_code"><?php echo $this->Session->read('carzapp_code_rg')?></span></p>
            <p>A welcome  email will be sent to  you shortly with additional instructions . </p>
            <p>Following that your Dealer License  will be  validated  and your account will be  Activated on the App.</p>
            <p>For enquiries: <a href="admin@carzapp.com.au">admin@carzapp.com.au</a></p>
            <p>Please continue to  select your preferred subscription options.</p>
            <p>The CarZapp Team</p>
            <div style="text-align: center; margin: 0px 0px 30px;">
                <a class="btn bt_login" type="button" href="<?php echo $this->Html->Url('/home_current')?>">DONE</a>
            </div>
        </div>
        <?php }else if($step == 4){?>
        
        <?php }?>
           
    </div>
</div>
<?php echo $this->element('login')?>
<script type="text/javascript">
    var listCompany;
    var test = null;
    
    Vcore.Home.SubmitSignIn();
    $(document).ready(function() {
        var content = $(document);
        $('#Regis').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                name: {
                    message: 'The name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The first name is required and can\'t be empty'
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
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter password'
                        },
                        identical: {
                            field: 'confirmPassword',
                            message: 'The password and its confirm are not the same'
                        },
                        regexp: {
                            regexp: /^\S*$/,
                            message: 'Password cannot contain space character(s)'
                        }
                    }
                },
                re_password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter confirm password'
                        },
                        identical: {
                            field: 'password',
                            message: 'Confirm password does not match'
                        }
                    }
                },
                phone: {
                    message: 'The phone is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The phone is required and can\'t be empty'
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
            var $form = $(e.target);
            $.post($('#Regis').attr('action'), $form.serialize(),function(data){
                load_hide();
                if(data.error == 0){
                    window.location.href = root + 'sign_up?step=2';
                }else{
                    showMessage(data.msg, 1);
                }
            },'json');
        });

        $('#Regis_2').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                company_name: {
                    message: 'The company_name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The company name is required and can\'t be empty'
                        }
                    }
                },
                carzapp_code: {
                    message: 'The carzapp code is not valid',
                    validators: {
                        //notEmpty: {
                        //    message: 'The carzapp code is required and can\'t be empty'
                        //}
                    }
                },
                dealer_number: {
                    message: 'The dealer number is not valid',
                    validators: {
                        //notEmpty: {
                        //    message: 'The dealer number is required and can\'t be empty'
                        //},
                        regexp: {
                            regexp: /^[0-9+]+$/,
                            message: "Please enter number"
                        }
                    }
                },
                dealer_number_new: {
                    message: 'The dealer number is not valid',
                    validators: {
                        //notEmpty: {
                        //    message: 'The dealer number is required and can\'t be empty'
                        //},
                        regexp: {
                            regexp: /^[0-9+]+$/,
                            message: "Please enter number"
                        }
                    }
                },
            }
        }).on('success.form.bv', function (e) {
            load_show();
            e.preventDefault();
            var $form = $(e.target);
            $.post('facebooks/register_2', $form.serialize(),function(data){
                load_hide();
                if(data.error == 0){
                    $("input[name='company_name']").val('');
                    $("input[name='dealer_number']").val('');
                    $("input[name='data_source']").val('');
                    window.location.href = root + 'sign_up?step=3';
                }else{
                    showMessage(data.msg, 1);
                }
            },'json');
        });
        
        $('.btn-search-company').click(function () {
            btnSearch = $(this);
            keyword = $("#keychecker").val();
            if (keyword.length > 0) {
                $('.img-loading').show();
                btnSearch.hide();
                $.get( root+"checkcompany",{'keyword':keyword}, function(data) {
                    $('.img-loading').hide();
                    btnSearch.show();
                    
                    if(data.ds != ''){
                        $("#gridlist").css('display','block');
                        $("input[name='carzapp_code']").prop( "readonly", false );
                        $("input[name='dealer_number']").prop( "readonly", false );
                        $("#gridlist").html(data.ds);
                        listCompany = data.list_company;
                        foreach(data.ds as )
                    }else{
                        $("#gridlist").css('display','block');
                        $("#gridlist").html('No data');
                        listCompany = null;
                        $("input[name='dealer_number_new']").prop( "readonly", false );
                        $("input[name='is_principle']").prop( "disabled", false );
                    }
                },'json');
            }
        });
        
        $('#keychecker').keyup(function (e) {
            $('.new_company').show();
            $('.old_company').hide();
            $('#gridlist').hide();
            $('#gridlist').html('');
            listCompany = null;
            
            if ($(this).val() != '') {
                $("input[name='dealer_number_new']").prop( "readonly", false );
                $('.company-address-field').prop( "readonly", false );
                $("input[name='is_principle']").prop( "disabled", false );
            }
        });

        $('#keychecker').dblclick(function(){
            if ($("#gridlist").children().length > 0 || $("#gridlist").text() != '') {
                $("#gridlist").show();
            }
        });

        $('#keychecker').keypress(function (e) {
            if (e.which == 13) {
                $('.btn-search-company').click();
                return false;
            }
        });
                
        $('body').click(function(){
            $("#gridlist").hide();
        });
        
        $(document).on('click', '.grouplist tr', function () {
            // get data
            companyID = $(this).attr('data-id');
            companyName = $(this).text();
            
            var selectedCompany;
            for (i = 0; i < listCompany.length; ++i) {
                if (listCompany[i]._id == companyID) {
                    selectedCompany = listCompany[i];
                    break;
                }
            }
            
            if (selectedCompany) {
                // set data for Company Address
                test = selectedCompany;
                $('input[name="address"]').val((selectedCompany.address)? selectedCompany.address : '');
                $('input[name="address2"]').val((selectedCompany.address2)? selectedCompany.address2 : '');
                $('input[name="address3"]').val((selectedCompany.address3)? selectedCompany.address3 : '');
                $('input[name="suburb"]').val((selectedCompany.suburb)? selectedCompany.suburb : '');
                $('input[name="post_code"]').val((selectedCompany.post_code)? selectedCompany.post_code : '');
                $('input[name="state"]').val((selectedCompany.state)? selectedCompany.state : '');
                $('input[name="country"]').val((selectedCompany.country)? selectedCompany.country : '');
                
                $('.old_company').show();
                $('.new_company').hide();

                $("input[name='carzapp_code']").prop( "readonly", false );
                $("input[name='dealer_number']").prop( "readonly", false );

                $('.company-address-field').prop( "readonly", true);
                
                $('#keychecker').val((selectedCompany.name)? selectedCompany.name : '');
            }
            else {
                console.log('ERROR');
            }
        });
    });
</script>