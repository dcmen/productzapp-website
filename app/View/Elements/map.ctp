<!--map -->
<div id="map" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 800px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Location</h4>
                </div>
                <div class="modal-body">
                    <div class="content-make">
                        <div id="map_canvas_detail"></div> 
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=en"></script>
<!-- <script src="http://maps.googleapis.com/maps/api/js?key=#AIzaSyBh8or_tM_5DScNF9U0IO5c73QA-vRfHGY&sensor=false"></script> -->
<script type="text/javascript" src="<?php echo $this->webroot ?>js/gmaps.js"></script>
<script type="text/javascript">
    var map;
    $(document).ready(function() {

        map = new GMaps({
            div: '#map_canvas_detail',
            lat: <?php echo $lat2 ?>,
            lng: <?php echo $lng2 ?>,
            
        });
        map.addMarker({
            lat: <?php echo $lat2 ?>,
            lng: <?php echo $lng2 ?>,
            infoWindow: {
              content: '<p><?php echo $address ?></p>'
            }
        });
        $('#map_canvas_detail').css({
            'width': '100%',
            'height': '455px'
        }); 
        $('.map-btn').click(function(event) {
            setTimeout(function(){ 
                map.refresh(); 
                map.setCenter(<?php echo $lat2 ?>,<?php echo $lng2 ?>); 
                google.maps.event.trigger(map.markers[0], 'click');
            }, 500);
            
        });

    });

    // var address = '<?php echo $address ?>' ;
    // var mylat = '<?php echo $lat2 ?>'; 
    // var mylng = '<?php echo $lng2 ?>'; 
    // var mx    =    0;
    // var my    =    0;
    // var mainMarkerPlace = new Array();
    // var array_hotelMarker = new Array();
    // var array_locationMarker = new Array();
    // var type_location    = 'school';
    // $(window).load(function() {
    //     $(document).bind('mousemove', function(e){
    //         mx = e.pageX;
    //         my = e.pageY;
    //     });

    //     var arrayListId = new Array();
    //     var iconmain = '<i class="fa fa-map-marker"></i>';
    //     var markerNull = new google.maps.MarkerImage(null);
    //     var mainImagePlace    =    new google.maps.MarkerImage(iconmain);
    //     var mainPosPlace        =    new google.maps.LatLng(mylat, mylng);

    //     var settings = {
    //             zoom: 15,
    //             center: mainPosPlace,
    //             mapTypeControl: true,
    //             mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    //             mapTypeId: google.maps.MapTypeId.ROADMAP
    //     };
    //     var map = new google.maps.Map(document.getElementById("map_canvas_detail"), settings);

    //     google.maps.event.addListener(mainMarkerPlace, 'mouseover', function(){
    //         $('body').append(show_google_map(this));
    //     });

    // });

</script>
        


