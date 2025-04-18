<div class="main-page">
    <?php echo $this->element('cz_menu_bar_offerboard'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-04">
        <div id="listCars">
            <div class="mg-bottom-40"></div>
            <?php if ($list) : ?>
            <div id="OfferBoardViewList">
                <?php foreach ($list as $data) : ?>
                    <?php echo $this->element('cz_car_item_offerboard', array('data' => $data, 'view_type' => $type)); ?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="mg-top-50 text-center font-size-24 msg-no-data <?php echo ($list)? 'dis-none' : '' ?>"><span>No data to display</span></div>
        </div>
    </div>
    
    <div class="mg-bottom-50"></div>
    
    <?php if ($maxpages > 1) :  ?>
    <div class="cz-pagination"></div>
    <?php endif; ?>
</div>

<div id="AdjustOfferModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Adjust Offer</h4>
                </div>
                <div class="modal-body">
                    <form id="AdjustOfferForm" class="form-horizontal">
                        <input type="hidden" name="offer_id" value=""/>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 8px;">Price ($)</label></div>
                            <div class="col-xs-12 col-md-9">
                                <input class="form-control" name="make_on_offer" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 8px;">Offer valid</label> <span style="font-size: 12px;">(Option)</span></div>
                            <div class="col-xs-9 col-md-8">
                                <input class="form-control" name="offer_valid" />
                            </div>
                            <div class="col-xs-3 col-md-1 no-padding"><label style="font-weight: 500; margin-top: 8px;">day</label></div>
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

<script>
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    
    $(document).ready(function () {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'offerboard', container = '#OfferBoardViewList');
    });
    

    $(document).on('click', '.btn-offer-cancel', function () {
        offerId = $(this).attr('data-offer-id');
        carId = $('#' + offerId).attr('data-car-id');
        buyerId = $('#' + offerId).attr('data-buyer-id');
        typeredirect = $(this).attr('data-type');
        offerItem = $('#' + offerId);
        isCustomZooper = $(this).attr('data-is-zooper');
        jConfirm('Do you want to cancel this transaction?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'cars/cancelAcceptOfferAjax',{offer_id:offerId, car_id:carId,buyer_id:buyerId,is_zooper:isCustomZooper },function(data){
                    if(data.error == 0){
                        // update number offer
                        countOffer = parseInt($('.count-data').text());
                        if (countOffer > 0) {
                            $('.count-data').text(--countOffer);
                        }
                        if (countOffer == 0) {
                            $('#OfferBoardViewList').hide();
                            $('.msg-no-data').show();
                            load_hide();
                        }
                        // remove row offer
                        offerItem.fadeOut('slow', function() {
                            $(this).remove();
                        });
                        // show message and redirect to Offer History page
                        showMessage('Successfully', 0, function () {
                            window.location.href = root + 'offerboard?type=' + typeredirect;
                        });
                    } else {
                        showMessage('Failure', 1);
                    }
                    load_hide();
                },'json');
            }
        });
    });
</script>