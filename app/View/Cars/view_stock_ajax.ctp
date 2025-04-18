<div class="mg-bottom-40"></div>
            
<?php if ($list) : ?>
    <?php echo $this->element('cz_cars_list', array('list' => $list, 'view_type' => 2)); ?>
<?php else : ?>
    <div class="mg-top-50 text-center font-size-24"><span>No car to display</span></div>
<?php endif; ?>