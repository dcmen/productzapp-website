<style>
    .datafeed-container {
        height: 182px;
        overflow-y: auto;
    }
    .datafeed-container > .checkbox {
        margin-top: 0;
    }
    @media (max-width: 640px) {
        .datafeed-container {
            height: 175px;
        }
    }
</style>
<div class="wrapper_regis">
    <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1">
        <div class="container-logo" style="margin: 30px 0">
            <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
        </div>
    </div>
    <div id="sign_up">
        <div class="step">
            <ul>
                <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
            </ul>
        </div>
        <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 no-padding frame-1">
            <div class="white-wrapper">
                <h5 style="color:black!important">Connecting to your DMS<br/><i style="font-size: 15px;">(Dealer Management System)</i></h5>
                <div class="col-lg-12">
                    <p style="color:black!important">In order to easily list your car inventory with CarZapp, simply select your DMS software provider from the link below.</p>
                </div>
                
                <form id="DataFeedForm" action="<?php echo $this->Html->Url('/facebooks/save_data_feed')?>" method="post">
                    <div class="col-lg-12">
                        <div class="form-group datafeed-container" style="margin-bottom: 0;">
                            <?php if (isset($info->datafeed_all)) : ?>
                            <?php foreach ($info->datafeed_all as $data) : ?>
                            <div class="checkbox" style="margin-left: 0">
                                <label style="color:black!important" class="txt-lb-name">
                                    <input class="checkbox-group" style="outline: 0;" type="checkbox" name="datafeed[]" <?php echo (in_array($data->_id, $datafeed_select)? 'checked' : '') ?>  <?php echo ($is_create_company)? '' : 'disabled' ?> value="<?php echo $data->_id ?>">
                                    <?php echo $data->name?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    <hr style="margin: 0;">
                    
                    <div class="col-lg-12" style="margin-top: 7px;">
                        <div class="form-group" style="margin-bottom: 6px;">
                           <div class="checkbox" style="padding-left: 0px; margin: 0px;" >
                               <label style="color:black!important">
                                   <input <?php echo ($info->company_info->is_agree)? 'checked' : '' ?> <?php echo ($is_create_company)? '' : 'disabled' ?> type="checkbox" name="agree" value="1" style="outline: 0px none; position: absolute; top: 6px; left: 19px;">
                                   I agree to forward my car inventory data to CarZapp.
                               </label>
                           </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12" style="margin-bottom: 7px;">
                        <div class="form-group">
                           <div class="checkbox" style="padding-left: 0px; margin: 0px;" >
                               <label style="color:black!important">
                                   <input class="not-dms" <?php echo ($info->company_info->not_dms)? 'checked' : '' ?> <?php echo ($is_create_company)? '' : 'disabled' ?> type="checkbox" name="not_dms" value="1" style="outline: 0px none; position: absolute; top: 6px; left: 19px;">
                                   Don't have a DMS
                               </label>
                           </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <?php if (!$is_create_company) : ?>
                    <input type="hidden" name="agree" value="<?php echo $info->company_info->is_agree ?>"/>
                    <input type="hidden" name="not_dms" value="<?php echo $info->company_info->not_dms ?>"/>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12">
                    <div style="text-align: center; margin: 20px 0px 20px;">
                        <a class="btn btn-custom btn-next btn-submit-form" href="javascript:;">PROCEED</a>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<script>
    function fixSizeStepImage() {
        $('#sign_up .step').css('width', $('#sign_up').width());
    }
    
    $(document).ready(function () {
        fixSizeStepImage();
        $(window).resize(function(){
            fixSizeStepImage();
        });
        
        $('.checkbox-group:checkbox').on('click', function() {
            var $box = $(this);
            if ($box.is(':checked')) {
                // get group of check box (by name)
                var group = ".checkbox-group:checkbox[name='" + $box.attr("name") + "']";
                // set all check box of group is false
                $(group).prop("checked", false);
                // check this
                $box.prop("checked", true);
            } else {
                $box.prop("checked", true);
            }
        });
        
        $('.not-dms').click(function () {
            if ($(this).is(':checked')) {
                $('input[name="datafeed[]"]').prop('checked', false);
            }
        });
        
        $('input[name="datafeed[]"]').click(function () {
            $('.not-dms').prop('checked', false);
        });
        
        $('.btn-submit-form').click(function () {
            form = $('#DataFeedForm');
            load_show();
            $.post(form.attr('action'), form.serialize(),function(data) {
                load_hide();
                if(data.error == 0){
                    load_show();
                    window.location.href = root + 'finish_step_4';
                }else{
                    showMessage(data.msg, 1);
                }
            },'json');
        });
    });
</script>