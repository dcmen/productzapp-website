<div class="ridbon">
    Add customer
</div>
<div class="body_pop" style="width: 400px">
    <?php if(isset($messages)){?>
        <div class="error"><?php echo $messages?></div>
    <?php }?>
    <?php echo $this->Form->create('Customer'); ?>
        <input type="hidden" name="id" value="">
        <div class="line-form">
            <label>Full name</label>
            <input type="text" name="full_name" value="" style="width: 300px">
        </div>
        <div class="line-form">
            <label>Email</label>
            <input type="text" name="email" value="" style="width: 300px">
        </div>
        <div class="line-form">
            <label>Phone</label>
            <input type="text" name="phone" value="" style="width: 300px">
        </div>
        <div class="form-group line-form" style="padding: 0 45%">
            <button type="submit" class="btn btn-view close_pop">Save</button>
        </div>
    <?php echo $this->Form->end(); ?>
</div>    
<script type="text/javascript">
        //validdate input of customer
        $('#CustomerAddcustomerForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                full_name: {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required and can\'t be empty'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'The phone is required and can\'t be empty'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            validator = $form.data('bootstrapValidator');
            load_show();
            $.post($('#Login').attr('action'), $form.serialize(), function (data) {
                load_hide();
                if(data.error == 0){
                    window.location.href = root + 'home';
                }else if(data.error == 2){
                    $("#my_login").modal('hide');
                    $("#enter_code_device").modal('show');
                }else{
                    jAlert(data.msg);
                    showMessageold();
                }

            },'json');
        });
</script>