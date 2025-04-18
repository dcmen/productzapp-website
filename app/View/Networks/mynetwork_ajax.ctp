<table cellspacing="0" id="tech-companies-1" class="table customer table-card">
    <thead>
        <th style="width: 95px;">Avatar</th>
        <th>Name</th>
        <th>Dealership</th>
        <th class="text-right">Action</th>
    </thead>
    <tbody class="result_search_network">
        <?php 
        if($list != ''){
            foreach($list as $rs):
        ?>
        <tr>
            <td>
                <img src="<?php echo (isset($rs->avatar) && $rs->avatar)? $rs->avatar : $this->webroot . 'images/no-avatar.png' ?>" class="img-circle" style="width: 40px; height: 40px;" />
            </td>
            <td>
                <a href="<?php echo $this->html->url('/users/userprofile?user_id=' . $rs->_id) ?>" style="padding: 0"><?php echo $rs->name?></a>
            </td>
            <td><?php echo (isset($rs->company_name) && $rs->company_name)? $rs->company_name : '' ?></td>
            <td align="right">
                <a title="View Stock" href="<?php echo $this->html->url('/view_stock?id=' . $rs->company_id) ?>"><i class="fa fa-car color-site" style="font-size: 14px;"></i></a>
                <a title="Remove" href="javascript:;" class="btn-remove-network mg-right-8" user-id="<?php echo $rs->_id?>"><i class="fa fa-times color-red"></i></a>
            </td>
        </tr>    
        <?php endforeach; }?>
    </tbody>
</table>

<script>
    // update data
    curPage = <?php echo $page?>;
    maxPage = <?php echo $maxpages?>;
    
    // update menubar
    $('.count-dealer').text(<?php echo $total ?>);
    $('.count-request').text(<?php echo $count_invite ?>);
    
    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'mynetwork', container = '#MyNetworkTable');
</script>