<style>
    #Notifi .col-noti-1 .col-noti-2 {
        float: left;
        margin-right: 10px;
    }
    #Notifi .col-noti-1 .col-noti-1 {
        padding-top: 7px;
    }
    #Notifi ul li a {
        position: relative;
    }
    #Notifi ul li a:hover, #Notifi ul li a:focus {
        text-decoration: none;
    }
    #Notifi li.last {
        border-bottom: 0;
    }
    #Notifi .fa-circle {
        color: rgb(255, 85, 0);
        font-size: 24px;
        position: relative;
    }
    #Notifi .fa-circle > span {
        color: rgb(255, 255, 255);
        font-size: 13px;
        font-weight: bold;
        position: absolute;
        right: 7px;
        top: 5px;
        z-index: 99;
    }
    #Notifi .no_request {
        position: absolute;
        top: 6px;
        right: 10px;
    }
</style>

<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="NotificationPage" class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow notification-content data-content" style="padding: 30px 20px 40px;">
                <div id="Notifi" class="col-xs-12">
                    <ul id="list_notify">
                        <!--1-->
                        <?php
                        foreach ($result as $key => $rs ) :  ?>
                            <li>
                            <?php if($key == 'count_dealer_network'){?>
                                <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9491')?>" data-notify-id="56d8e1c115e994a4b3ef9491" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                    <div class="col-noti-1">
                                        <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                        <div class="col-noti-1">Notify me when a new dealer has joined My Network.</div>
                                    </div>
                                    <div class="col-noti-2 no_request  <?php  $rs->id ?>" style="text-align: right">
                                        <?php
                                        $num_noti = $rs->count;
                                        $id_noti = $rs->id;
                                        echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request notify-badge hidden"><span class="count_dealer_network">' . $num_noti . '</span></i>' : '';
                                        ?>
                                    </div>
                                </a>
                                </li>
                            <?php }else if($key == 'count_car_add_stock'){?>
                                <!--2-->
                                <li>
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9492') ?>" data-notify-id="56d8e1c115e994a4b3ef9492" data-reset-noti-id="<?php echo $rs->id; ?>"class="is_read_notify" >
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when car has been added to My Stock.</div>
                                        </div>
                                        <div class="col-noti-2 no_request  <?php echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;

                                            echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request notify-badge hidden"><span class="count_car_add_stock">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }else if($key == 'count_car_add_network_stock'){?>
                                <!--3-->
                                <li>
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9493')  ?>" data-notify-id="56d8e1c115e994a4b3ef9493" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when car has been added to My Network's stock.</div>
                                        </div>
                                        <div class="col-noti-2 no_request  <?php  echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;

                                            echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request notify-badge hidden"><span class="count_car_add_network_stock">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }else if($key == 'count_car_updated'){?>
                                <!--4-->
                                <li>
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9495') ?>" data-notify-id="56d8e1c115e994a4b3ef9495" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when one of the cars I am following has been updated</div>
                                        </div>
                                        <div class="col-noti-2 no_request  <?php echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;
                                            echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request notify-badge hidden"><span class="count_car_updated">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }else if($key == 'count_car_following'){?>
                                <!--5-->
                                <li>
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=56d8e1c115e994a4b3ef9496') ?>" data-notify-id="56d8e1c115e994a4b3ef9496" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when someone starts following one of my cars.</div>
                                        </div>
                                        <div class="col-noti-2 no_request  <?php echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;
                                            echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request notify-badge hidden"><span class="count_car_following">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }else if($key == 'count_pulse'){?>
                                <!--6-->
                                <li>
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=573189e9a677439ab683b679') ?>" data-notify-id="573189e9a677439ab683b679" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when another dealer shares a car with me as a Post.</div>
                                        </div>
                                        <div class="col-noti-2 no_request  <?php echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;

                                            echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request notify-badge hidden"><span class="count_pulse">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }else if($key == 'count_invite'){?>
                                <!--7-->
                                <li>
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=57771aa0901a7602c86df93d') ?>" data-notify-id="57771aa0901a7602c86df93d" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when an invitation arrives for me to join another Dealers Network.</div>
                                        </div>
                                        <div class="col-noti-2 no_request  <?php echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;
                                            echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request notify-badge hidden"><span class="count_invite">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }else if($key == 'count_tender'){?>
                                <!--8-->
                                <li>
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=577db05a901a7602c86df93e') ?>" data-notify-id="577db05a901a7602c86df93e" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when an invitation arrives for me to join Tender event.</div>
                                        </div>
                                        <div class="col-noti-2 no_request  <?php echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;

                                            echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request notify-badge hidden"><span class="count_tender">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }else if($key == 'count_offer'){?>
                                <!--9-->
                                <li>
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=578060db901a7602c86df942') ?>" data-notify-id="578060db901a7602c86df942" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when a dealer make offers on my car.</div>
                                        </div>
                                        <div class="col-noti-2 no_request  <?php echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;
                                            echo ($num_noti > 0) ? '<i class="fa fa-circle col-noti-2 no_request hidden notify-badge"><span class="count_offer">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }else if($key == 'count_requestoffer'){?>
                                <!--10-->
                                <li class="last">
                                    <a href="<?php echo $this->Html->Url('/other_notifications?status=577f85da901a7602c86df941') ?>" data-notify-id="578060db901a7602c86df942" data-reset-noti-id="<?php echo $rs->id; ?>" class="is_read_notify">
                                        <div class="col-noti-1">
                                            <div class="col-noti-2"><?php echo $this->Html->image('/images/bulletpoint.png') ?></div>
                                            <div class="col-noti-1">Notify me when an invitation arrives for me to make an offer.</div>
                                        </div>
                                        <div class=" <?php echo $rs->id ?>" style="text-align: right">
                                            <?php
                                            $num_noti = $rs->count;
                                            $id_noti = $rs->id;
                                            echo ($num_noti > 0) ? '<i class=" fa fa-circle col-noti-2 no_request notify-badge hidden"><span class=" count_requestoffer ">' . $num_noti . '</span></i>' : '';
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php }  ?>

                        <?php  endforeach; ?>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>    
        </div>
    </div>
