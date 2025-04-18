<?php
echo $this->Html->script(array('swfobject'));
$flashplayer = $this->Html->url( '/', true ).'app/webroot/swf/player.swf';
$skin = $this->Html->url( '/', true ).'app/webroot/xml/blueratio/blueratio.xml';
$rand = 'video';
$width = '500';
$height = '300';
$file = 'https://www.youtube.com/watch?v=I2pdUXdjdFQ';
$image = $this->Html->url( '/', true ).'images/no_car.png' ;
?>
<script type='text/javascript'>
<?php
    $data ='  var so = new SWFObject(\''.$flashplayer.'\',\'mpl_1\',\''.$width.'\',\''.$height.'\',\'9\');
      so.addParam(\'allowfullscreen\',\'true\');
      so.addParam(\'allowscriptaccess\',\'always\');
      so.addParam(\'wmode\',\'opaque\');

      so.addVariable(\'stretching\',\'fill\');
      so.addVariable(\'autostart\',\'false\');
      so.addVariable(\'repeat\',\'always\');
      so.addVariable(\'file\',\''.$file.'\');
      so.addVariable(\'image\',\''.$image.'\');
      so.addVariable(\'skin\',\''.$skin.'\');    
      var vnit_1 = null;
      function playerReady(thePlayer) {
         vnit_1 = window.document[\'mpl_1\'];
       }';
       echo $data;
?>
</script> 
<div id="pop_detailcar" class="modal fade Popdetail" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 700px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox;?></h4>
                </div>
                <div class="modal-body">
                    <div class="content-make">
                        <div class="mod_video" style="display: none">
                            <div id="mediaspace<?php echo $rand?>"></div>
                        </div>
                        <?php if($car->image_url){?>
                            <div id="bigPic" class="Pic">
                                <img src="<?php echo $car->image_url?>">
                                <?php 
//                                for($k=0;$k<5;$k++){
//                                    if(isset($car['Image'][$k])){
//                                        $img = $car['Image'][$k];
//                                        if(isset($img['is_server_sdc']) && $img['is_server_sdc'] == 1){
//                                            echo $this->Html->image('/datafeed/'.$img['image_file_name']);
//                                        }else{
//                                            echo '<img src="'.$img['image_file_name'].'" alt="" />';
//                                        }
//                                    }else{
//                                        echo $this->Html->image('/images/no_image.jpg');
//                                    }
//                                }
                                ?>
                            </div>
                            <ul id="thumbs" class="Thum">
                                <?php
//                                 for($j=0;$j<5;$j++){
//                                      if(isset($car['Image'][$j])){
//                                          $img = $car['Image'][$j];
                                ?>
                                    <!-- <li class="<?php //echo ($j==0)?'active':''?>" rel='<?php //echo $j?>'> -->
                                        <?php 
//                                        if(isset($img['is_server_sdc']) && $img['is_server_sdc'] == 1){
//                                            echo $this->Html->image('/datafeed/'.$img['image_file_name']);
//                                        }else{
//                                            echo '<img src="'.$img['image_file_name'].'" alt="" />';
//                                        }
                                        ?>
                                    </li>
                                 <?php //}}?>
                            </ul>
                        <div class="clickvideo" style="display: none;" ><a href="javascript:;" video_file="<?=$file?>"><?php echo $this->Html->image('/images/video.jpg')?></a></div>
                            <div class='clearfix'></div>
                            <div id='push'></div>
                        <?php }else{
                           echo $this->Html->image('/images/no_car.png',array('width'=>'435','height' => '300'));
                        }
                        ?>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var currentImage;
    var currentIndex = -1;
    var interval;

    function showImage(index){
        if(index < $('.Pic img').length){
            var indexImage = $('.Pic img')[index];
            if(currentImage){   
                if(currentImage != indexImage ){
                    $(currentImage).css('z-index',2);
                    clearTimeout(myTimer);
                    $(currentImage).fadeOut(250, function() {
                        myTimer = setTimeout("showNext()", 3000);
                        $(this).css({'display':'none','z-index':1})
                    });
                }
            }
            $(indexImage).css({'display':'block', 'opacity':1});
            currentImage = indexImage;
            currentIndex = index;
            $('.Thum li').removeClass('active');
            $($('.Thum li')[index]).addClass('active');
        }
    }

    function showNext(){
        var len = $('.Pic img').length;
        var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
        showImage(next);
    }

    var myTimer;

    $(document).ready(function() {
        $('.Thum li').bind('click',function(e){
            $(".mod_video").css("display","none");
            $(".Pic").css("display","block");
            var count = $(this).attr('rel');
            showImage(parseInt(count));
        });
   
        so.write('mediaspace<?php echo $rand?>');
        $(".clickvideo a").click(function(){
            filename = $(this).attr('video_file');
            $(".Pic").css("display","none");
            $(".mod_video").css("display","block");
            playvideo(filename);
        });
        
    });
    function playvideo(filename){
        vnit_1.sendEvent('STOP');
        vnit_1.sendEvent('LOAD', filename);
        vnit_1.sendEvent('VOLUME', 80);
        vnit_1.sendEvent('PLAY');
    }             

</script>