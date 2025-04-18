<?php echo $this->Html->script('cz/ckeditor/ckeditor');?>

<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <?php if (isset($rs->_id) && $rs->_id) : ?>
            <form id="EmailContentForm" action="<?php echo $this->Html->Url('/emailcontents/edit_email/'. $rs->_id)?>" method="post">
            <?php else : ?>
            <form id="EmailContentForm" action="<?php echo $this->Html->Url('/emailcontents/add_email')?>" method="post">
            <?php endif; ?>
                <input type="hidden" name="id" value="<?php echo isset($rs->_id)? $rs->_id : '' ?>">
                <div class="form-group">
                    <div class="col-lg-12"><label>Keyword</label> (only allow 1-9, a-z, _ and .)</div>
                    <div class="col-lg-12">
                        <input type="text" name="key" autocomplete="off" class="form-control" value="<?php echo isset($rs->key)? $rs->key : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12"><label>Name</label></div>
                    <div class="col-lg-12">
                        <input type="text" name="name" autocomplete="off" class="form-control" value="<?php echo isset($rs->name)? $rs->name : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12"><label>Subject</label> <?php echo (isset($rs->_id) && $rs->_id)? "(don't change text inside [ ] )" : "" ?></div>
                    <div class="col-lg-12">
                        <input type="text" name="subject" autocomplete="off" class="form-control" value="<?php echo isset($rs->subject)? $rs->subject : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12"><label>Content</label> <?php echo (isset($rs->_id) && $rs->_id)? "(don't change text inside [ ] )" : "" ?></div>
                    <div class="col-lg-12">
                        <textarea name="content" class="ckeditor" id="content"><?php echo isset($rs->content)? $rs->content : '' ?></textarea>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn">Save</button>
                    <a class="btn btn-view btn-cancel" href="<?php echo $this->Html->Url('/emailcontents/list_email')?>">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#EmailContentForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            key: {
                validators: {
                    notEmpty: {
                        message: 'The key is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /^[0-9A-Za-z._]+$/,
                        message: 'Wrong data format'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    },
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    }
                }
            },
            subject: {
                validators: {
                    notEmpty: {
                        message: 'The subject is required and can\'t be empty'
                    }
                }
            },
            content: {
                validators: {
                    notEmpty: {
                        message: 'The content is required and can\'t be empty'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        load_show();
    });
    
    $('.btn-cancel').click(function() {
        load_show();
    });
});
</script>

