<div id="sellcar" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 400px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">My Network</h4>
                </div>
                <div class="modal-body">
                    <form id="SellCar" method="post">
                        <input type="hidden" class="car_id" name="id" value="">
                        <div class="content-make">
                        <?php 
                        $mynetwork = $this->requestAction('cars/ResultMyNetwork');
                        foreach($mynetwork as $mk):?>
                            <div class="line-form">
                                <input type="radio" name="transactor_id"  value="<?php echo $mk->_id?>">
                                <?php echo $mk->name?>
                            </div>
                        <?php endforeach;?>
                        </div>
                        <div class="form-group line-form">
                            <button type="submit" class="btn btn-view">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- buy car -->
<div id="buycar" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 400px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">CarZapp</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="car_id" name="id" value="">
                    <div class="content-make message_car"></div>
                    <div class="form-group line-form" style="text-align: center;margin-top: 15px">
                        <button type="button" class="btn btn-view submitbuycar">OK</button>
                        <button type="button" class="btn btn-view" data-dismiss="modal">CANCEL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cancel Sell buy car -->
<div id="alert_sell_buy_car" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 350px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">CarZapp</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="car_id" name="id" value="">
                    <div class="content-make message_car"></div>
                    <div class="form-group line-form" style="text-align: center">
                        <button type="button" class="btn btn-view update_sell_buy">OK</button>
                        <button type="button" class="btn btn-view" data-dismiss="modal">CANCEL</button>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>

<!--transfer -->
<div id="transfer" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 400px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Transfer car</h4>
                </div>
                <div class="modal-body">
                    <form id="Transfer"  method="post">
                        <input type="hidden" name="car_id" value="">
                        <div class="content-make">
                            <?php 
                            $mynetwork = $this->requestAction('cars/ResultMyNetwork');
                            foreach($mynetwork as $mk):?>
                                <div class="form-group">
                                    <input type="radio" name="receiver_id" <?php echo ($mynetwork[0])?'checked':''?> value="<?php echo $mk->_id?>">
                                    <?php echo $mk->name?>
                                </div>
                            <?php endforeach;?>
                        </div>
                        <div class="form-group line-form" style="text-align: center">
                            <button type="submit" class="btn btn-view">OK</button>
                            <button type="button" class="btn btn-view" data-dismiss="modal">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cancel transfer -->
<div id="cancel_transfers" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 350px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">CarZapp</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="type" name="type" value="">
                    <input type="hidden" class="car_id" name="id" value="">
                    <div class="content-make">
                        You are transferring this car to <span class="us_trans"></span>. </br>
                        Do you want to cancel this transfer?
                    </div>
                    <div class="form-group line-form" style="text-align: center">
                        <button type="button" class="btn btn-view canceltransfers">OK</button>
                        <button type="button" class="btn btn-view" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--acccep transfer-->
<div id="accept_transfers" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 350px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">CarZapp</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="type" name="type" value="">
                    <input type="hidden" class="us_trans_id" name="us_trans_id" value="">
                    <input type="hidden" class="car_id" name="id" value="">
                    <div class="content-make">
                        <span class="us_trans"></span> is transferring this car to you . </br>
                        Do you want to accept this transfer?
                    </div>
                    <div class="form-group line-form" style="text-align: center">
                        <button type="button" class="btn btn-view accepttransfers">OK</button>
                        <button type="button" class="btn btn-view" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Accept buy sell car -->
<div id="accept" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 350px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">CarZapp</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="car_id" name="id" value="">
                    <div class="content-make message_car"></div>
                    <div class="form-group line-form" style="text-align: center">
                        <button type="button" class="btn btn-view updateaccept">OK</button>
                        <button type="button" class="btn btn-view" data-dismiss="modal">CANCEL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="view_follow_car" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 350px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Followers</h4>
                </div>
                <div class="modal-body">
                    <div class="content-make">
                        <ul class="list_follow">
                            <?php 
                            if($count_follow != null){
                                foreach($count_follow as $rs):
                            ?>
                                <li>
                                    <a style="text-decoration: underline" href="<?php echo $this->Html->Url('/profileuser/'.$rs->_id)?>" target="_blank">    
                                        <?php echo $rs->full_name?>
                                    </a><br>
                                    <?php echo $rs->company_name?> Dealership
                                </li>
                            <?php 
                                endforeach;
                            } ?>
                        </ul>
                    </div>
                    <div class="form-group line-form" style="text-align: center">
                        <button type="button" class="btn btn-view" data-dismiss="modal">OK</button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>

  
<script>
$(document).ready(function() {
    $('#SellCar').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            transactor_id: {
                validators: {
                    notEmpty: {
                        message: 'Please choose your transactor.'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target),
        validator = $form.data('bootstrapValidator');
        load_show();
        id = $("input[name='id']").val();
        $.post(root + 'sellcar', $form.serialize(), function (data) {
            load_hide();
            if(data.error == 0){
                $("#sellcar").modal('hide');
                jAlert('You sold this car success!','Messages');
                window.location.href = root + 'car_detail?car='+id;
            }else{
                jAlert(data.msg,'Messages');
            }
        },'json');
    });

    $('#Transfer').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            receiver_id: {
                validators: {
                    notEmpty: {
                        message: 'Please choose user in your nextwork'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target),
        validator = $form.data('bootstrapValidator');
        load_show();
        $.post(root + 'add_transfers', $form.serialize(), function (data) {
            load_hide();
            if(data.error == 0){
                $("#transfer").modal('hide');
                window.location.href = root + 'my_stock';
            }else{
                jAlert(data.msg,'Messages');
            }
        },'json');
    });
    
    $(".submitbuycar").click(function(){
        id = $("input[name='id']").val();
        $.post(root + 'cars/buycar',{'id':id},function(data){
            if(data.error == 0){
                $("#buycar").modal('hide');
                jAlert('You bought this car success!','Messages');
                window.location.href = root + 'car_detail?car='+id;
            }else{
                jAlert(data.msg,'Messages');
            }
        },'json');
    });
    
    $(".update_sell_buy").click(function(){
        id = $("input[name='id']").val();
        $.post(root + 'update_sell_buy',{'id':id},function(data){
            if(data.error == 0){
                $("#alert_sell_buy_car").modal('hide');
                jAlert('You cancel this car success!','Messages');
                window.location.href = root + 'car_detail?car='+id;
            }else{
                jAlert(data.msg,'Messages');
            }
        },'json');
    });
    $(".canceltransfers").click(function(){
        type = $("input[name='type']").val();
        id = $("input[name='id']").val();
        $.post(root + 'cancel_transfers',{'id':id,'type':type});
    });
    $(".accepttransfers").click(function(){
        type = $("input[name='type']").val();
        id = $("input[name='id']").val();
        $.post(root + 'accept_transfers',{'id':id,'type':type});
    });
    $(".updateaccept").click(function(){
        id = $("input[name='id']").val();
        $.post(root + 'update_accept',{'id':id});
    });
});
</script>
    

