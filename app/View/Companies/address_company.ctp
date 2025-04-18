<div class="panel">
    <!--search and filter location-->
    <div class="panel-heading hidden" style="overflow: hidden">
        <div class="col-xs-12 no-padding hidden">
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
                    </select>
                </div>
                <div class="col-md-4 btn_control text-right pull-right no-padding" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view btn-submit-search">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '')?'':'style="display: none"'?>>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <div style="padding: 0px 4px 25px;font-size: 15px;">Dealership Name: <strong><?php echo $dealership_name ?></strong></div>
            
            <table id="ListDataTable" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>
                           Address line 1
                        </th>
                        <th style="display: none">
                            Address line 2
                        </th>
                        <th style="display: none">
                            Address line 3
                        </th>
                        <th>
                            Suburb
                        </th>
                        <th>
                            Postcode
                        </th>
                        <th>
                            State
                        </th>
                        <th>
                            Country
                        </th>
                        <th>
                            Datafeeds Id
                        </th>
                        <th>
                            Number cars
                        </th>
                        <th>
                            Latest date
                        </th>
                        <th style="text-align: right">
                            Recent car count
                        </th >
                        <th style="text-align: right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="body-list-dealership">
                    <?php if ($list) : ?>

                        <?php $i="0";
                        ?>
                        <?php foreach($list as $rs) : $i++ ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td>
                                <?php echo $rs->address1 ?>
                            </td>
                            <td style="display: none">
                                <?php echo $rs->address2 ?>
                            </td>
                            <td style="display: none">
                                <?php echo $rs->address3 ?>
                            </td>
                            <td>
                                <?php echo $rs->suburb ?>
                            </td>
                            <td>
                                <?php echo $rs->postcode ?>
                            </td>
                            <td>
                                <?php echo $rs->state ?>
                            </td>
                            <td>
                                <?php echo $rs->country ?>
                            </td>
                            <td>
                                <?php
                                if(!empty($rs->datafeeds_id)){
                                    echo implode(", ",$rs->datafeeds_id);
                                }
                                ?>
                            </td>
                            <td style="text-align: right">
                                <?php echo $rs->car_number ?>
                            </td>
                            <td >
                                <?php echo $rs->latest_date ?>
                            </td>
                            <td style="text-align: right">
                                <a data-container="body" data-original-title="Recent Car Count" href="<?php echo $this->Html->Url('/companies/recent_car_count?company_id='.$rs->company_id . '&dealership_name=' .$dealership_name)?>" data-toggle="tooltip" class="btn btn-xs btn-primary add-tooltip"><i class="fa fa-bar-chart"></i></a>
                            </td>
                            <td class="text-right">
                                <a data-container="body" data-original-title="Edit address company" href="<?php echo $this->Html->Url('/admin_address_edit?company_id='.$rs->company_id .'&dealership_name=' .$dealership_name.'&_id='.$rs->_id)?>" data-toggle="tooltip" class="btn btn-xs btn-primary add-tooltip"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="5">Not found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
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
//        $(".keyword").keydown(function(){
//            $(".reset_text").show();
//        });
//        $(".type").change(function(){
//            //$(".reset_text").show();
//            $('.btn-submit-search').click();
//        });
//        $(".reset_text").click(function(){
//            window.location.href = linkCurPage;
//        });
        
    });
</script>
