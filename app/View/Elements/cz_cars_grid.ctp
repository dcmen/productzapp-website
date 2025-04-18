<div id="flickaViewGrid">
<?php foreach($list as $data) : ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mg-bottom-30">
        <?php echo $this->element('cz_car_item_grid', array('data' => $data)); ?>
    </div>
<?php endforeach; ?>
</div>