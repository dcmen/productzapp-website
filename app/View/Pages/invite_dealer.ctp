<div class="main-page">
    <?php // echo $this->element('cz_breadcrumb'); ?>
    <?php // echo $this->element('cz_title_page'); ?>
    
    <?php // echo $this->element('cz_filterflicka'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow">
                <div id="MyNetwork" class="col-xs-12">
                    <div id="invite" class="col-lg-10 col-lg-offset-1">
                        <form id="FormSendMail" method="post" class="form-horizontal" action="<?php echo $this->Html->Url('/ajaxsendinvitedealer') ?>">
                            <div class="form-group">
                                <div class="col-lg-12 col-md-12"><input type="text" class="form-control" name="email" value="" placeholder="Send to email"></div>
                            </div>
                            <div class="bg_cc">
                                <p style="margin-bottom: 15px;"><?php echo CakeSession::read('Auth.User.name') ?> has invited you to join the CarZapp dealer network.</p>
                                <p style="text-indent: 10px;">- Connect with Dealers</p>
                                <p style="text-indent: 10px;">- Buy and Sell Cars Fast</p>
                                <p style="text-indent: 10px; margin-bottom: 15px;">- Grow Your Network</p>
                                <p style="margin-bottom: 15px;">Please download the app by clicking on one of these links to proceed:</p>
                                <p style="margin-bottom: 15px;">iOS - <a href="https://appsto.re/au/iJXK9.i">https://appsto.re/au/iJXK9.i</a></p>
                                <p style="margin-bottom: 15px;">Android - <a href=" https://play.google.com/store/apps/details?id=com.carzapp.australia">https://play.google.com/store/apps/details?id=com.carzapp.australia</a></p>
                                <p>The CarZapp Team.</p>
                            </div>
                            <div style="margin-top: 15px;">
                                <button type="submit" href="javascript:;" class="kb-btn-02 color-bg-site pull-right" style="font-size: 15px;">Send<span class="fa fa-angle-right"></span></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>    
        </div>
    </div>
    
    <div class="mg-bottom-50"></div>
</div>

<script>
    $("#FormSendMail").formValidation({
        framework: 'bootstrap',
        message: 'This value is not valid',
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            }
        }
    }).on('success.form.fv', function (e) {
//        e.preventDefault();
//        var $form = $(e.target);
                
        load_show();
//        $.post(root + 'ajaxsendinvitedealer', $form.serialize(),function(data){
//            $("#FormSendMail").formValidation('updateStatus', 'email', 'NOT_VALIDATED');
//            showMessage('Invitations have been sent, but we can not guarantee that they have been received, please follow up with the Dealers directly.', 0);
//            load_hide();
//        });
    });
</script>