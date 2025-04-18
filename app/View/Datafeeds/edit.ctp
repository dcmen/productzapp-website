<div class="panel">
    <div class="panel-body">
        <div id="AdminDatafeed" class="col-md-8">
            <form id="EditDatafeed" action="<?php echo $this->Html->Url('/update_datafeed')?>" method="post">
                <?php $datafeed = $rs->datafeed ?>
                <input type="hidden" name="id" value="<?php echo $datafeed->_id ?>">
                <div class="content_pulse">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Name</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $datafeed->name ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Email Address</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="email" id="email" class="form-control" value="<?php echo isset($datafeed->email)? $datafeed->email : "" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Connection Method</div>
                            <div class="col-xs-12 col-md-3">
                                <select class="form-control" name="connection" id="connection">
                                    <option <?php echo (strtoupper($datafeed->connection)=='API')?'selected':'' ?> value="API">API</option>
                                    <option <?php echo (strtoupper($datafeed->connection)=='FTP')?'selected':'' ?> value="FTP">FTP</option>
                                    <option <?php echo (strtoupper($datafeed->connection)!='API'&&strtoupper($datafeed->connection)!='FTP')?'selected':'' ?> value="0">Other</option>
                                </select>
                            </div>
                            <div class="other col-xs-12 col-md-6">
                            <?php if(strtoupper($datafeed->connection)!='API'&&strtoupper($datafeed->connection)!='FTP'){ ?>
                                <input type="text" id="other" name="other" class="form-control" value="<?php echo isset($other)?$other:'' ?>">
                            <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">File Type</div>
                            <div class="col-xs-12 col-md-3">
                                <select class="form-control" name="filetype" id="filetype">
                                    <option <?php echo (strtoupper($datafeed->filetype)=='XML')?'selected':'' ?> value="XML">XML</option>
                                    <option <?php echo (strtoupper($datafeed->filetype)=='CSV')?'selected':'' ?> value="CSV">CSV</option>
                                    <option <?php echo (strtoupper($datafeed->filetype)=='XLSX')?'selected':'' ?> value="XLSX">EXCEL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">IP Address</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="ip" class="form-control" value="<?php echo isset($datafeed->ftp_ip_address)? $datafeed->ftp_ip_address : "" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Username</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="username" class="form-control" value="<?php echo isset($datafeed->ftp_username)? $datafeed->ftp_username : "" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Password</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="password" class="form-control" value="<?php echo isset($datafeed->ftp_password)? $datafeed->ftp_password : "" ?>">
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
    var option = {
            message: 'This value is not valid',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required and can\'t be empty'
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
                },
                other: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required and can\'t be empty'
                        }
                    }
                }
            }
        };
    $(document).ready(function() {
        $('#EditDatafeed').bootstrapValidator(option).on('success.form.bv', function (event) {
            $('#EditDatafeed')[0].submit();
        });
        $(document).on('change', '#connection', function(event) {
            if(this.value==0){
                //$('#EditDatafeed').bootstrapValidator().destroy();
                //$('#EditDatafeed').bootstrapValidator(option);
                $('.other').html('<input type="text" id="other" name="other" class="form-control" value="<?php echo isset($other)?$other:'' ?>">');
            }else{
                //$('#EditDatafeed').bootstrapValidator().destroy();
                //$('#EditDatafeed').bootstrapValidator(option);
                $('.other').html('');
            }
        });
    });
    
</script>