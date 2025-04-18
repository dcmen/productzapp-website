<?php 
    if($list != null){
        $i= $start + 1;
        foreach($list as $rs):?>
    <tr>
        <td><?php echo $i?></td>
        <td>
            <?php echo $rs->first_name?>
        </td>
        <td>
            <?php echo $rs->last_name?>
        </td>
        <td><?php echo $rs->email?></td>
        <td><?php echo $rs->create_date?></td>
        <td>
           <a data-container="body" data-original-title="Del" href="<?php echo $this->Html->Url('/del_regis_brochure/'.$rs->_id)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a> 
        </td>
    </tr>
    <?php 
    $i++;
    endforeach; }?>