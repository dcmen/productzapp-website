<?php
$countries = array("", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
?>
<style>
    .grouplist {
        max-height: 200px;
        overflow-y: auto;
    }
    .gridlist {
        background: #fff none repeat scroll 0 0;
        left: 15px;
        line-height: 22px;
        position: absolute;
        top: 34px;
        width: 95%;
        z-index: 99;
    }
</style>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <form id="EditInfoUser" action="<?php echo $this->Html->Url('/edit_info_user/'.$rs->_id)?>" method="post">
                <input type="hidden" name="_id" value="<?php echo $rs->_id?>">
                <div class="form-group">
                    <div class="col-lg-4">CarZapp Number</div>
                    <div class="col-lg-8">
                        <input type="hidden" name="carzapp_code" value="<?php echo $rs->carzapp_code?>">
                        <input type="text" readonly name="code" autocomplete="off" class="form-control" value="<?php echo ($rs->is_principle == 1)?'A':'B'?><?php echo $rs->carzapp_code?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">First Name</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="name" value="<?php echo $rs->name?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Last Name</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="last_name" value="<?php echo $rs->last_name?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Email</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="email" value="<?php echo $rs->email?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Phone</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="phone" value="<?php echo $rs->phone?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Dealership</div>
                    <div class="col-md-8" style="position: relative;">
                        <input style="background-color: #fff; cursor: pointer;" readonly type="text" name="company_name" id="keychecker" autocomplete="off" class="form-control" value="<?php echo $rs->company_info->company_name?>">
                        <i class="fa fa-sort-asc" style="position: absolute; right: 24px;top: 4px;font-size: 18px;cursor: pointer;"></i>
                    </div>
                </div>

                <div class="old_company">
                    <div class="form-group">
                        <div class="col-lg-4">Dealer License Number</div>
                        <div class="col-lg-8">
                            <input type="text" name="license_number" autocomplete="off" class="form-control" value="<?php echo $rs->company_info->license_number?>">
                        </div>
                    </div>
                </div>
                
                <div class="new_company" style="display: none">
                    <div class="form-group">
                        <div class="col-lg-4">Dealer License Number</div>
                        <div class="col-lg-8">
                            <input readonly="true" type="text" name="license_number_new" autocomplete="off" class="form-control" value="">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-4">Dealership Phone</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="company_phone" value="<?php echo $rs->company_info->company_phone?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Datafeed Id</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="dealer_solution_number" value="<?php echo $rs->dealer_solution_number?>"></div>
                </div>
                <div class="form-group hidden">
                    <div class="col-md-4">Easy car number</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="easy_car_number" value="<?php // echo $rs->easy_car_number?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="is_principle" class="check_principle" <?php echo ($rs->is_principle == 1)?'checked':''?> value="1">Is principal
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="is_admin" <?php echo ($rs->is_admin == 1)?'checked':''?> value="1">Is admin
                        </label>
                    </div>
                </div>
                <!--company info-->
                <div class="form-group">
                    <div class="col-lg-4">Address</div>
                    <div class="col-lg-8">
                        <input type="text" name="address1" id="keycheckerAddress" value="<?php echo (isset($rs->company_info->street1) && $rs->company_info->street1)? $rs->company_info->street1 : '' ?>" autocomplete="off" class="form-control company-address-field" placeholder="Address line 1">
                        <i class="fa fa-search btn-search-address" style="position: absolute; right: 27px; top: 8px; font-size: 16px; cursor: pointer;"></i>
                        <img class="img-loading img-loading-address" src="<?php echo $this->webroot; ?>images/fancybox/fancybox_loading.gif" style="position: absolute; right: 27px; top: 9px; width: 15px; height: 15px; display: none;"/>
                        <div class="gridlist" id="gridlistAddress" style="display: none"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-8"><input placeholder="Address line 2" type="text" class="form-control" name="address2" value="<?php echo (isset($rs->company_info->street2) && $rs->company_info->street2)? $rs->company_info->street2 : '' ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-8"><input placeholder="Address line 3" type="text" class="form-control" name="address3" value="<?php echo (isset($rs->company_info->street3) && $rs->company_info->street3)? $rs->company_info->street3 : '' ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Suburb</div>
                    <div class="col-md-8"><input placeholder="Suburb" type="text" class="form-control" name="suburb" value="<?php echo (isset($rs->company_info->suburb) && $rs->company_info->suburb)? $rs->company_info->suburb : '' ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Post Code</div>
                    <div class="col-md-8"><input placeholder="Post Code" type="text" class="form-control" name="postcode" value="<?php echo (isset($rs->company_info->post_Code) && $rs->company_info->post_Code)? $rs->company_info->post_Code : '' ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">State</div>
                    <div class="col-lg-8">
                        <input <?php echo (isset($rs->company_info->country) && $rs->company_info->country && $rs->company_info->country == 'Australia')? 'style="display: none;" disabled' : '' ?> type="text" name="state" autocomplete="off" class="form-control company-address-field" placeholder="State" value="<?php echo (isset($rs->company_info->state) && $rs->company_info->state)? $rs->company_info->state : '' ?>">
                        <select <?php echo (!isset($rs->company_info->country) || $rs->company_info->country != 'Australia')? 'style="display: none;" disabled' : '' ?> name="state" class="form-control company-address-field">
                            <option <?php echo (isset($rs->company_info->state) && $rs->company_info->state == 'NSW')? 'selected' : '' ?> value="NSW">NSW</option>
                            <option <?php echo (isset($rs->company_info->state) && $rs->company_info->state == 'VIC')? 'selected' : '' ?> value="VIC">VIC</option>
                            <option <?php echo (isset($rs->company_info->state) && $rs->company_info->state == 'QLD')? 'selected' : '' ?> value="QLD">QLD</option>
                            <option <?php echo (isset($rs->company_info->state) && $rs->company_info->state == 'TAS')? 'selected' : '' ?> value="TAS">TAS</option>
                            <option <?php echo (isset($rs->company_info->state) && $rs->company_info->state == 'NT')? 'selected' : '' ?> value="NT">NT</option>
                            <option <?php echo (isset($rs->company_info->state) && $rs->company_info->state == 'WA')? 'selected' : '' ?> value="WA">WA</option>
                            <option <?php echo (isset($rs->company_info->state) && $rs->company_info->state == 'SA')? 'selected' : '' ?> value="SA">SA</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Country</div>
                    <div class="col-md-8">
                        <select name="country" class="form-control company-address-field">
                            <?php foreach ($countries as $country) : ?>
                            <option value="<?php echo $country ?>" <?php echo (isset($rs->company_info->country) && $rs->company_info->country && $rs->company_info->country == $country)? 'selected' : '' ?> ><?php echo $country ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <div class="col-md-4">Active since</div>
                    <div class="col-md-4"><input type="text" <?php echo (isset($rs->company_info->active_since) && $rs->company_info->active_since)? '' : 'disabled' ?> value="<?php echo (isset($rs->company_info->active_since) && $rs->company_info->active_since)? date('Y-m-d',strtotime($rs->company_info->active_since)) : '' ?>" class="form-control date" id="active_since" name="active_since_date"></div>
                    <div class="col-md-4" style="padding-top: 7px;"><label><input type="checkbox" name="inactive" <?php echo (isset($rs->company_info->active_since) && $rs->company_info->active_since)? '' : 'checked' ?> /> <span>Deactivate</span></label></div>
                </div>
                <input type="hidden" name="company_id" value="<?php echo $rs->company_info->company_id ?>" />
                
                <div class="form-group text-center">
                    <button type="submit" class="btn">Update</button>
                    <a class="btn btn-view" href="<?php echo $this->Html->Url('/all_user')?>">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="SearchDealershipModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog modal-sm vdialog" style="width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    Change Dealership To
                    <button style="position: absolute; top: 6px; right: 9px;" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-4"><label style="margin-top: 7px;">Search Dealership</label></div>
                        <div class="col-lg-8">
                            <input type="text" id="SearchDealershipInput" autocomplete="off" class="form-control" placeholder="Enter keyword" value="">
                            <i class="fa fa-search btn-search-company" style="position: absolute; right: 27px; top: 8px; font-size: 16px; cursor: pointer;"></i>
                            <img class="img-loading img-loading-company" src="<?php echo $this->webroot; ?>images/fancybox/fancybox_loading.gif" style="position: absolute; right: 27px; top: 9px; width: 15px; height: 15px; display: none;"/>
                        </div>
                        <div class="clearfix" style="margin-bottom: 15px;"></div>
                        <div class="col-lg-12" id="gridlist"></div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

<script>
    var listCompany;
$(document).ready(function() {
    var content = $(document);
    // BEGIN dealership

    $('input[name="company_name"]').click(function() {
        $('#SearchDealershipInput').val('');
        $('#gridlist').html('');
        $('#SearchDealershipModal').modal('show');
    });
    
    $('#SearchDealershipInput').keypress(function (e) {
        if (e.which == 13) {
            $('.btn-search-company').click();
        }
    });

    $('.btn-search-company').click(function () {
        btnSearch = $(this);
        keyword = $("#SearchDealershipInput").val();
        if (keyword.length > 0) {
            $('.img-loading-company').show();
            btnSearch.hide();
            $.get(root+"checkcompany",{keyword:keyword}, function(data) {
                $('.img-loading-company').hide();
                btnSearch.show();
                
                if(data.ds != ''){
                    $("#gridlist").html(data.ds);
                    listCompany = data.list_company;
                }else{
                    $("#gridlist").html('No data');
                    listCompany = null;
                }
            },'json');
        }
    });
    
    $(document).on('click', '.grouplist.group-company tr td', function () {
        // get data
        companyID = $(this).closest('tr').attr('data-id');
        companyName = $(this).closest('tr').text();

        var selectedCompany;
        for (i = 0; i < listCompany.length; ++i) {
            if (listCompany[i].company_info._id == companyID) {
                selectedCompany = listCompany[i].company_info;
                selectedCompany.address = (listCompany[i].address.length)? listCompany[i].address[0] : array();
                break;
            }
        }

        if (selectedCompany) {
            // dealership info
            $('input[name="company_id"]').val(selectedCompany._id);
            $('input[name="company_name"]').val((selectedCompany.name)? selectedCompany.name : '');
            $('input[name="license_number"]').val((selectedCompany.license_number)? selectedCompany.license_number : '');
            $('input[name="company_phone"]').val((selectedCompany.telephone)? selectedCompany.telephone : '');
            // dealership address
            $('input[name="address1"]').val((selectedCompany.address.address)? selectedCompany.address.address : '');
            $('input[name="address2"]').val((selectedCompany.address.address2)? selectedCompany.address.address2 : '');
            $('input[name="address3"]').val((selectedCompany.address.address3)? selectedCompany.address.address3 : '');
            $('input[name="suburb"]').val((selectedCompany.address.suburb)? selectedCompany.address.suburb : '');
            $('input[name="postcode"]').val((selectedCompany.address.postcode)? selectedCompany.address.postcode : '');
            $('input[name="state"]').val((selectedCompany.address.state)? selectedCompany.address.state : '');
            $('input[name="country"]').val((selectedCompany.address.country)? selectedCompany.address.country : '');
            // active
            $('input[name="active_since_date"]').val((selectedCompany.active_since)? selectedCompany.active_since : '');
            if (selectedCompany.active_since) {
                $('input[name="inactive"]').prop('checked', false);
            }
            else {
                $('input[name="inactive"]').prop('checked', true);
            }
            
            $('#SearchDealershipModal').modal('hide');
        }
        else {
            console.log('ERROR');
        }
    });
    // END dealership
    
    // BEGIN address
    $('#keycheckerAddress').keypress(function (e) {
        if (e.which == 13) {
            $('.btn-search-company').click();
        }
    });
    
    $('.btn-search-address').click(function () {
        btnSearch = $(this);
        keyword = $("#keycheckerAddress").val();
        if (keyword.length > 0) {
            $('.img-loading-address').show();
            btnSearch.hide();
            $.get( root+"facebooks/checkaddress",{keyword:keyword}, function(data) {
                $('.img-loading-address').hide();
                btnSearch.show();

                if(data.ds != ''){
                    $("#gridlistAddress").css('display','block');
                    $("#gridlistAddress").html(data.ds);
                }else{
                    $("#gridlistAddress").css('display','block');
                    $("#gridlistAddress").html('No data');
                }
            },'json');
        }
    });
    
    $(document).on('click', '.grouplist.group-address tr', function () {
        // get data
        address = $(this).text();
        addressID = $(this).attr('data-id');
        addressSuburb = $(this).attr('data-suburb');
        addressState = $(this).attr('data-state');
        addressPostCode = $(this).attr('data-post-code');

        $('input[name="address1"]').val(address);
        $('input[name="suburb"]').val(addressSuburb);
        $('input[name="postcode"]').val(addressPostCode);
        // set state
        $('select[name="state"]').prop('disabled', true);
        $('input[name="state"]').prop('disabled', false);
        $('select[name="state"]').hide();
        $('input[name="state"]').show();
        $('input[name="state"]').val(addressState);
    });

    $('body').click(function(){
        $("#gridlistAddress").hide();
    });
    
    $('select[name="country"]').change(function () {
        if ($(this).val() != 'Australia') {
            $('select[name="state"]').prop('disabled', true);
            $('input[name="state"]').prop('disabled', false);

            $('select[name="state"]').hide();
            $('input[name="state"]').show();

            $('input[name="state"]').val('');
        }
        else {
            $('select[name="state"]').prop('disabled', false);
            $('input[name="state"]').prop('disabled', true);

            $('select[name="state"]').show();
            $('input[name="state"]').hide();
        }
    });
    // END address
    
    $('#active_since').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        enableOnReadonly: true,
    });
    
    $('input[name="inactive"]').change(function () {
        if ($(this).is(':checked')) {
            $('#active_since').prop("disabled", true);
        }
        else {
            $('#active_since').prop("disabled", false);
        }
    });


    $('#EditInfoUser').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    }
                }
            },
            company_name: {
                validators: {
                    notEmpty: {
                        message: 'The dealership is required and can\'t be empty'
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
            },
            company_phone: {
                validators: {
                    regexp: {
                            regexp: /^[0-9 ]+$/,
                            message: 'Wrong data format'
                        }
                }
            },
            dealer_solution_number: {
                validators: {
                    regexp: {
                            regexp: /^[0-9 ]+$/,
                            message: 'Wrong data format'
                        }
                }
            },
            easy_car_number: {
                validators: {
                    regexp: {
                            regexp: /^[0-9 ]+$/,
                            message: 'Wrong data format'
                        }
                }
            },
            address1: {
                validators: {
                    notEmpty: {
                        message: 'The address is required and can\'t be empty'
                    }
                }
            }
        }
    });
    
    $("input[name='is_principle']").click(function(){
        
        if($(this).is(":checked")){
            carzapp_code = 'A' + $("input[name='carzapp_code']").val();
            $("input[name='code']").val(carzapp_code);
        }else{
            carzapp_code = 'B' + $("input[name='carzapp_code']").val();
            $("input[name='code']").val(carzapp_code);
        }
    });
});
</script>

