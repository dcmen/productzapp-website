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
    <td><?php echo $rs->time_login?></td>
    <td><?php echo $rs->time_logout?></td>
    <td><?php echo $rs->created_at?></td>
    <td><?php echo ($rs->is_admin == 1)?'<i class="fa fa-check"></i>':''?></td>
    <td>
        <a href="<?php echo $this->Html->Url('/edit_info_user/'.$rs->_id)?>"><i class="fa fa-edit"></i></a>
        <a href="<?php echo $this->Html->Url('/view_info_user/'.$rs->_id)?>"><i class="fa fa-eye"></i></a>

        <?php if($rs->is_active == 0){?>
            <a title="Active" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                <i class="fa fa-circle-o-notch"></i>
            </a>
        <?php }else if($rs->is_active == 1){?>
            <a title="Block" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',3)">
                <i class="fa fa-check"></i>
            </a>
         <?php }else if($rs->is_active == 2){?>
            <a title="Active" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                <i class="fa fa-check-square-o"></i>
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
endforeach; }else{?> <tr><td colspan="9">Not found</td></tr><?php }?>

