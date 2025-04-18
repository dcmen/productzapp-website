<?php foreach ($list as $data) : ?>
    <?php echo $this->element('cz_car_item_tender', array('data_tender' => $data, 'view_type' => $type)) ?>
<?php endforeach; ?>
 