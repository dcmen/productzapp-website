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
                <?php // elseif ($rs->offer_info->offer_status == 3) : ?>
                    <!--<a href="javascript:;" class="btn-send-offer" data-offer-id="<?php // echo $rs->offer_info->offer_id ?>" data-car-id="<?php // echo $carId ?>" title="Send Offer" ><i class="fa fa-reply color-site"></i></a>-->
                <?php endif; ?>
                <?php if ($rs->offer_info->is_tender == true) : ?>
                    <a href="<?php echo $this->Html->Url('/cars/listofferbuyingviewtender?car_id=' . $rs->offer_info->car_id . '&company_id=' . CakeSession::read('Auth.User.company_id').'&tender_id='.$rs->offer_info->tender_id.'&filter='.$filter ) ?>" title="View Offer Tender"><img style="height: 14px;" src="<?php echo $this->webroot; ?>images/ic_T.png" /></a>
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

    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'listofferbuying', container = '#OffersTable');
</script>