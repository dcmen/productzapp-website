<div class="main-page">
    <?php echo $this->element('cz_menu_bar_network_add'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="NetWorkPage" class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow data-content" style="padding: 30px 20px 30px;">
                <div class="msg-1" style="text-align: center; font-size: 16px;">
                    Type a name or keyword to search for Dealers in Carzapp, to add to your Network
                </div>
                <!--<div class="msg-2" style="display: none;">
                    Select from result below
                </div>-->
                <div class="msg-3" style="text-align: center; margin-bottom: 16px; font-size: 16px; display: none;">
                    Your invitation/s successfully sent to:
                </div>
                
                <div id="DealerTable" class="table-responsive col-xs-12">
                    
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-2 total-datatable no-padding" style="display: none;"><span>Total:</span> <strong class="total-count count-dealer"></strong></div>

                <div class="col-lg-10 col-xs-12 no-padding text-right group-btn-action-table" style="display: none;">
                    <div class="show-inbl">
                        <a href="javascript:;" type="submit" class="submit_network kb-btn-02 color-bg-site pull-right">Send Invitation<span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>

            <div class="mg-top-50 text-center font-size-24 message-nodata"><span>No dealer to display</span></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.submit_search_input').keypress(function (e) {
            if (e.which == 13) {
                $('.search_mynetwork').click();
            }
        });
        
        $('.search_mynetwork').click(function () {
            keywork = $('.submit_search_input').val();
            if (keywork) {
                urlAjax = root + 'networks/add_network?keywork=' + keywork + '&ajax=1';
                load_show();
                $.get(urlAjax, function( data ) {
                    $('#DealerTable').html(data);
                    //$("html, body").animate({ scrollTop: 0 }, "slow");
                    load_hide();
                });
            }
        });
        
        $('.submit_network').click(function() {
            var $Ids = $("input.cb-emails:checkbox:checked").map(function(){
                return $(this).val();
            }).get();
            if ($Ids == '') {
                showMessage('Please choose dealer', 1);
                return false;
            }
            else {
                load_show();
                $.post(root + 'networks/send_invite_network', $('#AddDealerForm').serialize(), function(data){
                    if (data.error == 0) {
                        $("input.cb-emails:checkbox").map(function(){
                            if (!$(this).is(':checked')) {
                                $(this).closest('tr').hide();
                            }
                        });
                        $('.cb-emails').hide();
                        
                        $('.flt-menu-back').show();
                        $('.flt-menu-search').hide();
                        
                        $('.msg-3').show();
                        
                        $('.group-btn-action-table').hide();
                        $('.total-datatable').hide();
                        
                        $('.txt-title-page').text('Invitation Sent');
                    }
                    else {
                        showMessage('Failure', 1);
                    }

                    load_hide();
                }, 'json');
            }
        });
    });
</script>