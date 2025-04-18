<div class="panel">
    <div class="panel-body">
        <div id="AdminDatafeed" class="col-md-8">
            <form id="AddDatafeed" action="<?php echo $this->Html->Url('/store_datafeed')?>" method="post">
                <div class="content_pulse">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Name</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Email Address</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="email" id="email" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Connection Method</div>
                            <div class="col-xs-12 col-md-3">
                                <select class="form-control" name="connection" id="connection">
                                    <option value="API">API</option>
                                    <option value="FTP">FTP</option>
                                    <option value="0">Other</option>
                                </select>
                            </div>
                            <div class="other col-xs-12 col-md-6">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">File Type</div>
                            <div class="col-xs-12 col-md-3">
                                <select class="form-control" name="filetype" id="filetype">
                                    <option value="XML">XML</option>
                                    <option value="CSV">CSV</option>
                                    <option value="XLSX">EXCEL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">IP Address</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="ip" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Username</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="username" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Password</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="password" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-lg-offset-5">
                        <button type="submit" class="btn btn-view col-xs-12 col-md-2 submit_pulse" style="margin-right: 5px">Submit</button>
                        <a href="<?php echo $this->Html->Url('/connect_datafeed')?>" class="btn btn-view col-xs-12 col-md-2">Cancel</a>
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
                            message: 'Please enter Name'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Email Address'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (event) {
            $('#AddDatafeed')[0].submit();
        });
        $(document).on('change', '#connection', function(event) {
            if(this.value==0){
                $('.other').html('<input type="text" id="other" name="other" class="form-control">');
            }else{
                $('.other').html('');
            }
        });
    });
    
</script>