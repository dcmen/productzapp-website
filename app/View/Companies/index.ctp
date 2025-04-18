<style>
    /*export*/
    .export-file-item {
        line-height: 22px;
    }
</style>
<div class="panel">
    <!--search and filter location-->
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12 no-padding">
            <form action="<?php echo $this->Html->Url('/admin_company')?>" method="get">
                <input type="hidden" name="limit" value="<?php echo $limit?>" />
                <div class="col-md-5 no-padding-left">
                    <label>Enter key:</label>
                    <input class="form-control keyword" type="text" name="key" placeholder="Dealership name, Address, License number" autocomplete="false" value="<?php echo ($keyword != '')? $keyword : ''?>">
                </div>
                <div class="col-md-2" style="padding: 0px 0px 0px 4px;;">
                    <label>Filter:</label>
                    <select name="filter" class="form-control type">
                        <option value="0" <?php echo ($filter == 0)?'selected':''?>>All Dealership</option>
                        <option value="1" <?php echo ($filter == 1)?'selected':''?>>Has Datafeed</option>
                        <option value="2" <?php echo ($filter == 2)?'selected':''?>>No Datafeed</option>
                        <option value="3" <?php echo ($filter == 3)?'selected':''?>>Has Car</option>
                        <option value="4" <?php echo ($filter == 4)?'selected':''?>>No Car</option>
                    </select>
                </div>
                <div class="col-md-4 btn_control text-right pull-right no-padding" style="margin-top: 21px">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '')?'':'style="display: none"'?>>
                    <input type="submit" value="Search" class="btn btn-view btn-submit-search">
                    <input type="button" value="Export" class="btn btn-view export_dealership">
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="ListDealershipTable" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('name', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Name 
                                <?php if($fieldsort == 'name') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <th style="display: none;">
                            Active since day/Inactive
                        </th>
                        <th>
                            License number
                        </th>
                        <th class="text-right">
                            Car count
                        </th>
                        <th class="text-right">
                            Lastest update
                        </th>
                        <th style="text-align: center">
                            Address
                        </th>
                        <th style=" text-align: right;">
                            Action 
                        </th>
                    </tr>
                </thead>
                <tbody class="body-list-dealership">
                    <?php if ($list) : ?>
                        <?php $i = $limit * ($page - 1); ?>
                        <?php foreach($list as $rs) : $i++ ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td>
                                <?php echo $rs->name ?>
                            </td>
                            <td style="display: none;">
                                <?php
                                if($rs->active_since=='')
                                    {
                                     echo"Inactive";
                                    }else{
                                    echo $rs->active_since;
                                    }
                                ?>
                            </td>
                            <td>
                                <?php echo $rs->license_number ?>
                            </td>
                            <td class="text-right">
                                <?php echo $rs->car_number ?>
                            </td>
                            <td class="text-right">
                                <?php echo $rs->latest_date ?>
                            </td>
                            <td style="text-align: center">
                                <a data-container="body" data-original-title="Address company" href="<?php echo $this->Html->Url('/companies/address_company?company_id='.$rs->_id . '&dealership_name=' . $rs->name)?>" data-toggle="tooltip" class="btn btn-xs btn-primary add-tooltip"><i class="fa fa-building"></i></a>
                            </td>
                            <td class="text-right">
<!--                                <a data-container="body" data-original-title="Recent Car Count" href="--><?php //echo $this->Html->Url('/companies/recent_car_count?company_id='.$rs->_id . '&dealership_name=' . $rs->name)?><!--" data-toggle="tooltip" class="btn btn-xs btn-primary add-tooltip"><i class="fa fa-bar-chart"></i></a> -->
                                <a data-container="body" data-original-title="View Dealership" href="<?php echo $this->Html->Url('/admin_company_detail?id='.$rs->_id)?>" data-toggle="tooltip" class="btn btn-xs btn-success add-tooltip"><i class="fa fa-eye"></i></a> 
                                <a data-container="body" data-original-title="Edit Dealership" href="<?php echo $this->Html->Url('/admin_company_edit?id='.$rs->_id.'&key='.$keyword)?>" data-toggle="tooltip" class="btn btn-xs btn-primary add-tooltip"><i class="fa fa-edit"></i></a> 
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="7">Not found</td></tr>
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

<script>
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
        //parasOnLink.fieldsort = fieldsort;
        //parasOnLink.sort = sort;
        
        //window.location.href = createLink(linkCurPage, parasOnLink);
    }
    
    function limitViewChange() {
        limit = $('#ViewLimit').val();
        parasOnLink.limit = limit;
        parasOnLink.page = 1;
        window.location.href = createLink(linkCurPage, parasOnLink);
    }
    
    $(document).ready(function(){
        // pagination
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $page?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            parasOnLink.page = num;
            window.location.href = createLink(linkCurPage, parasOnLink);
        });
        // search and filter location
        $(".keyword").keydown(function(){
            $(".reset_text").show();
        });
        $(".type").change(function(){
            //$(".reset_text").show();
            $('.btn-submit-search').click();
        });
        $(".reset_text").click(function(){
            window.location.href = linkCurPage;
        });
        
        // export dealership
        $(".export_dealership").click(function(){
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
                        $.post(root + 'companies/export_dealership_data', dataPost, function(data){
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