</div>
<script>
    //check is read notification

    $(document).ready(function(){
        $(document).on('click','.is_read_notify',function(){
           var is_read_notify = $(this).attr('data-notify-id');
            if(is_read_notify){
                $.post(root + 'OtherNotifications/ajaxreadtypenotification',{'is_read_notify':is_read_notify},function(data){
                    if(data.error == 0){
                    }else{
                    }
                },'json');
            }
            $('.'+is_read_notify).html('');
        });

        $.post(root + 'ajaxgetcountothernotify', {}, function(data){
            count_dealer_network = $('.count_dealer_network');
            count_car_add_stock = $('.count_car_add_stock');
            count_car_add_network_stock = $('.count_car_add_network_stock');
            count_car_updated = $('.count_car_updated');
            count_car_following = $('.count_car_following');
            count_pulse = $('.count_pulse');
            count_invite = $('.count_invite');
            count_tender = $('.count_tender');
            count_offer = $('.count_offer');
            count_requestoffer = $('.count_requestoffer');
            if (data.count_dealer_network > 0) {
                count_dealer_network.text(data.count_dealer_network);
                count_dealer_network.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_car_add_stock > 0) {
                count_car_add_stock.text(data.count_car_add_stock);
                count_car_add_stock.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_car_add_network_stock > 0) {
                count_car_add_network_stock.text(data.count_car_add_network_stock);
                count_car_add_network_stock.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_car_updated > 0) {
                count_car_updated.text(data.count_car_updated);
                count_car_updated.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_car_following > 0) {
                count_car_following.text(data.count_car_following);
                count_car_following.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_pulse > 0) {
                count_pulse.text(data.count_pulse);
                count_pulse.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_invite > 0) {
                count_invite.text(data.count_invite);
                count_invite.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_tender > 0) {
                count_tender.text(data.count_tender);
                count_tender.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_offer > 0) {
                console.log(count_offer.text(data.count_offer));
                count_offer.closest('.notify-badge').removeClass('hidden');
            }
            if (data.count_requestoffer > 0) {
                count_requestoffer.text(data.count_requestoffer);
                count_requestoffer.closest('.mnotify-badge').removeClass('hidden');
            }
        },'json');
    });


</script>