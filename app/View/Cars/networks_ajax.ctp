    <?php
    foreach ($networks as $network) { ?>
        <div class="form-group line_group1 item-checkbox">
            <div class="col-lg-1 col-xs-2 icon no-padding">
                <?php
                    echo $this->Html->image('/images/no_car.png',array('width'=>'50','height' => '50', 'class' => 'img-circle'));
                ?>
        </div>
        <div class="col-lg-10 col-xs-6 ">
            <?php echo $network->name;?> <br>
        </div>
        <div class="col-lg-10 col-xs-6 ">
            <?php echo $network->company_info->company_name;?> <br>
        </div>
        <div class="col-lg-1 col-xs-2  pull-right pos-rel">
            <input class="network-group-ids" type="checkbox" name="arr_tender_dealer[]" value=<?php echo $network->_id ?> onclick="return false" >
            <div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0"></div>
        </div>
        </div>
    <?php  } ?>
