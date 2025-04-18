
<div class="modal-body">
    <div class="modal-dialog vdialog" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Customer</h4>
            </div>
            <div class="modal-body">
                <form id="CustomerEdit" method="post" class="form-horizontal" action="customer">
                    <input type="hidden" name="id" value="<?php echo $rs->_id?>">
                    <input type="hidden" name="type" value="edit" />
                    <div class="form-group">
                        <div class="col-lg-3"><label>Full name</label></div>
                        <div class="col-lg-9"><input type="text" class="form-control" name="full_name" value="<?php echo $rs->full_name?>"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3"><label>Email</label></div>
                        <div class="col-lg-9"><input type="text" class="form-control" name="email" value="<?php echo $rs->email?>"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3"><label>Phone</label></div>
                        <div class="col-lg-9"><input type="text" class="form-control"  name="phone" value="<?php echo $rs->phone?>"></div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-view close_pop">Save</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#CustomerEdit').formValidation({
        framework: 'bootstrap',
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
                        message: 'The full_name is required and can\'t be empty'
                    }
                }
            },
            phone: {
                validators: {
                    regexp: {
                        regexp: /^[0-9+]+$/,
                        message: "Please enter the number"
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: 'Phone number must be between 6-20 characters in length'
                    },
                    notEmpty: {
                        message: "The phone is required and can't be empty"
                    }
                }
            }
        }
    });
</script>