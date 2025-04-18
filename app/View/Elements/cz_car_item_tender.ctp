<?php
$tender = $data_tender;
$tender_name = $tender->title;
$start_date = $tender->start_date;
$end_date = $tender->end_date;
$count_dealer = $tender->count_dealer_tender;
$inspection = $tender->inspection;
$count_car_tender = $tender->count_car_tender;
$name = $tender->user_create_tender->name . ' ' . $tender->user_create_tender->last_name;
$tender_in_progress = $tender->tender_in_progress;
$is_send_invites = $tender->is_send_invites;
$view_type = $type;
?>
<div id="<?php echo $tender->_id ?>" class="tender-item col-md-12" style="height: 171px;">
    <div class="wg-car-list" style="padding: 19px">
        <div class="wg-car-img_tender" style="height: 150px;position: absolute;top: 32px;box-shadow:none">
            <h6><b><?php
                    $date = new DateTime($start_date);
                    echo $date->format('d/m/Y');
                    ?></b></h6>
            <h6><?php
                $date = new DateTime($start_date);
                echo $date->format('h.i A');
                ?></h6>
            <div class="mg-bottom-4 clearfix"></div>
            <img style="" src="<?php echo $this->webroot; ?>images/ic_clock_tender.png"/>
            <h6><b><?php
                    $date = new DateTime($end_date);
                    echo $date->format('d/m/Y');
                    ?></b></h6>
            <h6><?php
                $date = new DateTime($end_date);
                echo $date->format('h.i A');
                ?></h6></h6>
        </div>
        <div class="wg-car-info-box_tender">
            <header class="wg-info-header_tender" style="margin-bottom: 17px">
                <!--Car name-->
                <div class="wg-name-ridbon color-bg-site"></div>
                <h3 class="wg-name font-txt-header truncate"
                    title="<?php echo $tender_name ?>"> <?php echo $tender_name ?></h3>
                <!--Car price-->
                 <span class="wg-car-price_tender">
                  <?php
                  $tyleBtn = 0;
                  if ($tender_in_progress == 0) {
                      if ($is_send_invites == 0) {
                          $tyleBtn = 0;
                      } else {
                          $tyleBtn = 1;
                      }
                  } else if ($tender_in_progress == 1) {
                      $tyleBtn = 2;
                  } else {
                      $tyleBtn = 3;
                  }
                  ?>
                     <?php
                     if ($view_type == 1) {
                         ?>
                         <a href="javascript:;" data-tender-id="<?php echo $tender->_id; ?>"
                            title="Send Invitation" style="display: inline-block;"
                            class="btn-action-tender <?php echo ($tyleBtn == 0) ? '' : 'hidden' ?> data-invitation-tender">
                             <img style="height: 25px;"
                                  src="<?php echo $this->webroot; ?>images/ic_tender_st2.png"/></a>
                         <a href="javascript:;" data-tender-id="<?php echo $tender->_id; ?>"
                            title="Start Tender" style="display: inline-block;"
                            class="btn-tender-invitation <?php echo ($tyleBtn == 1) ? '' : 'hidden' ?> data-start-tender">
                             <img style="height: 25px;"
                                  src="<?php echo $this->webroot; ?>images/ic_tender_st1.png"/></a>

                         <a href="javascript:;" data-tender-id="<?php echo $tender->_id; ?>"
                            title="Stop Tender" style="display: inline-block;"
                            class="btn-start-tender <?php echo ($tyleBtn == 2) ? '' : 'hidden' ?> data-stop-tender">
                             <img style="height: 25px;"
                                  src="<?php echo $this->webroot; ?>images/ic_tender_st3.png"/></a>
                         <a class="btn-tender-stop <?php echo ($tyleBtn == 3) ? '' : 'hidden' ?>"><img
                                 style="height: 25px;" src="<?php echo $this->webroot; ?>images/ic_tender_st4.png"/></a>
                     <?php } else {
                         ?>
                         <img class="btn-action-tender <?php echo ($tyleBtn == 0) ? '' : 'hidden' ?>" style="height: 25px;"
                                  src="<?php echo $this->webroot; ?>images/ic_tender_st2.png"/>

                         <img class="btn-tender-invitation <?php echo ($tyleBtn == 1) ? '' : 'hidden' ?> " style="height: 25px;"
                              src="<?php echo $this->webroot; ?>images/ic_tender_st1.png"/>

                         <img class="btn-start-tender <?php echo ($tyleBtn == 2) ? '' : 'hidden' ?>" style="height: 25px;"
                              src="<?php echo $this->webroot; ?>images/ic_tender_st3.png"/>
                         <a disabled class="btn-tender-stop <?php echo ($tyleBtn == 3) ? '' : 'hidden' ?>"><img
                                 style="height: 25px;" src="<?php echo $this->webroot; ?>images/ic_tender_st4.png"/></a>

                     <?php } ?>
                     ?>

                </span>
            </header>
            <div class="wg-car-info tender">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " style="margin-bottom: 5px">
                    <img style="height: 20px; vertical-align: bottom;" src="<?php echo $this->webroot; ?>images/ic_inpestion.png"/>
                    <span><?php if ($inspection == "") {
                            echo "Not set";
                        } else {
                            echo $inspection;
                        } ?></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-bottom: 5px">
                    <a data-tender-id="<?php echo $tender->_id ?>" class="btn-show-dealers no-decoration" style="color: #333;" href="javascript:;">
                        <img style="height: 20px; vertical-align: bottom;" src="<?php echo $this->webroot; ?>images/ic_dealer_tender.png"/>
                        <span><?php echo $count_dealer; ?> dealer(s) </span>
                    </a>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <a data-tender-id="<?php echo $tender->_id ?>" class="btn-show-cars no-decoration" style="color: #333;" href="javascript:;">
                        <img style="height: 20px; vertical-align: bottom;" src="<?php echo $this->webroot; ?>images/ic_car_type.png"/>
                        <span><?php echo $count_car_tender; ?> car(s)</span>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <a class="no-decoration" style="color: #333;" href="<?php echo ($view_type == 1)? $this->html->url('/myprofile') : $this->html->url('/users/userprofile?user_id=' . $tender->user_create_tender->_id) ?>">
                        <img style="height: 20px; vertical-align: bottom;" src="<?php echo $this->webroot; ?>images/ic_owner_tender.png"/>
                        <span><?php
                            if ($view_type == 1) {
                                echo 'me';
                            } else {
                                echo $name;
                            }

                            ?>   </span>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
            <span class="wg-car-price color-site-imp dis-none-min-641">


            </span>
            <div class="btn-view-detail btn-view-tender" style="position: absolute; bottom: -22px; right: -3px;">
                <!--                <a style="display: inline-block; width: 162px;" href=" " class="btn-view-car-detail color-bg-btn-hover">VIEW CAR DETAILS<span class="fa fa-angle-right"></span></a>-->
                <a href="<?php echo $this->Html->Url('/cars/listcaroftender?tender_id='.$tender->_id.'&type='.$view_type) ?>" style="display: inline-block; width: 140px; margin-left: 8px;" href="  "
                   class="btn-offer-buy btn-view-car-detail color-bg-btn-hover">VIEW TENDER<span
                        class="fa fa-angle-right"></span></a>
            </div>

        </div>
    </div>
    <div class="line-div" style="height: 2px;background-color: #0e1f2a4d;">
    </div>
</div>
<script>
    $.post(root + 'cars/getlisttender',{},function(data){
        if(data.error == 0){
            tenderItem.find('.btn-start-tender').addClass('hidden');
            tenderItem.find('.btn-tender-stop').removeClass('hidden');
        } else {
            showMessage('Failure', 1);
        }
        load_hide();
    },'json');
</script>