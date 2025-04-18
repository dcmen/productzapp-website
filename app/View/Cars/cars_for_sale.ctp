<div class="main-page">
    <?php // echo $this->element('cz_breadcrumb'); ?>
    <?php // echo $this->element('cz_title_page'); ?>
    
    <?php // echo $this->element('cz_txt_bar', array('text' => 'REFINE YOURS SEARCH TO FIND THE SUITABLE CARS')); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-8">
            <div class="wg-box-shadow pd-content-06">
                <form id="searchCarForm" action="<?php echo $this->Html->Url('/resultcarsforsale')?>" method="get">
                    <!--header-->
                    <div class="col-lg-12">
                        <header class="wg-info-header">
                                <div class="wg-name-ridbon color-bg-site"></div>
                                <h2 class="wg-name font-size-17 truncate">Start Your Search</h2>
                              <!-- <h2 class="wg-name font-size-17 truncate" style="padding-left: 200px;">Save Search</h2>-->
                        </header>
                    </div>
                    
                    <!--keyword-->
                    <div class="col-lg-12 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Keyword</label>
                            <div class="pos-rel">
                                <input type="text" name="keyword" class="form-control kb-input-item" placeholder="Keyword: eg: Rego, body, make, features">
                            </div>

                        </div>
                    </div>

                    <!--make-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Make</label>
                            <select name="make" class="chosen-select form-control changemake-car4sale" data-placeholder="Choose a Make...">
                                <option value="">-- Choose a make --</option>
                                <?php for($i=0;$i<sizeof($makes);$i++){?>
                                <option value="<?php echo $makes[$i]?>"><?php echo $makes[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <!--Model-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Model</label>
                            <input type="hidden" name="getmake" value="">
                            <select name="model" required id="boxModel" class="chosen-select form-control changemodel-car4sale" data-placeholder="Choose a Model...">
                                <option value="" style="display:none">-- Choose a model --</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--series-->
                    <div class="col-lg-12 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Series</label>
                            <select name="series" id="boxSeries" class="chosen-select form-control">
                                <option value="">-- Choose a series --</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                
                    <!--Year-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Year (from)</label>
                            <select name="manu_year_from" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($manu_year_from);$i++){?>
                                <option value="<?php echo $manu_year_from[$i]?>"><?php echo $manu_year_from[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">(to)</label>
                            <select name="manu_year_to" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($manu_year_to);$i++){?>
                                <option value="<?php echo $manu_year_to[$i]?>"><?php echo $manu_year_to[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--Transmission-->
                    <div class="col-lg-12 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Transmission</label>
                            <select name="gearbox" id="boxSeries" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($gearboxs);$i++){?>
                                <option value="<?php echo $gearboxs[$i]?>"><?php echo $gearboxs[$i]?></option>
                                <?php };?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--Colour-->
                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Colour</label>
                            <select name="body_colour" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for ($i = 0; $i < sizeof($colos); $i++) { ?>
                                    <option value="<?php echo $colos[$i] ?>"><?php echo $colos[$i] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <!--Body Type-->
                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Body Type</label>
                            <select name="body" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for ($i = 0; $i < sizeof($bodys); $i++) { ?>
                                    <option value="<?php echo $bodys[$i] ?>"><?php echo $bodys[$i] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--price-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Price (from)</label>
                            <select name="price_from" class="chosen-select form-control">
                                <option value="">(Min) Any</option>
                                <?php for($i=0;$i<sizeof($price_from);$i++){?>
                                <option value="<?php echo $price_from[$i]?>"><?php echo $price_from[$i] ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">(to)</label>
                            <select name="price_to" class="chosen-select form-control">
                                <option value="">(Max) Any</option>
                                <?php for($i=0;$i<sizeof($price_to);$i++){?>
                                <option value="<?php echo $price_to[$i]?>"><?php echo $price_to[$i] ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                
                    <!--Kilometers-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Kilometers (from)</label>
                            <select name="odometer_from" class="chosen-select form-control">
                                <option value="">(Min) Any</option>
                                <?php for($i=0;$i<sizeof($odometer_from);$i++){?>
                                <option value="<?php echo $odometer_from[$i]?>"><?php echo $odometer_from[$i] ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">(to)</label>
                            <select name="odometer_to" class="chosen-select form-control">
                                <option value="">(Max) Any</option>
                                <?php for($i=0;$i<sizeof($odometer_to);$i++){?>
                                <option value="<?php echo $odometer_to[$i]?>"><?php echo $odometer_to[$i] ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--Location-->
<!--                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Location</label>
                            <select name="location" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($locations);$i++){?>
                                <option value="<?php echo $locations[$i]?>"><?php echo $locations[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>-->
                    <!--Post Code-->
<!--                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Post Code</label>
                            <select name="post_code" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($post_codes);$i++){?>
                                <option value="<?php echo $post_codes[$i]?>"><?php echo $post_codes[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>-->
                    
                    <!--Fuel type-->
                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Fuel Type</label>
                            <select name="fuel_type" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($fuel_types);$i++){?>
                                <option value="<?php echo $fuel_types[$i]?>"><?php echo $fuel_types[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                    <!--Seats-->
                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Seats</label>
                            <select name="seats" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($seats);$i++){?>
                                <option value="<?php echo $seats[$i]?>"><?php echo $seats[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix mg-bottom-30"></div>
                    
                    <!--Capacity-->
<!--                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Capacity</label>
                            <select name="engine_capacity" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($engine_capacity);$i++){?>
                                <option value="<?php echo $engine_capacity[$i]?>"><?php echo $engine_capacity[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>-->
                    
                    <!--Cylinder-->
<!--                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Cylinder</label>
                            <select name="cylinders" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($cylinders);$i++){?>
                                <option value="<?php echo $cylinders[$i]?>"><?php echo $cylinders[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>-->

                    <!--Gears-->
<!--                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Gears</label>
                            <select name="gears" class="chosen-select form-control" data-placeholder="Choose a Gear...">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($gears);$i++){?>
                                <option value="<?php echo $gears[$i]?>"><?php echo $gears[$i] . ' Speed' ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>-->
                    
                    <!--Doors-->
<!--                    <div class="col-lg-6 form-item-container">
                        <div>
                            <label class="txt-lb-name">Doors</label>
                            <select name="doors" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($doors);$i++){?>
                                <option value="<?php echo $doors[$i]?>"><?php echo $doors[$i] ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>-->
                    
                    
                    <div class="col-lg-12 mg-top-10">
                        <button type="submit" class="btn-search-submit kb-btn-02 color-bg-site pull-right"> SEARCH <span class="fa fa-angle-right"></span></button>
                    </div>
                    <div class="clearfix"></div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
        
        <div class="col-lg-4 dis-none-max-640">
            <div class="wg-box-shadow" style="padding: 9px 20px 6px;">
                <div class="col-lg-12">
                    <header class="wg-info-header no-underline" style="padding-bottom: 0">
                        <div class="wg-name-ridbon color-bg-site"></div>
                        <h2 class="wg-name font-size-17 truncate">Flicka for now</h2>
                    </header>
                </div>
                
                <div class="clearfix"></div>
            </div>
            
            <div class="clearfix mg-bottom-15"></div>
            
            <?php foreach ($cars as $car) : ?>
                <?php echo $this->element('cz_car_recommend_item', array('car' => $car)); ?>
                <div class="clearfix mg-bottom-15"></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    Vcore.Flicka.CarsforSale();
    Vcore.Flicka.Follow();
    
    $(document).ready(function () {
        $(".btn-search-submit").click(function(event){
            keyword = $("input[name='keyword']").val();
            make = $("select[name='make']").val();
            manu_year_from = $("select[name='manu_year_from']").val();
            manu_year_to = $("select[name='manu_year_to']").val();
            price_from = $("select[name='price_from']").val();
            price_to = $("select[name='price_to']").val();
            body_colour = $("select[name='price_to']").val();
            body = $("select[name='price_to']").val();
            odometer_from = $("select[name='odometer_from']").val();
            odometer_to = $("select[name='odometer_to']").val();
            fuel_type = $("select[name='fuel_type']").val();
            seats = $("select[name='seats']").val();
            locationSearch = $("select[name='location']").val();
            if(keyword == '' && make == '' && manu_year_from == '' && manu_year_to == '' && price_from == '' && price_to == ''
                && body_colour == '' && body == '' && odometer_from == '' && odometer_to == '' && locationSearch == ''
                && fuel_type == '' && seats == '')
            {
                showMessage('Please input data', 1);
                return false;
            }        
            if(price_to != '' && price_from != '')
            {
                price_to = price_to.replace("$", ""); 
                price_to = price_to.replace(",", ""); 
                price_from = price_from.replace("$", ""); 
                price_from = price_from.replace(",", ""); 
                
                if(parseInt(price_to) < parseInt(price_from))
                {
                    showMessage('Price (from) must be less than price (to)', 1);
                    return false;
                }
            }
            if(odometer_to != '' && odometer_from != '')
            {
                odometer_to = odometer_to.replace(",", ""); 
                odometer_from = odometer_from.replace(",", ""); 
                
                if(parseInt(odometer_to) < parseInt(odometer_from))
                {
                    showMessage('Kilometers (from) must be less than kilometers (to)', 1);
                    return false;
                }
            }
            $('#searchCarForm').submit();
            return false;
        });
    });
</script>