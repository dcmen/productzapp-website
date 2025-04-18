<style>
    .img-car {
        max-height: 120px;
        max-width: 120px;
    }
    .no-padding-left {
        padding-left: 0px;
    }
    .checkbox input[type="checkbox"] {
        outline: 0;
    }
</style>
<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12 no-padding">
            <form action="<?php echo $this->Html->Url('/list_car_no_data')?>" method="get">
                <input type="hidden" name="limit" value="<?php echo $limit?>" />
                <div class="col-md-3 no-padding-left">
                    <label>Enter key:</label>
                    <input class="form-control keyword" type="text" name="key" placeholder=" VIN, Title car, Dealership" autocomplete="false" value="<?php echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="col-md-2" style="padding: 0px 0px 0px 4px;;">
                    <label>Type:</label>
                    <select name="type" class="form-control type">
                        <option value="0" <?php echo ($type == 0)?'selected':''?>>All</option>
                        <option value="1" <?php echo ($type == 1)?'selected':''?>>No VIN car</option>
                        <option value="2" <?php echo ($type == 2)?'selected':''?>>No image car</option>
                    </select>
                </div>
                <div class="col-md-4 btn_control text-right pull-right no-padding" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Export" class="btn btn-view export_car">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '')?'':'style="display: none"'?>>
                    <!--<input type="button" value="Setting" class="btn btn-view setting-display-car" onclick="showModalSetting()">-->
                    <a class="btn btn-view setting-display-car" style="font-size: 15px;" href="javascript:;" onclick="showModalSetting()" title="Setting display the cars missing data"><i class="fa fa-cog" ></i> Setting</a>
                </div>
            </form>   
            
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="regisbrochure" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('vin','<?php echo (isset($u_sort)?$u_sort:1) ?>')">
                                VIN <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('Image','<?php echo (isset($u_sort)?$u_sort:3) ?>')">
                                Image <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('car','<?php echo (isset($u_sort)?$u_sort:5) ?>')">
                                Car <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
