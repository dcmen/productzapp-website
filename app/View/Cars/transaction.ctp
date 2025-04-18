<input type="hidden" name="link" value="<?php echo $this->request->here()?>">
<div class="cars index">
    <div class="wrap_content">
        <div class="col-xs-12">
            <div class="title_response ridbon">
                <?php echo $this->Html->image('/images/transaction22.png')?> <?php echo $title?>
            </div>
        </div>
        <div id="Flicka" class="col-xs-12">
            <div class="countcars col-xs-12 col-lg-8 form-group">
                <?php echo $total?> <?php echo ($total > 1) ? 'results found' : 'result found' ?>
            </div>

            <div class="col-xs-12 col-lg-4">
                <div id="viewdropdown" class="btn-group col-xs-3">    
                    <button class="btn btn-primary btn-filter dropdown-toggle" data-toggle="dropdown">
                        <?php echo ($history != '')?count($history):0?><i class="fa fa-bell"></i>
                    </button>
                    <?php if($history != ''){?>
                    <ul class="dropdown-menu scrollable-menu" role="menu">
                        <?php 
                        foreach($history as $rs):?>
                        <li>
                            <div class="col-xs-10 no-padding">
                                <?php if($rs->client_no == CakeSession::read('Auth.User.id')){?>
                                You want to sell car 
                                <?php }else{?>
                                Someone want to buy your car
                                <?php }?>
                                <span style="color: red">
                                    <?php echo $rs->make.' '.$rs->model.' '.$rs->series?>
                                </span>
                            </div>
                            <div class="col-xs-2 btn_icon no-padding">
                                <a href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName))?>">
                                    <i aria-hidden="true" class="fa fa-eye"></i>
                                </a>
                                <a href="javascript:;" class="del_history" his_id="<?php echo $view_his->idhistory?>"><i aria-hidden="true" class="fa fa-trash"></i></a>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <?php }?>
                </div>
                
                <div class="btn-group pull-right col-xs-9 no-padding">
                    <button class="btn btn-primary btn-filter dropdown-toggle" data-toggle="dropdown">
                        Sort by: <span class="c_select"><?php echo $str?></span>
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu selectfilter">
                        <li class="dropdown-header">Basic option</li>
                        <li><a href="<?php echo $this->Html->Url('/transaction?action='.$action.'&sort=features')?>">Features</a></li>
                        <li><a href="<?php echo $this->Html->Url('/transaction?action='.$action.'&sort=pricelow')?>">Price (high to low)</a></li>
                        <li><a href="<?php echo $this->Html->Url('/transaction?action='.$action.'&sort=pricehigh')?>">Price (low to high)</a></li>
                        <li class="dropdown-header">Advanced option</li>
                        <li><a href="javascript:;" data-toggle="modal" data-target="#make" rel="Make">Make</a></li>
                    </ul>
                </div>
            
            </div>
            <div class="result_list col-xs-12">
                <?php
                if($cars != ''){
                for($i=0;$i<sizeof($cars);$i++){
                $rs = $cars[$i];
                $title = $rs->manu_year.' '.$rs->make.' '.$rs->model.' '.$rs->series.' '.$rs->gearbox;
                $this->user_id = $this->Session->read("Auth.User._id");
                $follow = ($views->is_follow == false)?0:1;
                ?>
                <div class="col-xs-12 content_car">
                    <div class="col-xs-12 no-padding">
                        <div class="title_car">
                            <?php echo $title?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-5 col-xs-12 no-padding">                            
                        <?php if($rs->client_no != $this->user_id){?>
                            <div class="clickfollow followbg <?php echo ($follow == 1)?'dis_follow':'follow'?>" car_id="<?php echo $rs->_id?>" user_id="<?php echo $this->user_id?>">
                                <?php echo ($follow == 1)?'<i title="Unfollow this car" class="fa fa-star star-yellow"></i>':'<i title="Follow this car" class="fa fa-star"></i>'?>
                            </div>
                        <?php }?>
                        <div class="img_active">
                            <a href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName))?>">
                                <?php if($rs->image_url != ''){
                                    $img = $rs->image_url;
                                    echo '<img src="'.$img.'" class="img-responsive" width="300px"  />';
                                }else{
                                    echo $this->Html->image('/images/no_car.png',array('class' => 'img-responsive','width'=>'300px'));
                                }?>
                            </a>
                        </div>
                    </div>
                    <div class="rm_pad col-lg-8 col-sm-7 col-md-8 col-xs-12 no-padding">
                        <div class="content_car_right col-xs-12 col-lg-8">
                            <div class="col-xs-7">
                                <div id="item_i_car">
                                    <?php echo $this->Html->image('/images/speed.png',array('class'=>'img-responsive','width'=>'20px'))?>
                                    <span><?php echo ($rs->gears != '' && $rs->gearbox != '') ? ($rs->gears.' '.$rs->gearbox) : 'Not set'?></span>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div id="item_i_car">
                                    <?php echo $this->Html->image('/images/sean.png',array('class'=>'img-responsive','width'=>'20px'))?>
                                    <span><?php echo (isset($rs->body))?$rs->body:'Not set'?></span>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div id="item_i_car">
                                    <?php echo $this->Html->image('/images/engine.png',array('class'=>'img-responsive','width'=>'20px'))?>
                                    <span><?php echo $rs->cylinders?>cyl <?php echo $rs->engine_capacity?> l</span>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div id="item_i_car">
                                    <?php echo $this->Html->image('/images/km.png',array('class'=>'img-responsive','width'=>'20px'))?>
                                    <span>
                                        <?php  
                                        $odometer = number_format($rs->odometer,0,',',',');
                                        if($odometer != '0') {
                                            echo $odometer . ' km';
                                        } else {
                                            echo 'Not set';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>    
                            <div class="col-xs-7">
                                <div id="item_i_car">
                                    <?php echo $this->Html->image('/images/use30.png',array('class'=>'img-responsive','width'=>'20px'))?>
                                    <span>
                                        <?php echo $users->dealer_name?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div id="item_i_car">
                                    <?php echo $this->Html->image('/images/view.png',array('class'=>'img-responsive','width'=>'20px'))?>
                                    <span><?php echo $views->count_follow?></span>
                                </div>
                            </div>   
                        </div>
                        <div class="col-lg-4 col-xs-12 col-r-fl">
                            <div class="col-xs-6 col-lg-12 no-padding">
                                <div class="dola text-center">
                                    <?php  
                                    $price = number_format($rs->price,0,',',',');
                                    if($price != '0') {
                                        echo '<i class="fa fa-usd"></i>' . $price;
                                    } else {
                                        echo 'Not set';
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if($rs->location != ''){
                                $tr = explode(' ', $rs->location);
                                $kytu1 = $tr[count($tr) - 1];
                                $kytu2 = $tr[count($tr) - 2];
                            ?>
                            <div class="col-xs-6 col-lg-12 no-padding">
                                <div class="nsw text-center">
                                    <a onclick="getLocation(<?php echo $rs->_id?>)"><?php echo $kytu2.' '.$kytu1;?></a>
                                </div>
                            </div>
                            <?php }?>
                            <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-lg-12 col-lg-offset-0 no-padding">
                                <a href="<?php echo $this->Html->Url('/cardetails/'. $car->_id.'/'.str_replace(' ', '-', $carName))?>" class="btn btn-view col-xs-12">View</a>
                            </div>
                        </div>
                    </div>    

                </div> 
                <?php }}?>
            </div>
            <?php 
            if($total > $limit){
                echo '<div class="pagecars pull-right"></div>';
            }
            ?>
        </div>    
    </div>
