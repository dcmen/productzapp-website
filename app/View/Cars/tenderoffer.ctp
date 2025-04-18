<div class="main-page">
    <?php echo $this->element('cz_menu_bar_tender'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-04">
        <div id="listCars">
            <div class="mg-bottom-40"></div>
            <?php if ($list) : ?>
            <div id="TenderViewList">
                <?php foreach ($list as $data) : ?>
                    <?php echo $this->element('cz_car_item_tender', array('data_tender' => $data)) ?>
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

<div id="DealersModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Dealers</h4>
                </div>
                <div class="modal-body">
                    <div id="DealerList" style="padding-right: 10px; min-height: 32px; max-height: 324px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="CarsModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cars</h4>
                </div>
                <div class="modal-body">
                    <div id="CarList" style="padding-right: 10px; min-height: 32px; max-height: 387px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // pagination
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    $(document).ready(function () {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'tenderoffer', container = '#TenderViewList');
    });
    
    //Invitation tender
    $(document).on('click', '.data-invitation-tender', function () {
        tenderId = $(this).attr('data-tender-id');
        tenderItem = $('#' + tenderId);
        jConfirm('Do you want to send invitation?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'cars/SendInvitationTenderAjax',{tender_id:tenderId},function(data){
                    if(data.error == 0){
                        tenderItem.find('.btn-action-tender').addClass('hidden');
                        tenderItem.find('.btn-tender-invitation').removeClass('hidden');
                        showMessage('Invitations sent', 0);
                    } else {
                        showMessage('Failure', 1);
                    }
                    load_hide();
                },'json');
            }
        });
    });
    // Start tender
    $(document).on('click', '.data-start-tender', function () {
        tenderId = $(this).attr('data-tender-id');
        tenderItem = $('#' + tenderId);
        jConfirm('Do you want to start this tender?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'cars/StartTenderAjax',{tender_id:tenderId},function(data){
                    if(data.error == 0){
                        tenderItem.find('.btn-tender-invitation').addClass('hidden');
                        tenderItem.find('.btn-start-tender').removeClass('hidden');
                        showMessage('Tender now in progress', 0);
                    } else {
                        showMessage('Failure', 1);
                    }
                    load_hide();
                },'json');
            }
        });
    });
    // Stop tender
    $(document).on('click', '.data-stop-tender', function () {
        tenderId = $(this).attr('data-tender-id');
        tenderItem = $('#' + tenderId);
        tenderItem = $('#' + tenderId);
        jConfirm('Do you want to stop this tender?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'cars/StopTenderAjax',{tender_id:tenderId},function(data){
                    if(data.error == 0){
                        tenderItem.find('.btn-start-tender').addClass('hidden');
                        tenderItem.find('.btn-tender-stop').removeClass('hidden');
                        showMessage('Tender over and closed out', 0);
                    } else {
                        showMessage('Failure', 1);
                    }
                    load_hide();
                },'json');
            }
        });
    });
    
    $('#DealerList').slimscroll({
        size: '4px',
        height: '100%'
    });
    $('#CarList').slimscroll({
        size: '4px',
        height: '100%'
    });
    
    // Show list dealers
    $(document).on('click', '.btn-show-dealers', function () {
        tenderID = $(this).data('tender-id');
        load_show();
        $.get(root + 'cars/listcaroftenderajax?tender_id='+tenderID+'&view_by=0', function(data) {
            $('#DealerList').html(data);  
            $('#DealersModal').modal('show');
            load_hide();
        });
    });
    // Show list cars
    $(document).on('click', '.btn-show-cars', function () {
        tenderID = $(this).data('tender-id');
        load_show();
        $.get(root + 'cars/listcaroftenderajax?tender_id='+tenderID+'&view_by=1', function(data) {
            $('#CarList').html(data);  
            $('#CarsModal').modal('show');
            load_hide();
        });
    });
    //
    $.post(root + 'cars/StopTenderAjax',{},function(data){
        if(data.error == 0){
            tenderItem.find('.btn-start-tender').addClass('hidden');
            tenderItem.find('.btn-tender-stop').removeClass('hidden');
        } else {
            showMessage('Failure', 1);
        }
        load_hide();
    },'json');
    $.post(root + 'cars/StartTenderAjax',{},function(data){
        if(data.error == 0){
            tenderItem.find('.btn-tender-invitation').addClass('hidden');
            tenderItem.find('.btn-start-tender').removeClass('hidden');
            showMessage('Tender now in progress', 0);
        } else {
            showMessage('Failure', 1);
        }
        load_hide();
    },'json');
    $.get(root + 'cars/SendInvitationTenderAjax',{},function(data){
            action_tender = $('.btn-action-tender');
            action_tender.text(data.btn-action-tender);
            action_tender.addClass('hidden');
            action_tender.find('.btn-tender-invitation').removeClass('hidden');
            showMessage('Invitations sent', 0);
    },'json');

</script>