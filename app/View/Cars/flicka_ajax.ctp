<?php if ($list) { foreach($list as $data) {
    echo $this->element('cz_car_item_list', array('data' => $data, 'hide_btn_follow' => true)); 
}} ?>