<div class="ridbon">
    <?php echo $this->Html->image('/images/search_plus.png')?> Car details transfer
</div>
<div class="wrap_content">
    <div id="Cardetail" class="col-xs-12">
        <div class="bt_top_detail pull-right">
            <?php if($car->client_no != CakeSession::read('Auth.User._id') && $car->client_no != -1){?>
                <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo ($follow > 0)?'Dis follow':'Follow'?>" class="clickfollow <?php echo ($follow > 0)?'dis_follow':'follow'?>" user_id="<?php echo CakeSession::read('Auth.User._id')?>" car_id="<?php echo $id?>">
                    <i class="fa fa-star <?php echo ($follow > 0)?'star-yellow':''?> a_<?php echo $id?>"></i>
                </a>
                <a href="<?php echo $this->Html->Url('/other_stock?car='.$id)?>" data-toggle="tooltip" data-placement="bottom" data-original-title="Other stock">
                    <i class="fa fa-cubes"></i>
                </a>
                <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo ($addnetwork == 0)?'+ My network':''?>" class="is_my_network" user_id="<?php echo $user_session ?>" request_id="<?php echo $car->client_no?>">
                    <i class="fa fa-group <?php echo ($addnetwork > 0)?'star-yellow':''?>"></i>
                </a>
            <?php }?>
            <a href=""><i class="fa fa-comments"></i></a>
            <a href=""><i class="fa fa-envelope"></i></a>
        </div>
        <div class="col-xs-12">
            <div class="text-center col-lg-8 col-lg-offset-2" style="margin-bottom: 15px">
                <div id="myCarousel" class="carousel slidecardetail" >
                    <div class="carousel-inner" role="listbox">
                        <div class="item active" id="abcd1">
                            <?php echo $this->Html->image('/images/car3.jpg',array('class'=>'img-responsive','width'=>'600px'))?>   
                        </div>
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <?php echo $this->Html->image('/images/prev2.png')?>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <?php echo $this->Html->image('/images/next2.png')?>
                        </a>
                    </div>
                    <div id="listfile">
                        <div class="camera" id="c_1" style="z-index: 1;"><input name="file[]" type="file" id="file" multiple=true/></div>
                    </div>
                </div>
            </div> 
            <div class="col-xs-12">
                <h4><?php echo $car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox;?></h4>
            </div>
            <div class="row col-lg-10 info_detail">
                <div class="col-lg-4">
                    <?php echo $this->Html->image('/images/speed.png')?>
                    <span><?php echo $car->gears.' '.$car->gearbox?> </span>
                </div>
                <div class="col-lg-4">
                    <?php echo $this->Html->image('/images/use30.png')?>
                    <span>
                        <?php
                        echo ($info_client_no->dealer_name != '')?$info_client_no->dealer_name:'';
                        ?>
                    </span>
                </div>
                <div class="col-lg-4">
                    <?php echo $this->Html->image('/images/km.png')?>
                    <span>
                        <?php  
                        $odometer = number_format($car->odometer,0,',',',');
                        if($odometer != '0') {
                            echo $odometer . ' km';
                        } else {
                            echo 'Not set';
                        }
                        ?>
                    </span>
                </div>
                <div class="col-lg-4">
                    <?php echo $this->Html->image('/images/engine.png')?>
                    <span><?php echo $car->cylinders?>cyl <?php echo $car->engine_capacity?> l</span>
                </div>
                <div class="col-lg-4">
                    <?php echo $this->Html->image('/images/sean.png')?>
                    <span><?php echo $car->body?></span>
                </div>

                <div class="col-lg-4">
                    <?php echo $this->Html->image('/images/view.png')?>
                    <a style="text-decoration: underline" href="javascript:;" data-toggle="modal" data-target="#view_follow_car" rel="view_follow_car">
                        <?php echo count($count_follow)?>
                    </a>
                </div>
            </div>
            <div class="row col-lg-2">
                <div class="dola"><i class="fa fa-usd"></i><?php echo number_format($car->price,0,',',',')?></div>
            </div>
            <div class="row col-lg-12 btn_detail_car">
                <div class="title_car">Dealer Information</div>
                <div class="row">
                    <div class="col-lg-6">
                        <?php
                        echo $info_client_no->dealer_name;
                        ?>
                    </div>
                    <div class="col-lg-6" style="text-align: right">
                        <?php if($car->location != ''){?>
                        <i class="fa fa-location-arrow"></i>
                        <a style="text-decoration: underline;margin-right: 5px" onclick="getLocation()" >
                            <?php
                                $tr = explode(' ', $car->location);
                                $kytu1 = $tr[count($tr) - 1];
                                $kytu2 = $tr[count($tr) - 2];
                                echo $kytu2.' '.$kytu1;
                            ?>
                        </a>
                        <a href="javascript:;" data-toggle="modal" data-target="#map" rel="map"><i class="fa fa-map-marker"></i></a>
                        <?php }?>
                        <script>
                            var x = document.getElementById("demo");
                            function getLocation() {
                                if(navigator.geolocation){
                                    navigator.geolocation.getCurrentPosition(function(position){
                                        var latitude = position.coords.latitude;
                                        var longitude = position.coords.longitude;

                                        $.post(root + 'Cars/khoangcach/<?php echo $car->_id?>', { 'latitude':latitude, 'longitude':longitude },function(data){
                                            $html = 'Distance from here to this car: '+data.kc+' Kms';
                                            jAlert($html);
                                        },'json');

                                    });
                                }
                            }

                        </script>
                    </div>
                </div>
                <div class="col-lg-6" style="text-align: left; padding: 0">
                    <a href="" class="btn <?php echo ($car->client_no == '')?'not-active':'btn-view'?>">Email</a>
                    <a href="" class="btn <?php echo ($car->client_no == '')?'not-active':'btn-view'?>">Chat</a>
                </div>
                <div class="col-lg-6" style="text-align: right; padding: 0">
                    <?php if($type == 'transfered'){?>
                        <a href="javascript:;" class="btn btn-view cancel_trans" data-toggle="modal" data-target="#cancel_transfers" rel="cancel_transfers" car-id="<?php echo $car->_id?>" user_trans = "<?php echo $us_receivers->transfer_name?>" type="<?php echo $type?>">CANCEL</a>
                        <a href="javascript:;" class="btn btn-view accept" data-toggle="modal" data-target="#accept_transfers" rel="accept_transfers" car-id="<?php echo $car->_id?>" user_trans = "<?php echo $us_trans->name?>" user_trans_id = "<?php echo $us_trans->_id?>" type="<?php echo $type?>" data-placement="bottom" data-original-title="This car is bought by...">ACCEPT</a>
                    <?php }else{?>
                        <a href="javascript:;" class="btn btn-view cancel_trans" data-toggle="modal" data-target="#cancel_transfers" rel="cancel_transfers" car-id="<?php echo $car->_id?>" user_trans = "<?php //echo $us_receivers->transfer_name?>" type="<?php echo $type?>">CANCEL</a>
                    <?php }?>
                </div>
            </div>
            <div class="row col-lg-12">
                <div class="title_car">More Information</div>
                <ul id="myTab4" class="nav nav-tabs padding-12 tab-color-blue background-blue">
                    <li class="active">
                        <a href="#detail" data-toggle="tab" aria-expanded="false"><b>Detail</b></a>
                    </li>
                    <li class="">
                        <a href="#comment" data-toggle="tab" aria-expanded="false"><b>Comments</b></a>
                    </li>
                    <li class="">
                        <a href="#notes" data-toggle="tab" aria-expanded="false"><b>Notes</b></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="detail">
                        <table class="content_detail">
                            <tr class="row0">
                                <td><b>Make</b></td>
                                <td><?php echo $car->make?></td>
                            </tr>
                            <tr class="row1">
                                <td><b>Series</b></td>
                                <td><?php echo $car->series?></td>
                            </tr>
                            <tr class="row0">
                                <td><b>Model</b></td>
                                <td><?php echo $car->model?></td>
                            </tr>
                            <tr class="row1">
                                <td><b>Manufacture Year</b></td>
                                <td><?php echo $car->manu_year?></td>
                            </tr>
                            <tr class="row0">
                                <td><b>Body</b></td>
                                <td><?php echo $car->body?></td>
                            </tr>
                            <tr class="row1">
                                <td><b>Seats</b></td>
                                <td><?php echo $car->seats?></td>
                            </tr>
                            <tr class="row0">
                                <td><b>Body Colour</b></td>
                                <td><?php echo $car->body_colour?></td>
                            </tr>
                            <tr class="row1">
                                <td><b>Fuel type</b></td>
                                <td><?php echo $car->fuel_type?></td>
                            </tr>
                            <tr class="row0">
                                <td><b>Price</b></td>
                                <td><?php echo number_format($car->price,0,',',',')?></td>
                            </tr>
                            <tr class="row1">
                                <td><b>Location</b></td>
                                <td><?php echo $car->location?></td>
                            </tr>
                            <tr class="row0">
                                <td><b>Transmission</b></td>
                                <td><?php echo $car->gearbox?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane" id="comment">
                        <?php if($car->client_no == $user_session){?>
                        <form action="<?php echo $this->Html->Url('/Cars/update_comment')?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $car->_id?>">
                            <div class="form-group line-form">
                                <textarea class="form-control" rows="5" id="comment" name="comments"><?php echo $car->comments?></textarea>
                            </div>
                            <div class="form-group line-form" style="text-align: right">
                                <input type="submit" class="btn btn-view" value="Save">
                            </div>
                        </form>   
                        <?php }else{ echo $car->comments;}?>
                    </div>
                    <div class="tab-pane" id="notes">
                        <form action="<?php echo $this->Html->Url('/Cars/update_notes')?>" method="post">
                            <input type="hidden" name="id" value="<?php echo ($notes != '')?$notes->_id:''?>">
                            <input type="hidden" name="car_id" value="<?php echo $car->_id?>">
                            <input type="hidden" name="user_id" value="<?php echo $user_session?>">
                            <div class="form-group line-form">
                                <textarea class="form-control" rows="5" id="comment" name="comment"><?php echo ($notes != '')?$notes->comment:''?></textarea>
                            </div>
                            <div class="form-group line-form" style="text-align: right">
                                <input type="submit" class="btn btn-view" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->element('detail_car');?>

<script type="text/javascript">
    Vcore.Popup();
    $(".accept").click(function(){
        var id = $(this).attr("car-id");
        var type = $(this).attr("type");
        var user_trans_id = $(this).attr("user_trans_id");
        var user_trans = $(this).attr("user_trans");
        $(".car_id").val(id);
        $(".us_trans").html(user_trans);
        $(".us_trans_id").val(user_trans_id);
        $(".type").val(type);
    })
    $(".cancel_trans").click(function(){
        var id = $(this).attr("car-id");
        var type = $(this).attr("type");
        var user_trans = $(this).attr("user_trans");
        $(".car_id").val(id);
        $(".us_trans").html(user_trans);
        $(".type").val(type);
    });
    
</script>
    