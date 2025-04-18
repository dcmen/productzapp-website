<form id="AddDealerForm">
    <table cellspacing="0" id="tech-companies-1" class="table customer table-card">
        <thead>
            <th></th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
        </thead>
        <tbody class="result_search_network">
            <?php foreach($list as $rs) : ?>
            <tr>
                <td data-card-no-title="true" data-card-display="left"><input class="cb-emails" type="checkbox" name="email[]" value="<?php echo $rs->email ?>"></td>
                <td><div><img class="img-circle" style="height: 40px; width: 40px;" src="<?php echo $rs->avatar_file_name ?>" /></div></td>
                <td><?php echo $rs->name?></td>
                <td><?php echo $rs->email?></td>
            </tr>    
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
<script>
    // update data
    total = <?php echo $total ?>;
    // update menubar
    $('.total-count').text(<?php echo $total ?>);
    $('.total-datatable').show();
    
    if (total) {
        $('.data-content').show();
        $('.message-nodata').hide();
        $('.group-btn-action-table').show();
    }
    else {
        $('.data-content').hide();
        $('.message-nodata').show();
        $('.group-btn-action-table').hide();
    }
    
    $('.msg-1').hide();
    $('.msg-2').show();
</script>