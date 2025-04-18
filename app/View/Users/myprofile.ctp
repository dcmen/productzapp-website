<?php
    echo $this->Html->css('dependencies/css/prettify.css');
    echo $this->Html->script(array('/src/jquery.picture.cut.js','/dependencies/jquery/prettify.js'));
    if($rs->avatar){
        $img = $rs->avatar;
    }else{
        $img = 'images/no-avatar.png';
    }
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#container_image").PictureCut({
            Extensions: ["jpg", "png", "gif"],
            InputOfImageDirectory: "image",
            PluginFolderOnServer: root,
            FolderOnServer: root + "app/webroot/img/uploads/users_avatar/",
            MinimumWidthToResize: 1024,
            MinimumHeightToResize: 630,
            EnableCrop: true,
            dataType : "json",
            CropWindowStyle: "Bootstrap",
            imgAvata: "<?php echo $img?>",
            CropModes : { square: true}
        }); 
    });
</script>

<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow pd-content-06">
                <form id="UserMyprofileForm" action="<?php echo $this->Html->Url('/myprofile')?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="url" value="<?php echo $this->Html->Url('/')?>">
                    <input type="hidden" name="id" value="<?php echo $rs->id?>">
                    
                    <div class="mg-bottom-25"></div>
                    
                    <!--avatar-->
                    <div class="col-xs-8 col-xs-offset-2 col-lg-3 col-lg-offset-5 text-center pos-rel">
                        <div id="container_image"></div>
                        <?php if (isset($disableEdit)) : ?>
                        <div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; background-color: transparent; z-index: 9999;" ></div>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix mg-bottom-20"></div>
                    
                    <!--Personal Information-->
                    <div class="col-lg-12">
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">Personal Information</h2>
                        </header>
                    </div>
                    <!--First name-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">First Name</label>
                            <div class="pos-rel">
                                <input <?php echo (isset($disableEdit) && $disableEdit)? 'readonly' : '' ?> type="text" name="name" class="form-control kb-input-item" value="<?php echo $rs->name?>">
                            </div>
                        </div>
                    </div>
                    <!--Last name-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Last Name</label>
                            <div class="pos-rel">
                                <input <?php echo (isset($disableEdit) && $disableEdit)? 'readonly' : '' ?> type="text" name="last_name" class="form-control kb-input-item" value="<?php echo $rs->last_name?>">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--Phone-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Phone</label>
                            <div class="pos-rel">
                                <input <?php echo (isset($disableEdit) && $disableEdit)? 'readonly' : '' ?> type="text" name="phone" class="form-control kb-input-item" value="<?php echo $rs->phone?>">
                            </div>
                        </div>
                    </div>
                    <!--Email Address-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Email Address</label>
                            <div class="pos-rel">
                                <input readonly type="email" name="email" class="form-control kb-input-item" value="<?php echo $rs->email?>">
                                <?php if (!isset($disableEdit)) : ?>
                                <a href="javascript:;" onclick="showChangeEmail()" class="editemail"><i class="fa fa-pencil-square-o"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!--Change password-->
                    <div class="col-lg-6 form-item-container dis-none-min-641">
                        <div class="form-group">
                            <label class="txt-lb-name"style="width:22%;float:left;">Change password</label>
                            <?php if (!isset($disableEdit)) : ?>
                                <a href="javascript:;" data-toggle="modal" data-target="#changepassword"><i class="fa fa-key"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--Dealer Information-->
                    <div class="col-lg-12">
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">Dealer Information</h2>
                        </header>
                    </div>
                    <?php if($rs->is_principle == 0) : ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
                        <!--CarZapp Number-->
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">CarZapp Number</label>
                                <div class="pos-rel">
                                    <input readonly type="text" name="easy_car_number" class="form-control kb-input-item" value="<?php echo ($rs->easy_car_number)? $rs->easy_car_number : '' ?>">
                                </div>
                            </div>
                        </div>
                        <!--Dealer License Number-->
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Dealer License Number</label>
                                <div class="pos-rel">
                                    <input readonly type="text" name="dealer_number" class="form-control kb-input-item" value="<?php echo ($rs->dealer_number)? $rs->dealer_number : '' ?>">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Data source</label>
                                <?php for($i=0;$i<sizeof($data_source);$i++) : ?>
                                <div class="checkbox" style="margin-left: 0">
                                    <label class="txt-lb-name">
                                        <input disabled type="checkbox" name="data_source[]" class="data_source" <?php echo (isset($my_data_source) && in_array($data_source[$i]->id, $my_data_source))?'checked':''?> data_id="<?php echo $data_source[$i]->id?>"  value="<?php echo $data_source[$i]->id?>">
                                        <?php echo $data_source[$i]->name?>
                                    </label>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php else : ?>
                    <input type="hidden" name="is_principle" value="0>">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
                        <!--Principle CarZapp Code-->
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Principal CarZapp Code</label>
                                <div class="pos-rel">
                                    <input readonly type="text" name="carzapp_code" class="form-control kb-input-item" value="<?php echo ($rs->carzapp_code)? $rs->carzapp_code : ''?>">
                                </div>
                            </div>
                        </div>
                        <!--Dealer License Number-->
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Dealer License Number</label>
                                <div class="pos-rel">
                                    <input readonly type="text" disabled class="form-control kb-input-item" value="<?php echo ($rs->dealer_number)? $rs->dealer_number: ''?>">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Data source</label>
                                <?php for($i=0;$i<sizeof($data_source);$i++) : ?>
                                <div class="checkbox" style="margin-left: 0">
                                    <label class="txt-lb-name">
                                        <input type="checkbox" name="data_source[]" disabled="" class="data_source" data_id="<?php echo $data_source[$i]->id?>" value="<?php echo $data_source[$i]->id?>">
                                        <?php echo $data_source[$i]->name?>
                                    </label>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php endif; ?>
                    <!--Company Information-->
                    <div class="col-lg-12">
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">Dealership Information</h2>
                        </header>
                    </div>
                    
                    <!--Company Name-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Dealership Name</label>
                            <div class="pos-rel">
                                <input <?php echo ($rs->is_principle && !isset($disableEdit)) ? '' : 'readonly' ?> type="text" name="company_name" class="form-control kb-input-item" value="<?php echo ($rs->company_info->name)? $rs->company_info->name : '' ?>">
                            </div>
                        </div>
                    </div>
                    <!--Company Email-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Dealership Email</label>
                            <div class="pos-rel">
                                <input <?php echo ($rs->is_principle && !isset($disableEdit)) ? '' : 'readonly' ?> type="text" name="company_email" class="form-control kb-input-item" value="<?php echo ($rs->company_info->email)? $rs->company_info->email : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--Address-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Address</label>
                            <div class="pos-rel">
                                <input <?php echo ($rs->is_principle && !isset($disableEdit)) ? '' : 'readonly' ?> type="text" name="company_address" class="form-control kb-input-item" value="<?php echo ($rs->company_info->address)? $rs->company_info->address : '' ?>">
                            </div>
                        </div>
                    </div>
                    <!--Telephone-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Telephone</label>
                            <div class="pos-rel">
                                <input <?php echo ($rs->is_principle && !isset($disableEdit)) ? '' : 'readonly' ?> type="text" name="tel" class="form-control kb-input-item" value="<?php echo ($rs->company_info->telephone)? $rs->company_info->telephone : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--fax-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Fax</label>
                            <div class="pos-rel">
                                <input <?php echo ($rs->is_principle && !isset($disableEdit)) ? '' : 'readonly' ?> type="text" name="fax" class="form-control kb-input-item" value="<?php echo ($rs->company_info->fax)? $rs->company_info->fax : '' ?>">
                            </div>
                        </div>
                    </div>
                    <!--abn-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">ABN</label>
                            <div class="pos-rel">
                                <input <?php echo ($rs->is_principle && !isset($disableEdit)) ? '' : 'readonly' ?> type="text" name="abn" class="form-control kb-input-item" value="<?php echo ($rs->company_info->abn)? $rs->company_info->abn : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--acn-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">ACN</label>
                            <div class="pos-rel">
                                <input <?php echo ($rs->is_principle && !isset($disableEdit)) ? '' : 'readonly' ?> type="text" name="acn" class="form-control kb-input-item" value="<?php echo ($rs->company_info->acn)? $rs->company_info->acn : '' ?>">
                            </div>
                        </div>
                    </div>
                    <!--dun-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">DUN</label>
                            <div class="pos-rel">
                                <input <?php echo ($rs->is_principle && !isset($disableEdit)) ? '' : 'readonly' ?> type="text" name="dun" class="form-control kb-input-item" value="<?php echo ($rs->company_info->dun)? $rs->company_info->dun : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <input type="hidden" name="lat" value="">
                    <input type="hidden" name="lng" value="">
                    
                    <div class="mg-bottom-40"></div>
                    
                    <?php if (!isset($disableEdit)) : ?>
                    <div class="col-lg-12 mg-top-10">
                        <button type="submit" class="bt_login kb-btn-02 color-bg-site pull-right"> UPDATE <span class="fa fa-angle-right"></span></button>
                    </div>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="editemail" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change email</h4>
                </div>
                <div class="modal-body">
                    <form id="EditEmail" method="post" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-lg-3"><label>Current email</label></div>
                            <div class="col-lg-9"><input type="text" class="form-control" name="current_email" readonly="" value=""></div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3"><label>New email</label></div>
                            <div class="col-lg-9"><input type="text" class="form-control" name="new_email" value=""></div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-view close_pop">Save</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
   </div>
