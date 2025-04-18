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
                            Dealership id
                        </th>
                        <th>
                            Number cars
                        </th>
                        <th>
                            Latest date
                        </th>
                        <th class="text-right">
                            Latest file
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
                                <?php echo $rs->dealership_id ?>
                            </td>
                            <td>
                                <?php echo $rs->number_car ?>
                            </td>
                            <td>
                                <?php echo $rs->latest_date ?>
                            </td>
                            <td class="text-right">
                                <?php if (isset($rs->url_file) && $rs->url_file) : ?>
                                <a target="_blank" href="<?php echo $rs->url_file ?>" title="Download File"><i class="fa fa-download"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="5">Not found</td></tr>
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
