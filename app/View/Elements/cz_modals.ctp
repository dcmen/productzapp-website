<!--change password-->
<div id="changepassword" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change password</h4>
                </div>
                <div class="modal-body">
                    <form id="formChangePassword" action="changepassword" method="post" class="form-horizontal">
                        <div class="form-group current-pass-group">
                            <div style="font-size: 14px;" class="col-lg-5 col-xs-12">Current password</div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="password" name="currentpassword" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="font-size: 14px;" class="col-lg-5 col-xs-12">New password</div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="password" name="newpassword" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="font-size: 14px;" class="col-lg-5 col-xs-12">Confirm new password</div>
                            <div class="col-lg-7 col-xs-12">
                                <input type="password" name="re_password" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-xs-offset-3 col-lg-3 col-lg-offset-5">
                                <button class="btn btn-view col-xs-12" type="submit">OK</button>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $('input[name="currentpassword"]').val();
            $('#formChangePassword').formValidation({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    currentpassword: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter current password'
                            }
                        }
                    },
                    newpassword: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter new password'
                            },
                            regexp: {
                                regexp: /^\S*$/,
                                message: 'New password cannot contain space character(s)'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Password must be larger 6 characters in length'
                            }
                        }
                    },
                    re_password: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter confirm new password'
                            },
                            identical: {
                                field: 'newpassword',
                                message: 'Confirm new password does not match'
                            }
                        }
                    }
                }
            }).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                
                load_show();
                $.post($form.attr('action'), $form.serialize(), function (data) {
                    load_hide();
                    if(data.error == 0){
                        showMessage('Change password sussesfull', 0);
                        $('#changepassword').modal('hide');
                        $('#formChangePassword').trigger('reset');
                        
                        $('#changepassword .modal-body').css('height', '100%');
                        $('#changepassword .modal-title').text('Change Password');
                        $('#changepassword .btn-view').text('OK');
                        $('#changepassword .current-pass-group').show();
                        $('#changepassword .close').show();
                        
                        $("#formChangePassword").formValidation('updateStatus', 'currentpassword', 'NOT_VALIDATED')
                                                .formValidation('updateStatus', 'newpassword', 'NOT_VALIDATED')
                                                .formValidation('updateStatus', 're_password', 'NOT_VALIDATED');
                    }else{
                        showMessage(data.msg, 1);
                    }
                },'json');
            });  
        });
    </script>
</div>

<!--view video-->
<style>
    #viewVideoModal iframe {
        width: 100%;
        border: 0;
    }
</style>
<div id="viewVideoModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-close-viewvideomodal" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Video</h4>
            </div>
            <div class="modal-body">
                <iframe src="" allowfullscreen="" height="315"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-close-viewvideomodal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function () {
        $('.btn-close-viewvideomodal').click(function () {
            $('#viewVideoModal iframe').attr('src', '');
        });
    });
    </script>
</div>

<div id="PostRepostModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report</h4>
                </div>
                <div class="modal-body">
                    <form id="PostReportForm" method="post">
                        <input type="hidden" class="car-id" value="" />
                        <div class="form-group">
                            <textarea class="form-control" name="comment"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-view">OK</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
    <script> 
    $(document).ready(function () {

        $('#PostReportForm').formValidation({
            message: 'This value is not valid',
            fields: {
                comment: {
                    validators: {
                        notEmpty: {
                            message: 'The comment is required and can\'t be empty'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            load_show();
            $.post($('#PostReportForm').attr('action'), $form.serialize(), function (data) {
                load_hide();
                if(data.error == 0){
                    $("#pulse_repost").modal('hide');
                    showMessage('Report was sent successfully!', 0);
                    $('.btn-post-report[data-post-id="'+$('#PostRepostModal #PostReportForm .car-id').val()+'"]').addClass('flag-reported');
                    $('#PostReportForm')[0].reset();
                    $('#PostRepostModal').modal('hide');
                }else{
                    showMessage(data.msg, 1);
                }
            },'json');
        });
    });
    </script>
</div>