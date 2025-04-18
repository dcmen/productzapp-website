<div class="main-page">
    <?php // echo $this->element('cz_breadcrumb'); ?>
    <?php // echo $this->element('cz_title_page'); ?>

    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow" style="padding: 15px 40px 74px;">
                <form id="GroupAddGroupForm" action="<?php echo $this->Html->Url('/add_group')?>" method="post">
                    <!--Group Name-->
                    <div class="col-lg-12">
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">Group Name</h2>
                        </header>
                    </div>
                    <div class="col-lg-12 form-item-container">
                        <div class="form-group">
                            <div class="pos-rel">
                                <input type="text" name="name" class="form-control kb-input-item" placeholder="Enter group name">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--Choose Dealers-->
                    <div class="col-lg-12 pos-rel">
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">Choose Dealers</h2>
                        </header>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="list_user">
                            <?php if($list != '') : ?>
                                <?php foreach($list as $rs): ?>
                                <div class="form-group line_group">
                                    <div class="col-xs-2 col-lg-1 middle">
                                        <input type="checkbox" name="member_id[]" value="<?php echo $rs->_id?>">
                                    </div>
                                    <div class="col-xs-2 col-lg-1 icon no-padding">
                                        <?php
                                        if($rs->avatar != ''){
                                            echo '<img class="img-circle" src="'.$rs->avatar.'" style="width: 50px;height: 50px">';
                                        }else{
                                            echo $this->Html->image('/images/no_car.png',array('width'=>'50','height' => '50', 'class' => 'img-circle'));
                                        }
                                        ?>
                                    </div>
                                    <div class="col-xs-6 col-lg-9">
                                        <?php echo $rs->name?> <br>
                                        <?php echo $rs->email?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                            <i class="mg-left-10">No dealer</i>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="clearfix mg-bottom-40"></div>
                    
                    <div class="col-lg-12 mg-top-10">
                        <button type="submit" class="bt_login kb-btn-02 color-bg-site pull-right"> DONE <span class="fa fa-angle-right"></span></button>
                    </div>
                    
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#GroupAddGroupForm').formValidation({
            framework: 'bootstrap',
            message: 'This value is not valid',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required and can\'t be empty'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            load_show();
            $.post($('#GroupAddGroupForm').attr('action'), $form.serialize(), function (data) {
                load_hide();
                if(data.error == 0) {
                    showMessage('Added successfully', 0);
                    window.location.href = root + 'group';
                } else if(data.error == 1){
                    showMessage(data.msg, 1);
                }
            },'json');
        });
    });
</script>