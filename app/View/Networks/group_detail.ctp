<style>
    .action-item {
        opacity: 0.5;
    }
    .action-item:hover {
        opacity: 1;
    }
</style>
<div class="main-page">
    <?php // echo $this->element('cz_breadcrumb'); ?>
    <?php // echo $this->element('cz_title_page'); ?>

    <?php echo $this->element('cz_menu_bar_group_detail'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <form id="EditGroupForm" action="<?php echo $this->Html->Url('/edit_group/' . $id)?>" method="post">
                <div class="wg-box-shadow" style="padding: 15px 40px 74px;">
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
                                <input readonly type="text" name="name" class="form-control kb-input-item input-group-name" value="<?php echo $group_name ?>">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 pos-rel">
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">Dealers In Group</h2>
                        </header>
                    </div>

                    <div class="col-lg-12">
                        <div class="list_user pd-content-01">
                            <?php if($list) : ?>
                                <?php foreach($list as $rs) : ?>
                                <div class="form-group line_group">
                                    <div class="col-xs-2 col-lg-1 icon no-padding">
                                        <?php
                                        if($rs->avatar_file_name != ''){
                                            echo '<img class="img-circle" src="'.$rs->avatar_file_name.'" style="width: 50px;height: 50px">';
                                        }else{
                                            echo $this->Html->image('/images/no_car.png',array('width'=>'50','height' => '50', 'class' => 'img-circle'));
                                        }
                                        ?>
                                    </div>
                                    <div class="col-xs-6 col-lg-9">
                                        <?php echo $rs->user_name?> <br>
                                        <?php echo $rs->email?>
                                    </div>

                                    <div class="col-xs-1 middle">
                                        <a class="btn-remove-groupmember" style="display: none;" href="javascript:;" data-groupmemberid="<?php echo $rs->_id ?>" title="Remove dealer from group"><i class="fa fa-times color-red action-item" style="font-size: 20px"></i></a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <i class="mg-left-10">No dealer</i>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="clearfix mg-bottom-40"></div>
                    
                    <div class="col-lg-12 mg-top-10 group-btn-edit dis-none text-right">
                        <div class="dis-inlblock">
                            <a href="javascript:;" class="btn-cancel kb-btn-02 color-bg-site pull-right"> CANCEL <span class="fa fa-angle-right"></span></a>
                        </div>
                        <div class="dis-inlblock width-120">
                            <button type="submit" class="btn-submit-form kb-btn-02 color-bg-site pull-right"> DONE <span class="fa fa-angle-right"></span></button>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="AddGroupMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>

<script type="text/javascript">
    var gruopName = '<?php echo $group_name ?>';
    var groupId = '<?php echo $id ?>';
    var editGroup = '<?php echo $editgroup ?>';
    
    $(document).ready(function () {
        $(document).on('click', '.btn-remove-groupmember', function () {
            item = $(this);
            groupMemberId = $(this).attr('data-groupmemberid');
            jConfirm('Are you sure you want to delete these customers?','Message',function(r) {
                if(r){
                    load_show();
                    $.post(root + 'networks/remove_groupmember_ajax', {groupmember_id : groupMemberId}, function (data) {
                        load_hide();
                        if(data.error == 0) {
                            showMessage('Successfully', 0);
                            item.closest('.line_group').fadeOut('slow', function() {
                                $(this).remove();
                                if ($('.line_group').length == 0) {
                                    $('.list_user').html('<i>No dealer</i>');
                                }
                            });
                        } else if(data.error == 1){
                            showMessage('Failure', 1);
                        }
                    },'json');
                }
            });
        });
        
        $(document).on('click', '.btn-edit-group', function () {
            $('.input-group-name').attr('readonly', false);
            $('.input-group-name').focus();
            $('.group-btn-edit').show();
            $('.btn-add-dealer').show();
            
            $('.btn-remove-groupmember').show();
            
            $('.txt-title-page').text('Edit Group');
        });
        
        $(document).on('click', '.btn-cancel', function () {
            $('.input-group-name').val(gruopName);
            $('.input-group-name').attr("readonly", true);
            $('#EditGroupForm').formValidation('updateStatus', 'name', 'NOT_VALIDATED');
            $('.group-btn-edit').hide();
            $('.btn-add-dealer').hide();
            
            $('.btn-remove-groupmember').hide();
            
            $('.txt-title-page').text('Group Detail');
        });
        
        $(document).on('click', '.btn-add-dealer', function () {
            load_show();
            $.get(root + 'networks/getlistdealernotingroup?group_id=' + groupId, function(data) {
                load_hide();
                $("#AddGroupMemberModal").html(data);
                $('#AddGroupMemberModal').modal('show');
            });
        });
        
        $('#EditGroupForm').formValidation({
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
            load_show();
        });
        
        if (editGroup) {
            $('.btn-edit-group').trigger('click');
            editGroup = '';
        }
//        }).on('success.form.fv', function (e) {
//            e.preventDefault();
//            var $form = $(e.target);
//            load_show();
//            $.post($form.attr('action'), $form.serialize(), function (data) {
//                load_hide();
//                if(data.error == 0) {
//                    showMessage('Added successfully', 0);
//                    window.location.href = root + 'group';
//                } else if(data.error == 1){
//                    showMessage(data.msg, 1);
//                }
//            },'json');
//        });
    });
</script>