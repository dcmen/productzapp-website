<div class="panel">
    <div class="panel-body">
        <div id="AdminDatafeed" class="col-md-8">
            <form id="AddDatafeed" action="<?php echo $this->Html->Url('/update_datafeed_details')?>" method="post">
                <input type="hidden" name="parent_id" value="<?php echo $parent_id?>">
                <input type="hidden" name="id" value="<?php echo $rs->_id?>">
                <div class="content_pulse">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Name</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $rs->name ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">FTP Parameters</div>
                            <br><br>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-xs-12 col-md-3">IP Address</div>
                                    <div class="col-xs-12 col-md-9">
                                        <input type="text" name="ip" class="form-control" value="<?php echo explode(' / ',$rs->ftp_parameters)[0] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-md-3">Username</div>
                                    <div class="col-xs-12 col-md-9">
                                        <input type="text" name="username" class="form-control" value="<?php echo explode(' / ',$rs->ftp_parameters)[1] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-md-3">Password</div>
                                    <div class="col-xs-12 col-md-9">
                                        <input type="text" name="password" class="form-control" value="<?php echo explode(' / ',$rs->ftp_parameters)[2] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-lg-offset-5">
                        <button type="submit" class="btn btn-view col-xs-12 col-md-2 submit_pulse" style="margin-right: 5px">Submit</button>
                        <a href="<?php echo $this->Html->Url('/admin_datafeed_detail?id='.$parent_id)?>" class="btn btn-view col-xs-12 col-md-2">Cancel</a>
                    </div>
                </div>    
            
            </form>
        </div>    
    </div>
</div>
<script>
    
    $(document).ready(function() {
        $('#AddDatafeed').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required and can\'t be empty'
                        }
                    }
                },

            }
        }).on('success.form.bv', function (event) {
            $('#AddDatafeed')[0].submit();
        });
    });
    
</script>