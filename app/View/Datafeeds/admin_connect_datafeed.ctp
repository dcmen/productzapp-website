<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12">
            <form action="<?php echo $this->Html->Url('/admin_pulse')?>" method="get">
                <!-- <div class="col-md-3">
                    <label>Enter key:</label>
                    <input class="form-control keyword" type="text" name="key" placeholder="Subject, Title car, Dealer" autocomplete="false" value="<?php echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="col-lg-1" style="padding: 0px 0px 0px 4px;;">
                    <label>Type:</label>
                    <select name="type" class="form-control type">
                        <option value="0" <?php echo ($type == 0)?'selected':''?>>All</option>
                        <option value="2" <?php echo ($type == 2)?'selected':''?>>News</option>
                        <option value="1" <?php echo ($type == 1)?'selected':''?>>Posts</option>
                    </select>
                </div> 
                <div class="view_search col-md-4 no-padding">
                    <div class="col-xs-6">
                        <label>Date from:</label>
                        <input type="text" autocomplete="false" value="<?php echo ($date_from != '')? date('Y-m-d', strtotime($date_from)):''?>" class="form-control date" id="date_from" name="date_from">
                    </div>
                    <div class="col-xs-6">
                        <label>Date to:</label>
                        <input type="text" autocomplete="false" value="<?php echo ($date_to != '')? date('Y-m-d', strtotime($date_to)):''?>" class="form-control date" id="date_to" name="date_to">
                    </div>
                </div> -->
                <div class="col-md-12 btn_control text-right" style="margin-top: 21px">
                    <!-- <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '' || $date_from != '' || $date_to != '')?'':'style="display: none"'?>> -->
                    <a href="<?php echo $this->Html->Url('/admin_datafeed_add')?>" class="btn btn-primary">Add new datafeed</a>
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
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo ($u_sort==1)?$u_sort:0?>)">
                                Data Source
                                <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?> 
                            </a>
                        </th>
                        <th width="120">
                                Email
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo ($u_sort==5)?$u_sort:4?>)">
                                Connection
                                <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo ($u_sort==3)?$u_sort:2?>)">
                                Filetype
                                <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
<!--                        <th>
                             <a href="javascript:;" class="sort_header" > 
                                Method

                             </a> 
                        </th>-->
                        <th>IP Address</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th class="text-right" width="120">
                                Action 
                        </th>
                    </tr>
                </thead>
                <tbody class="body_pulse">
                   <?php
                    if($list != ''){
                        $i = $stt;
                        foreach($list as $rs){     
                    ?>
                    <tr>
                       <td><?php echo $i?></td>
                        <td>
                            <?php echo $rs->name?>
                        </td>
                        <td>
                            <?php echo isset($rs->email)? $rs->email: 'Not set' ?>
                        </td>
                        <td>
                            <?php echo $rs->connection?>
                        </td>
                        <td>
                            <?php echo $rs->filetype?>
                        </td>
<!--                        <td>
                            Not set
                        </td>-->
                        <td>
                            <?php echo isset($rs->ftp_ip_address)? $rs->ftp_ip_address : '' ?>
                        </td>
                        <td>
                            <?php echo isset($rs->ftp_username)? $rs->ftp_username : '' ?>
                        </td>
                        <td>
                            <?php echo isset($rs->ftp_password)? $rs->ftp_password : '' ?>
                        </td>
  
                        <td class="text-right">
                            <?php
                            $type = isset($rs->filetype)? $rs->filetype : '';
                            $ip = isset($rs->ftp_ip_address)? $rs->ftp_ip_address : '';
                            $username = isset($rs->ftp_username)? $rs->ftp_username : '';
                            $password = isset($rs->ftp_password)? $rs->ftp_password : '';
                            ?>
                            <!--<a data-container="body" data-original-title="View details" href="<?php // echo $this->Html->Url('/admin_datafeed_detail?type='.$type.'&ip='.$ip.'&username='.$username.'&password='.urlencode($password))?>" data-toggle="tooltip" class="btn btn-xs btn-success add-tooltip"><i class="fa fa-eye"></i></a>-->
                            <?php if ($rs->is_delete != 2) : ?>
                            <a data-container="body" data-original-title="Edit datafeed" href="<?php echo $this->Html->Url('/admin_datafeed_edit?id='.$rs->_id)?>" data-toggle="tooltip" class="btn btn-xs btn-primary add-tooltip"><i class="fa fa-edit"></i></a> 
                           <a data-container="body" data-original-title="Delete datafeed" href="<?php echo $this->Html->Url('/del_datafeed?id='.$rs->_id.'&page='.$s_page)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a> 
                           <?php endif; ?>
                        </td>
                    </tr>
                    <?php $i++; }}?>
                </tbody>
            </table>
            <div class="row" style="margin: 20px 0 0;font-size: 13px;float: right">
                <div class="total_pag">
                    Total: <b><?php echo $total?></b>.             
                </div>
                <div class="pagina_select col-lg-2 col-xs-6 no-padding form-group">
                    <?php
                        $limit = (isset($this->params->query['limit'])) ? $this->params->query['limit'] : '20';
                        $options = array(20 => '20', 50 => '50', 100 => '100', 200 => '200');

                        echo $this->Form->create(array('type' => 'get'));
                    ?>
                    <label>Show</label>
                    <?php
                        echo $this->Form->select('limit', $options, array(
                            'value' => $limit,
                            'default' => 10,
                            'empty' => FALSE,
                            'onChange' => 'this.form.submit();',
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
<script>
    function sort_head(sort){
        //key = $("input[name='key']").val();
        window.location.href = '?sort='+sort+'&page=<?php echo $s_page?>';
    }
    $(document).ready(function(){
        var sort = '<?php echo $sort?>';
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $s_page?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            window.location.href = '?page='+num+'&sort='+sort+'&limit=<?php echo $limit?>';
        }); 
    });
</script>
