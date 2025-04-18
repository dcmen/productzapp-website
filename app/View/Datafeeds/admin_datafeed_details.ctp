<div class="panel">
    <!--search and filter location-->
<!--    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12 no-padding">
            <form action="<?php // echo $this->Html->Url('/admin_datafeed_detail')?>" method="get">
                <input type="hidden" name="type" value="<?php // echo $type ?>" />
                <input type="hidden" name="ip" value="<?php // echo $ip ?>" />
                <input type="hidden" name="username" value="<?php // echo $username ?>" />
                <input type="hidden" name="password" value="<?php // echo $password ?>" />
                
                <div class="col-md-4 no-padding-left">
                    <label>Enter key:</label>
                    <input class="form-control keyword" placeholder="Enter keyword" type="text" name="key" autocomplete="false" value="<?php // echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="col-md-4 btn_control text-right pull-right no-padding" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php // echo ($keyword != '')?'':'style="display: none"'?>>
                </div>
            </form>
        </div>
    </div>-->
    <div class="panel-body">
        <div class="table-responsive">
            <table id="ListRegisterTable" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <!--name file-->
                        <th class="sort-table">
                            <a href="javascript:;" class="sort_header">
                                File Name
                            </a>
                        </th>
                        <!--date file-->
                        <th class="sort-table">
                            <a href="javascript:;" class="sort_header">
                                Date
                            </a>
                        </th>
                        <!--action-->
                        <th style="width: 80px; text-align: center;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="body-list-register">
                    <?php if ($list!='') : ?>
                        <?php $i = 0; ?>
                        <?php foreach($list as $rs) : $i++ ?>
                        <tr>
                            <td class="index"><?php echo $i?></td>
                            <td><?php echo $rs->name_file ?></td>
                            <td><?php echo $rs->date_file ?></td>
                            <td class="text-center">
                                <a title="download" target="_blank" href="<?php echo $this->Html->Url('/datafeeds/download_ftp?file_name='.$rs->name_file.'&ip='.$ip.'&username='.$username.'&password='.$password) ?>"><i class="fa fa-download"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="4">Not found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <div class="row" style="margin: 20px 0 0;font-size: 13px; float: right">
                <div class="total_pag">
                    Total: <b><?php echo sizeof($list)?></b>.             
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // sort table
        $('th.sort-table').click(function(){
            var table = $(this).parents('table').eq(0);
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
            this.asc = !this.asc;
            if (!this.asc){
                rows = rows.reverse();
            }
            $('th.sort-table > a > i').remove();
            
            if (this.asc) {
                $(this).find('a').append('<i class="fa fa-sort-desc"></i>');
            }
            else {
                $(this).find('a').append('<i class="fa fa-sort-asc"></i>');
            }
            
            for (var i = 0; i < rows.length; i++){
                table.append(rows[i]);
            }
            
            $('table .index').each(function(index, val){
                $(this).text(index+1);
            }); 
        });
        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index);
                var valB = getCellValue(b, index);
                
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
            }
        }
        function getCellValue(row, index){ 
            return $(row).children('td').eq(index).html();
        }
    });
    
</script>