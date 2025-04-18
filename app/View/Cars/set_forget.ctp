<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    <div class="pd-content-01">
        <div class="col-lg-8">
            <div class="wg-box-shadow pd-content-06">
                <form id="SetForget" action="<?php echo $this->Html->Url('/get_setforget')?>" method="get">
                    <input type="hidden" name="option" value="1">
                    
                    <!--header-->
                    <div class="col-lg-12">
                        <header class="wg-info-header">
                            <div class="wg-name-ridbon color-bg-site"></div>
                            <h2 class="wg-name font-size-17 truncate">Start Your Search</h2>
                        </header>
                    </div>

                    <!--Customer-->
                    <div class="col-lg-12 form-item-container">
                        <div>
                            <label class="txt-lb-name">Customer</label>
                            <select name="customer_id" class="chosen-select form-control">
                                <option>Select a customer</option>
                                <?php foreach($customers as $rs):?>
                                <option value="<?php echo $rs->_id?>" <?php (CakeSession::read('Auth.User._id') == $rs->_id)? 'checked="checked"': ''?>>
                                    <?php  echo $rs->full_name?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <input type="hidden" name="arr_mynetwork" value="">
                    <div class="col-lg-12 form-item-container">
                        <div>
                            <label class="txt-lb-name" style="height: 0;"></label>
                            <a class="form-control kb-input-item" href="javascript:;" data-toggle="modal" data-target="#mynetwork" rel="mynetwork">
                                <label style="cursor: pointer;" class="msg-number-shared">Shared 0 dealer(s)</label>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                        
                    <!--keyword-->
                    <div class="col-lg-12 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Keyword</label>
                            <div class="pos-rel">
                                <input type="text" name="keyword" class="form-control kb-input-item" placeholder="Keyword: eg: Rego, body, make, features">
                            </div>
                        </div>
                    </div>
                    
                    <!--Year-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Year (from)</label>
                            <select name="manu_year_from" class="chosen-select form-control changeyearsearch">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($manu_year_from);$i++){?>
                                <option value="<?php echo $manu_year_from[$i]?>"><?php echo $manu_year_from[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Year (to)</label>
                            <select name="manu_year_to" class="chosen-select form-control changeyearsearch">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($manu_year_to);$i++){?>
                                <option value="<?php echo $manu_year_to[$i]?>"><?php echo $manu_year_to[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!--make-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Make</label>
                            <select id="boxMake" name="make" class="chosen-select form-control changemakesearch">
                                <option value="">Any</option>
                            </select>
                            <input type="hidden" name="make_code" />
                        </div>
                    </div>
                    <!--Model-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Model</label>
                            <input type="hidden" name="getmake" value="">
                            <select name="model" required id="boxModel" class="chosen-select form-control changemodelsearch">
                                <option value="">Any</option>
                            </select>
                            <input type="hidden" name="model_code" />
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <!--variant-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Variant</label>
                            <select name="variant" id="boxVariant" class="chosen-select form-control changevariantsearch">
                                <option value="">Any</option>
                            </select>
                        </div>
                    </div>
                    <!--series-->
                    <div class="col-lg-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Series</label>
                            <select name="series" id="boxSeries" class="chosen-select form-control">
                                <option value="">Any</option>
                            </select>
                            <input type="hidden" name="series_code" />
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <!--price-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Price (from)</label>
                            <select name="price_from" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($price_from);$i++){?>
                                <option value="<?php echo $price_from[$i]?>"><?php echo $price_from[$i] ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-item-container">
                        <div class="form-group">
                            <label class="txt-lb-name">Price (to)</label>
                            <select name="price_to" class="chosen-select form-control">
                                <option value="">Any</option>
                                <?php for($i=0;$i<sizeof($price_to);$i++){?>
                                <option value="<?php echo $price_to[$i]?>"><?php echo $price_to[$i] ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="clearfix mg-bottom-15"></div>
                    
                    <div class="col-lg-12 mg-top-10">
                        <button type="submit" class="save_set_forget kb-btn-02 color-bg-site pull-right" style="min-width: 180px;">SET & FORGET NOW<span class="fa fa-angle-right"></span></button>
                        <button type="submit" class="search_set_forget kb-btn-02 color-bg-site pull-right mg-right-25-min-768"> SEARCH <span class="fa fa-angle-right"></span></button>
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

<div id="mynetwork" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 700px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">My Network</h4>
                </div>
                <div class="modal-body">
                    <div class="content-make">
                        <?php
                        if(count($mynetwork) > 0){
                        foreach($mynetwork as $mk):
                        ?>
                        <div class="line-form">
                            <label style="font-weight: 500;">
                                <input type="checkbox" class="c_make" value="<?php echo $mk->_id?>">
                                <?php echo $mk->name?>
                            </label>
                        </div>
                        <?php 
                        endforeach;
                        }else{?>
                            Don't have dealer to share 
                        <?php }?>
                    </div>
                    <?php if(count($mynetwork) > 0) : ?>
                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view check_my_network">OK</button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    Vcore.Flicka.Follow();
    Vcore.Flicka.Setforget();
    Vcore.Flicka.CarsforSale();
    var listMake = {};
    var listModel = {};
    var listSeries = {};
    
    $(document).ready(function(){
        $('.changeyearsearch').change(function() {
            manu_year_from = $("select[name='manu_year_from']").val();
            manu_year_to = $("select[name='manu_year_to']").val();
            
            if(manu_year_to != '' && manu_year_from != '') {
                if(parseInt(manu_year_to) < parseInt(manu_year_from)) {
                    showMessage('Year (from) must be less than year (to)', 1);
                    return false;
                }
                else {
                    load_show();
                    $.post(root + 'cars/getmakelist',{year_from:manu_year_from, year_to:manu_year_to}, function(data){
                        $("#boxMake").html(data.html);
                        $("#boxMake").trigger("chosen:updated");
                        listMake = data.list;
                        
                        $("#boxModel").html('<option value="">Any</option>');
                        $("#boxModel").trigger("chosen:updated");
                
                        $("#boxVariant").html('<option value="">Any</option>');
                        $("#boxVariant").trigger("chosen:updated");
                        
                        $("#boxSeries").html('<option value="">Any</option>');
                        $("#boxSeries").trigger("chosen:updated");

                        load_hide();
                    }, 'json');
                }
            }
        });
        
        $(".changemakesearch").change(function() {
            manu_year_from = $("select[name='manu_year_from']").val();
            manu_year_to = $("select[name='manu_year_to']").val();
            make = listMake[$(this).val()];
            
            load_show();
            $.post(root + 'cars/getmodellist',{year_from:manu_year_from, year_to:manu_year_to, make:make}, function(data){
                $("#boxModel").html(data.html);
                $("#boxModel").trigger("chosen:updated");
                listModel = data.list;
                
                $("#boxVariant").html('<option value="">Any</option>');
                $("#boxVariant").trigger("chosen:updated");
                
                $("#boxSeries").html('<option value="">Any</option>');
                $("#boxSeries").trigger("chosen:updated");
                
                load_hide();
            }, 'json');
        });
        
        $(".changemodelsearch").change(function() {
            dataPost = {
                year_from : $("select[name='manu_year_from']").val(),
                year_to : $("select[name='manu_year_to']").val(),
                make : listMake[$("select[name='make']").val()],
                model : listModel[$(this).val()]
            };
            
            load_show();
            $.post(root + 'cars/getvariantlist', dataPost, function(data){
                $("#boxVariant").html(data.html);
                $("#boxVariant").trigger("chosen:updated");
                
                $("#boxSeries").html('<option value="">Any</option>');
                $("#boxSeries").trigger("chosen:updated");
                
                load_hide();
            }, 'json');
        });
        
        $(".changevariantsearch").change(function() {
            dataPost = {
                year_from : $("select[name='manu_year_from']").val(),
                year_to : $("select[name='manu_year_to']").val(),
                make : listMake[$("select[name='make']").val()],
                model : listModel[$("select[name='model']").val()],
                variant : $("select[name='variant']").val()
            };
            
            load_show();
            $.post(root + 'cars/getserieslist', dataPost, function(data){
                $("#boxSeries").html(data.html);
                $("#boxSeries").trigger("chosen:updated");
                listSeries = data.list;
                
                load_hide();
            }, 'json');
        });
        
        $(".search_set_forget").click(function() {
            make = $("select[name='make']").val();
            model = $("select[name='model']").val();
            variant = $("select[name='variant']").val();
            series = $("select[name='series']").val();
            manu_year_from = $("select[name='manu_year_from']").val();
            manu_year_to = $("select[name='manu_year_to']").val();
            price_from = $("select[name='price_from']").val();
            price_to = $("select[name='price_to']").val();
            
            if (!manu_year_from) {

                showMessage('Please select year (from)',1);
                return false;
            }
            if (!manu_year_to) {
                showMessage('Please select year (to)',1);
                return false;
            }
            if(manu_year_to != '' && manu_year_from != '') {
                if(parseInt(manu_year_to) < parseInt(manu_year_from)) {
                    showMessage('Year (from) must be less than year (to)',1);
                    return false;
                }
            }
            if (!make) {
                showMessage('Please select make',1);
                return false;
            }
            if (!model) {
                showMessage('Please select model',1);
                return false;
            }
            if(price_to != '' && price_from != '') {
                price_to = price_to.replace("$", ""); 
                price_to = price_to.replace(",", ""); 
                price_from = price_from.replace("$", ""); 
                price_from = price_from.replace(",", ""); 
                
                if(parseInt(price_to) < parseInt(price_from)) {
                    showMessage('Price (from) must be less than price (to)', 1);
                    return false;
                }
            }
            
            $("input[name='option']").val(0);
           
            load_show();
            
            $('#SetForget').submit();
            
            return false;
        });
        $('.kb-alert-message-popup .close').click(function(){
            $('.kb-alert-message-popup').css('display','none');
        });

        $(".save_set_forget").click(function() {
            make = $("select[name='make']").val();
            model = $("select[name='model']").val();
            variant = $("select[name='variant']").val();
            series = $("select[name='series']").val();
            manu_year_from = $("select[name='manu_year_from']").val();
            manu_year_to = $("select[name='manu_year_to']").val();
            price_from = $("select[name='price_from']").val();
            price_to = $("select[name='price_to']").val();
            
            if (!manu_year_from) {
                showMessage('Please select year (from)',1);
                return false;
            }
            if (!manu_year_to) {
                showMessage('Please select year (to)',1);
                return false;
            }
            if(manu_year_to != '' && manu_year_from != '') {
                if(parseInt(manu_year_to) < parseInt(manu_year_from)) {
                    showMessage('Year (from) must be less than year (to)',1);
                    return false;
                }
            }
            if (!make) {
                showMessage('Please select make',1);
                return false;
            }
            if (!model) {
                showMessage('Please select model',1);
                return false;
            }
            if(price_to != '' && price_from != '') {
                price_to = price_to.replace("$", ""); 
                price_to = price_to.replace(",", ""); 
                price_from = price_from.replace("$", ""); 
                price_from = price_from.replace(",", ""); 
                
                if(parseInt(price_to) < parseInt(price_from)) {
                    showMessage('Price (from) must be less than price (to)', 1);
                    return false;
                }
            }
            
            $("input[name='option']").val(1);
            
            $("input[name='make_code']").val(listMake[$("select[name='make']").val()]);
            $("input[name='model_code']").val(listModel[$("select[name='model']").val()]);
            $("input[name='series_code']").val(listSeries[$("select[name='series']").val()]);
            
            load_show();
            
            $('#SetForget').submit();
            
            return false;
        });
        
        $(".check_my_network").click(function(){
            var str_id = '';
            var count = 0;
            $("#mynetwork input[type='checkbox']").each(function(){
                if($(this).is(":checked")){
                    count++;
                    str_id += $(this).val()+'|';
                }
            });
            $('.msg-number-shared').html('Shared '+count+' dealer(s)');
            if(str_id != ''){
                $("#SetForget input[name='arr_mynetwork']").val(str_id);
            }else{
                $("#SetForget input[name='arr_mynetwork']").val('');
            }
            $("#mynetwork").modal('hide');
        });
    });
</script>