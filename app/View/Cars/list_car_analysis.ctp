<style>
    .img-car {
        max-height: 120px;
        max-width: 120px;
    }
    .checkbox input[type="checkbox"] {
        outline: 0;
    }
    .checker-show-car > .fa {
        display: none;
    }
    .checker-show-car.hide-car > .fa-eye-slash, .checker-show-car.show-car > .fa-eye {
        display: inline-block;
    }
    /*export*/
    .export-file-item {
        line-height: 22px;
    }
</style>
<div class="panel">
    <!--search and filter location-->
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12 no-padding">
            <form action="<?php echo $this->Html->Url('/list_car_analysis')?>" method="get">
                <input type="hidden" name="limit" value="<?php echo $limit?>" />
                <div class="col-md-5 no-padding-left">
                    <label>Enter key:</label>
                    <input class="form-control keyword" type="text" name="key" placeholder="Vin, Year, Make, Model, Series, Dealership" autocomplete="false" value="<?php echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="col-md-2" style="padding: 0px 0px 0px 4px;;">
                    <label>Filter:</label>
                    <select name="filter" class="form-control type auto-submit">
                        <option value="0" <?php echo ($filter == 0)?'selected':''?>>All Cars</option>
                        <option value="1" <?php echo ($filter == 1)?'selected':''?>>Come Off Cars</option>
                        <option value="2" <?php echo ($filter == 2)?'selected':''?>>Sold Cars</option>

                    </select>
                </div>
                <div class="col-md-4 btn_control text-right pull-right no-padding" style="margin-top: 21px">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '')?'':'style="display: none"'?>>
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="ListCarTable" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>
                            Image
                        </th>
                        <!--vin-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('vin', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                VIN 
                                <?php if($fieldsort == 'vin') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--manuyear-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('manuyear', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Manufactory Year 
                                <?php if($fieldsort == 'manuyear') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--make-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('make', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Make 
                                <?php if($fieldsort == 'make') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--model-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('model', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Model 
                                <?php if($fieldsort == 'model') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--series-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('series', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Series 
                                <?php if($fieldsort == 'series') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--company name-->
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('company_name', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Dealership
                                <?php if($fieldsort == 'company_name') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <!--status-->
                        <th>
                            Status
                        </th>
                        <!--action-->
                        <th style="width: 70px; text-align: right;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="body-list-car">
                    <?php if ($list) : ?>
                        <?php $i = $limit * ($page - 1); ?>
                        <?php foreach($list as $rs) : $i++ ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td>
                                <?php if(isset($rs->cars->image_url) || $rs->cars->image_url) : ?>
                                <img style="width: 75px;" src="<?php echo $rs->cars->image_url ?>" />
                                <?php endif; ?>
                            </td>
                            <td><?php echo $rs->cars->vin_number?></td>
                            <td><?php echo $rs->cars->manu_year?></td>
                            <td><?php echo $rs->cars->make?></td>
                            <td><?php echo $rs->cars->model?></td>
                            <td><?php echo $rs->cars->series?></td>
                            <td><?php echo $rs->company_info->company_name?></td>
                            <td style="width:200px" class="status-<?php echo $rs->cars->_id ?>">
                                <?php
                                $status = 1; // 0 - display, 1 - hidden, 2 - sold
                                if ($rs->type_analysis->is_car_sold == 0) {
                                    $status = 0;
                                    echo 'Come off';
                                ?>
                                <div><span>Last seen: </span>
                                    <?php
                                        echo $rs->type_analysis->latest_update;
                                    ?>
                                </div>
                                <?php } else if ($rs->type_analysis->is_car_sold == 1) {
                                    $status = 1;
                                    echo 'Sold';
                                }
                                else {
                                    $status = 1;
                                    echo 'Sold';
                                }
                                ?>
                            </td>
                            <td style="text-align:center;width:20px;">
                                <a title="View car detail" href="<?php echo $this->Html->Url('/view_car_analysis/'.$rs->cars->_id)?>"><i class="fa fa-car"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="9">Not found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="row" style="margin: 20px 0 0;font-size: 13px; float: right">
                <div class="total_pag">
                    Total: <b><?php echo $total?></b>.             
                </div>
                <?php if($total > $limit) : ?>
                <div class="pagina_select col-lg-2 col-xs-6 no-padding form-group">
                    <label>Show</label>
                    <select id="ViewLimit" onchange="limitViewChange();">
                        <option value="20" <?php echo ($limit == 20)? 'selected' : '' ?> >20</option>
                        <option value="50" <?php echo ($limit == 50)? 'selected' : '' ?> >50</option>
                        <option value="100" <?php echo ($limit == 100)? 'selected' : '' ?> >100</option>
                        <option value="200" <?php echo ($limit == 200)? 'selected' : '' ?> >200</option>
                    </select>
                </div>
                <div class="pagecars pull-right"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div id="ModalSettingViewCar" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog modal-sm vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    Setting for the cars that are displayed on the App and Website
                    <button style="position: absolute; top: 6px; right: 9px;" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="FormSettingViewCar" action="<?php echo $this->Html->Url('/cars/set_display_car')?>" method="POST">
                        <div class="checkbox" style="margin: 6px 10px 10px;">
                            <label><input class="input-show-all" type="checkbox" name="show_all" value="1" checked disabled>Display all</label>
                        </div>
                        <div class="checkbox" style="margin: 6px 10px 10px;">
                            <label><input class="input-show" type="checkbox" name="no_image_showing" value="1" <?php echo ($showing && !$showing->image_showing) ? 'checked' : '' ?> >Hide cars that have no images</label>
                        </div>
                        <div class="checkbox" style="margin: 0px 10px 20px;">
                            <label><input class="input-show" type="checkbox" name="no_vin_showing" value="1" <?php echo ($showing && !$showing->vin_showing) ? 'checked' : '' ?> >Hide cars that have no VIN</label>
                        </div>
                        <div class="text-center"><input class="btn btn-view btn-set-display" value="Save View"></div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>

<div id="ExportModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog modal-sm vdialog" style="width: 300px;">
            <div class="modal-content">
                <div class="modal-header">
                    Export Cars
                    <button style="position: absolute; top: 6px; right: 9px;" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="max-height: 250px; overflow-y: auto;">
                    <ul class="export-file-container">
                        
                    </ul>
                </div>
            </div>
        </div>
   </div>
</div>

<script type="text/javascript">
    var totalCar = <?php echo $total ?>;
     
    function createLink(linkBase, parameters) {
        str = '';
        $.each(parameters, function(key, val) {
            str = str + key + '=' + val + '&';
        });
        str = str.replace(/^\&+|\&+$/g, '');
        
        return linkBase.replace(/^\?+|\?+$/g, '') + '?' + str;
    }
    
    function sort_head(fieldsort, sort){
//        parasOnLink.fieldsort = fieldsort;
//        parasOnLink.sort = sort;
//        
//        window.location.href = createLink(linkCurPage, parasOnLink);
    }
    
    function limitViewChange() {
        limit = $('#ViewLimit').val();
        parasOnLink.limit = limit;
        parasOnLink.page = 1;
        window.location.href = createLink(linkCurPage, parasOnLink);
    }
    
    function showModalSetting() {
        $('#ModalSettingViewCar').modal('show');
    }
    
    $(document).ready(function() {
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $page?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            parasOnLink.page = num;
            window.location.href = createLink(linkCurPage, parasOnLink);
        });

        $(".keyword").keydown(function(){
            $(".reset_text").show();
        });
        $(".auto-submit").change(function(){
            //$(".reset_text").show();
            $('.searchuser').click();
        });
        $(".reset_text").click(function(){
            window.location.href = linkCurPage;
        });
        
        $('.btn-set-display').click(function () {
            load_show();
            $('#FormSettingViewCar').submit();
//            $form = $('#FormSettingViewCar');
//            $.get($form.attr('action'), $form.serialize(), function (data) {
//                load_hide();
//                if (data.error == 0) {
//                    jAlert('Setting was saved successfully');
//                    $("#ModalSettingViewCar").modal('hide');
//                    window.location.href = createLink(linkCurPage, parasOnLink);
//                }
//                else {
//                    jAlert('Failed to save your setting');
//                }
//            },'json');
        });
        
        $('.checker-show-car').click(function () {
            item = $(this);
            type = 1; // 1 - show; 2 - hide
            if ($(this).hasClass('hide-car')) {
                type = 2;
            }
            carId = $(this).attr('data-car-id');
            
            load_show();
            $.post(root + 'Cars/setDisplayCar',{car_id:carId, type:type}, function(data){
                load_hide();
                if (data.error != 0) {
                    jAlert('Failure');
                }
                else {
                    if (type == 1) {
                        item.removeClass('show-car');
                        item.addClass('hide-car');
                        $('.status-'+carId).text('Display');
                    }
                    else {
                        item.addClass('show-car');
                        item.removeClass('hide-car');
                        $('.status-'+carId).text('Hidden');
                    }
                    jAlert('Changed successfully');
                }
            },'json');
        });
        
        $(".export_car").click(function(){
            jConfirm('Do you want to export data?', 'Message', function(r) {
                if (r) {
                    $('.export-file-container').html('');
                    
                    numberFileExport = Math.ceil(totalCar / 500);
                    
                    for(i = 1; i <= numberFileExport; i++) {
                        $('.export-file-container').append('<li data-id="'+i+'" class="export-file-item id-'+i+'"><div class="file-name col-lg-10 col-md-10">Loading...</div><a target="_blank" class="btn-download col-lg-2 col-md-2"><i class="fa fa-download"></i></a></li>');
                    }
                    
                    for(j = 1; j <= numberFileExport; j++) {
                        dataPost = {
                            key : parasOnLink.key,
                            filter : parasOnLink.filter,
                            id : j
                        };
                        $.post(root + 'cars/export_car_data', dataPost, function(data){
                            if (data.error == 0) {
                                fileItem =  $('li.export-file-item.id-' + data.id);
                                if (Math.ceil(totalCar / 500) > 1) {
                                    fileItem.find('.file-name').text('File ' + data.id);
                                }
                                else {
                                    fileItem.find('.file-name').text('Export File');
                                }
                                fileItem.find('.btn-download').attr('href', data.link);
                            }
                        }, 'json');
                    }
                    
                    $('#ExportModal').modal('show');
                }
            });
        });
    });
</script>