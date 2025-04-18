<div class="cars index">
    <div class="wrap_content">
        <div class="col-xs-12">
            <div class="title_response ridbon">
                <i class="fa fa-user fa_18 "></i> Profile user's
            </div>
        </div>
        <div id="ProfileUser" class="col-md-10 col-md-offset-1 col-xs-12">
            <div class="col-xs-3">
                <?php 
                if($rs->avatar){
                    echo '<img src="'.Configure::read('api.avatar_url').'app/webroot/img/uploads'.$rs->avatar.'" class="avata img-responsive" style="height: 165px">';
                }else{
                    echo $this->Html->image('/images/profile.png', array('class' => 'avata img-responsive','height'=>'165'));
                }?>
            </div>
            <div class="col-xs-9">
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"><i class="fa fa-user"></i><span class="orange">Fullname</span></div>
                        <div class="profile-info-value"><?php echo $rs->name.' '.$rs->last_name?></div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"><i class="fa fa-laptop"></i><span class="orange">Dealership</span></div>
                        <div class="profile-info-value"><?php echo $rs->company_name?></div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"><i class="fa fa-phone"></i><span class="orange">Phone</span></div>
                        <div class="profile-info-value"><?php echo $rs->phone?></div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"><i class="fa fa-home"></i><span class="orange">Address</span></div>
                        <div class="profile-info-value"><?php echo $rs->company_address?></div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"><i class="fa fa-home"></i><span class="orange">Email</span></div>
                        <div class="profile-info-value"><?php echo $rs->email?></div>
                    </div>
                </div>    
            </div>
            <div class="col-xs-12" style="margin-top: 20px">
            <div id="map_canvas_detail" style="width: 98%; height: 250px;"></div> 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=vi"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=#AIzaSyBh8or_tM_5DScNF9U0IO5c73QA-vRfHGY&sensor=false"></script>
<script type="text/javascript">
    var address = '<?php echo $rs->company_address ?>' ;
    var mylat = '<?php echo $rs->latitude ?>'; 
    var mylng = '<?php echo $rs->longitude ?>'; 
    var mx    =    0;
    var my    =    0;
    var mainMarkerPlace = new Array();
    var array_hotelMarker = new Array();
    var array_locationMarker = new Array();
    var type_location    = 'school';
    $(window).load(function() {
        $(document).bind('mousemove', function(e){
            mx = e.pageX;
            my = e.pageY;
        });

        var arrayListId = new Array();
        var iconmain = '<i class="fa fa-map-marker"></i>';
        var markerNull = new google.maps.MarkerImage(null);
        var mainImagePlace    =    new google.maps.MarkerImage(iconmain);
        var mainPosPlace        =    new google.maps.LatLng(mylat, mylng);

        var settings = {
                zoom: 15,
                center: mainPosPlace,
                mapTypeControl: true,
                mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas_detail"), settings);

        google.maps.event.addListener(mainMarkerPlace, 'mouseover', function(){
            $('body').append(show_google_map(this));
        });

    });

</script>

