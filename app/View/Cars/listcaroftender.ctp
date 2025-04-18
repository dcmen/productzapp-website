<div class="main-page">
    <?php echo $this->element('cz_menu_bar_listcar_tender'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>

    <div class="pd-content-04">
        <div class="data-content">
            <?php
            if(isset($custom_zooper) && $custom_zooper){
                $is_cusstom_zooper = 1;
                if ($custom_zooper && $price) {
                    if ($custom_zooper->price_cheaper_type == 1) {
                        $price_type_1 = $price - $custom_zooper->price_cheaper_value;
                    } else {
                        $price_type_1 = 0;
                    }
                }
                if ($custom_zooper && $price) {
                    if ($custom_zooper->price_cheaper_type == 2) {
                        $price_type_2 = $price - ($price * $custom_zooper->price_cheaper_value) / 100;
                    } else {
                        $price_type_2 = '';
                    }
                }
            }
            else{
                $price_type_1 = 0;
                $price_type_2 = 0;
                $is_cusstom_zooper = 0;
            }
            ?>
            <?php if ($list) : ?>
                <?php if ($viewBy == 1) : ?>
                    <!--view cars-->
                    <?php foreach($list as $data) : ?>
                        <?php echo $this->element('cz_car_item_listcartender', array('data' => $data, 'in_progress' => $inProgress, 'tender_type' => $type, 'tender_id' => $tenderId)); ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!--view dealers-->
                    <div class="wg-box-shadow data-content" style="padding: 30px 20px 40px;">
                        <div id="OffersTable" class="table-responsive col-xs-12">
                            <table class="table customer">
                                <thead>
                                    <th style="width: 95px;">Avatar</th>
                                    <th>Dealer</th>
                                    <th>Phone Number</th>
                                    <th>Dealership</th>
                                </thead>
                                <tbody class="result_search">
                                <?php foreach ($list as $rs) :?>
                                    <tr id="<?php echo $rs->_id ?>" class="dealer-item" data-dealer-id="<?php echo $rs->_id ?>">
                                        <td>
                                            <a class="no-decoration" href="<?php echo $this->html->url('/users/userprofile?user_id=' . $rs->_id) ?>" style="padding: 0;">
                                                <img src="<?php echo (isset($rs->avatar) && $rs->avatar) ? $rs->avatar : $this->webroot . 'images/no-avatar.png' ?>"
                                                     class="img-circle"
                                                     style="width: 40px; height: 40px;"/>
                                            </a>
                                        </td>
                                        <td><a class="no-decoration" href="<?php echo $this->html->url('/users/userprofile?user_id=' . $rs->_id) ?>" style="padding: 0;"><strong><?php echo $rs->name ?></strong></a></td>
                                        <td><?php echo $rs->phone ?></td>
                                        <td><?php echo $rs->company_info->company_name ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <div class="mg-top-50 text-center font-size-24 msg-no-data <?php echo ($list) ? 'dis-none' : '' ?>"><span>No data to display</span></div>
    </div>
</div>

<div id="MakeOfferModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Make an Offer</h4>
                </div>
                <div class="modal-body">
                    <form id="MakeOfferForm" class="form-horizontal">
                        <input name="car_id" type="hidden" />
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 8px;">Price($)</label></div>
                            <div class="col-xs-12 col-md-9">
                                <input class="form-control" name="price_offer" maxlength="9"/>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: center; margin-top: 10px;">
                            <div class="col-xs-12">
                                <button class="btn btn-view">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="AddItemModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo ($viewBy)? 'My Stock' : 'My Network' ?></h4>
                </div>
                <div class="modal-body">
                    <form id="AddItemForm" action="<?php echo $this->html->url('/cars/add_item_into_tender') ?>" method="POST" class="form-horizontal">
                        <input name="type" type="hidden" class="add-type" value="<?php echo $viewBy ?>"/>
                        <input name="tender_id" type="hidden" value="<?php echo $tenderId ?>" />
                        <div id="ListItems" style="padding-right: 10px; min-height: 32px; <?php echo ($viewBy)? 'max-height: 387px;' : 'max-height: 324px;' ?>"></div>
                        <div class="form-group group-btn-action" style="text-align: center; margin-top: 10px;">
                            <div class="col-xs-12">
                                <button class="btn btn-view btn-done">DONE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#ListItems').slimscroll({
        size: '4px',
        height: '100%'
    });

    //BEGIN Send list offer
    var tenderId = '<?php echo $tenderId ?>';
    var isCustomZooper = <?php echo $is_cusstom_zooper ?>;
    $(document).on('click', '.btn-offer', function() {
        $carId = $(this).data('car-id');
        $('#MakeOfferForm input[name="car_id"]').val($carId);
        $('#MakeOfferModal').modal('show');
    });
    
    $(document).on('click', '.btn-send-offer-list', function () {
        var car_offer = getArrayCarOffer();
        var totalPrice = parseInt($('.total-offer').text().replace(",", ""));
        
        if (totalPrice) {
            load_show();
            $.post(root + 'cars/sendOfferList', {tender_id : tenderId, car_offer : car_offer,is_custom_zooper:isCustomZooper}, function (data) {
                load_hide();
                if(data.error == 0){
                    showMessage('Sent offer successfully', 0);
                }else{
                    showMessage('Failure', 1);
                }
            },'json');
        }
    });
    
    function getArrayCarOffer() {
        var arrCars = [];
        $('.btn-offer').each(function(){ 
            arrCars.push({car_id : $(this).data('car-id'), price_offer : $(this).data('price')});
        }); 
        
        return arrCars;
    }
    //END Send list offer
    
    //BEGIN add cars and dealers
    $(document).on('click', '.btn-add-car-tender', function () {
        var carIds = getListCarsInTender();
        load_show();
        $.post(root + 'cars/get_select_stock_for_tender_ajax', {car_ids: carIds}, function (data) {
            $('#ListItems').html(data);
            $('#AddItemModal').modal('show');
            load_hide();
        });
    });
    
    $(document).on('click', '.btn-add-dealer-tender', function () {
        var dealerIds = getListDealersInTender();
        load_show();
        $.post(root + 'cars/get_select_network_for_tender_ajax', {dealer_ids: dealerIds}, function (data) {
            $('#ListItems').html(data);
            $('#AddItemModal').modal('show');
            load_hide();
        });
    });
    
    function getListCarsInTender() {
        var carIds = [];
        $('.tender-item').each(function(){ 
            carIds.push($(this).data('car-id'));
        }); 
        
        return carIds;
    }
    
    function getListDealersInTender() {
        var dealerIds = [];
        $('.dealer-item').each(function(){ 
            dealerIds.push($(this).data('dealer-id'));
        }); 
        
        return dealerIds;
    }
    
    $('#AddItemForm .btn-done').click(function(e) {
        e.preventDefault();
        addType = $('#AddItemForm .add-type').val();
        // check data
        if (addType == 1) {
            var $ids = $("input.car-ids:checkbox:checked").map(function(){
                return $(this).val();
            }).get();
            if ($ids == '') {
                showMessage('No cars selected', 1);
                return false;
            }
        }
        else {
            var $ids = $("input.dealer-ids:checkbox:checked").map(function(){
                return $(this).val();
            }).get();
            if ($ids == '') {
                showMessage('No dealers selected', 1);
                return false;
            }
        }
        load_show();
        $('#AddItemForm').submit();
    });
    //BEGIN add cars and dealers
    
    $(document).on('click', '.btn-car-tender-delete', function () {
        tenderId = $(this).attr('data-tender-id');
        carId = $(this).attr('data-car-id');
        filter = $(this).attr('data-filter-tender');
        filter_mytender = $(this).attr('data-filter-mytender');
        inprogress = $(this).attr('data-in-progress');
        tenderItem = $('#' + tenderId);
        
        jConfirm('Do you want to remove this car?', 'Message', function (r) {
            if (r) {
                load_show();
                $.post(root + 'cars/DeleteCarOfTenderAjax', {
                    tender_id: tenderId,
                    car_id: carId
                }, function (data) {
                    if (data.error == 0) {
                        // update number offer
                        countTender = parseInt($('.count-data').text());
                        if (countTender > 0) {
                            $('.count-data').text(--countTender);
                        }
                        if (countTender == 0) {
                            $('#ListCarOfTender').hide();
                            $('.msg-no-data').show();
                            load_hide();
                        }
                        // remove row offer
                        tenderItem.fadeOut('slow', function () {
                            $(this).remove();
                        });
                        // show message and redirect to Offer History page
                        showMessage('Successfully', 0, function () {
                          window.location.href = root + 'cars/listcaroftender?tender_id='+tenderId+'&filter_tender='+filter+'&in_progress=0';
                        });
                    } else {
                        showMessage('Failure', 1);
                    }
                    load_hide();
                }, 'json');
            }
        });
    });
    
    $(document).ready(function () {
        var price = <?php echo (isset($price) && $price ? $price : 0)?>;
        $("#MakeOfferForm").formValidation({
            framework: 'bootstrap',
            message: 'This value is not valid',
            fields: {
                price_offer: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter price'
                        },
                        numeric: {
                            message: 'Please enter number'
                        },
                        greaterThan: {
                            value: 1,
                            message: 'Please input price greater than 0'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            var price_type_1 = <?php if(isset($price_type_1) && $price_type_1){echo $price_type_1;}else{  echo 0;} ?>;
            var price_type_2 = <?php if(isset($price_type_2) && $price_type_2){echo $price_type_2;}else{  echo 0;} ?>;
            var make_on_offer = parseInt($('#MakeOfferForm input[name="price_offer"]').val());
            if(isCustomZooper){
                if(make_on_offer <= 0 ){
                    showMessage('Offer is too low,please make offers must be heighter than 0', 1);
                    return false;
                }
                if(make_on_offer < price_type_1){
                    showMessage('Offer is too low,please make offers with a min of '+price_type_1+'$', 1);
                    return false;
                }
                if(make_on_offer < price_type_2){
                    showMessage('Offer is too low,please make offers with a min of '+price_type_2+'$', 1);
                    return false;
                }
                // update data of button offer
                carItem = $('#' + $('#MakeOfferForm input[name="car_id"]').val());
                btnOffer = carItem.find('.btn-offer');
                btnOffer.digits(make_on_offer + '');
                btnOffer.data('price', make_on_offer);
                // update data in menu bar
                $total = 0;
                $('.tender-item').each(function(){
                    $total += $(this).find('.btn-offer').getPrice();
                });
                $('.total-offer').digits($total + '');

                clearForm();
                $('#MakeOfferModal').modal('hide');
            }else {
                // update data of button offer
                carItem = $('#' + $('#MakeOfferForm input[name="car_id"]').val());
                btnOffer = carItem.find('.btn-offer');
                btnOffer.digits(make_on_offer + '');
                btnOffer.data('price', make_on_offer);

                // update data in menu bar
                $total = 0;
                $('.tender-item').each(function(){
                    $total += $(this).find('.btn-offer').getPrice();
                });
                $('.total-offer').digits($total + '');

                clearForm();
                $('#MakeOfferModal').modal('hide');
            }
        });
    });
    
    function clearForm() {
        $('#MakeOfferForm').trigger('reset');
        $('#MakeOfferForm').formValidation('updateStatus', 'price_offer', 'NOT_VALIDATED');
    }
    
    $.fn.digits = function(number) { 
        return this.each(function(){ 
            $(this).text(number.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
        });
    };
    
    $.fn.getPrice = function(number) { 
        price = parseInt($(this).text().replace(",", ""));
        return (isNaN(price))? 0 : price;
    };
</script>