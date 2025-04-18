<?php 
//$suggestData = $this->requestAction('facebooks/getSuggestion');

$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
?>

<style>
    .gridlist, .gridlist-address {
        max-height: 200px;
        overflow-y: auto;
    }
    .btn-search-company, .btn-search-address {
        position: absolute;
        top: 10px;
        right: 25px;
        cursor: pointer;
    }
    .list-company-table, .list-company-address {
        width: 100%;
    }
    .signup-input label {
        margin-top: 5px;
    }
    input[type="text"]::-webkit-input-placeholder ,textarea[type="text"]::-webkit-input-placeholder {
        color:#ccc;
        font-size: 12px;
    }
    input[type="text"]:-moz-placeholder,textarea[type="text"]:-moz-placeholder {
        color:#ccc;
        font-size: 12px;
    }
    input[type="text"]::-moz-placeholder,textarea[type="text"]::-moz-placeholder {
        color:#ccc;
        font-size: 12px;
    }
    input[type="text"]:-ms-input-placeholder ,textarea[type="text"]:-ms-input-placeholder {
        color:#ccc;
        font-size: 12px;
    }
/*    #AddressSuggestion {
        border-radius: 0px;
    }*/
    .easy-autocomplete input {
        color: #858585;
    }
    
    input[type="checkbox"] {
        outline: 0 !important;
    }
