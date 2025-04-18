<link href="<?php echo $this->webroot; ?>js/cz/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
<link href="<?php echo $this->webroot; ?>js/cz/datetimepicker/bootstrap-datetimepicker-standalone.css" rel="stylesheet" />

<script src="<?php echo $this->webroot; ?>js/cz/datetimepicker/moment.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/cz/datetimepicker/bootstrap-datetimepicker.min.js"></script>

<style>
    .total-result {
        padding-bottom: 20px;
        font-size: 16px;
    }
</style>
<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow" style="padding: 15px 40px 74px;">
                <form id="AddTenderForm1" method="post">
                        <input type="hidden" name="is_custom_zooper" value="<?php echo($this->Session->read('is_custom_zooper')) ? $this->Session->read('is_custom_zooper') : null ;?>"/>
                        <div class="frame-1">
                        <!--Title-->
                        <div class="col-lg-12">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Title</h2>
                            </header>
                        </div>
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <div class="pos-rel">
                                    <input type="text" name="title" class="form-control kb-input-item" placeholder="Enter title">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <!--Start date-->
                        <div class="col-lg-12 pos-rel">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Start date</h2>
                            </header>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="pos-rel">
                                    <input id="start-date-picker" type='text' class="form-control kb-input-item" name="start_date" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <!--End date-->
                        <div class="col-lg-12 pos-rel">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">End date</h2>
                            </header>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="pos-rel">
                                    <input id="end-date-picker" type='text' class="form-control kb-input-item" name="end_date" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <!--Inspect location-->
                        <div class="col-lg-12">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Inspect location</h2>
                            </header>
                        </div>
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <div class="pos-rel">
                                    <textarea class="form-control kb-input-item" name="inspection" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <!--Inspection Dates and Times-->
                        <div class="col-lg-12">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Inspection Dates and Times</h2>
                            </header>
                        </div>
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <div class="pos-rel">
                                    <textarea class="form-control kb-input-item" name="inspect_datetime_start" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    
                        <div class="col-lg-12">
                            <button type="submit" class="btn-done-frame1 kb-btn-02 color-bg-site pull-right"> NEXT <span class="fa fa-angle-right"></span></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
                <div id="ListMyStock" class="frame-2" style="display: none;">
                    <!--Header-->
                    <?php if ($listMyStock) : ?>
                    <div class="col-lg-12">
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">My Stock <span class="font-size-14">(<?php echo ($totalMyStock > 1)? $totalMyStock . ' results' : $totalMyStock . ' result' ?>)</span></h2>
                        </header>
                        <form id="AddTenderForm2">
                            <?php foreach($listMyStock as $data) {
                                echo $this->element('cz_car_detail_selection', array('data' => $data));
                            } ?>
                            <div class="clearfix"></div>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                    <?php else : ?>
                        <div class="mg-top-50 text-center font-size-24"><span>No car to display</span></div>
                    <?php endif; ?>
                    <div class="col-lg-12">
                        <div class="col-lg-6 text-left">
                            <button class="btn-back kb-btn-03 color-bg-site pull-left"><span class="fa fa-angle-left"></span> BACK </button>
                        </div>
                        <div class="col-lg-6 text-left">
                            <button class="btn-done-frame2 kb-btn-02 color-bg-site pull-right"> NEXT <span class="fa fa-angle-right"></span></button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="frame-3" style="display: none;">
                    <?php if ($listMyNetwork) : ?>
                    <div class="col-lg-6">
                        <!--Header-->
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">My Network<span class="font-size-14">(<?php echo ($totalNetworkGroup > 1)? $totalNetworkGroup . ' results' : $totalNetworkGroup . ' result' ?>)</span></h2>
                        </header>
                        <form id="AddTenderForm3">
                            <?php foreach($listMyNetwork as $data) : ?>
                            <div class="form-group line_group item-checkbox">
                                <div class="col-lg-1 col-xs-2 icon no-padding">
                                    <?php
                                    if($data->avatar != ''){
                                        echo '<img class="img-circle" src="'.$data->avatar.'" style="width: 50px;height: 50px">';
                                    }else{
                                        echo $this->Html->image('/images/no_car.png',array('width'=>'50','height' => '50', 'class' => 'img-circle'));
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-10 col-xs-6 ">
                                    <?php echo $data->name?> <br>
                                    <?php echo $data->company_info->company_name?>
                                </div>
                                <div class="col-lg-1 col-xs-2 middle pull-right pos-rel">
                                    <input class="dealer-ids" type="checkbox" name="arr_tender_dealer[]" value="<?php echo $data->_id?>" onclick="return false" >
                                    <div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0;z-index:9999;"></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                            <div class="scroll-loading" ><label>Loading...</label></div>
                        </form>
                    </div>
                    <?php else : ?>
                        <div class="mg-top-50 text-center font-size-24"><span>No dealers to display</span></div>
                    <?php endif; ?>
                    <!--List network group-->
                    <?php if ($listNetworkGroup) : ?>
                        <div class="col-lg-6">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">All group <span class="font-size-14">(<?php echo ($totalNetworkGroup > 1)? $totalNetworkGroup . ' results' : $totalNetworkGroup . ' result' ?>)</span></h2>
                            </header>
                            <form id="AddTenderForm4">
                                <?php foreach($listNetworkGroup as $data) : ?>
                                    <div class="form-group line_group1 item-checkbox">
                                        <div class="col-lg-1 col-xs-2 icon no-padding">
                                            <?php
                                                echo $this->Html->image('/images/no_car.png',array('width'=>'50','height' => '50', 'class' => 'img-circle'));
                                            ?>
                                        </div>
                                        <div class="col-lg-10 col-xs-6 ">
                                            <?php echo $data->name;?> <br>
                                        </div>
                                        <div class="col-lg-10 col-xs-6 ">
                                            <?php echo $data->count_member." members"?> <br>
                                        </div>
                                        <div class="col-lg-1 col-xs-2  pull-right pos-rel">
                                            <input class="network-group-ids" type="checkbox" name="arr_tender_dealer[]" value=<?php echo $data->_id ?> onclick="return false" >
                                            <div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0;z-index:9999;"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="clearfix mg-bottom-25"></div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    <?php else : ?>
                        <div class="mg-top-50 text-center font-size-24"><span>No group to display</span></div>
                    <?php endif; ?>
                    <div class="clearfix mg-bottom-25"></div>

                    <div class="col-lg-6 text-left">
                        <button class="btn-back kb-btn-03 color-bg-site pull-left"><span class="fa fa-angle-left"></span> BACK </button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn-done-frame3 kb-btn-02 color-bg-site pull-right"> DONE <span class="fa fa-angle-right"></span></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // BEGIN datetime picker
    $('#start-date-picker').datetimepicker({
        useCurrent: false,
        format: 'DD-MM-YYYY HH:mm',
        sideBySide: true
    });
    $('#end-date-picker').datetimepicker({
        useCurrent: false,
        format: 'DD-MM-YYYY HH:mm',
        sideBySide: true
    });
    //$('#start-date-picker') = new Date();
    $("#start-date-picker").on("click", function (e) {
        $('#start-date-picker').data("DateTimePicker").minDate(e.date);
        $('#end-date-picker').data("DateTimePicker").minDate(e.date);
        $("#AddTenderForm1").formValidation('updateStatus', 'start_date', 'NOT_VALIDATED');
    });
    $("#end-date-picker").on("dp.change", function (e) {
        $('#start-date-picker').data("DateTimePicker").maxDate(e.date);
        $("#AddTenderForm1").formValidation('updateStatus', 'end_date', 'NOT_VALIDATED');
    });
    $('#start-date-picker, #end-date-picker').click(function () {
        $(this).find('.add-on').click();
    });
    // END datetime picker
    // BEGIN frame 1
    $(document).ready(function () {
        $('#AddTenderForm1').formValidation({
            framework: 'bootstrap',
            message: 'This value is not valid',
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'The title is required and can\'t be empty'
                        }
                    }
                },
                start_date: {
                    validators: {
                        notEmpty: {
                            message: 'The Start date is required and can\'t be empty'
                        }
                    }
                },
                end_date: {
                    validators: {
                        notEmpty: {
                            message: 'The End date is required and can\'t be empty'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            
            $('.frame-1').fadeOut('slow', function () {
                $('.frame-2').fadeIn('slow');
            });
            $('.frame-3').hide();
            
            return false;
        });
    });
    // END frame 1
    
    // BEGIN frame 2
    $('.btn-done-frame2').click(function(e) {
        e.preventDefault();
        
        var $ids = $("input.car-ids:checkbox:checked").map(function(){
            return $(this).val();
        }).get();
        if ($ids == '') {
            showMessage('No cars selected', 1);
            return false;
        }
        else {
            $('.frame-2').fadeOut('slow', function () {
                $('.frame-3').fadeIn('slow');
            });
            $('.frame-1').hide();
            
            return false;
        }
    });
    $('.frame-2 .btn-back').click(function (e) {
        e.preventDefault();
        
        $('.frame-2').fadeOut('slow', function () {
            $('.frame-1').fadeIn('slow');
        });
        $('.frame-3').hide();

        $(".frame-2 input:checkbox").prop('checked', false);
        
        resetForm();
        
        return false;
    });
    // END frame 2

    // BEGIN frame 3
    var arrGroups = <?php
        $arrTmp = array();
        if($listNetworkGroup){
            foreach ($listNetworkGroup as $group) {
                $arrTmp[$group->_id] = $group->list_member;
            }
            echo json_encode($arrTmp);
        } else {
            $arrTmp = 0;
            echo $arrTmp;
        }
        ?>;
    $('.btn-done-frame3').click(function(e) {
        e.preventDefault();
        var $ids = $("input.dealer-ids:checkbox:checked").map(function(){
            return $(this).val();
        }).get();
        var $network_ids=$("input.network-group-ids:checkbox:checked").map(function(){
            return $(this).val();
        }).get();
        if ($ids == '' && $network_ids == '') {
            showMessage('No dealers or groups selected', 1);
            return false;
        }
        else {
            load_show();
            var arrDealers = [];
            var arrGroupId = $("input.network-group-ids:checkbox:checked").map(function(){
                return $(this).val();
            }).get();
            strGroup = '';
            for(i = 0; i < arrGroupId.length; i++) {
                for(j = 0; j < arrGroups[arrGroupId[i]].length; j++) {
                    strGroup = strGroup + '&arr_tender_dealer[]=' + arrGroups[arrGroupId[i]][j];
                }
            }

            $.post(root + 'cars/add_tender', $('#AddTenderForm1').serialize() + '&' + $('#AddTenderForm2').serialize() + '&' + $('#AddTenderForm3').serialize() + '&' + strGroup, function (data) {
                load_hide();
                if(data.error == 0) {
                    showMessage('Added successfully', 0, function () {
                        window.location.href = root + 'tenderoffer';
                    });
                } else if(data.error == 1){
                    showMessage('Failure', 1);
                }
            },'json');
            
            return false;
        }
    });
    
    $('.frame-3 .btn-back').click(function (e) {
        e.preventDefault();
        
        $('.frame-3').fadeOut('slow', function () {
            $('.frame-2').fadeIn('slow');
        });
        $('.frame-1').hide();

        $(".frame-3 input:checkbox").prop('checked', false);
        
        return false;
    });
    // END frame 3
    /* BEGIN scroll tender */
    var scrollLimitLoad = 10;
    var scrollPage = 0;
    var scrollIsLoading = false;
    // scroll to bottom
    $('#AddTenderForm3').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            loadNetworkAjax(root + 'cars/getDealersInCompanyAjax');

        }
    });
    function loadNetworkAjax() {
        url = root + 'cars/getNetworkAjax';
        if (!scrollIsLoading) {
            scrollIsLoading = true;
            scrollPage++;
            $('#AddTenderForm3 .scroll-loading').show();

            $.post(url,{limit:scrollLimitLoad, page:scrollPage}, function(data){
                if (data.error==0) {
                    $('#AddTenderForm3 .scroll-loading').before(data);
                }
                $('#AddTenderForm3 .scroll-loading').hide();
                scrollIsLoading = (data.list_dealer.length < scrollLimitLoad)? true : false;

                if (!data.list_dealer.length && scrollPage == 1) {
                    $('#AddTenderForm3').html('<div>No data</div>');
                }

            });
        }
    }
    function resetForm() {
        $("#AddTenderForm1").formValidation('updateStatus', 'title', 'NOT_VALIDATED')
                    .formValidation('updateStatus', 'start_date', 'NOT_VALIDATED')
                    .formValidation('updateStatus', 'end_date', 'NOT_VALIDATED');

        $('.frame-1 .btn-done-frame1').removeClass('disabled');
        $('.frame-1 .btn-done-frame1').prop('disabled', false);
    }

</script>