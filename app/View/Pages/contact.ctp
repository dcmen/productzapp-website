<!-- <div id="solution" style="margin-top: 0">
    <div class="introabout">
        <div class="ContactContent">
            <img src="<?php echo $this->webroot ?>images/ic_contact.png">
            <h1 class="color-white">
                CONTACT US
            </h1>
        </div>
    </div>
</div> -->
<div id="mainabout">
    <div class="main_content_terms">
        <div class="main_contact col-lg-8 col-lg-offset-2">
            <h1>Contact Us</h1>
            <p>Please feel free to send us your questions, comments, feedback and project ideas. We will be happy to hear from you.</p>
            <form id="Contact" action="" method="post" class="form-horizontal mg-top-35">
                <div class="col-xs-12 no-padding-mb no-padding">   
                    <div class="form-group">
                        <div class="col-xs-12 col-lg-3 no-margin-mb">
                            <label>Your name</label><span class="sao">*</span>
                        </div>
                        <div class="col-lg-9 col-xs-12 no-margin-mb">
                            <input type="text" name="name" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-lg-3 no-margin-mb">
                            <label>Email Address</label><span class="sao">*</span>
                        </div>
                        <div class="col-lg-9 col-xs-12 no-margin-mb">
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-lg-3 no-margin-mb">
                            <label>Phone Number </label>
                        </div>
                        <div class="col-lg-9 col-xs-12 no-margin-mb">
                            <input type="text" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-lg-3 no-margin-mb">
                            <label>Your Enquiry</label><span class="sao">*</span>
                        </div>
                        <div class="col-lg-9 col-xs-12 no-margin-mb">
                            <textarea name="content" style="height: 100px" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 no-margin-mb" style="text-align: right">
                            <img src="<?php echo $this->webroot ?>images/required.png">
                            Required
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12" style="text-align: right">
                            <button type="submit"  class="btn-kb-02">
                                Send
                            </button>
                        </div>     
                    </div>
                </div> 
            </form> 
        </div>    
    </div>
</div> 
<script type="text/javascript">
    $(document).ready(function () {
        $('#Contact').bootstrapValidator({
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
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required and can\'t be empty'
                        }
                    }
                },
                content: {
                    validators: {
                        notEmpty: {
                            message: 'The content is required and can\'t be empty'
                        }
                    }
                },
                phone: {
                    validators: {
                        regexp: {
                            regexp: /^[0-9 ]+$/,
                            message: 'Wrong data format'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
                    
            load_show();
            $.post(root + 'sendcontactajax', $form.serialize(), function (data) {
                load_hide();
                if(data.error == 0){
                    showMessage('Sent susscessfully');
                } else {
                    showMessage('Failure');
                }
            }, 'json');
        });
    });
</script>