</style>
<div class="wrapper_regis">
    <div class="col-xs-12 pull-left col-xs-offset-2 col-lg-10 col-lg-offset-1">
        <div style="margin: 30px 0">
            <a href="<?php echo $this->Html->Url('/')?>"><?php echo $this->Html->image('/images/ic_logo_login.png')?></a>
        </div>
    </div>
    <div id="sign_up">
        <form id="Regis_2" method="post" class="form-horizontal">
            <div class="step" style="position: absolute; width: 100%;">
                <ul>
                    <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                    <li><?php echo $this->Html->image('/images/radio_on.png')?></li>
                    <li><?php echo $this->Html->image('/images/radio_off.png')?></li>
                    <li><?php echo $this->Html->image('/images/radio_off.png')?></li>
                </ul>
            </div>

            <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 signup-input no-padding">
                <h5>Step 2</h5>
                <div class="col-xs-12 col-md-6 col-lg-6 no-padding-left">
                    <fieldset class="signup-box">
                        <div class="form-group">
                            <input type="text" name="company_name" id="keychecker" autocomplete="off" class="form-control input-custom" placeholder="Dealership Name" value="<?php echo $this->Session->read('company_name_rg')?>">
                            <i style="color:#fff" class="fa fa-search btn-search-company"></i>
                            <img class="img-loading img-loading-company" src="<?php echo $this->webroot; ?>images/fancybox/fancybox_loading.gif"/>
                            <div class="gridlist" id="gridlist" style="display: none"></div>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" name="license_number" autocomplete="off" class="form-control license-number-new input-custom" placeholder="Enter Dealership License Number" value="<?php echo $this->Session->read('license_number_rg')?>">
                            <input disabled style="display: none;" type="text" name="license_number_old" autocomplete="off" class="form-control license-number-old input-custom" placeholder="Dealership License Number" value="<?php echo $this->Session->read('license_number_rg')?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="border-checkbox control-checkbox agree-checkbox" style="margin-right: 20px;">
                                <input type="checkbox" name="is_principle" value="1">
                                <div class="j-check-confirm control_indicator"></div>
                                Principal of Dealership
                            </label>
                        </div>

                        <div id="form-group-AddressCompany" class="form-group" style="display: none">
                            <div class="col-lg-3 no-padding" ><label>Select address</label></div>
                            <div class="col-lg-6 no-padding-left">
                                <select id="AddressCompany" name="addresscompany" class="form-control select-custom company-address-field"></select>
                            </div>
                            <div class="col-lg-3 no-padding">
                                <label class="border-checkbox control-checkbox agree-checkbox">
                                    <span style="margin-right: 5px;">Add address</span>
                                    <input id="add_address" type="checkbox">
                                    <div class="j-check-confirm control_indicator"></div>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>   
                <input id="CompanyId" type="hidden" name="company_id" value=""/>

                <!--Dealership Address-->
                <input id="IsUpgrade" type="hidden" name="is_upgrade" value="0" />
                <div class="col-xs-12 col-md-6 col-lg-6">
                    <fieldset class="company_address border-fieldset">
                        <legend>Dealership Address</legend>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" name="address" id="keycheckerAddress" autocomplete="off" class="form-control input-custom" placeholder="Address line 1">
                                <!-- <i class="fa fa-search btn-search-address"></i> -->
                                <img class="img-loading img-loading-address" src="<?php echo $this->webroot; ?>images/fancybox/fancybox_loading.gif"/>
                                <div class="gridlist" id="gridlistAddress" style="display: none"></div>
                            </div>
                            <!--<div class="col-lg-8">
                                <input id="AddressSuggestion" type="text" name="address" autocomplete="off" class="form-control company-address-field" placeholder="Address line 1">
                            </div>-->
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" name="address2" id="address2"  autocomplete="off" class="form-control input-custom company-address-field" placeholder="Address line 2">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" id="address3"  name="address3" autocomplete="off" class="form-control input-custom company-address-field" placeholder="Address line 3">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" id="suburb"  name="suburb" autocomplete="off" class="form-control input-custom company-address-field" placeholder="Suburb">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" id="postcode"  name="postcode" autocomplete="off" class="form-control input-custom company-address-field" placeholder="Post Code">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <input style="display: none;" type="text"  name="state" autocomplete="off" class="form-control company-address-field" placeholder="State">
                                <label>State</label>
                                <select name="state"  id="state" class="form-control select-custom company-address-field">
                                    <option value="NSW">NSW</option>
                                    <option value="VIC">VIC</option>
                                    <option value="QLD">QLD</option>
                                    <option value="TAS">TAS</option>
                                    <option value="NT">NT</option>
                                    <option value="WA">WA</option>
                                    <option value="SA">SA</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <label>Country</label>
                                <select name="country" id="country"  class="form-control select-custom company-address-field">
                                    <?php foreach ($countries as $country) : ?>
                                    <option value="<?php echo $country ?>" <?php echo ($country == 'Australia')? 'selected' : '' ?> ><?php echo $country ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12" style="text-align: center; margin: 0px 0px 30px;">
                <a style="margin-right: 10px;" href="<?php echo $this->Html->Url('/facebooks/register_back')?>" class="btn btn-custom-back bt_back">Previous</a>
                <button  style="margin-left: 10px;" type="submit" class="btn btn-custom btn-proceed">Next</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var listCompany;
    var listAddress;
    var oldCompanyName = '';
    var test = null;
    var addressFromCompany = 0;
    var changeDealerShipName = 0;
    var newAddress=0;
    var changeAddress = 0;

    Vcore.Home.SubmitSignIn();
    
    fixSizeStepImage();
    
    function fixSizeStepImage() {
        $('#sign_up .step').css('width', $('#sign_up').width());
    }
    
    $(document).ready(function() {
        fixSizeStepImage();
        $(window).resize(function(){
            fixSizeStepImage();
        });
        
        $('.checkbox-group:checkbox').on('click', function() {
            var $box = $(this);
            if ($box.is(':checked')) {
                // get group of check box (by name)
                var group = ".checkbox-group:checkbox[name='" + $box.attr("name") + "']";
                // set all check box of group is false
                $(group).prop("checked", false);
                // check this
                $box.prop("checked", true);
            } else {
                $box.prop("checked", true);
            }
        });

        $('#Regis_2').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                company_name: {
                    message: 'The company_name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The company name is required and can\'t be empty'
                        }
                    }
                },
                license_number: {
                    message: 'The dealer number is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The dealer number is required and can\'t be empty'
                        }
//                        regexp: {
//                            regexp: /^[0-9+]+$/,
//                            message: "Please enter number"
//                        }
                    }
                },
