<?php if($list != '') : ?>
    <?php
    foreach ($list as $data) {
        echo $this->element('cz_car_item_post', array('data' => $data));
    }
    ?>
    <div class="clearfix mg-bottom-50"></div>
<?php else : ?>
    <div class="text-center font-size-24"><span>No data to display</span></div>
<?php endif; ?>

<script>
    resetViewData();
</script>