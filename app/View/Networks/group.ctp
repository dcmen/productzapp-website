<div class="main-page">
    <?php // echo $this->element('cz_breadcrumb'); ?>
    <?php // echo $this->element('cz_title_page'); ?>

    <?php echo $this->element('cz_menu_bar_group'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="CustomerPage" class="pd-content-01">
        <div class="col-lg-12">
            <?php if ($list != '') : ?>
            <div class="wg-box-shadow group-content data-content" style="padding: 30px 20px 40px;">
                <div id="GroupContainer" class="table-responsive col-xs-12">
                    <table cellspacing="0" class="table group">
                        <thead>
                            <th>No.</th>
                            <th>Group Name</th>
                            <th>Number of Members</th>
                            <th class="text-right">Action</th>
                        </thead>

                        <tbody>
                            <?php $i = $limit*($page-1) ?>
                            <?php foreach($list as $rs) :?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><a style="padding: 0px;" class="no-underline-hover" href="<?php echo $this->Html->Url('/group_detail/'.$rs->_id)?>"><?php echo $rs->name ?></a></td>
                                <td><?php echo $rs->count_member?></td>
                                <td class="text-right">
                                    <a title="View Group" href="<?php echo $this->Html->Url('/group_detail/'.$rs->_id)?>" class="mg-right-8"><i class="fa fa-eye color-orange"></i></a>
                                    <a title="Edit Group" href="<?php echo $this->Html->Url('/group_detail/'.$rs->_id . '?editgroup=1')?>" class="mg-right-8"><i class="fa fa-pencil-square-o color-orange"></i></a>
                                    <a title="Delete Group" href="javascript:;" group-id="<?php echo $rs->_id?>" class="del_group"><i class="fa fa-times color-red"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-2 total-datatable no-padding"><span>Total:</span> <strong class="total-count count-group"><?php echo $total ?></strong></div>

                <div class="clearfix"></div>

                <?php if ($maxpages > 1) :  ?>
                <div class="cz-pagination"></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="msg-no-data mg-top-50 text-center font-size-24 <?php echo (count($list)>0)? 'dis-none' : '' ?>"><span>No data to display</span></div>    
        </div>
    </div>
</div>

<script type="text/javascript">
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    
    $(document).ready(function () {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'group', container = '#GroupContainer');
        
        $(document).on('click', '.del_group', function () {
            id = $(this).attr("group-id");
            item = $(this);
            jConfirm('Are you sure you want to delete this group?','Message',function(r) {
                if(r){
                    load_show();
                    $.post('networks/deletegroup',{'id':id},function(data) {
                        if(data.error == 0){
                            // remove group
                            item.closest('tr').fadeOut('slow', function() {
                                $(this).remove();
                                
                                countGroup = parseInt($('.count-group').text());
                                if (countGroup > 0) {
                                    $('.count-group').text(--countGroup);
                                    if (countGroup == 0) {
                                        showNodata();
                                    }
                                }

                                // show message and refresh page
                                showMessage('Deleted successfully', 0, function () {
                                    // if current page has no car => load new page data
                                    if ($('#GroupContainer').children('.item_group').length === 0) {
                                        // set current page
                                        curPage = (curPage < maxPage)? curPage : --curPage;
                                        curPage = (curPage < 1)? 1 : curPage;
                                        // update max page
                                        maxPage--;
                                        // load ajax
                                        loadHTMLAjax('group', $.extend(parasOnLink, {page:curPage, ajax:1}), container = '#GroupContainer');
                                    }
                                });
                                
                                load_hide();
                            });
                            
//                            showMessage('Deleted successfully', 0);
//                            window.location.href = root + 'group?page=<?php // echo $page?>';
                        }else{
                            showMessage(data.msg, 1);
                        }
                    },'json');
                }
            });
        });
    });
</script>