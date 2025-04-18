<?php if ($list && sizeof($list) > 0) : ?>
<?php foreach($list as $rs): ?>
    <div class="form-group line_group cursor-pointer item-checkbox">
        <div class="col-xs-2 col-lg-2 icon">
            <?php
            if($rs->avatar != ''){
                echo '<img class="img-circle" src="'.$rs->avatar.'" style="width: 40px;height: 40px">';
            }else{
                echo $this->Html->image('/images/no_car.png',array('width'=>'50','height' => '50', 'class' => 'img-circle'));
            }
            ?>
        </div>
        <div class="col-xs-6 col-lg-9">
            <?php echo $rs->name ?> <br>
            <?php echo $rs->company_info->company_name ?>
        </div>
        <div class="col-xs-2 col-lg-1 text-left no-padding middle">
            <input type="checkbox" name="arr_tender_dealer[]" class="dealer-ids" value="<?php echo $rs->_id?>">
        </div>
    </div>
<?php endforeach; ?>
<?php else : ?>
    <div>No data loaded</div>
    <script>
        $('.group-btn-action').hide();
    </script>
<?php endif; ?>
<div class="clearfix"></div>