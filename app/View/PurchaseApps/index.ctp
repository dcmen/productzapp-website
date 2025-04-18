<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-6"><h3 class="panel-title">Code</h3></div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="purchase" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>User`s name</th>
                    <th>Code</th>
                    <th>Purchased date</th>
                    <th>Expired date</th>
                </tr>
                </thead>
                <?php 
                    $i=1;
                    foreach($list as $rs):?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $rs->name?></td>
                    <td><?php echo $rs->code?></td>
                    <td><?php echo $rs->purchased_date?></td>
                    <td><?php echo $rs->expired_date?></td>
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
        $("#purchase").tablesorter();
    });
    $(document).ready(function(){
    $('.pagecars').bootpag({
        total: <?php echo $maxpages?>,
        page: 1,
        maxVisible: 5,
        leaps: true
    }).on("page", function(event, num){
        window.location.href = root + 'purchaseapps?page='+num+'&limit=<?php echo $limit?>';
    });
        
    $(".random").click(function(){
        $.post(root + 'create_code', function(data){
            alert(data.msg);
        },'json');
    })
});
</script>