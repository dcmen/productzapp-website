<style>
    .info_customer img {
        width: 95px;
    }
    .info_customer .active, .info_customer:hover {
        background: #fff;
    }
    .info_customer:hover {
        color: #000;
    }
    .click_cus {
        overflow-y: auto;
        height: 300px;
    }
    @media(max-width:360px){
        .info_customer img {
            width: 51px;
        }
        .click_cus {
            overflow-y: auto;
            height: 270px;
        }
    }
</style>
<div class="main-page">
    <?php echo $this->element('cz_menu_bar_set4get_manage'); ?> 
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow data-content" style="padding: 30px 20px 30px;">
                <div class="message-nodata">Not found</div>
                <?php
                if ($result != '') {
                    $i = 1;
                    foreach ($result as $rs):
                        if (!isset($rs->customer_infor) || !$rs->customer_infor) {
                            continue;
                        }
                        $customers = $rs->customer_infor;
                        $manage_customers = $rs->manage;
                        ?>
                        <div class="info_customer <?php echo ($i == 1) ? 'active' : '' ?>" data-name="<?php echo $customers->full_name ?>" data-phone="<?php echo $customers->phone ?>" data-email="<?php echo $customers->email ?>">
                            <div class="col-lg-2 col-sm-3 col-md-2 col-xs-4 text-center no-padding">
                                <?php echo $this->Html->image('/images/no-avatar.png') ?>
                            </div>
                            <ul class="info_cus col-lg-10 col-xs-8 col-md-10 col-sm-9 no-padding">
                                <li>
                                    <i class="fa fa-user"></i>
                                    <?php echo $customers->full_name ?>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <?php echo $customers->phone ?>
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i>
                                    <?php echo $customers->email ?>
                                </li>
                            </ul>
                            <?php if ($manage_customers != '') { ?>
                                <div class="click_cus cus" style="display: none">
                                    <?php foreach ($manage_customers as $m): ?>
                                        <div id="<?php echo $m->_id ?>" class="r_customer">
                                            <div class="col-lg-12 cus_<?php echo $m->_id ?>">
                                                <div class="col-lg-11">
                                                    <i class="fa fa-car"></i>
                                                    <?php
                                                    $rel = json_decode($m->search_params);
                                                    $a = '';
                                                    if (isset($rel->make)) {
                                                        $a .= $rel->make;
                                                    }
                                                    if (isset($rel->model)) {
                                                        $a .= $rel->model;
                                                    }
                                                    if (isset($rel->series)) {
                                                        $a .= $rel->series;
                                                    }
                                                    if (isset($rel->gearbox)) {
                                                        $a .= $rel->gearbox;
                                                    }
                                                    echo ($a != '') ? $a : 'Not set';
                                                    ?>
                                                </div>
                                                <div class="col-lg-1 pull-right">
                                                    <a href="javascript:;" class="del_setforget" setforgetid="<?php echo $m->_id ?>"><i class="fa fa-times" style="color: #fff"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <i class="fa fa-clock-o"></i>
                                                    <?php
                                                    echo ($m->updated_at != '') ? $m->updated_at : 'Not set';
                                                    ?>
                                                </div>
                                                <div>
                                                    <i class="fa fa-calendar"></i>
                                                    <?php
                                                    $c = '';
                                                    if (isset($rel->manu_year_from)) {
                                                        $c .= $rel->manu_year_from;
                                                    }
                                                    if (isset($rel->manu_year_to)) {
                                                        $c .= ' ' . $rel->manu_year_to;
                                                    }
                                                    echo ($c != '') ? $c : 'Not set';
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <i class="fa fa-tachometer"></i>
                                                    <?php
                                                    $d = '';
                                                    if (isset($rel->odometer_from)) {
                                                        $d .= $rel->odometer_from;
                                                    }
                                                    if (isset($rel->odometer_to)) {
                                                        $d .= ' - ' . $rel->odometer_to;
                                                    }
                                                    echo ($d != '') ? $d : 'Not set';
                                                    ?>
                                                </div>
                                                <div>
                                                    A<i class="fa fa-usd"></i>
                                                    <?php
                                                    $e = '';
                                                    if (isset($rel->price_from)) {
                                                        $e .= $rel->price_from;
                                                    }
                                                    if (isset($rel->price_to)) {
                                                        $e .= ' - ' . $rel->price_to;
                                                    }
                                                    echo ($e != '') ? $e : 'Not set';
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php $i++;
                    endforeach;
                } ?>

                <div class="text-center font-size-24 msg-no-data-display <?php echo ($i != 1)? 'dis-none' : '' ?>"><span>No data to display</span></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    Vcore.Flicka.CarsforSale();
    Vcore.Flicka.Setforget();
    $(document).ready(function() {
        $(".del_setforget").click(function(){
            setforgetid = $(this).attr("setforgetid");
            jConfirm('Are you sure want to delete this set forget?','Message',function(r) {
                if(r){
                    load_show();
                    click_cus = $('#'+setforgetid).parents('.click_cus');
                    info_customer = click_cus.parents('.info_customer');
                    $.post(root + 'cars/deleteSetandForget',{'setforgetid':setforgetid},function(data){
                        load_hide();
                        if(data.error == 0){
                            $('#'+setforgetid).remove();
                    
                            if (click_cus.children().length == 0) {
                                click_cus.remove();
                            }

                            if (info_customer.find('.click_cus').length == 0) {
                                info_customer.remove();
                            }

                            if ($('.info_customer').length == 0) {
                                $('.msg-no-data-display').show();
                            }
                            
                            showMessage('Successfully', 0);
                        }else{
                            showMessage(data.msg,1);
                        }
                    },'json');
                }
            });
            $('.cancel').hide();
            return false;

        });
    });
</script>