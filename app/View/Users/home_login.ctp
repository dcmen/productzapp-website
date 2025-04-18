<?php $base_url = $this->Html->Url('/')?>
<link rel="stylesheet" href="<?php echo $base_url?>app/webroot/cars/jquery.bxslider.css" type="text/css" />
<script src="<?php echo $base_url?>app/webroot/cars/jquery.bxslider.js"></script>
<script src="<?php echo $base_url?>app/webroot/cars/rainbow.min.js"></script>
<script src="<?php echo $base_url?>app/webroot/cars/scripts.js"></script>
<div class="ridbon">
    <i class="fa fa-home"></i> Home
</div>
<div class="wrap_content">
    <div id="slide_car">
        <div class="row">
            <div class="col-lg-12">
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('.bxslider').bxSlider({
                            mode: 'fade',
                            captions: true,
                            interval: 3000,
                            auto: true
                        });
                    });
                </script>
                <div class="slider">
                    <ul class="bxslider">
                        <?php 
                        for($j=0;$j<sizeof($listcars);$j++){
                            $rs = $listcars[$j];
                            $a = $rs['Car']['manu_year'].' '.$rs['Car']['make'].' '.$rs['Car']['model'].' '.$rs['Car']['series'].' '.$rs['Car']['gearbox'];
                            $b = $rs['Image'][1]['image_file_name'];
                            $c = $rs['Image'][2]['image_file_name'];
                        ?>
                            <li>
                                <div class="img col-lg-8 col-xs-12" style="padding: 0">
                                <?php if($rs['Image'][0]['image_file_name']){
                                    echo $this->Html->image('/datafeed/dealersolutions/images/'.$rs['Image'][0]['image_file_name'],array('title'=>$a,'h1'=>$b,'h2'=>$c)) ;
                                }else{
                                    echo '<img src="cars/car1.png">';
                                }?>
                                </div>   
                                <div class="col-lg-4 col-xs-6">
                                    <div class="h1"></div>
                                </div>
                                <div class="col-lg-4 col-xs-6">
                                    <div class="h2"></div>
                                </div>
                            </li>
                        <?php }?>
                    </ul>
                    
                </div>
              </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_for_sale">
                    <div class="bg_i"><img src="images/ic_cars_sold64x64.png"></div>
                    <div class="number">116</div>
                    <div class="title">Cars For Sale</div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_followed">
                    <div class="bg_i"><img src="images/ic_cars_follow64x64.png"></div>
                    <div class="number">36</div>
                    <div class="title">Cars Followed</div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_set_forget">
                    <div class="bg_i"><img src="images/ic_cars_forget.png"></div>
                    <div class="number">18</div>
                    <div class="title">Set & Forget</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_app_chat">
                    <div class="bg_i"><img src="images/ic_chats.png"></div>
                    <div class="number">6</div>
                    <div class="title">Zapp Chat</div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_my_network">
                    <div class="bg_i"><img src="images/ic_dealer.png"></div>
                    <div class="number">42</div>
                    <div class="title">My Network</div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_my_stock">
                    <div class="bg_i"><img src="images/ic_cars_network.png"></div>
                    <div class="number">15</div>
                    <div class="title">My Stock</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_Flicka">
                    <div class="bg_i"><img src="images/ic-flicka.png"></div>
                    <div class="number"><img src="images/ic_infinity.png"></div>
                    <div class="title">Flicka</div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_my_customer">
                    <div class="bg_i"><img src="images/ic-mycustomer.png"></div>
                    <div class="number">67</div>
                    <div class="title">My Customers</div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-4">
                <div class="item_bt car_carlendar">
                    <div class="bg_i"><img src="images/ic_calendar.png"></div>
                    <div class="number"></div>
                    <div class="title">Calendar</div>
                </div>
            </div>
        </div>
    </div>
</div>