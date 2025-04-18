<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .openfilterdis{
        display: none;
        position: absolute;
        left: 0;
        right: 0;
        height: 80px;
        z-index: 9999;
    }
    .closefilterdis{
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        height: 80px;
        z-index: 9999;
    }
</style>
<?php
echo $this->Html->css([
            'cz/dropdownchecklist/jquery-ui-1.8.13.custom',
            'cz/dropdownchecklist/ui.dropdownchecklist.themeroller',
            'cz/addslider/addSlider'
        ]);
echo $this->Html->script([
            'cz/dropdownchecklist/jquery-ui-1.8.13.custom.min',
            'cz/dropdownchecklist/ui.dropdownchecklist',
            'cz/addslider/Obj.min',
            'cz/addslider/addSlider'
        ]);

$rsGetFilter = $this->requestAction('cars/ResultDatasearch');
if ($rsGetFilter != '') {
    $filters = $rsGetFilter[0];
    for ($i = 0; $i < sizeof($filters); $i++) {
        if ($filters[$i]->field_name == 'make') {
            $car_make = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'gearbox') {
            $gearbox = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'body_colour') {
            $body_colour = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'body') {
            $body = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'fuel_type') {
            $fuel_type = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'seats') {
            $seats = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'series') {
            $series = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'manu_year_from') {
            $manu_year_from = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'manu_year_to') {
            $manu_year_to = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'price_from') {
            $price_from = $filters[$i]->values;
        }
        if ($filters[$i]->field_name == 'price_to') {
            $price_to = $filters[$i]->values;
        }
    }
}
?>
<style>
    .filter-item {
        margin-bottom: 24px;
    }
    .filter-item label {
        font-weight: 500;
        font-size: 14px;
        margin-top: 4px;
    }
    .filter-item select {
        width: 100%;
        height: 29px;
    }
    #ddcl-FlickaLocationSelection {
        width: 100%;
    }
    select > option {
        font-family: 'lato' !important;
        font-size: 13px !important;
        padding: 4px 5px 5px;
        border: 0 !important;
    }
</style>
<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-03">
            <!--select filter by-->
            <div class="flt-menu pull-right">
                <div class="btn-group mg-bottom-4">
                    <a href="javascript:;" class="flt-menu-content flt-menu-content-center btn-filter-flicka btn">
                        <span>Filter</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--modal-->
