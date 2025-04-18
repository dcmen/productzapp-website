<div class="main-page">
    <?php echo $this->element('cz_menu_bar_network_block'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="BlockNetWorkPage" class="pd-content-01">
        <div class="col-lg-12">
            <?php if(count($list)>0) : ?>
            <div class="wg-box-shadow network-content data-content" style="padding: 30px 20px 40px;">
                <div id="BlockTable" class="table-responsive col-xs-12">
                    <table cellspacing="0" id="tech-companies-1" class="table customer table-card">
                        <thead>
                            <th style="width: 95px;">Avatar</th>
                            <th>Name</th>
                            <th>Dealership</th>
                            <th class="text-right">Action</th>
                        </thead>
                        <tbody class="result_search_network">
                            <?php foreach ($list as $dealer) : ?>
                            <tr>
                                <td>
                                    <img src="<?php echo (isset($dealer->avatar) && $dealer->avatar)? $dealer->avatar : $this->webroot . 'images/no-avatar.png' ?>" class="img-circle" style="width: 40px; height: 40px;" />
                                </td>
                                <td><?php echo $dealer->name?></td>
                                <td><?php echo $dealer->company_name?></td>
                                <td align="right">
                                    <a title="Unblock Dealer" href="javascript:;" class="un_blockuser" user-id="<?php echo $dealer->_id?>"><i class="fa fa-unlock color-orange"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-2 total-datatable no-padding"><span>Total:</span> <strong class="total-count count-dealer"><?php echo $total ?></strong></div>

                <?php // if ($maxpages > 1) :  ?>
                    <!--<div class="cz-pagination"></div>-->
                <?php // endif; ?>

                <div class="clearfix"></div>
            </div>
            <?php endif; ?>

            <div class="mg-top-50 text-center font-size-24 <?php echo ($total > 0)? 'dis-none' : '' ?>"><span>No dealer to display</span></div>    
        </div>
    </div>
</div>
<script type="text/javascript">
//    var curPage = <?php // echo $page?>;
//    var maxPage = <?php // echo $maxpages?>;
    
    Vcore.Customer();
    
//    $(document).ready(function () {
//        initPagination(maxPage, curPage, maxVisible = 5, 'block_network', '#BlockTable');
//    });
</script>