<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="viewos" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                <tr>
                    <th>CarZapp number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Time login</th>
                    <th>Time logout</th>
                    <th>View app</th>
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
                    <td><?php echo $rs->time_login?></td>
                    <td><?php echo $rs->time_logout?></td>
                    <td><?php echo $rs->count_view?></td>
                    <td>
                        <a href="<?php echo $this->Html->Url('/view_info_user/'.$rs->_id)?>"><i class="fa fa-eye"></i></a>
                        <?php if($rs->is_active == 0){?>
                            <a title="Active" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                                <i class="fa fa-circle-o-notch"></i>
                            </a>
                        <?php }else if($rs->is_active == 1){?>
                            <a title="Block" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',3)">
                                <i class="fa fa-unlock"></i>
                            </a>
                         <?php }else if($rs->is_active == 2){?>
                            <a title="Active" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                                <i class="fa fa-lock"></i>
                            </a>
                        <?php }else{ ?>
                            <a title="Active" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                                <i class="fa fa-ban"></i>
                            </a>
                        <?php }?>
                    </td>
                </tr>
                <?php 
                $i++;
                endforeach;
                }?>
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
<script type="text/javascript">
    $(function() {
        $("#viewos").tablesorter({
            headers: { 
                6: { 
                    sorter: false 
                }
            }
        });
    });
    $('.pagecars').bootpag({
        total: <?php echo $maxpages?>,
        page: 1,
        maxVisible: 5,
        leaps: true
    }).on("page", function(event, num){
        window.location.href = root + 'view_os?os=<?php echo $os?>&page='+num+'&limit=<?php echo $limit?>';
    });
    
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
                    window.location.href = root + 'view_os' + "?os=" + <?php echo $os;?>;
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
