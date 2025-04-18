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
            <form id="AddComapny" action="<?php echo $this->Html->Url('/update_company')?>" method="post">
                <input type="hidden" name="_id" value="<?php echo $rs->_id ?>">
                <div class="content_pulse">
                    <div class="form-group">
                        <div class="col-lg-4">Name</div>
                        <div class="col-lg-8">
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $rs->name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">License Number</div>
                        <div class="col-lg-8">
                            <input type="text" name="license" id="license" class="form-control" value="<?php echo isset($rs->license_number)? $rs->license_number : '' ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-4">Select Datafeeds</div>
                        <div class="col-lg-8">
                            <select id="select_datafeed"  name="datafeed" class="form-control">
                                <?php if($list_datafeed){
                                    foreach ($list_datafeed as $item) {
                                        ?>
                                        <option

                                            <?php
                                            if($rs->datafeed!=''){
                                                foreach ($rs->datafeed as $item_datafeed) {
                                                    if($item_datafeed->_id==$item->_id){ echo 'selected';}
                                                }
                                            }
                                            else{

                                            }
                                            ?>
                                            value="<?php echo $item->_id ?>"><?php echo $item->name ?></option>
                                    <?php }}?>
                            </select>
<!--                            <select id="list_datafeed" name="list_datafeed" multiple="multiple">-->
<!--                                --><?php //if($list_datafeed){
//                                    foreach ($list_datafeed as $item) {
//                                ?>
<!--                                <option  value="--><?php //echo $item->_id ?><!--">--><?php //echo $item->name ?><!--</option>-->
<!--                                --><?php //}}?>
<!--                            </select>-->
                        </div>
                    </div>
                    
                    <!--address info-->
