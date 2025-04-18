<?php if ($list && sizeof($list) > 0) : ?>
<?php foreach($list as $rs): ?>
    <div class="form-group line_group cursor-pointer">
        <div class="col-lg-2 col-xs-2 icon">
            <?php
            if($rs->avatar != ''){
                echo '<img class="img-circle" src="'.$rs->avatar.'" style="width: 40px;height: 40px">';
            }else{
                echo $this->Html->image('/images/no_car.png',array('width'=>'50','height' => '50', 'class' => 'img-circle'));
            }
            ?>
        </div>
        <div class="col-lg-10 col-xs-10">
            <a href="<?php echo $this->html->url('/users/userprofile?user_id=' . $rs->_id) ?>"><?php echo $rs->name ?></a> <br>
            <?php echo $rs->company_info->company_name ?>
        </div>
    </div>
<?php endforeach; ?>
<?php else : ?>
    <div>No data loaded</div>
<?php endif; ?>
<div class="clearfix"></div>