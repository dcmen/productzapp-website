<div class="main-page">
    <?php echo $this->element('cz_menu_bar_offers_sellingviewtender') ?>
    <div class="mg-bottom-4 clearfix"></div>
    <div class="pd-content-01">
       
        <div class="mg-bottom-15"></div>
        <div class="col-lg-12">
            <?php if(count($list)>0) : ?>
            <div class="wg-box-shadow data-content" style="padding: 30px 20px 40px;">
                <div id="OfferBoardViewList">
                    <?php echo $this->element('cz_tender_item_detail', array('data_tender' => $tender_info)); ?>
                </div>
                <div class="line-div" style="height: 2px;background-color: #0e1f2a4d;">
                </div>
                <div id="OffersTable" class="table-responsive col-xs-12">
                    <table class="table customer">
                        <thead>
                            <th style="width: 95px;">Avatar</th>
                            <th>Dealer</th>
                            <th>Phone Number</th>
                            <th>Dealership</th>
                            <th>Offer Price</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </thead>
                        <tbody class="result_search">
                            <?php foreach($list as $rs) : ?>
                            <tr id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $rs->offer_info->car_id ?>" data-buyer-id="<?php echo $rs->offer_info->buyer_id ?>">
                                <td>
                                    <img src="<?php echo (isset($rs->user_info->avatar_file_name) && $rs->user_info->avatar_file_name)? $rs->user_info->avatar_file_name : $this->webroot . 'images/no-avatar.png' ?>" class="img-circle" style="width: 40px; height: 40px;" />
                                </td>
                                <td><strong><?php echo $rs->user_info->name ?></strong></td>
                                <td><?php echo $rs->user_info->phone ?></td>
                                <td><?php echo $rs->user_info->company_name ?></td>
                                <td><?php echo (isset($rs->offer_info->make_on_offer))? '$'.number_format($rs->offer_info->make_on_offer,0,',',',') : '' ?></td>
                                <td class="offer-status">
                                    <strong>
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
                                    </strong>
                                </td>
                                <td class="offer-action" align="right">
                                    <?php if ($rs->offer_info->offer_status == 0) : ?>
                                    <a href="javascript:;" class="btn-offer-accept" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $rs->offer_info->car_id ?>"  data-buyer-id="<?php echo $rs->offer_info->buyer_id ?>" title="Accept Offer" ><i class="fa fa-check color-orange"></i></a>
                                    <a href="javascript:;" class="btn-offer-counter" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $rs->offer_info->car_id ?>" data-buyer-id="<?php echo $rs->offer_info->buyer_id ?>" title="Counter Offer" ><i class="fa fa-bolt color-site"></i></a>
                                    <a href="javascript:;" class="btn-offer-reject" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $rs->offer_info->car_id ?>" data-buyer-id="<?php echo $rs->offer_info->buyer_id ?>" title="Reject Offer"><i class="fa fa-times color-red"></i></a>
                                    <?php elseif ($rs->offer_info->offer_status == 3) : ?>
<!--                                    <a href="javascript:;" class="btn-offer-reject" data-offer-id="--><?php //echo $rs->offer_info->offer_id ?><!--" data-car-id="--><?php //echo $rs->offer_info->car_id ?><!--" data-buyer-id="--><?php //echo $rs->offer_info->buyer_id ?><!--" title="Reject Offer"><i class="fa fa-times color-red"></i></a>-->
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

<div id="CounterOfferModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Counter Offer</h4>
                </div>
                <div class="modal-body">
                    <form id="CounterOfferForm" method="post" class="form-horizontal">
                        <input type="hidden" name="offer_id"/>
                        <input type="hidden" name="car_id"/>
                        <input type="hidden" name="buyer_id"/>
                        <div class="form-group current-pass-group">
                            <div class="col-lg-3 col-xs-12"><label style="font-size: 14px; font-weight: 500; margin-top: 6px;">Price($)</label></div>
                            <div class="col-lg-9 col-xs-12">
                                <input type="text" name="make_counter" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center">
                                <button class="btn btn-view" type="submit">OK</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    
    $(document).on('click', '#CounterOfferModal .close', function () {
        $("#OfferForm").formValidation('updateStatus', 'make_counter', 'NOT_VALIDATED');
    });
    
    $(document).on('click', '.btn-offer-counter', function() {
        offerId = $(this).data('offer-id');
        carId = $(this).data('car-id');
        buyerId = $(this).data('buyer-id');
        
        $('#CounterOfferForm input[name="offer_id"]').val(offerId);
        $('#CounterOfferForm input[name="car_id"]').val(carId);
        $('#CounterOfferForm input[name="buyer_id"]').val(buyerId);
        $('#CounterOfferForm input[name="make_counter"]').val('');
        
        $('#CounterOfferModal').modal('show');
    });
    
    $(document).on('click', '.btn-offer-accept', function() {
        offerId = $(this).attr('data-offer-id');
        offerItem = $('#' + offerId);
        carId = offerItem.attr('data-car-id');
        buyerId = offerItem.attr('data-buyer-id');

        
        jConfirm('Are you sure you want to accept this offer?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'cars/acceptOfferAjax',{offer_id:offerId, car_id:carId,buyer_id:buyerId},function(data){
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
                        // remove row offer
                        offerItem.fadeOut('slow', function() {
                            $(this).remove();
                        });
                        // show message and redirect to Offer History page
                        showMessage('<strong>Offer Accepted</strong><br/>Car will now be hidden from view.<br/>You can cancelthis transaction in Offer Board', 0, function () {
                            window.location.href = root + 'offerboard?type=3';
                        });
                    } else {
                        showMessage('Failure', 1);
                    }
                    load_hide();
                },'json');
            }
        });
    });
    
    $(document).on('click', '.btn-offer-reject', function() {
        offerId = $(this).attr('data-offer-id');
        carId = $('#' + offerId).attr('data-car-id');
        offerItem = $('#' + offerId);
        buyerId = $('#' + offerId).attr('data-buyer-id');
        
        jConfirm('Are you sure you want to reject this offer?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'cars/rejectOfferAjax',{offer_id:offerId, car_id:carId,buyer_id:buyerId},function(data){
                    if(data.error == 0){
                        // update data view
                        $('#' + offerId + ' .offer-status').html('<strong>Rejected</strong>');
                        $('#' + offerId + ' .offer-action').html('');


                        // show message
                        showMessage('Offer rejected successfully.', 0);
                    } else {
                        showMessage('Failure', 1);
                    }
                    load_hide();
                },'json');
            }
        });
    });
    
    $(document).ready(function() {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'listdealersentoffer', container = '#OffersTable');


        $("#CounterOfferForm").formValidation({
            framework: 'bootstrap',
                message: 'This value is not valid',
                fields: {
                    make_counter: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter price'
                            },
                            numeric: {
                                message: 'Please enter number'
                            }
                        }
                    }
                }
        }).on('success.form.fv', function (e) {
            load_show();
            offerId = $('#OfferForm input[name="offer_id"]').val();console.log('1');
            
            $.post(root + 'cars/counterOfferAjax', $("#CounterOfferForm").serialize(), function(data){console.log('2');
                if (data.error == 0) {
                    $('#' + offerId + ' .btn-offer-reject').hide();
                    $('#' + offerId + ' .btn-offer-accept').hide();
                    $('#' + offerId + ' .btn-offer-counter').hide();
                    showMessage('Successfully', 0);
                }
                else {
                    showMessage('Failure', 1);
                }
                $('#CounterOfferModal').modal('hide');console.log('6');
                load_hide();
            },'json');

            return false;
        });
    });
</script>