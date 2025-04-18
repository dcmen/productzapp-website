<div class="main-page">
    <?php echo $this->element('cz_menu_bar_network'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="NetWorkPage" class="pd-content-01">
        <div class="col-lg-12">
            <?php if($total > 0) : ?>
            <div class="wg-box-shadow network-content data-content" style="padding: 30px 20px 40px;">
                <?php echo $this->Form->create('Network'); ?>
                    <div id="MyNetworkTable" class="table-responsive col-xs-12">
                        <table cellspacing="0" id="tech-companies-1" class="table customer table-card">
                            <thead>
                                <th style="width: 95px;">Avatar</th>
                                <th>Name</th>
                                <th>Dealership</th>
                                <th class="text-right">Actions</th>
                            </thead>
                            <tbody class="result_search_network">
                                <?php 
                                if($list != ''){
                                    foreach($list as $rs):
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo $this->html->url('/users/userprofile?user_id=' . $rs->_id) ?>" style="padding: 0">
<!--                                            <img src="--><?php //echo (isset($rs->avatar) && $rs->avatar)? $rs->avatar : $this->webroot . 'images/no-avatar.png' ?><!--" class="img-circle" style="width: 40px; height: 40px;" />-->
                                            <img src="<?php echo (isset($rs->avatar)  && $rs->avatar) ? $rs->avatar : $this->webroot . 'images/no-avatar.png' ?>" onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no-avatar.png';" class="img-circle" style="width: 40px; height: 40px;" />
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo $this->html->url('/users/userprofile?user_id=' . $rs->_id) ?>" style="padding: 0"><?php echo $rs->name?></a>
                                    </td>
                                    <td><?php echo (isset($rs->company_name) && $rs->company_name)? $rs->company_name : '' ?></td>
                                    <td align="right">
                                        <a title="View Stock" href="<?php echo $this->html->url('/view_stock?id=' . $rs->company_id) ?>"><i class="fa fa-car color-site" style="font-size: 14px;"></i></a>
                                        <a title="Remove" href="javascript:;" class="btn-remove-network mg-right-8" user-id="<?php echo $rs->_id?>"><i class="fa fa-times color-red"></i></a>
                                    </td>
                                </tr>    
                                <?php endforeach; }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-2 total-datatable no-padding"><span>Total:</span> <strong class="total-count count-dealer"><?php echo count($list) ?></strong></div>

                    <div class="col-lg-10 col-xs-12 no-padding text-right">
                        <div class="show-inbl width-120">
                            <a href="<?php echo $this->Html->Url('/group')?>" type="submit" class="kb-btn-02 color-bg-site pull-right">Groups<span class="fa fa-angle-right"></span></a>
                        </div>
                    </div>

                    <?php if ($maxpages > 1) :  ?>
                    <div class="cz-pagination"></div>
                    <?php endif; ?>

                <?php echo $this->Form->end()?>
                <div class="clearfix"></div>
            </div>
            <?php endif; ?>

            <div class="mg-top-50 msg-no-data text-center font-size-24 <?php echo ($total > 0)? 'dis-none' : '' ?>"><span>No dealer to display</span></div>
        </div>
    </div>
</div>

<script>
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    
    $(document).ready(function () {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'mynetwork', container = '#MyNetworkTable');

        $('.search_mynetwork').click(function () {
            $('#SearchMynetwork').submit();
        });
    });
    
    $(document).on('click', '.btn-remove-network', function () {
        member_id = $(this).attr('user-id');
        item = $(this);
        jConfirm('Remove this Dealer from My Network. To confirm click OK.','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'network_del',{id:member_id}, function(data){
                    load_hide();
                    if(data.error == 0){
                        // update number of dealers
                        countDealer = parseInt($('.count-dealer').text());
                        if (countDealer > 0) {
                            $('.count-dealer').text(--countDealer);
                            if (countDealer === 0) {
                                //$('#NetworkMynetworkForm').hide();
                                showNodata();
                            }
                        }
                        
                        // remove row contain dealer
                        item.closest('tr').fadeOut('slow', function() {
                            $(this).remove();
                            // show message and refresh page
                            if (countDealer > 0 && $('tbody > tr').length === 0) {
                                showMessage('Removed successfully', 0, function () {
                                    if (countDealer > 0 && $('tbody > tr').length === 0) {
                                        curPage = (curPage < maxPage)? curPage : --curPage;
                                        curPage = (curPage < 1)? 1 : curPage;
                                        maxPage--;

                                        loadHTMLAjax('mynetwork', $.extend(parasOnLink, {page:curPage, ajax:1}), container = '#MyNetworkTable');
                                    }
                                    else {
                                        load_hide();
                                    }
                                });
                            }
                            else {
                                showMessage('Removed successfully', 0);
                            }
                            
                            load_hide();
                        });
                    }else{
                        showMessage('Failure', 1);
                    }
                },'json');
            }
        });
    });
</script>