<script src="<?php echo $this->webroot; ?>js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo $this->webroot; ?>css/bootstrap-multiselect.css">

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
    .multiselect-item.multiselect-filter {
        display: none;
    }
</style>
<div class="panel">
    <div class="panel-body">
        <div id="AdminCompany" class="col-md-8">
            <form id="AddComapny" action="<?php echo $this->Html->Url('/update_address')?>" method="post">
                <input type="hidden" name="_id" value="<?php echo $rs->_id ?>">
                <div class="content_pulse">

                    <!--address info-->
                                        <div class="form-group">
                                            <div class="col-lg-4">Address line 1</div>
                                            <!--hidden field dealershipname and company_id-->
                                            <input type="hidden" name="dealershipname" value="<?php echo $dealership_name ;?>">
                                            <input type="hidden" name="company_id" value="<?php echo $company_id ; ?>">
                                            <div class="col-lg-8">
                                                <input type="hidden" name="branch_address_id" id="branch_address_id" value="<?php echo $rs->_id;?>">
                                                <input type="text" name="address1" id="keycheckerAddress" value="<?php echo (isset($rs->address1) && $rs->address1)? $rs->address1 : '' ?>" autocomplete="off" class="form-control company-address-field" placeholder="Address line 1">
                                                <img class="img-loading img-loading-address" src="<?php echo $this->webroot; ?>images/fancybox/fancybox_loading.gif" style="position: absolute; right: 27px; top: 9px; width: 15px; height: 15px; display: none;"/>
                                                <div class="gridlist" id="gridlistAddress" style="display: none"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">Address line 2</div>
                                            <div class="col-md-8"><input placeholder="Address line 2" type="text"  name="address2" class="form-control" name="address2" value="<?php echo (isset($rs->address2) && $rs->address2)? $rs->address2 : '' ?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">Address line 3</div>
                                            <div class="col-md-8"><input placeholder="Address line 3" type="text"  name="address3" class="form-control" name="address3" value="<?php echo (isset($rs->address3) && $rs->address3)? $rs->address3 : '' ?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">Suburb</div>
                                            <div class="col-md-8"><input placeholder="Suburb" type="text"  name="suburb" class="form-control" name="suburb" value="<?php echo (isset($rs->suburb) && $rs->suburb)? $rs->suburb : '' ?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">Post Code</div>
                                            <div class="col-md-8"><input placeholder="Post Code" type="text" name="postcode" class="form-control" name="postcode" value="<?php echo (isset($rs->post_Code) && $rs->post_Code)? $rs->post_Code : '' ?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">State</div>
                                            <div class="col-lg-8">
                                                <input <?php echo (isset($rs->country) && $rs->country && $rs->country == 'Australia')? 'style="display: none;" disabled' : '' ?> type="text" name="state" autocomplete="off" class="form-control company-address-field" placeholder="State" value="<?php echo (isset($rs->state) && $rs->state)? $rs->state : '' ?>">
                                                <select <?php echo (!isset($rs->country) || $rs->country != 'Australia')? 'style="display: none;" disabled' : '' ?> name="state" class="form-control company-address-field">
                                                    <option <?php echo (isset($rs->state) && $rs->state == 'NSW')? 'selected' : '' ?> value="NSW">NSW</option>
                                                    <option <?php echo (isset($rs->state) && $rs->state == 'VIC')? 'selected' : '' ?> value="VIC">VIC</option>
                                                    <option <?php echo (isset($rs->state) && $rs->state == 'QLD')? 'selected' : '' ?> value="QLD">QLD</option>
                                                    <option <?php echo (isset($rs->state) && $rs->state == 'TAS')? 'selected' : '' ?> value="TAS">TAS</option>
                                                    <option <?php echo (isset($rs->state) && $rs->state == 'NT')? 'selected' : '' ?> value="NT">NT</option>
                                                    <option <?php echo (isset($rs->state) && $rs->state == 'WA')? 'selected' : '' ?> value="WA">WA</option>
                                                    <option <?php echo (isset($rs->state) && $rs->state == 'SA')? 'selected' : '' ?> value="SA">SA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">Country</div>
                                            <div class="col-md-8">
                                                <select name="country" class="form-control company-address-field">
                                                    <?php foreach ($countries as $country) : ?>
                                                    <option value="<?php echo $country ?>" <?php echo (isset($rs->country) && $rs->country && $rs->country == $country)? 'selected' : '' ?> ><?php echo $country ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                    <div class="form-group">
                        <div class="col-md-4">Add datafeedId</div>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="datafeedId" name="datafeedId[]"  value= '<?php if($rs){
                                ?><?php if(isset($rs->datafeeds_id_str)){ echo $rs->datafeeds_id_str;}  ?>' <?php }?>' data-role="tagsinput" />
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-offset-5">
                        <button type="submit" id="editaddress" class="btn btn-view col-xs-12 col-md-2 submit_pulse" style="margin-right: 5px" >Submit</button>
                        <a href="<?php echo $this->Html->Url('/companies/address_company?company_id='.$company_id .'&dealership_name=' .$dealership_name)?>" class="btn btn-view col-xs-12 col-md-2">Cancel</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //Disable auto submit when enter!!!!!!
        $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
        //Remove all character not is nummeric
        $('.bootstrap-tagsinput input[type=text]').keyup(function() {
            var regex = new RegExp(/[^0-9]/g);
            var containsNonNumeric = this.value.match(regex);
            if (containsNonNumeric)
                this.value = this.value.replace(regex, '');
        });
        // BEGIN datafeed
        $('#list_datafeed').multiselect({maxHeight: 300,enableFiltering: true});
        $('.checkbox input').attr({
            "name": 'datafeed[]'
        });
        // END datafeed

        $('#AddComapny').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required and can\'t be empty'
                        }
                    }
                },
                license: {
                    validators: {
                        notEmpty: {
                            message: 'The license number is required and can\'t be empty'
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'The address is required and can\'t be empty'
                        }
                    }
                },
                address1: {
                    validators: {
                        notEmpty: {
                            message: 'The address line 1 is required and can\'t be empty'
                        }
                    }
                },
                suburb: {
                    validators: {
                        notEmpty: {
                            message: 'The suburb is required and can\'t be empty'
                        }
                    }
                },
                state: {
                    validators: {
                        notEmpty: {
                            message: 'The state is required and can\'t be empty'
                        }
                    }
                }
            }
        });

        // BEGIN address
        $('#keycheckerAddress').keypress(function (e) {
            if (e.which == 13) {
                $('.btn-search-company').click();
                //return false;
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

        // BEGIN active_since
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
        // END active_since
    });

</script>