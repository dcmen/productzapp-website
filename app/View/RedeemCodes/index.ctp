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
                    foreach($redeemCodes as $rs):?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $rs['RedeemCode']['code']?></td>
                    <td><?php echo ($rs['User']['name'])?$rs['User']['name']:''?></td>
                </tr>
                <?php 
                $i++;
                endforeach;?>
            </table>
            <div class="row" style="margin: 20px 0 0;font-size: 13px;float: right">
                <div class="total_pag">
                    Total: <b><?php echo $this->Paginator->param('count')?></b>.             
                </div>
                <div class="paging">
                    <?php 
                    if($this->Paginator->numbers()){
                        echo $this->Paginator->counter();
                        echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
                    }
                    ?> 
                    <?php echo $this->Paginator->numbers(array('separator' => '')); ?> 
                    <?php 
                    if($this->Paginator->numbers()){
                        echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); 
                    }
                    ?> 
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(".random").click(function(){
    $.post(root + 'create_code', function(data){
        alert(data.msg);
    },'json');
})
</script>