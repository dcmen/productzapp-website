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
<script>
    // update data
    curPage = <?php echo $page?>;
    maxPage = <?php echo $maxpages?>;

    // update menubar
    $('.total-count').text(<?php echo $total ?>);

    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'listdealersentoffer', container = '#OffersTable');
</script>