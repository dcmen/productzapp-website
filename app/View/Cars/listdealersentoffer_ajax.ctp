<div id="OffersTable" class="table-responsive col-xs-12">
    <table class="table customer">
        <thead>
            <th>Offer Price</th>
            <th style="width: 95px;">Avatar</th>
            <th>Dealer</th>
            <th>Dealership</th>
            <th>Status</th>
            <th class="text-right">Action</th>
        </thead>
        <tbody class="result_search">
            <?php foreach($list as $rs) :  ?>
            <tr id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $rs->offer_info->car_id ?>" data-buyer-id="<?php echo $rs->offer_info->buyer_id ?>">
                <td style="line-height: 26px;">
                    <strong><?php echo (isset($rs->offer_info->make_on_offer))? '$'.number_format($rs->offer_info->make_on_offer,0,',',',') : '' ?></strong>
                    <div class="font-size-12"><?php echo $rs->offer_info->create_date_offer . ' ' . $rs->offer_info->create_time_offer ?></div>
                </td>
                <td>
                    <img src="<?php echo (isset($rs->user_info->avatar_file_name) && $rs->user_info->avatar_file_name)? $rs->user_info->avatar_file_name : $this->webroot . 'images/no-avatar.png' ?>" class="img-circle" style="width: 40px; height: 40px;" />
                </td>
                <td><?php echo $rs->user_info->name . ' - ' . $rs->user_info->phone ?></td>
                <td><?php echo $rs->user_info->company_name ?></td>
                <td class="offer-status">
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
                <td class="offer-action" align="right">
                    <?php if ($rs->offer_info->offer_status == 0) : ?>
                    <a href="javascript:;" class="btn-offer-accept" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $rs->offer_info->car_id ?>"  data-buyer-id="<?php echo $rs->offer_info->buyer_id ?>" title="Accept Offer" ><i class="fa fa-check color-orange"></i></a>
                    <a href="javascript:;" class="btn-offer-counter" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $rs->offer_info->car_id ?>" data-buyer-id="<?php echo $rs->offer_info->buyer_id ?>" title="Counter Offer" ><i class="fa fa-bolt color-site"></i></a>
                    <a href="javascript:;" class="btn-offer-reject" data-offer-id="<?php echo $rs->offer_info->offer_id ?>" data-car-id="<?php echo $rs->offer_info->car_id ?>" data-buyer-id="<?php echo $rs->offer_info->buyer_id ?>" title="Reject Offer"><i class="fa fa-times color-red"></i></a>
                    <?php endif; ?>
                    <?php if($rs->offer_info->is_tender): ?>
                        <a href="<?php echo $this->Html->Url('/cars/listdealersentofferviewtender?car_id=' . $rs->offer_info->car_id .'&tender_id='.$rs->offer_info->tender_id .'&filter='.$filter) ?>" title="View Offer Tender"><img style="height: 14px;" src="<?php echo $this->webroot; ?>images/ic_T.png" /></a>
                   <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    // update data
    curPage = <?php echo $page?>;
    maxPage = <?php echo $maxpages?>;
    
    // update menubar
    $('.total-count').text(<?php echo $total ?>);
    
    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'listdealersentoffer', container = '#OffersTable');
</script>