<!--                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('dealer','<?php // echo (isset($u_sort)?$u_sort:7) ?>')">
                                Dealer <?php // echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('company','<?php echo (isset($u_sort)?$u_sort:7) ?>')">
                                Dealership <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th class="text-center">
                            Hide/Unhide
                        </th>
                    </tr>
                </thead>
                <tbody class="body_pulse">
                    <?php
                    if($list != ''){
                        $i = $stt;
                        foreach($list as $rs):
                        $car = ($rs->cars != null)?$rs->cars:'';    
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $car->vin_number?></td>
                        <td>
                            <?php if ($car->image_url) : ?></a>
                            <img class="img-car" src="<?php echo $car->image_url ?>"/>
                            <?php endif; ?></a>
                        </td>
                        <td><?php echo ($car != '')?$car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gears:''?></td>
<!--                        <td>
                            <?php // echo ($rs->users->dealer_name)?>
                        </td>-->
                        <td>
                            <?php echo ($rs->company->company_name)?>
                        </td>
                        <td class="text-center">
                            <input style="outline: 0;" class="checker-show-car" data-car-id="<?php echo $car->_id ?>" type="checkbox" <?php echo (isset($car->is_active) && $car->is_active == 2)? 'checked' : '' ?> />
                        </td>
                    </tr>
                    <?php 
                    $i++;
                    endforeach;}?>
                </tbody>
            </table>
            <div class="row" style="margin: 20px 0 0;font-size: 13px;float: right">
                <div class="total_pag">
                    Total: <b><?php echo $total?></b>.             
                </div>
                <div class="pagina_select col-lg-2 col-xs-6 no-padding form-group">
                    <?php
                        $limit = (isset($this->params->query['limit'])) ? $this->params->query['limit'] : '6';
                        $options = array(20 => '20', 50 => '50', 100 => '100', 200 => '200');

                        echo $this->Form->create(array('type' => 'get'));
                    ?>
                    <label>Show</label>
                    <?php
                        echo $this->Form->select('limit', $options, array(
                            'value' => $limit,
                            'default' => 10,
                            'empty' => FALSE,
                            'onChange' => 'limitViewChange();',
                            'name' => 'limit'
                                )
                        );
                        echo $this->Form->end();
                    ?>
                </div>
                <?php 
                if($total > $limit){
                    echo '<div class="pagecars pull-right"></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div id="ModalSettingViewCar" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog modal-sm vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    Setting view the cars missing data
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="FormSettingViewCar" action="set_display_car_ajax" method="POST">
                        <div class="checkbox" style="margin: 6px 10px 10px;">
                            <label><input class="input-show-all" type="checkbox" name="show_all" value="1" <?php echo ($showing && $showing->image_showing && $showing->vin_showing) ? 'checked' : '' ?> >Show all</label>
                        </div>
                        <div class="checkbox" style="margin: 6px 10px 10px;">
                            <label><input class="input-show" type="checkbox" name="no_image_showing" value="1" <?php echo ($showing && $showing->image_showing) ? 'checked' : '' ?> >Show no image car</label>
                        </div>
                        <div class="checkbox" style="margin: 0px 10px 20px;">
                            <label><input class="input-show" type="checkbox" name="no_vin_showing" value="1" <?php echo ($showing && $showing->vin_showing) ? 'checked' : '' ?> >Show no VIN car</label>
                        </div>
                        <div class="text-center"><input class="btn btn-view btn-set-display" value="Save View"></div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>
<script type="text/javascript">
    function limitViewChange() {
        fieldsort = '<?php echo $fieldsort?>',
        sort = '<?php echo $sort?>',
        key = '<?php echo $keyword?>',
        type = '<?php echo $type?>',
        limit = $('#CarLimit').val();
        window.location.href = root + 'list_car_no_data?sort='+sort+'&fieldsort='+fieldsort+'&key='+key+'&type='+type+'&limit='+limit;
    }
    
    function showModalSetting() {
        $('#ModalSettingViewCar').modal('show');
    }
    
    $(document).ready(function(){
        $('.checker-show-car').click(function () {
            item = $(this);
            type = 1; // 1 - show; 2 - hide
            if ($(this).is(':checked')) {
                type = 2;
            }
            carId = $(this).attr('data-car-id');
            //console.log({'car_id':carId, 'type':type});
            load_show();
            $.post(root + 'Cars/setDisplayCar',{'car_id':carId, 'type':type}, function(data){
                load_hide();
                if (data.error != 0) {
                    showMessage('Failure', 1);
                    vcheck = 3 - type;
                    item.prop('checked', vcheck);
                }
            },'json');
        });
        
        $('.input-show-all').click(function() {
            if ($(this).is(':checked')) {
                $('.input-show').prop('checked', true);
            }
            else {
                $('.input-show').prop('checked', false);
            }
        });
        
        $('.input-show').click(function() {
            $('.input-show-all').prop('checked', false);
        });
        
        fieldsort = '<?php echo $fieldsort?>',
        sort = '<?php echo $sort?>',
        key = '<?php echo $keyword?>',
        type = '<?php echo $type?>',
        
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $s_page?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            window.location.href = root + 'list_car_no_data?page='+num+'&sort='+sort+'&fieldsort='+fieldsort+'&key='+key+'&type='+type;
        });

        $(".keyword").keydown(function(){
            $(".reset_text").show();
        });
        $(".type").change(function(){
            $(".reset_text").show();
        });
        $(".reset_text").click(function(){
            $("input[name='key']").val('');
            $(".reset_text").hide();
            window.location.href = root +'list_car_no_data';
        });
        
        function load_show(msg){
            $("#loading-body, #loading").show();
            $("#loading #msg").text(msg);
        }

        function load_hide(){
            $("#loading-body, #loading").hide();
        }
        
        $('.btn-set-display').click(function () {
            load_show();
            $form = $('#FormSettingViewCar');
            $.get($form.attr('action'), $form.serialize(), function (data) {
                load_hide();
                if (data.error == 0) {
                    jAlert('Setting was saved successfully');
                    $("#ModalSettingViewCar").modal('hide');
                }
                else {
                    jAlert('Failed to save your setting');
                }
            },'json');
        });
        
        $(".export_car").click(function(){           
            var total = <?php echo $total?>;
            fieldsort = '<?php echo $fieldsort?>',
            sort = '<?php echo $sort?>',
            key = '<?php echo $keyword?>',
            type = '<?php echo $type?>',
            
            jConfirm('Do you want to export data?', 'Message', function(r) {
                if (r) {
                    window.location.href = root + 'cars/export_car_missing_data?sort='+sort+'&fieldsort='+fieldsort+'&key='+key+'&type='+type;
                }
            });
            
        });
    });
</script>