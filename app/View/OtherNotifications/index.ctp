<style>
    .del_notifi {
        text-align: right;
    }
</style>

<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="NotificationPage" class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow notification-content data-content" style="padding: 30px 20px 40px;">
                <div id="Notifi" class="col-xs-12">
                    <ul>
                        <?php
                        //1,2
                        if ($notification_id == '56d8e1c115e994a4b3ef948e' || $notification_id == '56d8e1c115e994a4b3ef948f') {
                            if($list != null){
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $rs = $list[$i]->cars;
                                    $title = $rs->manu_year . ' ' . $rs->make . ' ' . $rs->model . ' ' . $rs->series . ' ' . $rs->gearbox;
                                    $img = $rs->image_url;
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/car_detail?car=' . $rs->_id) ?>">
                                                <div class="col-xs-12 col-sm-1 col-lg-1 icon no-padding">
                                                    <?php
                                                    if (isset($img)) {
                                                        echo '<img src="' . $img . '" alt="" />';
                                                    } else {
                                                        echo $this->Html->image('/images/no_car.png', array('width' => '50', 'height' => '50'));
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-xs-12 col-sm-9 col-lg-11 notifi_con">
                                                    <?php
                                                    echo 'I have car (' . $title . ')';
                                                    if ($notification_id == '56d8e1c115e994a4b3ef948e') {
                                                        echo ' matched my Set & Forget.';
                                                    } else {
                                                        echo ' matched other dealers` Set & Forget.';
                                                    }
                                                    ?>

                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $rs->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }else{
                                echo "No data to display";
                            }
                            //4
                        } else if ($notification_id == '56d8e1c115e994a4b3ef9491') {
//                            debug($list);die();
                            if($list != null){
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $car = $list[$i]->other_notifications;
                                    $u = $list[$i]->users;
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/mynetwork') ?>">
                                                <div class="col-xs-12 col-sm-1 col-lg-1 icon no-padding">
                                                    <?php echo ($u->avatar_file_name) ? $this->Html->image(Configure::read('api.avatar_url') . 'app/webroot/img/uploads/users_avatar/' . $u->avatar_file_name) : $this->Html->image('/images/no-avatar.png') ?>
                                                </div>
                                                <div class="col-xs-12 col-sm-9 col-lg-11 notifi_con">
                                                    <?php
                                                    echo $u->name . ' accepted your invitation.';
                                                    ?>
                                                    <div class="col-lg-12 col-sm-9 col-xs-11 icon no-padding " style="min-height:30px;padding-top:5px;">
                                                        <?php  echo $car->created_at; ?>
                                                    </div>
                                                </div>

                                            </a>
                                        </div>
                                        <div class="col-xs-2">
                                            <a href="javascript:;" data-id="<?php echo $car->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }else{
                                echo "No data to display";
                            }

                            //9
                        } else if ($notification_id == '56d8e1c115e994a4b3ef9496'){
                            if($list != null){
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $car = $list[$i]->other_notifications;
                                    $u = $list[$i]->users;
                                    $view = $list[$i]->views;
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/cardetails/'. $car->car_id.'/'.str_replace(' ', '-', $car->car_name)) ?>">
                                                <div class="col-xs-12 col-sm-1 col-lg-1 icon no-padding">
                                                    <?php echo ($view->dealer_avatar) ? $this->Html->image($view->dealer_avatar) : $this->Html->image('/images/no-avatar.png') ?>
                                                </div>
                                                <div class="col-xs-2 col-sm-9 col-lg-11 notifi_con">
                                                    <div><?php echo $u->name . ' is following your car.'; ?></div>
                                                    <div class="notifi-time"><?php echo $car->created_at; ?></div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $car->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }else{
                                echo"No data to display";
                            }
                        } else if ($notification_id == '57771aa0901a7602c86df93d') {
                            if($list != null){
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $car = $list[$i]->other_notifications;
                                    $u = $list[$i]->users;
                                    $view = $list[$i]->views;
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/request_network?type=received') ?>">
                                                <div class="col-xs-12 col-sm-1 col-lg-1 icon no-padding">
                                                    <?php echo ($view->dealer_avatar) ? $this->Html->image($view->dealer_avatar) : $this->Html->image('/images/no-avatar.png') ?>
                                                </div>
                                                <div class="col-xs-12 col-sm-9 col-lg-11 notifi_con">
                                                    <div><?php echo $car->message; ?></div>
                                                    <div class="notifi-time"><?php echo $view->notification_time ?></div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $car->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }else{
                                echo "No data to display";
                            }
                        } else if ($notification_id == '577db05a901a7602c86df93e') {
                            if($list != null){
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $car = $list[$i]->other_notifications;
                                    $u = $list[$i]->users;
                                    $view = $list[$i]->views;
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/tenderoffer?type=2') ?>">
                                                <div class="col-xs-12 col-sm-1 col-lg-1 icon no-padding">

                                                    <img class="img-responsive" src="<?php echo (isset($view->dealer_avatar)  && $view->dealer_avatar) ?$view->dealer_avatar : $this->webroot . 'images/no-avatar.png' ?>"onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no-avatar.png';">
                                                </div>
                                                <div class="col-xs-12 col-sm-9 col-lg-11 notifi_con">
                                                    <div><?php echo $car->message; ?></div>
                                                    <div class="notifi-time"><?php echo $view->notification_time ?></div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $car->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }else{
                                echo "No data to display";
                            }

                        } else if ($notification_id == '56d8e1c115e994a4b3ef9492' || $notification_id == '56d8e1c115e994a4b3ef9495') {
                            if($list != null){
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $rs = $list[$i]->other_notifications;
                                    $car_name = $rs->car_name;
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/cardetails/'. $rs->car_id.'/'.str_replace(' ', '-', $rs->car_name)) ?>">
                                                <div class="col-xs-12 col-sm-9 col-lg-11 notifi_con">
                                                    <?php
                                                    echo 'Car ' . $car_name . '';
                                                    if ($notification_id == '56d8e1c115e994a4b3ef9495') {
                                                        echo ' has some features updated.';
                                                    } else if ($notification_id == '56d8e1c115e994a4b3ef9492') {
                                                        echo ' has been added to My Stock';
                                                    } else if ($notification_id == '56d8e1c115e994a4b3ef9493') {
                                                        echo ' has been added to My Network`s Stock';
                                                    }
                                                    ?>

                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $rs->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }//pulse
                            }else{
                                echo "No data to display";
                            }
                        }  else if ($notification_id == '56d8e1c115e994a4b3ef9493') {
                            //debug($list);die();
                            if($list != null){
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $rs = $list[$i]->other_notifications;
                                    $car_name = $rs->car_name;
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/cardetails/'. $rs->car_id.'/'.str_replace(' ', '-', $rs->car_name)) ?>">
                                                <div class="col-xs-12 col-sm-9 col-lg-11 notifi_con">
                                                    <?php
                                                    echo 'Car ' . $car_name . '';
                                                        echo ' has been added to My Network`s Stock';
                                                    ?>

                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $rs->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }//pulse
                            }else{
                                echo "No data to display";
                            }
                        }else if ($notification_id == '573189e9a677439ab683b679') {
                            if ($list != '') {
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $rs = $list[$i];
                                    $img = $list[$i]->pulse_image;
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/pulse_detail/' . $rs->pulse_id) ?>">
                                                <div class="col-xs-12 col-sm-1 col-lg-1 icon no-padding">
                                                    <?php
                                                    if ($img != '') {
                                                        echo '<img src="' . $img . '" alt="" />';
                                                    } else {
                                                        echo $this->Html->image('/images/no_car.png', array('width' => '50', 'height' => '50'));
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-xs-12 col-sm-9 col-lg-11 notifi_con">
                                                    <div><?php echo $rs->message ?></div>
                                                    <div class="notifi-time"><?php echo $rs->notification_time ?></div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $rs->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                <?php
                                }
                            }
                        }else if($notification_id == '578060db901a7602c86df942'){
                            if ($list != null) {
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $rs = $list[$i];
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                                <a href="<?php echo $this->Html->Url('/cars/listdealersentoffer?car_id=').$rs->other_notifications->car_id ?>"/>
                                                <div class="col-lg-12 col-sm-12 col-xs-12 icon no-padding " style="min-height:30px;padding-top:5px;">
                                                   <?php
                                                        if(isset($rs->other_notifications->message) && $rs->other_notifications->message) {
                                                           echo preg_replace('/\r?\n|\r/','<br/>',  $rs->other_notifications->message);

                                                        }
                                                  ?>
                                                </div>
                                                <div class="col-lg-12 col-sm-12 col-xs-12 icon no-padding " style="min-height:30px;padding-top:5px;">
                                                  <?php  echo $rs->other_notifications->created_at; ?>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $rs->other_notifications->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }

                            } else{
                                echo 'No data to display';
                            }
                        }else if($notification_id == '577f85da901a7602c86df941'){
                            if ($list != null) {
                                for ($i = 0; $i < sizeof($list); $i++) {
                                    $rs = $list[$i];
                                    ?>
                                    <li>
                                        <div class="col-lg-10 col-sm-10 col-xs-12">
                                            <a href="<?php echo $this->Html->Url('/cars/listofferbuying?car_id=').$rs->other_notifications->car_id.'&company_id='.$rs->other_notifications->company_id_ofcar ?>"/>
                                            <div class="col-lg-12 col-sm-12 col-xs-12 icon no-padding " style="min-height:30px;padding-top:5px;">
                                                <?php
                                                if(isset($rs->other_notifications->message) && $rs->other_notifications->message) {
                                                    echo preg_replace('/\r?\n|\r/','<br/>',  $rs->other_notifications->message);
                                                }
                                                ?>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12 icon no-padding " style="min-height:30px;padding-top:5px;">
                                                <?php  echo $rs->other_notifications->created_at; ?>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <a href="javascript:;" data-id="<?php echo $rs->other_notifications->_id ?>" status="<?php echo $notification_id ?>" class="del_notifi"><i title="Delete notification" class="fa fa-times color-red"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            else{
                                echo 'No data to display';
                            }
                        }
                        ?>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".del_notifi").click(function(){
            id = $(this).attr('data-id');
            status = $(this).attr('status');
            item = $(this);
            jConfirm('Are you sure want to delete this notify?','Message',function(r) {
                if(r){
                    load_show();
                    $.post(root + 'OtherNotifications/delete',{'id':id},function(data){
                        load_hide();
                        if(data.error == 0){
                            showMessage('Deleted successfully', 0);
                            parent_li = item.closest('li');
                            parent_li.fadeOut('slow', function() {$(this).remove();});
                        }else{
                            showMessage('Deleted not successfully', 1);
                        }
                    },'json');
                }
            });
        });
    });
</script>