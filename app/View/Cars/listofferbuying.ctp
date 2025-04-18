<div class="main-page">
    <?php echo $this->element('cz_menu_bar_offers_buying',array('is_show_add'=>$is_show_submit)); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <?php if(count($list)>0) : ?>
            <div class="wg-box-shadow data-content" style="padding: 30px 20px 40px;">
                <!--car info-->
                <?php echo $this->element('cz_car_detail_in_offer', array('data' => $car, 'view_type' => 2)); ?>
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
                    $is_cusstom_zooper = null;
                }?>
                <!--offer board-->
                <div id="OffersTable" class="table-responsive col-xs-12">
                    <table class="table customer table-responsive col-xs-12">
                        <thead>
                            <th>Offer Price</th>
                            <th>Date Time</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </thead>
                        <tbody class="result_search">
                            <?php foreach($list as $rs) : ?>
                            <tr id="<?php echo $rs->offer_info->offer_id ?>" 
                                data-car-id="<?php echo $rs->offer_info->car_id ?>" 
                                data-offer-price="<?php echo $rs->offer_info->make_on_offer ?>" 
                                data-offer-valid="<?php echo $rs->offer_info->offer_valid ?>" >
                                <td><strong class="offer_price"><?php echo (isset($rs->offer_info->make_on_offer))? '$'.number_format($rs->offer_info->make_on_offer,0,',',',') : '' ?></strong></td>
                                <td><?php echo $rs->offer_info->create_date_offer . ' ' . $rs->offer_info->create_time_offer ?></td>
                                <td style="padding-top: 0;padding-bottom: 0; vertical-align: middle;">
                                    <?php 
                                    switch ($rs->offer_info->offer_status) {
                                        case 0:
                                            echo 'Pending'; break;
                                        case 1:
                                            echo 'Accepted'; break;
                                        case 2:
                                            echo 'Rejected'; break;
                                        case 3:
                                            echo '<div style="height: 24px;">Countered</div>';
                                            echo (isset($rs->offer_info->countered_make) && $rs->offer_info->countered_make)? '<span>$'.number_format($rs->offer_info->countered_make,0,',',',').'</span>' : '' ; break;
                                        case 4:
                                            echo 'Expired'; break;
                                        default :
                                            echo ''; break;
                                    }
                                    ?>
                                </td>

                                <td align="right">

                                    <?php if (!$rs->offer_info->is_reject_offer && !$rs->offer_info->is_accept_offer && $rs->offer_info->offer_status !=4) : ?>
                                    <a href="javascript:;" class="btn-offer-edit" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-is-zooper="<?php echo $rs->offer_info->is_custom_zooper; ?>" title="Ajust Offer" ><i class="fa fa-edit color-orange"></i></a>
                                    <a href="javascript:;" class="btn-offer-delete" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" title="Cancel Offer"><i class="fa fa-times color-red"></i></a>
                                    <?php elseif ($rs->offer_info->offer_status == 3) : ?>
                                    <a href="javascript:;" class="btn-resend-offer" data-offer-dealers="<?php echo (isset($rs->offer_info->offer_to_dealers))? implode("|",$rs->offer_info->offer_to_dealers) : '' ?>" data-car-price="<?php echo isset($car->cars->price) && $car->cars->price ? $car->cars->price : null;  ?>" data-offer-option="<?php  echo isset($rs->offer_info->option_offer)? $rs->offer_info->option_offer : '' ?>" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $carId ?>" data-buyer-id="<?php echo $rs->offer_info->buyer_id ;?>" data-is-zooper="<?php echo $rs->offer_info->is_custom_zooper; ?>" title="Resend Offer" ><i class="fa fa-reply color-site"></i></a>
                                    <?php endif; ?>
                                    <?php if ($rs->offer_info->is_tender == true) : ?>
                                        <a href="<?php echo $this->Html->Url('/cars/listofferbuyingviewtender?car_id=' . $rs->offer_info->car_id . '&company_id=' . CakeSession::read('Auth.User.company_id').'&tender_id='.$rs->offer_info->tender_id.'&filter='.$filter ) ?>" title="View Offer Tender"><img style="height: 14px;" src="<?php echo $this->webroot; ?>images/ic_T.png" /></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="total-datatable"><span>Total:</span> <strong class="total-count"><?php echo $total ?></strong></div>

                <div class="clearfix"></div>
            </div>
            <?php endif; ?>
            
            <div class="msg-no-data mg-top-50 text-center font-size-24 <?php echo ($total)? 'dis-none' : '' ?>"><span>No data to display</span></div>
            
            <?php if ($maxpages > 1) :  ?>
            <div class="cz-pagination"></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="OfferModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Offer</h4>
                </div>
                <div class="modal-body">
                    <form id="OfferForm" class="form-horizontal">
                        <input type="hidden" name="car_price" />
                        <input type="hidden" name="offer_id" />
                        <input type="hidden" name="option_offer" />
                        <input type="hidden" name="offer_to_dealers" />
                        <input type="hidden" name="offer_id"/>
                        <input type="hidden" name="car_id"/>
                        <input type="hidden" name="is_custom_zooper"/>
                        <input type="hidden" name="buyer_id"/>
                        <input type="hidden" name="submit_type"/>
                        <div class="form-group current-pass-group">
                            <div class="col-lg-3 col-xs-12"><label style="font-size: 14px; font-weight: 500; margin-top: 6px;color:black;">Price($)</label></div>
                            <div class="col-lg-9 col-xs-12">
                                <input style="color:black;" type="text" name="make_on_offer" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 col-xs-12"><label style="font-size: 14px; font-weight: 500; margin-top: 6px;color:black;">Offer valid day(s)</label></div>
                            <div class="col-lg-9 col-xs-12">
                                <input  style="color:black;" type="text" name="offer_valid" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center">
                                <button class="btn btn-view btn-resend-price" type="submit">OK</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var limit   = <?php echo $limit?>;
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    //var price = <?php echo isset($car->cars->price) && $car->cars->price ? $car->cars->price : null;?>;
    var price_type_1 = <?php if(isset($price_type_1) && $price_type_1){echo $price_type_1;}else{  echo 0;} ?>;
    var price_type_2 = <?php if(isset($price_type_2) && $price_type_2){echo $price_type_2;}else{  echo 0;} ?>;


    $(document).on('click', '#OfferModal .close', function () {
        $("#OfferForm").formValidation('updateStatus', 'make_on_offer', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'offer_valid', 'NOT_VALIDATED');
    });
    
    $(document).on('click', '.btn-offer-edit', function() {
        offerId = $(this).attr('data-offer-id');
        offerItem = $('#' + offerId);

        $('#OfferForm input[name="submit_type"]').val('edit');
        $('#OfferForm input[name="offer_id"]').val(offerId);
        $('#OfferForm input[name="make_on_offer"]').val(offerItem.attr('data-offer-price'));
        $('#OfferForm input[name="offer_valid"]').val(offerItem.attr('data-offer-valid'));

        $('#OfferModal .modal-title').text('Adjust Offer');
        $('#OfferModal').modal('show');
    });
    
    $(document).on('click', '.btn-resend-offer', function() {
        $('#OfferForm input[name="submit_type"]').val('add');
        $('#OfferForm input[name="option_offer"]').val($(this).data('offer-option'));
        $('#OfferForm input[name="offer_to_dealers"]').val($(this).data('offer-dealers'));
        $('#OfferForm input[name="car_id"]').val($(this).attr('data-car-id'));
        $('#OfferForm input[name="is_custom_zooper"]').val($(this).attr('data-is-zooper'));
        $('#OfferForm input[name="buyer_id"]').val($(this).attr('data-buyer_id'));
        $('#OfferForm input[name="make_on_offer"]').val('');
        $('#OfferForm input[name="offer_valid"]').val('');
        $('#OfferForm input[name="offer_id"]').val($(this).attr('offer_id'));

        $('#OfferModal .modal-title').text('Resend Offer');
        $('#OfferModal').modal('show');

    });
    $(document).on('click', '.btn-resend-price', function() {

//        if(price)
//        if( $('#OfferForm input[name="make_on_offer"]').val('') < price){
//            alert('123');
//        }

    });
    
    $(document).on('click', '.btn-offer-delete', function () {
        offerId = $(this).data('offer-id');
        offerItem = $('#' + offerId);
        
        jConfirm('Are you sure you want to cancel this Offer?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'cars/deleteOfferAjax',{offer_id:offerId},function(data){
                    if(data.error == 0){
                        // update number offer
                        countOffer = parseInt($('.total-count').text());
                        if (countOffer > 0) {
                            $('.total-count').text(--countOffer);
                        }
                        if (countOffer == 0) {
                            $('.data-content').hide();
                            $('.msg-no-data').show();
                            load_hide();
                        }
                        // hide pagination if total <= limit
                        if (countOffer <= limit) {
                            $('.cz-pagination').hide();
                        }
                        // remove row content
                        if (countOffer > 0 && $('.offer-item').length === 0) {
                            offerItem.fadeOut('slow', function() {
                                $(this).remove();
                                showMessage('Successfully', 0, function () {
                                    loadHTMLAjax('cars/offerboard', $.extend(parasOnLink, {page:curPage, ajax:1}), container = '#OfferBoardViewList');
                                });
                            });
                        }
                        else {
                            offerItem.fadeOut('slow', function() {
                                $(this).remove();
                            });
                            showMessage('Successfully', 0);
                        }
                    } else {
                        showMessage('Failure', 1);
                    }
                    load_hide();
                },'json');
            }
        });
    });
    
    $(document).ready(function() {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'listofferbuying', container = '#OffersTable');
        
        $("#OfferForm").formValidation({
            framework: 'bootstrap',
                message: 'This value is not valid',
                fields: {
                    make_on_offer: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter price'
                            },
                            numeric: {
                                message: 'Please enter number'
                            }
                        }
                    },
                    offer_valid: {
                        validators: {
                            numeric: {
                                message: 'Please enter number'
                            }
                        }
                    }
                }
        }).on('success.form.fv', function (e) {
            load_show();
            offerId = $('#OfferForm input[name="offer_id"]').val();
            submitType = $('#OfferForm input[name="submit_type"]').val();
            if (submitType == 'edit') {
                var make_on_offer = parseInt($('#OfferForm  input[name="make_on_offer"]').val());
                var isCustomZooper = $('#OfferForm input[name="is_custom_zooper"]').val($(this).attr('data-is-zooper'));
                if(isCustomZooper){
                    if(make_on_offer <= 0){
                        load_hide();
                        showMessage('Offer is too low,please make offers must be heighter than 0', 1);
                        return false;
                    }
                    if(make_on_offer < price_type_1){
                        load_hide();
                        showMessage('Offer is too low,please make offers with a min of '+price_type_1+'$', 1);
                        return false;
                    }
                    if(make_on_offer < price_type_2){
                        load_hide();
                        showMessage('Offer is too low,please make offers with a min of '+price_type_2+'$', 1);
                        return false;
                    }
                    $.post(root + 'cars/adjustOfferAjax', $("#OfferForm").serialize(), function(data){
                        if (data.error == 0) {
                            offerItem = $('#' + offerId);
                            offerItem.attr('data-offer-price', data.offer_infor.make_on_offer);
                            offerItem.attr('data-offer-valid', data.offer_infor.offer_valid);
                            offerItem.find('.offer_price').text(data.offer_infor.new_offer_price);

                            showMessage('Successfully', 0);
                        }
                        else {
                            showMessage('Failure', 1);
                        }
                        $('#OfferModal').modal('hide');
                        load_hide();
                    },'json');

                    return false;
                }else{
                    $.post(root + 'cars/adjustOfferAjax', $("#OfferForm").serialize(), function(data){
                        if (data.error == 0) {
                            offerItem = $('#' + offerId);
                            offerItem.attr('data-offer-price', data.offer_infor.make_on_offer);
                            offerItem.attr('data-offer-valid', data.offer_infor.offer_valid);
                            offerItem.find('.offer_price').text(data.offer_infor.new_offer_price);

                            showMessage('Successfully', 0);
                        }
                        else {
                            showMessage('Failure', 1);
                        }
                        $('#OfferModal').modal('hide');
                        load_hide();
                    },'json');

                    return false;
                }
            }
            else if(submitType == 'add'){
                var make_on_offer = parseInt($('#OfferForm  input[name="make_on_offer"]').val());
                var isCustomZooper = $('#OfferForm input[name="is_custom_zooper"]').val($(this).attr('data-is-zooper'));
                if(isCustomZooper){
                    if(make_on_offer <= 0){
                        load_hide();
                        showMessage('Offer is too low,please make offers must be heighter than 0', 1);
                        return false;
                    }
                    if(make_on_offer < price_type_1){
                        load_hide();
                        showMessage('Offer is too low,please make offers with a min of '+price_type_1+'$', 1);
                        return false;
                    }
                    if(make_on_offer < price_type_2){
                        load_hide();
                        showMessage('Offer is too low,please make offers with a min of '+price_type_2+'$', 1);
                        return false;
                    }
                    $.post(root + 'cars/sendOffer', $("#OfferForm").serialize(), function(data){
                        if (data.error == 0) {
                            offerItem = $('#' + offerId);
                            offerItem.attr('data-offer-price', data.offer_infor.make_on_offer);
                            offerItem.attr('data-offer-valid', data.offer_infor.offer_valid);
                            offerItem.find('.offer_price').text(data.offer_infor.new_offer_price);
                            showMessage('Successfully', 0);
                        }
                        else {
                            showMessage('Failure', 1);
                        }
                        $('#OfferModal').modal('hide');
                        load_hide();
                    },'json');

                    return false;
                }else{
                    $.post(root + 'cars/sendOffer', $("#OfferForm").serialize(), function(data){
                        if (data.error == 0) {
                            offerItem = $('#' + offerId);
                            offerItem.attr('data-offer-price', data.offer_infor.make_on_offer);
                            offerItem.attr('data-offer-valid', data.offer_infor.offer_valid);
                            offerItem.find('.offer_price').text(data.offer_infor.new_offer_price);
                            showMessage('Successfully', 0);
                        }
                        else {
                            showMessage('Failure', 1);
                        }
                        $('#OfferModal').modal('hide');
                        load_hide();
                    },'json');

                    return false;
                }
            }else {
                return true;
            }
        });
    });
</script>