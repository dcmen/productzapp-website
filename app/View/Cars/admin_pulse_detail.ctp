<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-6"><h3 class="panel-title">View info pulse</h3></div>
        <div class="col-xs-6 text-right">
            
            <a data-container="body" data-original-title="Delete" href="<?php echo $this->Html->Url('/del_pulse?id='.$rs->_id.'&key='.$keyword.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$s_page)?>" data-toggle="tooltip" class="btn btn-danger add-tooltip delete_record">Delete</a> 
            <a href="<?php echo $this->Html->Url('/admin_report_pulse/'.$rs->_id)?>" class="btn btn-view">View report</a>
            <a href="<?php echo $this->Html->Url('/admin_pulse')?>" class="btn btn-view">Back</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <td>Dealer</td>
                    <td>
                        <?php if ($rs->type != 2) {?>
                        <a href="<?php echo $this->Html->Url('/admin_pulse_user/'.$rs->user_id)?>">
                            <?php echo ($rs->type == 2) ? $rs->rss_info->title_company : $rs->full_name?>
                        </a>
                        <?php } else {?>
                        <?php echo ($rs->type == 2) ? $rs->rss_info->title_company : $rs->full_name?>
                        <?php } ?>
                    </td>
                </tr>
                <?php if ($rs->type != 2) {?>
                <tr>
                    <td>Phone</td>
                    <td><?php echo isset($rs->phone) ? $rs->phone : ''?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>Dealership</td>
                    <?php if ($rs->type != 2) {?>
                    <td><?php echo ($rs->type == 2) ? $rs->rss_info->link_company : $rs->company_name?></td>
                    <?php } else {?>
                    <td><a href="<?php echo $rs->rss_info->title_company ?>">
                        <?php echo ($rs->type == 2) ? $rs->rss_info->link_company : $rs->company_name?>
                    </a></td>
                    <?php } ?>
                </tr>
                <?php if ($rs->type != 2) {?>
                <tr>
                    <td>Email</td>
                    <td><?php echo isset($rs->email) ? $rs->email : ''?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>Subject</td>
                    <td><?php echo $rs->subject?></td>
                </tr>
                <tr>
                    <td>Content</td>
                    <td><?php echo $rs->content?></td>
                </tr>
                <tr>
                    <td>Share to</td>
                    <td>
                        <?php 
                        if($rs->is_network == 0){
                            echo 'Pulse(s)';
                        }else if($rs->is_network == 1){
                            echo 'My network';
                        }else if($rs->is_network == 2){
                            echo 'Group(s)';
                        }else{
                            echo 'Dealer(s)';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Create date</td>
                    <td><?php echo $rs->created_at?></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>
                        <ul class="pulse_image">
                        <?php 
                        if($images != ''){
                            for($j=0;$j< sizeof($images);$j++){
                            ?>
                            <li><img src="<?php echo $images[$j]?>" class="img-responsive" width="200px"></li>
                        <?php } }?>
                        </ul>     
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

