
<table>
<?php foreach ($data as $row) {?>
	<?php if($i=0){ ?>
	<tr>
		<th><?php echo $row[0][1]?></th>
		<th><?php echo $row[0][2]?></th>
		<th><?php echo $row[0][3]?></th>
	</tr>
	<?php }else{?>
	<tr>
		<td><?php echo $row[$i][1]?></td>
		<td><?php echo $row[$i][2]?></td>
		<td><?php echo $row[$i][3]?></td>
	</tr>
	<?php }?>
<?php } ?>
</table>
