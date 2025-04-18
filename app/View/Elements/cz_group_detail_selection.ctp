<?php
debug($data);die();
$group = $data->network_groups;
$group_name=$group->name;
$view = $data->views;
?>
<div id="<?php echo $group->_id ?>" class="col-md-12 mg-bottom-20 no-padding item-checkbox car-detail-selection cursor-pointer" style="border-bottom: 1px solid #aaa;padding-bottom: 18px; cursor: pointer;">
    <div class="wg-car-detail">
        <div class="wg-car-img" >
            <!--car image-->
            <img src="<?php echo (isset($group->image_url)  && $group->image_url) ? $group->image_url : $this->webroot . 'images/no_car.png' ?>">
        </div>
        <div class="wg-car-info-box">
            <header class="wg-info-header">
                <!--Car name-->
                <div class="wg-name-ridbon color-bg-site"></div>
                <h2 class="wg-name font-txt-header truncate" title="<?php echo $group_name ?>"><?php echo $group_name ?></h2>
                <!--Car price-->
            </header>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
