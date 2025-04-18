<div class="main-page">

    <?php echo $this->element('cz_menu_bar_offers_buying_viewtender'); ?>
    <div class="mg-bottom-4 clearfix"></div>
    <div class="pd-content-01">
        
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
                            <th>Offer Price</th>
                            <th>Date Time</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </thead>
                        <tbody class="result_search">
                            <?php foreach($list as $rs) : ?>
                            <tr id="<?php echo $rs->offer_info->offer_id ?>" 
                                data-car-id="<?php echo $rs->offer_info->car_id ?>" 
                                data-offer-price="<?php echo $rs->offer_info->make_on_offer ?>" 
                                data-offer-valid="<?php echo $rs->offer_info->offer_valid ?>" >
                                <td><strong class="offer_price"><?php echo (isset($rs->offer_info->make_on_offer))? '$'.number_format($rs->offer_info->make_on_offer,0,',',',') : '' ?></strong></td>
                                <td><?php echo $rs->offer_info->create_date_offer ?></td>
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
                                    <a href="javascript:;" class="btn-offer-edit" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" title="Ajust Offer" ><i class="fa fa-edit color-orange"></i></a>
                                    <a href="javascript:;" class="btn-offer-delete" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" title="Cancel Offer"><i class="fa fa-times color-red"></i></a>
                                    <?php elseif ($rs->offer_info->offer_status == 3) : ?>
                                    <a href="javascript:;" class="btn-send-offer" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $carId ?>" title="Send Offer" ><i class="fa fa-reply color-site"></i></a>
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
                    <form id="OfferForm" action="<?php echo $this->Html->Url('/cars/sendOffer') ?>" method="post" class="form-horizontal">
                        <input type="hidden" name="offer_id"/>
                        <input type="hidden" name="car_id"/>
                        <input type="hidden" name="submit_type"/>
                        <div class="form-group current-pass-group">
                            <div class="col-lg-3 col-xs-12"><label style="font-size: 14px; font-weight: 500; margin-top: 6px;">Price</label></div>
                            <div class="col-lg-9 col-xs-12">
                                <input type="text" name="make_on_offer" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 col-xs-12"><label style="font-size: 14px; font-weight: 500; margin-top: 6px;">Offer valid</label></div>
                            <div class="col-lg-9 col-xs-12">
                                <input type="text" name="offer_valid" class="form-control" value="">
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
    var limit   = <?php echo $limit?>;
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    
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
    
    $(document).on('click', '.btn-send-offer', function() {
        $('#OfferForm input[name="submit_type"]').val('add');
        $('#OfferForm input[name="car_id"]').val($(this).attr('data-car-id'));
        $('#OfferForm input[name="make_on_offer"]').val('');
        $('#OfferForm input[name="offer_valid"]').val('');

        $('#OfferModal .modal-title').text('Send Offer');
        $('#OfferModal').modal('show');
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
            else {
                return true;
            }
        });
    });
</script>