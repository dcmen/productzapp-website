<div class="main-page">
    <?php echo $this->element('cz_menu_bar_network_request'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="RequestNetWorkPage" class="pd-content-01">
        <div class="col-lg-12">
            <?php if($total > 0) : ?>
            <div class="wg-box-shadow network-content data-content" style="padding: 30px 20px 40px;">
                <div id="RequestTable" class="table-responsive col-xs-12" data-pattern="priority-columns">
                    <table cellspacing="0" id="tech-companies-1" class="table customer table-card">
                        <thead>
                            <th style="width: 50px; display: none;">No.</th>
                            <th style="width: 95px;">Avatar</th>
                            <th>Name</th>
                            <th>Dealership</th>
                            <th style="width: 250px;">Status</th>
                            <th style="width: 120px;" class="text-right">Action</th>
                        </thead>
                        <tbody>
                            <?php $i = ($page - 1) * $limit ; ?>
                            <?php foreach ($list as $rs) : $i++; ?>
                                <tr>
                                    <td data-card-display="hide" align="text-left" class="hidden"><?php echo $i ?></td>
                                    <td>
                                        <a href="<?php echo $this->html->url('/users/userprofile?user_id=' . $rs->_id) ?>" style="padding: 0">
                                            <img src="<?php echo (isset($rs->avatar) && $rs->avatar)? $rs->avatar : $this->webroot . 'images/no-avatar.png' ?>" class="img-circle" style="width: 40px; height: 40px;" />
                                        </a>
                                    </td>
                                    <td><a href="<?php echo $this->html->url('/users/userprofile?user_id=' . $rs->_id) ?>" style="padding: 0"><?php echo $rs->name ?></a></td>
                                    <td><?php echo $rs->company_info->company_name ?></td>
                                    <td><?php echo ($rs->is_received)? 'Request Received' : 'Request Sent' ?></td>
                                    <td class="text-right">
                                        <?php if (!$rs->is_received) : ?>
                                        <a title="Resend" href="javascript:;" class="btn-resend-invite mg-right-8"
                                                data-invite-id="<?php echo $rs->_id ?>"
                                                data-sender-id="<?php echo CakeSession::read('Auth.User._id') ?>"
                                                data-sender-name="<?php echo CakeSession::read('Auth.User.name') ?>"
                                                data-request-email="<?php echo $rs->email ?>">
                                            <i class="fa fa-reply-all color-orange"></i>
                                        </a>
                                        <a title="Cancel" href="javascript:;" invi_id="<?php echo $rs->invited_id ?>" class="del_invite"><i class="fa fa-times color-red"></i></a>
                                        <?php else : ?>
                                        <a title="Accept" href="javascript:;" request_id="<?php echo $rs->_id ?>" request_email="<?php echo $rs->email ?>" class="accept_invite mg-right-8"><i class="fa fa-check color-orange"></i></a>
                                        <a title="Cancel" href="javascript:;" invi_id="<?php echo $rs->invited_id ?>" class="del_invite"><i class="fa fa-times color-red"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-2 total-datatable no-padding"><span>Total:</span> <strong class="total-count count-result"><?php echo $total ?></strong></div>
                <div class="clearfix"></div>
                <?php if ($maxpages > 1) :  ?>
                <div class="cz-pagination"></div>
                <?php endif; ?>
                    
                <div class="clearfix"></div>
            </div>
            <?php endif; ?>

            <div class="mg-top-50 text-center font-size-24 <?php echo ($total > 0)? 'dis-none' : '' ?>"><span>No data to display</span></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    Vcore.Addnetwork();
    
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    
    $(document).on('click', '.del_invite', function () {
        id = $(this).attr('invi_id');
        var item = $(this);
        jConfirm('Are you sure want to cancel this invitation?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'InviteNetworks/delete',{'id':id},function(data){
                    // update menubar count-result
                    countRS = parseInt($('.total-count').text());
                    if (countRS > 0) {
                        $('.total-count').text(--countRS);
                    }
                    if (countRS == 0) {
                        $('.data-content').hide();
                        $('#RequestNetWorkPage').append('<div class="mg-top-50 text-center font-size-24"><span>No data to display</span></div>');
                    }
                    
                    // remove row contain dealer
                    item.closest('tr').fadeOut('slow', function() {
                        $(this).remove();
                        // show message and refresh page
                        if (countRS > 0 && $('tbody > tr').length === 0) {
                            showMessage('Successfully', 0, function () {
                                curPage = (curPage < maxPage)? curPage : --curPage;
                                curPage = (curPage < 1)? 1 : curPage;
                                maxPage--;

                                loadHTMLAjax('request_network', $.extend(parasOnLink, {page:curPage, ajax:1}), container = '#RequestTable');
                            });
                        }
                        else {
                            showMessage('Successfully', 0);
                        }
                    });

                    load_hide();
                });
            }
        });
        return false;
    });
    
    $(document).on('click', '.accept_invite', function () {
        id = $(this).attr('request_id');
            request_email = $(this).attr('request_email');
            var item = $(this);
            jConfirm('Are you sure want to accept this invitation?','Message',function(r) {
                if(r){
                    load_show();
                    $.post(root + 'InviteNetworks/accept_invite',{'id':id,'request_email':request_email},function(data){
                        // update menubar count-result
                        countRS = parseInt($('.count-result').text());
                        if (countRS > 0) {
                            $('.count-result').text(--countRS);
                        }
                        if (countRS == 0) {
                            $('.data-content').hide();
                            $('#RequestNetWorkPage').append('<div class="mg-top-50 text-center font-size-24"><span>No data to display</span></div>');
                        }
                        
                        // remove row contain dealer
                        item.closest('tr').fadeOut('slow', function() {
                            $(this).remove();
                            // show message and refresh page
                            if (countRS > 0 && $('tbody > tr').length === 0) {
                                showMessage('Successfully', 0, function () {
                                    curPage = (curPage < maxPage)? curPage : --curPage;
                                    curPage = (curPage < 1)? 1 : curPage;
                                    maxPage--;

                                    loadHTMLAjax('request_network', $.extend(parasOnLink, {page:curPage, ajax:1}), container = '#RequestTable');
                                });
                            }
                            else {
                                showMessage('Successfully', 0);
                            }
                        });
                        
                        load_hide();
                    });
                }
            });
            return false;
    });
    
    $(document).ready(function(){
        initPagination(maxPage, curPage, maxVisible = 5, url = 'request_network', container = '#RequestTable');
    });
</script>