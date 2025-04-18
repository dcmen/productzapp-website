<div class="panel">
    <div class="panel-body">
        <div class="form-group form_search">
            <form id="SearchUser" method="get">
                <div class="col-lg-6" style="padding: 0px 0px 0px 4px;;">
                    <label>Keyword</label>
                    <input type="text" name="key" class="form-control keyword" placeholder="Name, Email, Dealership" value="<?php echo ($key != '')?$key:''?>">
                </div>
                <div class="col-lg-6  btn_control text-right" style="margin-top: 24px; padding-right: 10px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($key != '')?'':'style="display: none"'?>>
                </div>
            </form>
            <form id="importForm" class="hide" action="<?php echo './import_user' ?>" enctype='multipart/form-data' method="post">
                <input type="file" name="import_file" id="import_file" accept=".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            </form>
        </div>
        <div class="col-xs-12">
            <div class="table-responsive">
                <table id="inactivate" cellspacing="0" class="tablesorter table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:1)?>)">
                                CarZapp number <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:3)?>)">
                                Name <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:5)?>)">
                                Email <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:7)?>)">
                                Dealership <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:9)?>)">
                                Registration Time <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>Is Admin</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php
                    if($list != ''){
                        $i=1;
                        foreach($list as $rs):
                    ?>
                    <tr>
                        <td><?php echo $rs->carzapp_code?></td>
                        <td><?php echo $rs->name?></td>
                        <td><?php echo $rs->email?></td>
                        <td><?php echo $rs->company_name?></td>
                        <td><?php echo $rs->created_at?></td>
                        <td><?php echo ($rs->is_admin == 1)?'<i class="fa fa-check"></i>':''?></td>
                        <td>
                            <a href="<?php echo $this->Html->Url('/view_info_user/'.$rs->_id)?>"><i class="fa fa-eye"></i></a>
                            <a title="Activate" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                                <i class="fa fa-circle-o-notch"></i>
                            </a>
                        </td>
                    </tr>
                    <?php 
                    $i++;
                    endforeach; }else{?> <tr><td colspan="9">Not found</td></tr><?php }?>
                </table>
                <div class="row" style="margin: 20px 0 0;font-size: 13px;float: right">
                    <div class="total_pag">
                        Total: <b><?php echo $total?></b>.             
                    </div>
                    <?php if($total > $limit):?>
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
                    <div class="pagecars pull-right"></div>
                    <?php endif;?>
                </div>
            </div>
        </div> 
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        limit= '<?php echo $limit?>';
        sort = '<?php echo $sort?>';
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $page_s?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            window.location.href = root + 'inactivate_user?limit='+limit+'&sort='+sort+'&page='+num;
        });
        $(".keyword").keydown(function(){
            $(".reset_text").show();
        });
        $(".reset_text").click(function(){
            $("input[name='key']").val('');
            $(".reset_text").hide();
            window.location.href = root +'inactivate_user';
        });
    });
    function sort_head(sort){
        var type = $("select[name='type']").val();
        key = $("input[name='key']").val();
        date_from = $("input[name='date_from']").val();
        date_to = $("input[name='date_to']").val();
        window.location.href = root + 'inactivate_user?limit='+limit+'&sort='+sort+'&page=<?php echo $page_s?>';
        
    }
    function change_active($id,$active){
        if($active == 1){
            $msg = 'Are you sure you want to activate this user?';
        }else{
            $msg = 'Are you sure you want to block this user?';
        }
        
        jConfirm($msg,'Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'activate_user',{'id':$id,'active':$active},function(data){
                    window.location.href = root + 'inactivate_user';
                    load_hide();
                });
            }
        });
        return false;
    }
    
     function load_show(msg){
        $("#loading-body, #loading").show();
        $("#loading #msg").text(msg);
    }

    function load_hide(){
        $("#loading-body, #loading").hide();
    }

</script>
