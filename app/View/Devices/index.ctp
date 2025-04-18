<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-6"><h3 class="panel-title">Code</h3></div>
        <div class="col-xs-6" style="text-align: right">
            <a href="javascript:;" class="btn btn-info random">Create random code</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Code</th>
                    <th>User</th>
                </tr>
                </thead>
                <?php 
                    $i=1;
                    foreach($list as $rs):
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $rs->code?></td>
                    <td><?php echo $rs->name?></td>
                </tr>
                <?php 
                $i++;
                endforeach;?>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: 1,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            window.location.href = root + 'redeemcodeactive?page='+num+'&limit=<?php echo $limit?>';
        });
        $(".random").click(function(){
            load_show();
            $.post(root + 'create_code_active', function(data){
                load_hide();
                alert(data.msg);
            },'json');
        });
});
</script>