<!--                    <div class="form-group">-->
<!--                        <div class="col-lg-4">Address</div>-->
<!--                        <div class="col-lg-8">-->
<!--                            <input type="text" name="address1" id="keycheckerAddress" value="--><?php //echo (isset($rs->address) && $rs->address)? $rs->address : '' ?><!--" autocomplete="off" class="form-control company-address-field" placeholder="Address line 1">-->
<!--                            <i class="fa fa-search btn-search-address" style="position: absolute; right: 27px; top: 8px; font-size: 16px; cursor: pointer;"></i>-->
<!--                            <img class="img-loading img-loading-address" src="--><?php //echo $this->webroot; ?><!--images/fancybox/fancybox_loading.gif" style="position: absolute; right: 27px; top: 9px; width: 15px; height: 15px; display: none;"/>-->
<!--                            <div class="gridlist" id="gridlistAddress" style="display: none"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <div class="col-md-4"></div>-->
<!--                        <div class="col-md-8"><input placeholder="Address line 2" type="text" class="form-control" name="address2" value="--><?php //echo (isset($rs->address2) && $rs->address2)? $rs->address2 : '' ?><!--"></div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <div class="col-md-4"></div>-->
<!--                        <div class="col-md-8"><input placeholder="Address line 3" type="text" class="form-control" name="address3" value="--><?php //echo (isset($rs->address3) && $rs->address3)? $rs->address3 : '' ?><!--"></div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <div class="col-md-4">Suburb</div>-->
<!--                        <div class="col-md-8"><input placeholder="Suburb" type="text" class="form-control" name="suburb" value="--><?php //echo (isset($rs->suburb) && $rs->suburb)? $rs->suburb : '' ?><!--"></div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <div class="col-md-4">Post Code</div>-->
<!--                        <div class="col-md-8"><input placeholder="Post Code" type="text" class="form-control" name="postcode" value="--><?php //echo (isset($rs->post_Code) && $rs->post_Code)? $rs->post_Code : '' ?><!--"></div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <div class="col-md-4">State</div>-->
<!--                        <div class="col-lg-8">-->
<!--                            <input --><?php //echo (isset($rs->country) && $rs->country && $rs->country == 'Australia')? 'style="display: none;" disabled' : '' ?><!-- type="text" name="state" autocomplete="off" class="form-control company-address-field" placeholder="State" value="--><?php //echo (isset($rs->state) && $rs->state)? $rs->state : '' ?><!--">-->
<!--                            <select --><?php //echo (!isset($rs->country) || $rs->country != 'Australia')? 'style="display: none;" disabled' : '' ?><!-- name="state" class="form-control company-address-field">-->
<!--                                <option --><?php //echo (isset($rs->state) && $rs->state == 'NSW')? 'selected' : '' ?><!-- value="NSW">NSW</option>-->
<!--                                <option --><?php //echo (isset($rs->state) && $rs->state == 'VIC')? 'selected' : '' ?><!-- value="VIC">VIC</option>-->
<!--                                <option --><?php //echo (isset($rs->state) && $rs->state == 'QLD')? 'selected' : '' ?><!-- value="QLD">QLD</option>-->
<!--                                <option --><?php //echo (isset($rs->state) && $rs->state == 'TAS')? 'selected' : '' ?><!-- value="TAS">TAS</option>-->
<!--                                <option --><?php //echo (isset($rs->state) && $rs->state == 'NT')? 'selected' : '' ?><!-- value="NT">NT</option>-->
<!--                                <option --><?php //echo (isset($rs->state) && $rs->state == 'WA')? 'selected' : '' ?><!-- value="WA">WA</option>-->
<!--                                <option --><?php //echo (isset($rs->state) && $rs->state == 'SA')? 'selected' : '' ?><!-- value="SA">SA</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <div class="col-md-4">Country</div>-->
<!--                        <div class="col-md-8">-->
<!--                            <select name="country" class="form-control company-address-field">-->
<!--                                --><?php //foreach ($countries as $country) : ?>
<!--                                <option value="--><?php //echo $country ?><!--" --><?php //echo (isset($rs->country) && $rs->country && $rs->country == $country)? 'selected' : '' ?><!-- >--><?php //echo $country ?><!--</option>-->
<!--                                --><?php //endforeach; ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group">
                        <div class="col-lg-4">Telephone</div>
                        <div class="col-lg-8">
                            <input type="text" name="telephone" class="form-control" value="<?php echo isset($rs->telephone)? $rs->telephone : '' ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="email" value="<?php echo (isset($rs->email) && $rs->email)? $rs->email : '' ?>"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">Website</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="website" value="<?php echo (isset($rs->website) && $rs->website)? $rs->website : '' ?>"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">Fax</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="fax" value="<?php echo (isset($rs->fax) && $rs->fax)? $rs->fax : '' ?>"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">ABN</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="abn" value="<?php echo (isset($rs->abn) && $rs->abn)? $rs->abn : '' ?>"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">ACN</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="acn" value="<?php echo (isset($rs->acn) && $rs->acn)? $rs->acn : '' ?>"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">DUN</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="dun" value="<?php echo (isset($rs->dun) && $rs->dun)? $rs->dun : '' ?>"></div>
                    </div>
               <!--     <div class="form-group">
                        <div class="col-md-4">Is login</div>
                        <div class="col-md-8"><input type="checkbox"  name="is_login" <?php (isset($rs->is_login ) && $rs->is_login==1)? 'checked':'' ?>></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">Is Readdata</div>
                        <div class="col-md-8"><input type="checkbox"  name="is_readdata" <?php  (isset($rs->is_readdata) && $rs->is_readdata==1)? 'checked':'' ?>></div>
                    </div>
                    -->
                   <!-- <div class="form-group">
                        <div class="col-md-4">Active since</div>
                        <div class="col-md-4"><input type="text" <?php /*// echo (isset($rs->active_since) && $rs->active_since)? '' : 'disabled' */?> value="<?php /*echo (isset($rs->active_since) && $rs->active_since)? date('Y-m-d',strtotime($rs->active_since)) : '' */?>" class="form-control date" id="active_since" name="active_since_date"></div>
                        <div class="col-md-4" style="padding-top: 7px;"><label><input type="checkbox" name="inactive" <?php /*// echo (isset($rs->active_since) && $rs->active_since)? '' : 'checked' */?> /> <span>Deactivate</span></label></div>
                    </div>-->
                    
                    <div class="col-xs-12 col-lg-offset-5">
                        <button type="submit" class="btn btn-view col-xs-12 col-md-2 submit_pulse" style="margin-right: 5px">Submit</button>
                        <a href="<?php echo $this->Html->Url('/admin_company')?>" class="btn btn-view col-xs-12 col-md-2">Cancel</a>
                    </div>
                </div>    
            
            </form>
        </div>    
    </div>
</div>

<script>
    $(document).ready(function() {
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