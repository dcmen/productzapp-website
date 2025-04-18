<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow" style="padding: 40px 8px;">
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                    <aside class="tutor-box">
                        <div class="tutor-step">
                            <h3 class="tutor-step-header">Step 1</h3>
                            <div class="tutor-step-content clearfix">
                                <div class="tutor-step-icon">
                                    <span class="fa fa-file-image-o"></span>
                                </div>
                                <div class="totor-step-text">
                                    <h4>PHOTOS & VIDEOS</h4>
                                    <p>Add images/videos of car</p>
                                </div>
                            </div>
                        </div>
                        <div class="tutor-step">
                            <h3 class="tutor-step-header">Step 2</h3>
                            <div class="tutor-step-content clearfix">
                                <div class="tutor-step-icon">
                                    <span class="fa fa-list-ul"></span>
                                </div>
                                <div class="totor-step-text">
                                    <h4>SELECT DETAIL</h4>
                                    <p>Choose car specifications</p>
                                </div>
                            </div>
                        </div>
                        <div class="tutor-step">
                            <h3 class="tutor-step-header">Step 3</h3>
                            <div class="tutor-step-content clearfix">
                                <div class="tutor-step-icon">
                                    <span class="fa fa-comment-o"></span>
                                </div>
                                <div class="totor-step-text">
                                    <h4>COMMENT & NOTE</h4>
                                    <p>Write yours comment & note</p>
                                </div>
                            </div>
                        </div>
                        <div class="tutor-step">
                            <h3 class="tutor-step-header">Step 4</h3>
                            <div class="tutor-step-content clearfix">
                                <div class="tutor-step-icon">
                                    <span class="fa fa-globe"></span>
                                </div>
                                <div class="totor-step-text">
                                    <h4>SUBMIT & PUBLISH</h4>
                                    <p>Submit & publish your car</p>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-7 col-xs-6">
                    <form id="CarAddStockByManualForm" class="form-horizontal mg-left-10" action="add_stock_by_manual" enctype="multipart/form-data" method="post">
                        <div class="col-lg-12">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Upload Your Car Photos</h2>
                            </header>
                        </div>

                        <!--image-->
                        <div class="col-lg-12 form-item-container">
                            <p class="txt-upload-photo">You can upload upto 10 photos of your vehicle here.</p>
                            <div class="img-review-container"></div>
                            <label class="btn-choose-photo">
                                <input class="input-choose-photo" data-img="1" name="file[]" type="file" accept=".png,.jpg,.jpeg">
                                <span class="txt-btn-choose-photo">CHOOSE A PHOTO</span>
                                <span class="fa fa-angle-right"></span>
                            </label>
                            <label class="txt-desc-choose-photo">Max. file size: 3.5 MB. Allowed images: jpg, jpeg, png.</label>
                        </div>

                        <!--video-->
                        <div class="col-lg-12 form-item-container">
                            <div class="pos-rel">
                                <input type="text" name="video_url" class="form-control kb-input-item video-link" style="background-color: transparent;" placeholder="LIKE YOUTUBE OR VIDEO URL">
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-12">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Enter Specifications Of Your Car</h2>
                            </header>
                        </div>

                        <!--Year-->
                        <div class="col-lg-12 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Year</label>
                                <select name="manu_year" class="chosen-select form-control">
                                    <option value="">-- Choose a year --</option>
                                    <?php foreach ($years as $year) : ?>
                                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <!--VIN-->
                        <div class="col-lg-6 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">VIN number</label>
                                <div class="pos-rel">
                                    <input type="text" name="vin_number" class="form-control kb-input-item" placeholder="Input your VIN" value="">
                                    <input type="button" class="search_vin">
                                </div>
                            </div>
                        </div>
                        <!--Registration date-->
                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Registration Date</label>
                                <div class="input-group date form_date kb-input-item-group" data-date="" data-date-format="dd-mm-yyyy">
                                    <input name="registration_date" class="form-control dateInput kb-group-item" size="16" type="text" readonly>
                                    <span class="input-group-addon kb-group-item"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <!--make-->
                        <div class="col-lg-6 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Make</label>
                                <div class="pos-rel">
                                    <input type="text" name="make" readonly class="form-control kb-input-item" value="">
                                </div>
                            </div>
                        </div>
                        <!--Model-->
                        <div class="col-lg-6 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Model</label>
                                <div class="pos-rel">
                                    <input type="text" name="model" readonly class="form-control kb-input-item" value="">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <!--variant-->
                        <div class="col-lg-6 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Variant</label>
                                <div class="pos-rel">
                                    <input type="text" name="variant" readonly class="form-control kb-input-item" value="">
                                </div>
                            </div>
                        </div>
                        <!--series-->
                        <div class="col-lg-6 form-item-container">
                            <div class="form-group">
                                <label class="txt-lb-name">Series</label>
                                <div class="pos-rel">
                                    <input type="text" name="series" readonly class="form-control kb-input-item" value="">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <!--transmission-->
                        <div class="col-lg-12 form-item-container">
                            <div>
                                <label class="txt-lb-name">Transmission</label>
                                <select name="gearbox" class="chosen-select form-control">
                                    <option value="">-- Choose a transmission --</option>
                                    <?php for ($i = 0; $i < sizeof($gearboxs); $i++) { ?>
                                        <option value="<?php echo $gearboxs[$i] ?>"><?php echo $gearboxs[$i] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Colour</label>
                                <select name="body_colour" class="chosen-select form-control" data-placeholder="Choose a Color...">
                                    <option value="">-- Choose a colour --</option>
                                    <?php for ($i = 0; $i < sizeof($colos); $i++) { ?>
                                        <option value="<?php echo $colos[$i] ?>"><?php echo $colos[$i] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Body Type</label>
                                <select name="body" class="chosen-select form-control" data-placeholder="Choose a Body type...">
                                    <option value="">-- Choose a body type --</option>
                                    <?php for ($i = 0; $i < sizeof($bodys); $i++) { ?>
                                        <option value="<?php echo $bodys[$i] ?>"><?php echo $bodys[$i] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Price</label>
                                <select name="price" class="chosen-select form-control" data-placeholder="Choose a Price...">
                                    <option value="">-- Choose a price --</option>
                                    <?php for ($i = 0; $i <= 150000; $i = $i + 2500) { ?>
                                        <option value="<?php echo $i ?>"><?php echo '$' . number_format($i,0,',',',') ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Retail</label>
                                <select name="retail" class="chosen-select form-control" data-placeholder="Choose a Price...">
                                    <option value="">-- Choose a retail --</option>
                                    <?php for ($i = 0; $i <= 150000; $i = $i + 2500) { ?>
                                        <option value="<?php echo $i ?>"><?php echo '$' . number_format($i,0,',',',') ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-12 form-item-container">
                            <div>
                                <label class="txt-lb-name">Kilometers</label>
                                <select name="odometer" class="chosen-select form-control" data-placeholder="Choose a Kilometters...">
                                    <option value="">-- Choose kilometers --</option>
                                    <?php for ($i = 0; $i <= 60000; $i = $i + 5000) { ?>
                                        <option value="<?php echo $i ?>"><?php echo number_format($i,0,',',',') ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Location</label>
                                <select name="location" class="chosen-select form-control" data-placeholder="Choose a location...">
                                    <option value="">-- Choose a location --</option>
                                    <?php for ($i = 0; $i < sizeof($locations); $i++) { ?>
                                        <option value="<?php echo $locations[$i] ?>"><?php echo $locations[$i] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Post Code</label>
                                <select name="postcode" class="chosen-select form-control" data-placeholder="Choose a To...">
                                    <option value="">-- Choose a post code --</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Distance</label>
                                <select name="distance" class="chosen-select form-control" data-placeholder="Choose a Kilometters...">
                                    <option value="">-- Choose a distance --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Drive Type</label>
                                <select name="drive" class="chosen-select form-control" data-placeholder="Choose a To...">
                                    <option value="">-- Choose a drive type --</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Fuel Type</label>
                                <select name="fuel_type" class="chosen-select form-control" data-placeholder="Choose a Kilometters...">
                                    <option value="">-- Choose a fuel type --</option>
                                    <?php for ($i = 0; $i < sizeof($fuel_types); $i++) { ?>
                                        <option value="<?php echo $fuel_types[$i] ?>"><?php echo $fuel_types[$i] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 form-item-container">
                            <div>
                                <label class="txt-lb-name">Seats</label>
                                <select name="seats" class="chosen-select form-control" data-placeholder="Choose a seat...">
                                    <option value="">-- Choose seats --</option>
                                    <?php for ($i = 0; $i < sizeof($seats); $i++) { ?>
                                        <option value="<?php echo $seats[$i] ?>"><?php echo $seats[$i] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-12">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Write Some Comments About Your Car </h2>
                            </header>
                        </div>

                        <div class="col-lg-12 form-item-container">
                            <div>
                                <textarea class="form-control kb-tbox-item" rows="5" id="comment" name="comments" placeholder="write additional comments"></textarea>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-12">
                            <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Write Some Notes About Your Car </h2>
                            </header>
                        </div>

                        <div class="col-lg-12 form-item-container">
                            <div>
                                <textarea class="form-control kb-tbox-item" rows="5" id="notes" name="notes" placeholder="write additional notes"></textarea>
                            </div>
                        </div>  
                        <div class="clearfix"></div>

                        <div class="col-lg-12 mg-top-10">
                            <button type="submit" class="kb-btn-02 color-bg-site pull-right">ADD TO MY STOCK<span class="fa fa-angle-right"></span></button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    <div class="mg-bottom-50"></div>
</div>

<script>
    Vcore.Flicka.MyStock();
    Vcore.Flicka.CarsforSale();
    
    var indexImg = 1;
    
    function viewThumbnail(files, index) {
        var output = $('.img-review-container');

        for(var i = 0; i< files.length; i++) {
            var file = files[i];
            //Only pics
            if(!file.type.match('image'))
                continue;

            var picReader = new FileReader();
            picReader.onload = function (event) {
                var picFile = event.target;
                test = picFile;
                output.append('<div class="thumbnail-container"><img class="thumbnail" src="' + picFile.result + '"/><div class="bg-cover"></div><i class="fa fa-times" data-img="'+index+'" title="Remove image"></i></div>');        
            };
            picReader.readAsDataURL(file);
        }
    }
    
    function initFilePicker() {
        $('.input-choose-photo').first().change(function() {
            if (this.files[0] && this.files[0].type.match('image')) {
                // display image has select
                viewThumbnail(this.files, $(this).attr('data-img'));
                // turn of event change of this file 
                $(this).off('change');
                // add new file picker
                indexImg++;
                $(this).before('<input class="input-choose-photo" data-img="'+indexImg+'" name="file[]" type="file" accept=".png,.jpg,.jpeg,.gif">');
                // set event change for this file picker
                initFilePicker();
            }
            else {
                showMessage('Please choose image', 1);
            }
        });
    }
    
    $(document).ready(function () {
        setCurrentDate('.dateInput');
        
        initFilePicker();
        
        $('.btn-choose-photo').click(function () {
            if ($('.img-review-container').children().length >= 10) {
                showMessage('Cannot choose more than 10 images', 1);
                return false;
            }
            else {
                return true;
            }
        });
        
        $(document).on('click', '.thumbnail-container > .fa-times', function () {
            index = $(this).attr('data-img');
            $('.input-choose-photo[data-img="'+index+'"]').remove();
            $(this).parent('.thumbnail-container').fadeOut("normal", function() {
                $(this).remove();
            });
        });
        
        $('.form_date').datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            endDate: '+0d'
        });
        
        $('.video-link').change(function () {
            if ($(this).val() == '') {
                $("#CarAddStockByManualForm").formValidation('updateStatus', 'video_link', 'NOT_VALIDATED');
            }
        });
        
        $("#CarAddStockByManualForm").formValidation({
            framework: 'bootstrap',
                message: 'This value is not valid',
                fields: {
                    vin_number: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your VIN number'
                            },
                            stringLength: {
                                min: 17,
                                max: 17,
                                message: 'Please enter 17 characters'
                            }
                        }
                    },
                    video_link: {
                        validators: {
                            uri: {
                                message: 'Video link is not valid'
                            }
                        }
                    }
                }
        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            // You can get the form instance
            var $form = $(e.target);
            // FormValidation instance
            var fv = $form.data('formValidation');
            $vin = $("input[name='vin_number']").val();
            $year = $("select[name='manu_year']").val();
            $make = $('input[name="make"]').val();
            $series = $('input[name="series"]').val();
            $model = $('input[name="model"]').val();
            
            if ($year) {
                if ($vin) {
                    if (!$make && !$series && !$model) {
                        load_show();

                        $.post(root + 'Cars/search_vin',{vin:vin, year:year},function(data){
                            if (data) {
                                $('input[name="make"]').val(data.make);
                                $('input[name="series"]').val(data.series);
                                $('input[name="model"]').val(data.model);
                                $('input[name="variant"]').val(data.variant_name);
                                $('select[name="body"]').val(data.body);
                                // submit form
                                fv.defaultSubmit();
                            }
                            else {
                                load_hide();
                                showMessage('Cannot found this car', 1);
                                $('input[name="make"]').val('');
                                $('input[name="series"]').val('');
                                $('input[name="model"]').val('');
                                $('input[name="variant"]').val('');
                                $('select[name="body"]').val('');
                            }
                        },'json');
                    }
                    else {
                        // submit form
                        fv.defaultSubmit();
                    }
                } else {
                    showMessage('Please enter VIN', 1);
                }
            }
            else {
                showMessage('Please select year', 1);
            }
        });
    });
</script>