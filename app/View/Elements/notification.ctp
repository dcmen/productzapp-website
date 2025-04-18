<?php
    $email = $this->Session->read('Auth.User.email');
    $user_id = $this->Session->read('Auth.User.id');
?>
<div id="Notification">
    <div class="bg-cover-action" data-target="#FrameNotification" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0;"></div>
    <div id="FrameNotification" class="colspand support" style="left: -570px;">
        <div class="title_notifi">NOTIFICATIONS</div>
        <div class="notifylist" style="padding: 0px 50px 45px;">
            <ul style="padding: 0px;">
                <!--1-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef948e') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when a match has been found, for one of my Set & Forget records, and either my car or another dealers car.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="countCarsNotifyRS1" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>    
                </li>
                <!--2-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef948f') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Send me a notification if I have a car in my stock that matches another dealers Set & Forget record.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="countCarsNotifyRS2" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>    
                </li>
                <!--        4-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9491') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when a new dealer has joined My Network.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="noti_count_dealer_network" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>    
                </li>
                <!--        5-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9492') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when car has been added to My Stock.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="noti_count_car_add_stock" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>   
                </li>
                <!--        6-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9493') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when car has been added to My Network`s stock.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="noti_count_car_add_network_stock" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>
                </li>

                <!-- 8-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9495') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when one of the cars I am following has a feature updated.e.g price, description change.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="noti_count_car_updated" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>    
                </li>
                <!--9-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9496') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when someone starts following one of my cars.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="noti_count_car_following" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>    
                </li>
                <!--10-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=573189e9a677439ab683b679') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when another dealer shares a car with me as a Post.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="noti_count_pulse" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>    
                </li>
                <!--11-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=57771aa0901a7602c86df93d') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when an invitation arrives for me to join another Dealers Network.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="noti_count_invite" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>    
                </li>
                <!--12-->
                <li>
                    <a href="<?php echo $this->Html->Url('/other_notifications?status=577db05a901a7602c86df93e') ?>">
                        <div class="col-noti-1">
                            <div class="col-noti-2"><?php echo $this->Html->image('/images/notifi.png') ?></div>
                            <div class="col-noti-1">Notify me when an invitation arrives for me to join Tender event.</div>
                        </div>
                        <div class="col-noti-2 no_request" style="text-align: right">
                            <i id="noti_count_tender" style="display: none;" class="fa fa-circle"><span></span></i>
                        </div>
                    </a>    
                </li>
            </ul>
        </div>
        <a href="javascript:;" class="arrow"></a>
    </div>
</div>
<script>
    Vcore.Notification();
    
    $(document).ready(function() {
        function GetCountCarsNotify() {
            $.post(root + 'ajaxgetcountcarsnotify', {}, function(data){
                if (data.result1) {
                    $('#countCarsNotifyRS1 > span').html(data.result1);
                    $('#countCarsNotifyRS1').show();
                }
                if (data.result2) {
                    $('#countCarsNotifyRS2 > span').html(data.result2);
                    $('#countCarsNotifyRS2').show();
                }
            },'json');
        }
        
        function GetCountOtherNotify() {
            $.post(root + 'ajaxgetcountothernotify', {}, function(data){
                if (data.count_dealer_network) {
                    $('#noti_count_dealer_network > span').html(data.count_dealer_network);
                    $('#noti_count_dealer_network').show();
                }
                if (data.count_car_add_stock) {
                    $('#noti_count_car_add_stock > span').html(data.count_car_add_stock);
                    $('#noti_count_car_add_stock').show();
                }
                if (data.count_car_add_network_stock) {
                    $('#noti_count_car_add_network_stock > span').html(data.count_car_add_network_stock);
                    $('#noti_count_car_add_network_stock').show();
                }
                if (data.count_car_updated) {
                    $('#noti_count_car_updated > span').html(data.count_car_updated);
                    $('#noti_count_car_updated').show();
                }
                if (data.count_car_following) {
                    $('#noti_count_car_following > span').html(data.count_car_following);
                    $('#noti_count_car_following').show();
                }
                if (data.count_pulse) {
                    $('#noti_count_pulse > span').html(data.count_pulse);
                    $('#noti_count_pulse').show();
                }
                if (data.count_invite) {
                    $('#noti_count_invite > span').html(data.count_invite);
                    $('#noti_count_invite').show();
                }
                if (data.count_tender) {
                    $('#noti_count_tender > span').html(data.count_tender);
                    $('#noti_count_tender').show();
                }
            },'json');
        }
        
        GetCountCarsNotify();
        GetCountOtherNotify();
    });
</script>