<div class="wrap_content">
    <div class="col-xs-12">
        <div class="title_response ridbon">
            <i class="fa fa-users"></i>
            Edit group
        </div>
    </div>
    <div id="MyNetwork" class="col-xs-12 col-lg-10 col-lg-offset-1">
        <?php echo $this->Form->create('Group', array('class' => 'form-horizontal')); ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" name="name" placeholder="Group name" class="form-control" value="<?php echo $title?>">
                </div>
            </div>
            <fieldset>
                <legend>Choose user</legend>
                <div class="form-group">
                    <div class="col-xs-12 col-md-5 col-md-offset-7">
                        <div class="search">
                            <input type="text" placeholder="Search" autocomplete="off" id="key" name="key" value="<?php echo ($key!='')?$key:''?>">
                            <input type="button" class="search_edit_group" value="">
                        </div>
                    </div>
                </div>

                <?php 
   
                if($networks != ''){
                    for($i=0;$i<sizeof($networks);$i++){
                        $rs = $networks[$i];
                        $check = ($ar_us != '' && in_array($rs->_id, $ar_us))?1:0;
                    ?>
                <div class="form-group line_group">
                    <div class="col-xs-2 col-lg-1 middle">
                        <input type="checkbox" name="member_id[]" <?php echo ($check == 1)?'checked':''?> value="<?php echo $rs->_id?>">
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
                    <div class="col-xs-1 middle">
                        <a href=""><i class="fa fa-group" style="font-size: 20px"></i></a>
                    </div>
                </div>
                    <?php } }?>
            </fieldset>   
            <div class="form-group text-center">
                <button type="submit" class="btn btn-view">DONE</button>
            </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>


<script type="text/javascript">
    key = $("input[name='key']").val();    
$('.pagecars').bootpag({
    total: <?php echo $maxpages?>,
    page: <?php echo $s_page?>,
    maxVisible: 5
}).on('page', function(event, num){
    window.location.href = root + 'edit_group/<?php echo $id?>?key='+key+'&page='+num;
});

$(".search_edit_group").click(function(){
    key = $("input[name='key']").val();
    window.location.href = root + 'edit_group/<?php echo $id?>?key='+key;
});
$('#GroupEditGroupForm').bootstrapValidator({
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
}).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target),
        validator = $form.data('bootstrapValidator');
        load_show();
        $.post($('#GroupEditGroupForm').attr('action'), $form.serialize(), function (data) {
            load_hide();
            if(data.error == 0){
                jAlert('Edited successfully','Messages');
                window.location.href = root + 'group';
            }else if(data.error == 1){
                jAlert(data.msg);
            }

        },'json');
});
</script>