<style>
    .payment-header {
        color: #fff;
        background-color: #30b001;
        padding: 15px;
        height: 50px;
        font-size: 20px;
    }
    .review{
        color:#333333;
        border-top: 1px solid #ccc;
    }

</style>
<div class="panel">
    <form id="settingSubscription">
        <div class="panel-body">
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="col-lg-5 form-group">
                        <label>Free time for supscription</label>
                        <input id="date_not_payment" type="text" value="<?php echo isset($time_free_not_enter_payment) ? $time_free_not_enter_payment : '' ?>" class="form-control date date_not_payment" name="date_not_payment">
                    </div>
                    <div class="col-lg-5 form-group">
                        <label>Charge time for subscription </label>
                        <input id="date_payment"  type="text" value="<?php echo isset($time_free_enter_payment) ? $time_free_enter_payment : '' ?>" class="form-control date date_payment" name="date_payment">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 form-group">
                        <input  name="line1" class="form-control" type="text" value="<?php echo isset($line1) ? $line1 : '';?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input disabled type="text" value="<?php echo isset($time_free_not_enter_payment) ? $time_free_not_enter_payment : '' ?>" class="form-control date date_not_payment" name="date_not_payment1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12 form-group">
                        <input name="line2" class="form-control" type="text" value="<?php echo isset($line2) ? $line2 : '';?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 form-group">
                        <input name="line3" class="form-control" type="text" value="<?php echo isset($line3) ? $line3 : '';?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input  disabled type="text" value="<?php echo isset($time_free_not_enter_payment) ? $time_free_not_enter_payment : '' ?>" class="form-control date date_not_payment" name="date_not_payment1">
                    </div>
                </div>
<!--                <div class="form-group">-->
<!--                    <div class="col-lg-10 form-group">-->
<!--                        <input name="line4" class="form-control" type="text" value="--><?php //echo isset($line4) ? $line4 : '';?><!--">-->
<!--                    </div>-->
<!--                    <div class="col-lg-2 form-group">-->
<!--                        <input disabled type="text" value="--><?php //echo isset($time_free_not_enter_payment) ? $time_free_not_enter_payment : '' ?><!--" class="form-control date date_not_payment" name="date_not_payment1">-->
<!--                    </div>-->
<!--                </div>-->
                <div class="form-group">
                    <div class="col-lg-12 form-group">
                        <input name="line5" class="form-control" type="text" value="<?php echo isset($line5) ? $line5 : '';?>">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-lg-10 form-group">
                        <input name="line6" class="form-control" type="text" value="<?php echo isset($line6) ? $line6 : '';?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input disabled type="text" value="<?php echo isset($time_free_enter_payment) ? $time_free_enter_payment : '' ?>" class="form-control date date_payment" name="date_payment1">
                    </div>
                </div>
                <div class="col-lg-12">
                    <input type="button" name="btn_update" href="javascript:;" class="btn btn-default btn_update_sup" value="Update">
                </div>
            </div>
        </div>
    </form>
    <div class="review panel-body">
        <div class="col-lg-12">
            <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 no-padding frame-1">
                <h5 class="payment-header" style="border-bottom: 0;text-align: center">Free Subscription Period</h5>
                <div class="clearfix"></div>
                <div class="col-lg-12" style="margin-bottom: 13px; margin-top: 10px; text-align: center">
                    <div class="text-center line1" style="font-size: 14.5px; display: inline-block"><?php echo isset($line1) ? $line1 : '';?></div> <div class="date_1" style="display: inline-block;"><?php echo date('dS F Y', strtotime($time_free_not_enter_payment)); ?> </div>
                </div>
                <div class="col-lg-12" style="margin-bottom: 13px; text-align: center">
                    <div class="text-center line2" style="display: inline-block;"><?php echo isset($line2) ? $line2 : '';?></div><div style="display: inline-block;"></div>
                </div>
                <div class="col-lg-12" style="margin-bottom: 13px; text-align: center">
                    <div class="text-center line3" style="display: inline-block;"><?php echo isset($line3) ? $line3 : '';?></div> <div class="date_2" style="display: inline-block;"><?php echo date('dS F Y', strtotime($time_free_not_enter_payment)); ?></div>
                </div>
