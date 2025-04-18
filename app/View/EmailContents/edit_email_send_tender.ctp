<style>
    .form-group{margin: 10px 0;min-height: 10px;}
    label{margin:5px 0;}
</style>
<?php echo $this->Html->script('cz/ckeditor1/ckeditor');?>

<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <?php if (isset($rs) && $rs) :?>
            <form id="EmailContentFormSendTender">
                <input type="hidden" name="key" value="<?php echo isset($rs->key)? $rs->key : '' ?>">
                <input type="hidden" name="name" value=" <?php echo isset($rs->name)? $rs->name : '' ?>">
                <div class="form-group">
                    <div class="col-lg-12"><label>Subject</label></div>
                    <div class="col-lg-12">
                        <input type="text" name="subject" autocomplete="off" class="form-control" value="<?php echo isset($rs->subject)? $rs->subject : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12"><label>Content</label></div>
                    <div class="col-lg-12">
                        <textarea name="content" class="ckeditor" id="content_email"><?php echo isset($rs->content)? $rs->content : '' ?></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn_submit">Save</button>
                    <a class="btn btn-view btn-cancel" href="<?php echo $this->Html->Url('/email_send_tender')?>">Cancel</a>
                </div>
            </form>
            <?php endif ;?>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#EmailContentFormSendTender').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
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
    });
});
    $('.btn_submit').click(function (){
        //get value text and html of ckeditor
        var content = CKEDITOR.instances['content_email'].getData();
        var key = $('input[name="key"]').val();
        var name = $('input[name="name"]').val();
        var subject = $('input[name="subject"]').val();
        if(content == ''){
            showMessage('The content is required and can\'t be empty',0);
            return false;
        }else {
            load_show();
            $.post(root + 'EmailContents/save_email_send_tender', {key:key,name:name,content:content,subject:subject}, function(data){
                if(data.error == 0){
                    load_hide();
                    showMessage('Successfully',0);

                }else{
                    load_hide();
                    showMessage('Failure',1);
                }
            },'json');
            return false;
        }
    });
    $('.btn-cancel').click(function() {
        load_show();
    });

</script>

