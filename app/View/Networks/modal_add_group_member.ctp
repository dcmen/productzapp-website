<div class="modal-body">
    <div class="modal-dialog vdialog" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Dealer</h4>
            </div>
            <div class="modal-body">
                <?php if($listnetwork) : ?>
                <form id="AddGroupMemberForm" action="<?php echo $this->Html->Url('/add_group_member')?>" method="post">
                    <input type="hidden" name="group_id" value="<?php echo $group_id ?>" />
                    <div class="col-lg-12">
                        <div class="list_user" style="min-height: 95px; max-height: 300px;">
                            <?php // if($listnetwork) : ?>
                                <?php foreach($listnetwork as $rs): ?>
                                <div class="form-group line_group">
                                    <div class="col-xs-2 col-lg-2 icon">
                                        <?php
                                        if($rs->avatar != ''){
                                            echo '<img class="img-circle" src="'.$rs->avatar.'" style="width: 40px;height: 40px">';
                                        }else{
                                            echo $this->Html->image('/images/no_car.png',array('width'=>'50','height' => '50', 'class' => 'img-circle'));
                                        }
                                        ?>
                                    </div>
                                    <div class="col-xs-6 col-lg-9">
                                        <?php echo $rs->name?> <br>
                                        <?php echo $rs->email?>
                                    </div>
                                    <div class="col-xs-2 col-lg-1 text-left no-padding middle">
                                        <input type="checkbox" name="member_id[]" value="<?php echo $rs->_id?>">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php // else : ?>
                            <!--<i class="mg-left-10">No dealer</i>-->
                            <?php // endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center mg-top-15">
                            <button class="btn btn-view" type="submit">OK</button>
                        </div>
                    </div>
                </form>   
                <?php else : ?>
                <i>No dealer</i>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('#AddGroupMemberForm').submit(function () {
        if ($('#AddGroupMemberForm input:checkbox:checked').length == 0) {
            showMessage('Select dealer', 1);
            return false;
        }
        else {
            load_show();
        }
    });
</script>