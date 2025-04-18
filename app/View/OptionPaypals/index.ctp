<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-6"><h3 class="panel-title">Price sell app</h3></div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Number month</th>
                    <th>Price ($)</th>
                    <th>Options</th>
                </tr>
                </thead>
                <?php 
                if($list != ''){
                    $i=1;
                    foreach($list as $rs):?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $rs->title?></td>
                    <td><?php echo $rs->number_month?></td>
                    <td><?php echo $rs->price?></td>
                    <td>
                        <a data-container="body" data-original-title="Edit" href="<?php echo $this->Html->Url('/edit_price/'.$rs->_id)?>" data-toggle="tooltip" class="btn btn-xs btn-default add-tooltip"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                <?php 
                $i++;
                endforeach;}?>
            </table>
     
        </div>
    </div>
</div>
