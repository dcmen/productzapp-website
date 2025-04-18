<script type="text/javascript" src="js/price_format.js"></script>
<div class="ridbon">
    <?php echo $this->Html->image('/images/ic_circarr25.png')?> Flicka
</div>
<div class="wrap_content">
    <?php echo $this->element('filterflicka')?>
    <div id="Flicka">
        <?php 
        $i=1;
        $rs = $flicka_car_0[0];
        $title = $rs['Car']['manu_year'].' '.$rs['Car']['make'].' '.$rs['Car']['model'].' '.$rs['Car']['series'].' '.$rs['Car']['gearbox'];
        $this->user_id = $this->Session->read("Auth.User.id");
        $car_id = $rs['Car']['id'];
        $follow = ClassRegistry::init('FollowedCar')->query("select * from followed_cars where user_id = $this->user_id and car_id = $car_id");
        ?>
        <div class="row">
            <?php 
            for($i=0;$i<sizeof($flicka_car_0);$i++){
            $rs = $flicka_car_0[$i];
            $title = $rs['Car']['manu_year'].' '.$rs['Car']['make'].' '.$rs['Car']['model'].' '.$rs['Car']['series'].' '.$rs['Car']['gearbox'];
            $this->user_id = $this->Session->read("Auth.User.id");
            $car_id = $rs['Car']['id'];
            $follow = ClassRegistry::init('FollowedCar')->query("select * from followed_cars where user_id = $this->user_id and car_id = $car_id");
            ?>
            <div class="col-lg-4">
                <div class="itemcar_4">
                    <div class="img_item_4">
                        <?php if(count($follow)>0){?>
                            <div id="follow" class="follow_small" car_id="<?php echo $rs['Car']['id']?>" user_id = <?php echo $this->user_id?>></div>
                        <?php }else{?>
                            <div id="follow" class="dis_follow_small" car_id="<?php echo $rs['Car']['id']?>" user_id = <?php echo $this->user_id?>></div>
                        <?php }?>

                        <a target="_blank" href="">
                            <?php 
                                if(isset($rs['Image'][0])){
                                    $img = $rs['Image'][0];
                                    if(isset($img['is_server_sdc']) && $img['is_server_sdc'] == 1){
                                        echo $this->Html->image('/datafeed/'.$img['image_file_name']);
                                    }else{
                                        echo '<img src="'.$img['image_file_name'].'" alt="" />';
                                    }
                                }else{
                                    echo '<img src="cars/car1.jpg" alt="" />';
                                }
                            ?>
                        </a>
                    </div>
                    <div class="title_car_4"><?php echo $title?></div>
                    <div class="price">$ <?php echo number_format($rs['Car']['price'],0,',',',')?></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="round_car"><?php echo $rs['Car']['gears'].' '.$rs['Car']['gearbox']?></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="round_car"><?php echo $rs['Car']['body']?></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="round_car"><?php echo $rs['Car']['cylinders']?>cyl <?php echo $rs['Car']['engine_capacity']?> l</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="round_car"><?php echo number_format($rs['Car']['odometer'],0,',',',')?> km</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="round_car">
                                <?php
                                $user_id = $rs['Car']['client_no'];
                                $user = ClassRegistry::init('User')->find('first',array('conditions'=>array('User.id' => $user_id)));
                                echo (isset($user['User']['name']))?$user['User']['name']:'';
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="round_car">
                                <?php echo $rs['Car']['view_count']?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="nsw_4">
                                <?php
                                if($rs['Car']['location'] != ''){
                                    $tr = explode(' ', $rs['Car']['location']);
                                    $kytu1 = $tr[count($tr) - 1];
                                    $kytu2 = $tr[count($tr) - 2];
                                    echo $kytu2.' '.$kytu1;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div style="text-align: right; padding-right: 20px;">
                                <a href="" class="btn btn-view">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="row">
            <div class="paging">
                <?php
                    echo $this->Paginator->numbers(array('separator' => ''));
                ?>
            </div>
            <div class="selectpage">
                <div style="float:left; width: 80%">Items per page:</div>
                <div style="float:left; width: 20%">
                    <?php
                    $limit = (isset($this->params->query['limit']))?$this->params->query['limit']:'10';
                    $options = array( 5 => '5', 10 => '10',  15 => '15', 20 => '20' );

                    echo $this->Form->create(array('type'=>'get'));

                    echo $this->Form->select('limit', $options, array(
                        'value'=>$limit, 
                        'default'=>10, 
                        'empty' => FALSE, 
                        'onChange'=>'this.form.submit();', 
                        'name'=>'limit'
                        )
                    );
                    echo $this->Form->end();?>
                </div>    
            </div>    
        </div>  
    </div>    
</div>

<script type="text/javascript">
Vcore.Flicka.Follow();
Vcore.Flicka.Filter();
$('.vdialog_filter .content-make').slimscroll({
    size: '4px',
    height: 450
});
</script>