<div id="FilterFlicka" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 500px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Set Filter</h4>
                </div>
                <div class="modal-body">
                    <form id="FilterFlickaForm" method="get">
                        <div class="filter-container">
                            <input type="hidden" name="type" value="1" />
                            <!--manu year-->
                            <div class="filter-item">
                                <div class="col-lg-3 no-padding-max-640">
                                    <label>Year from</label>
                                </div>
                                <div class="col-lg-4 no-padding">
                                    <select name="year_from">
                                        <option value="">Any</option>
                                        <?php foreach ($manu_year_from as $year) : ?>
                                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-1 no-padding-max-640">
                                    <label>to</label>
                                </div>
                                <div class="col-lg-4 no-padding">
                                    <select name="year_to">
                                        <option value="">Any</option>
                                        <?php foreach ($manu_year_to as $year) : ?>
                                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!--location-->
                            <div class="filter-item">
                                <div class="col-lg-3 no-padding-max-640">
                                    <label>Location</label>
                                </div>
                                <div class="col-lg-9 no-padding">
                                    <select id="FlickaLocationSelection" multiple="multiple" name="location[]">
                                        <option value="NSW">NSW</option>
                                        <option value="NT">NT</option>
                                        <option value="QLD">QLD</option>
                                        <option value="SA">SA</option>
                                        <option value="TAS">TAS</option>
                                        <option value="ACT">ACT</option>
                                        <option value="VIC">VIC</option>
                                        <option value="WA">WA</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!--Price-->
                            <div class="filter-item">
                                <div class="col-lg-3 no-padding-max-640">
                                    <label>Price from</label>
                                </div>
                                <div class="col-lg-4 no-padding">
                                    <select name="price_from">
                                        <option value="">Any</option>
                                        <?php foreach ($price_from as $price) : ?>
                                        <option value="<?php echo str_replace("$","", str_replace(",","", $price)) ?>"><?php echo $price ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-1 no-padding-max-640">
                                    <label>to</label>
                                </div>
                                <div class="col-lg-4 no-padding">
                                    <select name="price_to">
                                        <option value="">Any</option>
                                        <?php foreach ($price_to as $price) : ?>
                                        <option value="<?php echo str_replace("$","", str_replace(",","", $price)) ?>"><?php echo $price ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!--distance-->
                            <div class="filter-item">
                                <div class="col-lg-3 no-padding-max-640">
                                    <label style="margin-top: 13px;">Distance</label>
                                </div>
                                <div class="col-lg-9 no-padding">
                                    <!-- Rounded switch -->
                                    <label class="switch">
                                        <input type="checkbox" name="distance" checked >
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="filter-item distance ">

                                <div class="col-lg-9 col-lg-offset-3 no-padding">
                                    <div class="wall closefilterdis"></div>
                                    <input
                                        name='distance'
                                        data-addui='slider'
                                        data-min='0'
                                        data-max='5500'
                                        data-formatter='kms'
                                        data-fontsize='13'
                                        data-step='1'
                                        data-range='true'
                                        value='0,5500'
                                        />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group line-form text-center">
                            <button type="submit" class="btn btn-view">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function betterParseFloat(x) {
            if(isNaN(parseFloat(x)) && x.length > 0)
                return betterParseFloat(x.substr(1));
            return parseFloat(x);
        }
        
        function kms(x){
            x = betterParseFloat(x);
            if(isNaN(x))
                return "0 kms";
            var kms = Math.floor(x) + '';
            return kms.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' kms';
        }
  
        var initDropdownCheckList = false;
        $(document).ready(function () {
            $('.btn-filter-flicka').click(function () {
                $('#FilterFlicka').modal('show');
                if (!initDropdownCheckList) {
                    initDropdownCheckList = true;
                    setTimeout(function () {
                        $('#FlickaLocationSelection').dropdownchecklist({
                            emptyText: "Any",
                            width: '100%'
                        });
                    }, 200);
                }
            });
            
            $('#FilterFlickaForm').submit(function () {
                if (parseInt($('select[name="year_from"]').val()) > parseInt($('select[name="year_to"]').val())) {
                    showMessage('Date (from) must be less than date (to)', 1);
                    return false;
                }
                if (parseInt($('select[name="price_from"]').val()) > parseInt($('select[name="price_to"]').val())) {
                    showMessage('Price (from) must be less than price (to)', 1);
                    return false;
                }
                load_show();
                return true;
            });
            $(document).on('change','input[type="checkbox"]', function() {
                value = ($(this).is(':checked'))? 1 : 0;
                if(value == 1){
                    $('.wall').removeClass('closefilterdis').addClass('openfilterdis');
                    $('.addui-slider-handle-l').css('background','#2196F3');
                    $('.addui-slider-handle-h').css('background','#2196F3');
                    $('.addui-slider-range').css('background','#2196F3');
                    $('.addui-slider-handle-l .addui-slider-value span').css({'color':'#2196F3','display':'block'});
                    $('.addui-slider-handle-h .addui-slider-value span').css({'color':'#2196F3','display':'block'});
                    $('.addui-slider .addui-slider-track .addui-slider-handle').append("<style>.addui-slider .addui-slider-track .addui-slider-handle::after{ background:#2196F3; }</style>");
                }else if(value == 0){
                    $('.wall').removeClass('openfilterdis').addClass('closefilterdis');
                    $('input[name=distance]').val('0,5500');
                    $('.addui-slider-range').css('left','0');
                    $('.addui-slider-range').css('width','100%');
                    $('.addui-slider-handle-l').css('left',0);
                    $('.addui-slider-handle-l').css('background','#ccc');
                    $('.addui-slider-handle::after').css('background','#ccc');
                    $('.addui-slider-handle-h').css('background','#ccc');
                    $('.addui-slider-handle-h').css('left','100%');
                    $('.addui-slider-handle-l .addui-slider-value span').css('display','none');
                    $('.addui-slider-handle-h .addui-slider-value span').css('display','none');
                    $('.addui-slider-range').css('background','#ccc');
                    $('.addui-slider .addui-slider-track .addui-slider-handle').append("<style>.addui-slider .addui-slider-track .addui-slider-handle::after{ background:#ccc; }</style>");
                }
            });
        });

    </script>
</div>