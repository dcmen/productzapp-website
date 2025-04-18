<?php if ($list && sizeof($list) > 0) : ?>
    <?php foreach($list as $data) {
        echo $this->element('cz_car_detail_selection_modal', array('data' => $data));
    } ?>
<?php else : ?>
    <div>No data loaded</div>
    <script>
        $('.group-btn-action').hide();
    </script>
<?php endif; ?>
<div class="clearfix"></div>