<script src="<?php echo $this->webroot; ?>js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo $this->webroot; ?>css/bootstrap-multiselect.css">
<div class="panel">
    <div class="panel-body">
        <div id="AdminCompany" class="col-md-8">
            <form id="AddComapny" action="<?php echo $this->Html->Url('/store_company')?>" method="post">
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
                            <div class="col-xs-12 col-md-3">License Number</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="license" id="license" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Datafeed Number</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="datafeed_number" id="datafeed_number" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Select Datafeeds</div>
                            <div class="col-xs-12 col-md-9">
                                <select id="list_datafeed" name="list_datafeed" multiple="multiple">
                                    <?php if($list_datafeed!=""){ 
                                        foreach ($list_datafeed as $item) {
                                    ?>
                                    <option value="<?php echo $item->_id ?>"><?php echo $item->name ?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Email</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="email" id="email" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Address</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="address" id="address" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Website</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="website" id="website" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Telephone</div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" name="telephone" id="telephone" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-xs-12 col-lg-offset-5">
                        <button type="submit" class="btn btn-view col-xs-12 col-md-2 submit_pulse" style="margin-right: 5px">Submit</button>
                        <a href="<?php echo $this->Html->Url('/admin_company')?>" class="btn btn-view col-xs-12 col-md-2">Cancel</a>
                    </div>
                </div>    
            
            </form>
        </div>    
    </div>
</div>
<style>
    .multiselect-container{
        width: 300px;
    }
</style>
<script>
    
    $(document).ready(function() {
        $('#list_datafeed').multiselect({maxHeight: 300,enableFiltering: true});
        $('.checkbox input').attr({
            "name": 'datafeed[]'
        });
        $('#AddComapny').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required and can\'t be empty'
                        }
                    }
                },
                license: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required and can\'t be empty'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                            message: 'The email is not valid'
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required and can\'t be empty'
                        }
                    }
                },
                telephone: {
                    validators: {
                        digits: {
                            message: 'The phone number is not valid'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (event) {
            var count = $('input:checkbox:checked').length;
            if(count>0){
                $('#list_datafeed').next().next('.help-block').remove();
                $('.btn-group').parent().parent().parent().addClass('has-success');
                $('#AddComapny')[0].submit();
            }else{
                $('.btn-group').parent().parent().parent().addClass('has-error');
                $('.btn-group').after('<small class="help-block">Please choose datafeed</small>');
                return false;
            }
            
        });
    });
    
</script>