</div>

<script type="text/javascript">
    Vcore.Home.UpdateAccount();
    
    function showChangeEmail() {
        $('input[name="current_email"]').val($('input[name="email"]').val());
        $('#editemail').modal('show');
    }
        
    $(document).ready(function () {
        $('#EditEmail').formValidation({
            framework: 'bootstrap',
            message: 'This value is not valid',
            fields: {
                new_email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            load_show();
            $.post(root + 'users/editemail', $form.serialize(), function (data) {
                load_hide();
                if(data.error == '0'){
                    $("#editemail").modal('hide');
                }
                showMessage(data.msg, parseInt(data.error));
                
                $('input[name="email"]').val($('input[name="new_email"]').val());
                $('#EditEmail').trigger('reset');
                $('#EditEmail').formValidation('updateStatus', 'new_email', 'NOT_VALIDATED');
                    
            },'json');
        });
        
        $("#UserMyprofileForm").formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: "Please enter your name"
                        }
                    }
                },
                tel: {
                    validators: {
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
                phone: {
                    validators: {
                        regexp: {
                            regexp: /^[0-9+]+$/,
                            message: "Please enter the number"
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Phone number must be between 6-20 characters in length'
                        },
                        notEmpty: {
                            message: "The phone is required and can't be empty"
                        }
                    }
                },
                company_name:{
                    validators: {
                        notEmpty: {
                            message: "Please enter dealership name"
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: "Please enter your email",
                        },
                        emailAddress: {
                            message: "Incorrect email!"
                        }
                    }
                },
                company_email:{
                    validators: {
                        emailAddress: {
                            message: "Incorrect email!"
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: "Please enter your address"
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            load_show();
        });
    });
</script>