<!--                <div class="col-lg-12" style="margin-bottom: 13px; text-align: center">-->
<!--                    <div class="text-center line4"style="display: inline-block;">--><?php //echo isset($line4) ? $line4 : '';?><!--</div> <div class="date_3" style="display: inline-block;">--><?php //echo date('dS F Y', strtotime($time_free_not_enter_payment)); ?><!--</div>-->
<!--                </div>-->
                <div class="col-lg-12" style="margin-bottom: 13px; text-align: center">
                    <div class="text-center line5"><?php echo isset($line5) ? $line5 : '';?></div>
                </div>
                <div class="col-lg-12" style="margin-bottom: 13px;text-align:center ">
                    <div class="line6" style="text-align: center; display: inline-block;"><strong><?php echo isset($line6) ? $line6 : '';?></div> <div class="date_4" style="display: inline-block;"><?php echo date('dS F Y', strtotime($time_free_enter_payment)); ?></div> </strong>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    line1 = $('input[name="line1"]').val();
    $('input[name="line1"]').keyup(function() {
        if ($('input[name="line1"]').val() != line1) {
            line1 =  $('input[name="line1"]').val();
        }
    });
    line2 = $('input[name="line2"]').val();
    $('input[name="line2"]').keyup(function() {
        if ($('input[name="line2"]').val() != line2) {
            line2 =  $('input[name="line2"]').val();
        }
    });
    line3 = $('input[name="line3"]').val();
    $('input[name="line3"]').keyup(function() {
        if ($('input[name="line3"]').val() != line3) {
            line3 =  $('input[name="line3"]').val();
        }
    });
//    line4 = $('input[name="line4"]').val();
//    $('input[name="line4"]').keyup(function() {
//        if ($('input[name="line4"]').val() != line4) {
//            line4 =  $('input[name="line4"]').val();
//        }
//    });
    line5 = $('input[name="line5"]').val();
    $('input[name="line5"]').keyup(function() {
        if ($('input[name="line1"]').val() != line5) {
            line5 =  $('input[name="line5"]').val();
        }
    });
    line6 = $('input[name="line6"]').val();
    $('input[name="line6"]').keyup(function() {
        if ($('input[name="line6"]').val() != line6) {
            line6 =  $('input[name="line6"]').val();
        }
    });
    date_not_payment = $('input[name="date_not_payment"]').val();
    date_payment = $('input[name="date_payment"]').val();
    $('.date_not_payment').datepicker({
        autoclose: false,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        enableOnReadonly: true,
    }).on('changeDate', function (e) {
        $('input[name="date_not_payment"]').datepicker('setEndDate', $('input[name="date_not_payment"]').datepicker('getDate'));
        $('input[name="date_not_payment1"]').val($('input[name="date_not_payment"]').val());
        date_not_payment = $('input[name="date_not_payment"]').val();
        $('.date_1').html($('input[name="date_not_payment"]').val());
        var startDate = new Date($('.date_not_payment').val());
        var endDate = new Date($('.date_payment').val());
        if (startDate > endDate){
            // Do something
            jAlert("Date (free) must be less than date (charge)");
            $('input[name="date_not_payment"]').val('');
        }
    });

    $('.date_payment').datepicker({
        autoclose: false,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        enableOnReadonly: true,
    }).on('changeDate', function (e) {
        $('input[name="date_payment"]').datepicker('setEndDate', $('input[name="date_payment"]').datepicker('getDate'));
        $('input[name="date_payment1"]').val($('input[name="date_payment"]').val());
        date_payment = $('input[name="date_payment"]').val();
        var startDate = new Date($('.date_not_payment').val());
        var endDate = new Date($('.date_payment').val());
        if (startDate > endDate){
            // Do something
            jAlert("Date (free) must be less than date (charge)");
                $('input[name="date_payment"]').val('');

        }
    });
    $('input[type="button"]').click(function(){
        load_show();
        $.post(root + 'Facebooks/save_set_supscription', {line1:line1,line2:line2,line3:line3,line5:line5,line6:line6,date_not_payment:date_not_payment,date_payment:date_payment}, function(data){
            if(data.error == 0){
                load_hide();
                jAlert("Successfully");
               window.location.href = root + 'subscription';
            }else{
                load_hide();
                jAlert("Failure");
            }
        },'json');
    });
    //review text
    $('input[name="line1"]').bind("change paste keyup", function() {
      $('.line1').text($('input[name="line1"]').val());
    });
    $('input[name="line2"]').bind("change paste keyup", function() {
        $('.line2').text($('input[name="line2"]').val());
    });
    $('input[name="line3"]').bind("change paste keyup", function() {
        $('.line3').text($('input[name="line3"]').val());
    });
    $('input[name="line4"]').bind("change paste keyup", function() {
        $('.line4').text($('input[name="line4"]').val());
    });
    $('input[name="line5"]').bind("change paste keyup", function() {
        $('.line5').text($('input[name="line5"]').val());
    });
    $('input[name="line6"]').bind("change paste keyup", function() {
        $('.line6').text($('input[name="line6"]').val());
    });
//    if( $('input[name="date_payment"]').val('') ||  $('input[name="date_not_payment"]').val('')){
//        jAlert("Please enter date for supscription ");
//    };


</script>


