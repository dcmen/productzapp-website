<?php $url = $this->params->url?>
<div class="cars index">
    <div class="wrap_content">
        <div class="col-xs-12">
            <div class="title_response ridbon">
                <?php echo $this->Html->image('/images/transaction22.png')?> Transfers
            </div>
        </div>
        <div id="Transfers" class="col-xs-12">
            <div class="col-xs-12 tab-a no-padding">
                <div class="col-xs-6 col-lg-3 no-padding">
                    <a class="<?php echo ($type == 'transferring')?'current':''?> col-xs-12 text-center" href="<?php echo $this->Html->Url('/transfer?type=transferring')?>">Transferring</a></div>
                <div class="col-xs-6 col-lg-3 no-padding">
                    <a class="<?php echo ($type == 'transfered')?'current':''?> col-xs-12 text-center" href="<?php echo $this->Html->Url('/transfer?type=transfered')?>">Transferred</a></div>
            </div>
            <?php 
            if(count($list) > 0){
            foreach($list as $rs):
            ?>
            <div class="col-xs-12 no-padding">
                <div class="row_transfer">
                    <div class="col-lg-2 col-xs-12 no-padding">
                        <a href="<?php echo $this->Html->Url('/car_detail_transfer/'.$rs->_id.'?type='.$type)?>">
                            <?php
                            if(isset($rs->image_url)){
                                echo '<img src="'.$rs->image_url.'" class="img-responsive" width="300px" />';
                            }else{
                                echo $this->Html->image('/images/no_car.png', array('class' => 'img-responsive','width'=>'300px'));
                            }
                            ?>
                        </a>    
                    </div>
                    <div class="col-lg-10 col-xs-12 no-padding">
                        <a href="<?php echo $this->Html->Url('/car_detail_transfer/'.$rs->_id.'?type='.$type)?>">
                            <div class="col-lg-8 col-xs-12 form-group"><b>Transfer to <?php echo $receiver->transfer_name?></b></div>
                            <div class="col-lg-4 col-xs-12 text-right form-group"<b><?php echo $rs->created_at?></b></div>
                            <div class="col-xs-12 form-group">
                                <?php echo $rs->manu_year.' '.$rs->make.' '.$rs->model.' '.$rs->series.' '.$rs->gearbox;?>
                            </div>
                            <div class="col-xs-12 text-right"><b>$<?php echo $rs->price?></b></div>
                        </a>
                    </div>
                </div>    
            </div>
            <?php endforeach; }?>
        </div>
    </div>
</div>
