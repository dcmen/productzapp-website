<?php
    if (!isset($view_type)) {
        $view_type = 3; // 0,1 - show normal; 2 - show company name;3-Show car in analysis;
    }
?>
<div id="flickaViewList">
<?php foreach($list as $data) : ?>
    <?php if (isset($view_type) && $view_type == 0){ ?>
    <?php echo $this->element('cz_car_item_list', array('data' => $data));}
    elseif((isset($view_type) && $view_type == 3)){?>
    <?php echo $this->element('cz_car_item_list_analysis', array('data' => $data));} else{?>
    <?php echo $this->element('cz_car_item_list_stock', array('data' => $data, 'view_type' => $view_type)); ?>
    <?php } ?>
<?php endforeach; ?>
</div>