</div>


<?php
$result2 = $this->requestAction('cars/ResultDatasearch');
if($result2 != ''){
    $car_make = $result2[1];
?>
<div id="make" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 500px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Make</h4>
                </div>
                <div class="modal-body">
                    <div class="content-make">
                    <?php 
                    for($i=0;$i < sizeof($car_make);$i++){
                    ?>
                        <div class="line-form">
                            <input type="checkbox" name="make" class="c_make" value="<?php echo $car_make[$i]?>">
                            <?php echo $car_make[$i]?>
                        </div>
                    <?php }?>
                    </div>
                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view col-xs-12 col-lg-6 col-lg-offset-3 choosemake">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<script type="text/javascript">
Vcore.Flicka.Follow();
$(document).ready(function(){
    $(".choosemake").click(function(){
        var link = $("input[name='link']").val();
        make = '';
        $(".c_make").each(function(){
            if($(this).is(":checked")){
                if ($(this).val() != 'undefined'){
                    make += $(this).val()+',';
                };
            }
        });
        if(make == ''){
            jAlert('No items selected');
        }else{
            window.location.href = link +'&make='+make;
        }
    });
    
    $('.pagecars').bootpag({
        total: <?php echo $maxpages?>,
        page: 1,
        maxVisible: 5
    }).on('page', function(event, num){
        var dataString = {
            action: '<?php echo $action?>',
            ajax: 'true',
            page: num
        };
        load_show();
        $.get("transaction", dataString , function( data ) {
            $(".result_list").html(data);
            load_hide();
        });
    });
    
    $(".del_history").click(function(){
        //cars/deleteHistory
        his_id = $(this).attr("his_id");
        jConfirm('Are you sure want to delete this history?','Message',function(r) {
          if(r){
                $.post(root + 'cars/deleteHistory',{'id':his_id},function(data){
                    if(data.error == 0){
                          window.location.href = root + 'transaction?action=<?php echo $action?>';
                    }else{
                        jAlert('Error','Messages');
                    }

                },'json');
            }
        });
    });
});
</script>