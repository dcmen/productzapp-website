<div class="mg-bottom-40"></div>

<?php if ($list) : ?>
    <div class="dis-none-max-640">
        <?php echo $this->element('cz_cars_list', array('list' => $list)); ?>
    </div>
    <div class="dis-block-max-640 dis-none-min-641">
        <?php echo $this->element('cz_cars_grid', array('list' => $list)); ?>
    </div>
<?php else : ?>
    <div class="mg-top-50 text-center font-size-24"><span>No car to display</span></div>
<?php endif; ?>