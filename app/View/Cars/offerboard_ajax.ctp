<?php foreach ($list as $data) : ?>
    <?php echo $this->element('cz_car_item_offerboard', array('data' => $data, 'view_type' => $type)); ?>
<?php endforeach; ?>