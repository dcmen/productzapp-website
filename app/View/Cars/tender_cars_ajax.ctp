<?php if ($list && sizeof($list) > 0) : ?>
    <?php foreach($list as $data) {
        echo $this->element('cz_car_detail_selection_modal', array('data' => $data, 'hide_check_box' => true));
    } ?>
<?php else : ?>
    <div>No data loaded</div>
<?php endif; ?>
<div class="clearfix"></div>