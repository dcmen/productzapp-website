<style>
    #UsersInCompanyTable .user-avatar {
        height: 35px;
        width: 35px;
    }
</style>
<div class="main-page">
    <?php echo $this->element('cz_menu_bar_users_in_company'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    <div class="pd-content-01">
        <div class="col-lg-12">
            <?php if(count($list)>0) : ?>
            <div class="wg-box-shadow data-content" style="padding: 30px 20px 40px;">
                <div id="UsersInCompanyTable" class="table-responsive col-xs-12">
                    <table class="table customer">
                        <thead>
                            <th style="width: 100px;">Avatar </th>
                            <th style="width: 180px;">Name</th>
                            <th>Email</th>
                            <th class="text-right">Actions</th>
                        </thead>
                        <tbody class="result_search">
                            <?php foreach($list as $rs) :?>
                            <tr id="<?php $idDealer = $rs->_id;
                                    echo $idDealer;
                            foreach($list_mynetwork as $rs) { $idMynetwork = $rs->_id;}
                                if($idDealer == $idMynetwork ){
                                    $is_mynetwork = 1;
                                }else{
                                    $is_mynetwork = 0;
                                }

                            ?>">
                                <td><img class="user-avatar img-circle" src="<?php echo (isset($rs->avatar_file_name) && $rs->avatar_file_name)? $rs->avatar_file_name : $this->webroot . 'images/no-avatar.png' ?>" /></td>
                                <td><?php echo $rs->name ?></td>
                                <td><?php echo $rs->email ?></td>
                                <td align="right">
                                    <a href="javascript:;" class="btn-send-inbox" data-email="<?php echo $rs->email ?>" title="Send email"><i class="fa fa-envelope"></i></a>
                                    <a href="javascript:;" class="btn-add-network is_my_network" user_id="" request_id="<?php echo $rs->_id ?>" is_mynetwork="<?php echo $is_mynetwork; ?>"title="Add my network"><i class="fa fa-users"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="total-datatable"><span>Total:</span> <strong class="total-count"><?php echo $total ?></strong></div>

                <div class="clearfix"></div>
            </div>
            <?php endif; ?>
            
            <div class="msg-no-data mg-top-50 text-center font-size-24 <?php echo ($total)? 'dis-none' : '' ?>"><span>No data to display</span></div>
            
            <?php if ($maxpages > 1) :  ?>
            <div class="cz-pagination"></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="SendMailModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send mail</h4>
                </div>
                <div class="modal-body">
                    <div id="invite" class="col-lg-12">
                        <form id="FormSendMail" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-lg-2 col-md-2 no-padding-right"><label>Send to</label></div>
                                <div class="col-lg-10 col-md-10"><input readonly type="text" class="form-control" name="email" value="" placeholder="email"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-2 col-md-2 no-padding-right"><label>Subject</label></div>
                                <div class="col-lg-10 col-md-10"><input readonly type="text" class="form-control" name="subject" value="<?php echo trim(trim($car->manu_year).' '.trim($car->make).' '.trim($car->model).' '.trim($car->series).' '.trim($car->gearbox))?>" placeholder="subject"></div>
                            </div>
                            <div class="bg_cc">
                                <div style="margin-bottom: 11px; font-size: 15px;"><strong>Car informational</strong></div>
                                <?php 
                                echo (isset($car->price) && $car->price) ? '<strong>Price: </strong> $' . ((number_format($car->price,0,',',',') != '0')? number_format($car->price,0,',',',')  . '<br/>' : 'Send Offer' . '<br/>') : '';
                                echo (isset($car->make) && $car->make) ? '<strong>Make: </strong> ' . $car->make . '<br/>' : '';
                                echo (isset($car->model) && $car->model) ? '<strong>Model: </strong> ' . $car->model . '<br/>' : '';
                                echo (isset($car->series) && $car->series) ? '<strong>Series: </strong> ' . $car->series . '<br/>' : '';
                                echo (isset($car->manu_year) && $car->manu_year) ? '<strong>Year: </strong> ' . $car->manu_year . '<br/>' : '';
                                echo (isset($car->body) && $car->body) ? '<strong>Body:</strong> ' . $car->body . '<br/>' : '';
                                echo (isset($car->doors) && $car->doors) ? '<strong>Doors: </strong> ' . $car->doors . '<br/>' : '';
                                echo (isset($car->seats) && $car->seats) ? '<strong>Seats: </strong> ' . $car->seats . '<br/>' : '';
                                echo (isset($car->body_colour) && $car->body_colour) ? '<strong>Body Colour: </strong> ' . $car->body_colour . '<br/>' : '';
                                echo (isset($car->gears) && $car->gears) ? '<strong>Seats: </strong> ' . $car->gears . '<br/>' : '';
                                echo (isset($car->fuel_type) && $car->fuel_type) ? '<strong>Fuel type: </strong> ' . $car->fuel_type . '<br/>' : '';
                                echo (isset($car->odometer) && $car->odometer) ? '<strong>Odometers: </strong> ' . number_format($car->odometer,0,',',',') . ' kms' . '<br/>' : '';
                                echo (isset($car->cylinders) && $car->cylinders) ? '<strong>Cylinders: </strong> ' . $car->cylinders . 'cyl' . '<br/>' : '';
                                echo (isset($car->engine_capacity) && $car->engine_capacity) ? '<strong>Engine capacity: </strong> ' . $car->engine_capacity . 'L' . '<br/>' : '';
                                echo (isset($car->manu_month) && $car->manu_month) ? '<strong>Month made: </strong> ' . $car->manu_month . '<br/>' : '';
                                echo (isset($car->gearbox) && $car->gearbox) ? '<strong>Gearbox: </strong> ' . $car->gearbox . '<br/>' : '';
                                ?>
                            </div>
                            <div style="margin-top: 15px;">
                                <button type="button" href="javascript:;" class="btn btn-view pull-right btn-send-email" style="width: 100px;">Send</button>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
   </div>
</div>

<script type="text/javascript">
    $(document).on('click', '.is_my_network', function () {
        request_id = $(this).attr('request_id');
        user_id = $(this).attr('user_id');
        is_mynetwork = $(this).attr('is_mynetwork');
        if(is_mynetwork == 1){
            showMessage('This user realy in your network',1);
            return false;
        }
        if( $(this).find('i').hasClass('star-yellow') ) {
            jConfirm('Are you sure you want to remove this user from your network?', 'Message', function(r) {
                if(r){
                    load_show();
                    $.post(root + 'network_del', {id:request_id}, function(data){
                        if(data.error == 0){
                            $("a.is_my_network").find('i').removeClass('star-yellow');
                        }
                        showMessage('Removed successfully', 0);
                        load_hide();
                    },'json');
                }
            });
            $('.cancel').hide();
            return false;

        }else{
            jConfirm('Do you want to add this dealer to your network?','Message',function(r) {
                if(r){
                    load_show();
                    $.post(root + 'InviteNetworks/add_network', {'request_id':request_id,'user_id':user_id},function(data){
                        if(data.error == 0){
                            //$(this).find('i').addClass('star-yellow');
                            showMessage('An invite to join your network have been sent',0);
                        }else{
                            showMessage(data.msg,1);
                        }
                        load_hide();
                    },'json');
                }
            });
            $('.cancel').hide();
            return false;

        }
    });
    Vcore.Addnetwork();
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    $(document).ready(function() {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'car_detail_action_page', container = '#UsersInCompanyTable');
        $(document).on('click', '.btn-send-inbox', function() {
            email = $(this).attr('data-email');
            $('#SendMailModal input[name="email"]').val(email);
            $('#SendMailModal').modal('show');
        });
        
        $('.btn-send-email').click(function () {
            email = $('#SendMailModal input[name="email"]').val();
            subject = $('#SendMailModal input[name="subject"]').val();
            content = $('#SendMailModal .bg_cc').html();
            
            load_show();
            $.post(root + 'ajaxsendmail', {email:email, subject: subject, content: content},function(data){
                showMessage('Sent mail successfully', 0);
                $('#SendMailModal').modal('hide');
                load_hide();
            });
        });
    });

</script>