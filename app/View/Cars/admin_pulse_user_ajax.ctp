<?php
    if($list != ''){
        $i=1;
        foreach($list as $rs):
        $car = ($rs->cars != null)?$rs->cars:'';    
    ?>
    <tr>
        <td><?php echo $i?></td>
        <td>
            <a href="<?php echo $this->Html->Url('/admin_pulse_detail/'.$rs->_id)?>"><?php echo $rs->subject?></a>
        </td>
        <td>
            <?php echo ($car != '')?$car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox:''?>
        </td>
        <td>
            <?php echo $rs->full_name?> 
        </td>
        <td><?php echo $rs->created_at?></td>
        <td>
           <a data-container="body" data-original-title="Del" href="<?php echo $this->Html->Url('/del_pulse/'.$rs->_id)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a> 
        </td>
    </tr>
    <?php 
    $i++;
    endforeach;}?>