//                license_number_old: {
//                    message: 'The dealer number is not valid',
//                    validators: {
//                        regexp: {
//                            regexp: /^[0-9+]+$/,
//                            message: "Please enter number"
//                        }
//                    }
//                },
                address: {
                    message: 'The dealer number is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The address is required and can\'t be empty'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            load_show();
            e.preventDefault();
            var $form = $(e.target);
            $.post('facebooks/register_step_2', $form.serialize(),function(data){
                load_hide();
                if(data.error == 0){
                    load_show();
                    window.location.href = root + 'sign_up';
                }else{
                    showMessage(data.msg, 1);
                }
                resetForm();
            },'json');
        });
        
        $('.btn-search-company').click(function () {
            btnSearch = $(this);
            keyword = $("#keychecker").val();
            if (keyword.length > 0) {
                $('.img-loading-company').show();
                btnSearch.hide();
                $.get( root+"checkcompany",{'keyword':keyword}, function(data) {
                    $('.img-loading-company').hide();
                    btnSearch.show();

                    if(data.ds != ''){
                        $("#gridlist").css('display','block');
                        $("#gridlist").html(data.ds);

                        listCompany = data.list_company;

                        oldCompanyName = $('#keychecker').val();

                        if (data.company_id) {
                            var selectedCompany;
                            for (i = 0; i < listCompany.length; ++i) {
                                if (listCompany[i].company_info._id == data.company_id) {
                                    selectedCompany = listCompany[i];
                                    break;
                                }
                            }

                            if (selectedCompany) {
                                // set dealer id and name
                                $('#CompanyId').val(selectedCompany._id);
                                $('#keychecker').val((selectedCompany.name)? selectedCompany.name : '');
                                // show form old dealershiper
                                $('input[name="license_number_old"]').prop('disabled', false);
                                $('input[name="license_number"]').hide();
                                $('input[name="license_number_old"]').show();
                                addressFromCompany = 1;

                                listAddress = selectedCompany.address;
                                $('#AddressCompany').html('');
                                for(i = 0; i < listAddress.length; i++){
                                    $('#AddressCompany').append('<option value="'+listAddress[i]._id+'">'+listAddress[i].address+'</option>');
                                }

                                $('input[name="address"]').val((listAddress[0].Street)? listAddress[0].Street : '');
                                $('input[name="address2"]').val((listAddress[0].Street1)? listAddress[0].Street1 : '');
                                $('input[name="address3"]').val((listAddress[0].Street2)? listAddress[0].Street2 : '');
                                $('input[name="suburb"]').val((listAddress[0].suburb)? listAddress[0].suburb : '');
                                $('input[name="postcode"]').val((listAddress[0].postcode)? listAddress[0].postcode : '');
                                $('select[name="country"]').val((listAddress[0].country)? listAddress[0].country : '');
                                //$('select[name="country"]').trigger('change');
                                $('input[name="state"]').val((listAddress[0].state)? listAddress[0].state : '');
                                $('select[name="state"]').val((listAddress[0].state)? listAddress[0].state : '');

                                resetForm();
                            }
                        }
                        else {
                            // clear company id
                            $('#CompanyId').val('');
                            // show form new dealershiper
                            $('input[name="license_number_old"]').prop('disabled', true);
                            $('input[name="license_number"]').show();
                            $('input[name="license_number_old"]').hide();
                            addressFromCompany = 0;

                            resetForm();
                        }
                    }else{
                        $("#gridlist").css('display','block');
                        $("#gridlist").html('No data');
                        listCompany = null;
                    }
                },'json');
            }
        });
        
        $('.btn-search-address').click(function () {
            btnSearch = $(this);
            keyword = $("#keycheckerAddress").val();
            if (keyword.length > 0) {
                $('.img-loading-address').show();
                btnSearch.hide();
                $.get( root+"facebooks/checkaddress",{'keyword':keyword}, function(data) {
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
        
        $('#keychecker').keypress(function (e) {
            if (e.which == 13) {
                changeDealerShipName = 0;
                oldCompanyName = $("#keychecker").val();
                resetAddress();
                $("#form-group-AddressCompany").css('display','none');
                $('.btn-search-company').click();
                return false;
            }
            else {
                changeDealerShipName = 1;
                
                $('#CompanyId').val('');
                $('#gridlist').hide();
                $('#gridlist').html('');
                listCompany = null;
                // show form new dealershiper
                $('input[name="license_number_old"]').prop('disabled', true);
                $('input[name="license_number"]').show();
                $('input[name="license_number_old"]').hide();
                // clear form address
                if (addressFromCompany) {
                    $('input[name="address"]').val('');
                    $('input[name="address2"]').val('');
                    $('input[name="address3"]').val('');
                    $('input[name="suburb"]').val('');
                    $('input[name="postcode"]').val('');
                    $('input[name="state"]').val('');
                    //$('select[name="state"]').val('');
                    $('select[name="country"]').val('Australia');

                    addressFromCompany = 0;
                }

                resetForm();
            }
        });

        $('#keychecker').dblclick(function(){
            if ($("#gridlist").children().length > 0 || $("#gridlist").text() != '') {
                $("#gridlist").show();
            }
        });
        
        $('#keycheckerAddress').dblclick(function(){
            if ($("#keycheckerAddress").children().length > 0 || $("#keycheckerAddress").text() != '') {
                $("#keycheckerAddress").show();
            }
        });
        $('input[name="company_name"]').blur(function(){
            $('.btn-search-company').click();
            $('#keychecker').change(function(){
                $("#form-group-AddressCompany").css('display','none');
                resetAddress();
            });
        });
        $('input[name="address"]').blur(function(){
            $('.btn-search-address').click();
        });



        
        $('#keycheckerAddress').keypress(function (e) {
            if (e.which == 13) {
                $('.btn-search-address').click();
                return false;
            }
            else {
                $('input[name="suburb"]').val('');
                $('input[name="postcode"]').val('');
                $('input[name="state"]').val('');
                $('select[name="country"]').val('Australia');
                resetForm();
            }
            return true;
        });
        
        $('body').click(function(){
            $("#gridlist").hide();
            $("#gridlistAddress").hide();
        });

        function selectAddress(item) {
            $("#form-group-AddressCompany").css('display','block');
            $('#IsUpgrade').val('1');
            disableAddress();
            // get data
            companyID = item.attr('data-id');
            companyName = item.text();
            var selectedCompany;
            for (i = 0; i < listCompany.length; ++i) {
                if (listCompany[i].company_info._id == companyID) {
                    selectedCompany = listCompany[i];
                    break;
                }
            }
            test = selectedCompany;
            if (selectedCompany) {
                $('#CompanyId').val(selectedCompany.company_info._id);
                $('#keychecker').val((selectedCompany.company_info.name)? selectedCompany.company_info.name : '');
                $('input[name="license_number_old"]').prop('disabled', false);
                $('input[name="license_number"]').hide();
                $('input[name="license_number_old"]').show();

                listAddress = selectedCompany.address;
                $('#AddressCompany').html('');
                for(i = 0; i < listAddress.length; i++){
                    $('#AddressCompany').append('<option value="'+listAddress[i]._id+'">'+listAddress[i].Street+'</option>');
                }
                $('input[name="address"]').val((listAddress[0].address)? listAddress[0].address : '');
                $('input[name="address2"]').val((listAddress[0].address1)? listAddress[0].address1 : '');
                $('input[name="address3"]').val((listAddress[0].address2)? listAddress[0].address2 : '');
                $('input[name="suburb"]').val((listAddress[0].suburb)? listAddress[0].suburb : '');
                $('input[name="postcode"]').val((listAddress[0].postcode)? listAddress[0].postcode : '');
                $('select[name="country"]').val((listAddress[0].country)? listAddress[0].country : '');
                //$('select[name="country"]').trigger('change');
                $('input[name="state"]').val((listAddress[0].state)? listAddress[0].state : '');
                $('select[name="state"]').val((listAddress[0].state)? listAddress[0].state : '');
                addressFromCompany = 1;
                resetForm();
            }
            else {
                console.log('ERROR');
            }
        }

        $(document).on('click', '.grouplist.group-company tr', function  () {
            selectAddress($(this));
        });

        $(document).on('click', '.grouplist.group-address tr', function () {
            // get data
            address = $(this).text();
            addressID = $(this).attr('data-id');
            address1 = $(this).attr('data-address1');
            address2 = $(this).attr('data-address2');
            addressSuburb = $(this).attr('data-suburb');
            addressState = $(this).attr('data-state');
            addressPostCode = $(this).attr('data-post-code');
            $('input[name="address"]').val(address);
            $('input[name="address1"]').val(address1);
            $('input[name="address2"]').val(address2);
            $('input[name="suburb"]').val(addressSuburb);
            $('input[name="postcode"]').val(addressPostCode);
        });

//        $(document).on('click', '.grouplist.group-address tr', function () {alert('1');
//            addressID = $(this).attr('data-id');
//            var selectedAddress;
//            for (i = 0; i < listAddress.length; ++i) {
//                if (listAddress[i].address._id == addressID) {
//                    selectedAddress = listAddress[i];
//                    break;
//                }
//            }
//            test = selectedAddress;
//            if (selectedAddress) {
//                $('#keycheckerAddress').val((selectedAddress.address)? selectedAddress.address: '');
//                $('input[name="address"]').val((selectedAddress.address)? selectedAddress.address : '');
//                $('input[name="address2"]').val((selectedAddress.address1)? selectedAddress.address1 : '');
//                $('input[name="address3"]').val((selectedAddress.address2)? selectedAddress.address2 : '');
//                $('input[name="suburb"]').val((selectedAddress.suburb)? selectedAddress.suburb : '');
//                $('input[name="postcode"]').val((selectedAddress.postcode)? selectedAddress.postcode : '');
//                $('select[name="country"]').val((selectedAddress.country)? selectedAddress.country : '');
//                //$('select[name="country"]').trigger('change');
//                $('input[name="state"]').val((selectedAddress.state)? selectedAddress.state : '');
//                $('select[name="state"]').val((selectedAddress.state)? selectedAddress.state : '');
//
//            }
//            });


        $('#AddressCompany').change(function() {
            addressID = $(this).val();
            companyName = $(this).text();
            var selectedAddress;
            i=0;
            for (i = 0; i < listAddress.length; ++i) {
                if (listAddress[i]._id == addressID) {
                    break;
                }
            }
             if(i<listAddress.length){
                $('input[name="address"]').val((listAddress[i].address)? listAddress[i].address : '');
                $('input[name="address2"]').val((listAddress[i].address1)? listAddress[i].address1 : '');
                $('input[name="address3"]').val((listAddress[i].address2)? listAddress[i].address2 : '');
                $('input[name="suburb"]').val((listAddress[i].suburb)? listAddress[i].suburb : '');
                $('input[name="postcode"]').val((listAddress[i].postcode)? listAddress[i].postcode : '');
                $('select[name="country"]').val((listAddress[i].country)? listAddress[i].country : '');
                //$('select[name="country"]').trigger('change');
                $('input[name="state"]').val((listAddress[i].state)? listAddress[i].state : '');
                $('select[name="state"]').val((listAddress[i].state)? listAddress[i].state : '');
            }

        });
        
//        $('select[name="country"]').change(function () {
//            if ($(this).val() != 'Australia') {
//                $('select[name="state"]').prop('disabled', true);
//                $('input[name="state"]').prop('disabled', false);
//
//                $('select[name="state"]').hide();
//                $('input[name="state"]').show();
//
//                $('input[name="state"]').val('');
//            }
//            else {
//                $('select[name="state"]').prop('disabled', false);
//                $('input[name="state"]').prop('disabled', true);
//
//                $('select[name="state"]').show();
//                $('input[name="state"]').hide();
//            }
//        });
        
        function resetForm() {
            $("#Regis_2").formValidation('updateStatus', 'company_name', 'NOT_VALIDATED')
                        .formValidation('updateStatus', 'license_number', 'NOT_VALIDATED')
                       /* .formValidation('updateStatus', 'address', 'NOT_VALIDATED');*/
                
            $('#Regis_2 .btn-proceed').removeClass('disabled');
            $('#Regis_2 .btn-proceed').prop('disabled', false);
        };
        $('input:checkbox#add_address').click(function(){
            resetAddress();
            if ($('#add_address').prop('checked')) {
                $('#AddressCompany').prop('disabled', true);
                $('#IsUpgrade').val('0');
                $('.btn-search-address').css('display','block');

            }
            else {
                $('#AddressCompany').prop('disabled', false);
                $('#IsUpgrade').val('1');
                disableAddress();
                $('.btn-search-address').css('display','none');

                addressIdSelected = $('#AddressCompany').val();
                i = 0;
                for(i = 0; i < listAddress.length; i++) {
                    if (listAddress[i]._id == addressIdSelected) {
                        break;
                    }
                }
                test=addressIdSelected;
                if(i<listAddress.length){
                    $('input[name="address"]').val((listAddress[i].address)? listAddress[i].address : '');
                    $('input[name="address2"]').val((listAddress[i].address1)? listAddress[i].address1 : '');
                    $('input[name="address3"]').val((listAddress[i].address2)? listAddress[i].address2 : '');
                    $('input[name="suburb"]').val((listAddress[i].suburb)? listAddress[i].suburb : '');
                    $('input[name="postcode"]').val((listAddress[i].postcode)? listAddress[i].postcode : '');
                    $('select[name="country"]').val((listAddress[i].country)? listAddress[i].country : '');
                    //$('select[name="country"]').trigger('change');
                    $('input[name="state"]').val((listAddress[i].state)? listAddress[i].state : '');
                    $('select[name="state"]').val((listAddress[i].state)? listAddress[i].state : '');
                }
            }
        });
        function resetAddress() {
            $('#keycheckerAddress').prop('disabled', false);
            $('#keycheckerAddress').val('');
            $('#address2').prop('disabled',false);
            $('#address2').val('');
            $('#address3').prop('disabled',false);
            $('#address3').val('');
            $('#suburb').prop('disabled',false);
            $('#suburb').val('');
            $('#postcode').prop('disabled',false);
            $('#postcode').val('');
            $('#state').prop('disabled',false);
            $('#state').val('');
            $('#country').prop('disabled',false);
            $('#country').val('');


        }
        function disableAddress() {
            $('.btn-search-address').css('display','none');
            $('#keycheckerAddress').prop('disabled', true);
            $('#address2').prop('disabled',true);
            $('#address3').prop('disabled', true);
            $('#suburb').prop('disabled', true);
            $('#postcode').prop('disabled', true);
            $('#state').prop('disabled', true);
            $('#country').prop('disabled', true);



        }
    });
</script>