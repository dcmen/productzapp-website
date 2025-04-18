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
?>
<div id=" ">
    <div style="box-shadow: none;padding: 0px 0px 20px;" class="wg-car-list">
        <div class="wg-car-img_tender" >
            <h6><?php
                $date = new DateTime($start_date);
                echo $date->format('d/m/Y');
                ?></h6>
            <h6 class=""><?php
                $date = new DateTime($start_date);
                echo $date->format('h.i A');
                ?></h6>
            <div class="mg-bottom-4 clearfix"></div>
            <img style="" src="<?php echo $this->webroot; ?>images/ic_clock_tender.png"/>
            <h6><?php
                $date = new DateTime($end_date);
                echo $date->format('d/m/Y');
                ?></h6>
            <h6 class=""><?php
                $date = new DateTime($end_date);
                echo $date->format('h.i A');
                ?></h6>
        </div>
        <div class="wg-car-info-box_tender">
            <header class="wg-info-header_tender">
                <div class="wg-name-ridbon color-bg-site"></div>
                <h3 class="wg-name font-txt-header truncate"
                    title="<?php echo $tender_name ?>"> <?php echo $tender_name ?></h3>
            <span class="wg-car-price_tender">
                  <?php
                  if ($tender_in_progress == 0) {
                      if ($is_send_invites == 0) {
                          ?>
                          <img style="height: 25px;" src="<?php echo $this->webroot; ?>images/ic_tender_st2.png"/>
                          <?php
                      } else { ?>
                          <img style="height: 25px;" src="<?php echo $this->webroot; ?>images/ic_tender_st1.png"/>
                      <?php }
                  } else if ($tender_in_progress == 1) { ?>
                      <img style="height: 25px;" src="<?php echo $this->webroot; ?>images/ic_tender_st3.png"/>
                      <?php
                  } else { ?>
                      <img style="height: 25px;" src="<?php echo $this->webroot; ?>images/ic_tender_st4.png"/>
                      <?php
                  }
                  ?>
                </span>
            </header>


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-bottom: 5px">
                <img style="height: 20px" src="<?php echo $this->webroot; ?>images/ic_inpestion.png"/>
                <span><?php if($inspection==""){echo "Not set"; }else{echo $inspection;}  ?></span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-bottom: 5px">
                <img style="height: 20px;" src="<?php echo $this->webroot; ?>images/ic_dealer_tender.png"/>
                <span><?php echo $count_dealer; ?> dealer(s) </span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <img style="height: 20px;" src="<?php echo $this->webroot; ?>images/ic_car_type.png"/>
                <span><?php echo $count_car_tender; ?> car(s)</span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <img style="height: 20px;" src="<?php echo $this->webroot; ?>images/ic_owner_tender.png"/>
                <span><?php echo $name; ?>   </span>
            </div>


        </div>

    </div>
</div>
