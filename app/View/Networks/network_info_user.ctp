<div class="wrap_content">
    <div class="col-xs-12">
        <div class="title_response ridbon">
            <i class="fa fa-users"></i>
            My Network
        </div>
    </div>
    <div id="MyNetwork" class="col-xs-12">
        <div class="col-xs-12 col-lg-10 col-lg-offset-1">
            <div id="setforget" class="col-xs-12">
                <div class="col-xs-12 form-group">
                    <div class="col-lg-3 col-xs-12">
                        <div class="ic_user"><i class="fa fa-user"></i></div>                        
                    </div>
                    <div class="col-lg-9 col-xs-12">
                        <ul class="info_cus">
                            <li>
                                <i class="fa fa-user"></i>
                                <?php echo $info->name?>                            
                            </li>
                            <li>
                                <i class="fa fa-home"></i>
                                <?php echo (isset($info->company_address) && $info->company_address != '')? $info->company_address : ''?>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <?php echo $info->phone?>                         
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i>
                                <?php echo $info->email?>                            
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 text-right form-group"><a href="<?php echo $this->Html->Url('/view_stock?id='.$info->_id)?>" class="btn btn-view">View dealer's stock</a></div>
                <?php if(isset($address)){?>
                <div class="col-xs-12 form-group">
                    <div id="map_canvas_detail" style="width: 100%; height: 455px;"></div> 
                </div>
                <?php }?>
                <div class="col-xs-12 text-center button_network no-padding">
                    <a href="" class="btn btn-view">Send email</a>
                    <a href="" class="btn btn-view">Chat</a>
                    <?php if($info->_id != $this->Session->read('Auth.User.id')){?>
                    <a href="<?php echo $this->Html->Url('/network_del/'.$info->_id)?>" class="del_customer btn btn-view">Delete</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($lat) {?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=vi"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=#AIzaSyBh8or_tM_5DScNF9U0IO5c73QA-vRfHGY&sensor=false"></script>

<script type="text/javascript">
    var mylat = '<?php echo $lat?>'; 
    var mylng = '<?php echo $lng?>';
    
    function initialize() {
        var myCenter = new google.maps.LatLng(mylat, mylng);
        
        var mapProp = {
            center : myCenter,
            zoom : 15,
            mapTypeId : google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("map_canvas_detail"), mapProp);

        var marker = new google.maps.Marker({
            position : myCenter
        });

        marker.setMap(map);
    }
    
    $(window).load(function() {
        initialize();
    });
</script>
<?php } ?>
<script type="text/javascript">
 Vcore.Customer();
</script>