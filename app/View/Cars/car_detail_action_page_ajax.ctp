<table class="table customer">
    <thead>
        <th style="width: 100px;">Avatar </th>
        <th style="width: 180px;">Name</th>
        <th>Email</th>
        <th class="text-right">Actions</th>
    </thead>
    <tbody class="result_search">
        <?php foreach($list as $rs) : ?>
        <tr id="<?php echo $rs->_id ?>">
            <td><img class="user-avatar img-circle" src="<?php echo (isset($rs->avatar_file_name) && $rs->avatar_file_name)? $rs->avatar_file_name : $this->webroot . 'images/no-avatar.png' ?>" /></td>
            <td><?php echo $rs->name ?></td>
            <td><?php echo $rs->email ?></td>
            <td align="right">
                <a href="javascript:;" class="btn-send-inbox" data-email="<?php echo $rs->email ?>" title="Send email"><i class="fa fa-envelope"></i></a>
                <a href="javascript:;" class="btn-add-network is_my_network" user_id="" request_id="<?php echo $rs->_id ?>" title="Add my network"><i class="fa fa-users"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    // update data
    curPage = <?php echo $page?>;
    maxPage = <?php echo $maxpages?>;
    
    // update menubar
    $('.total-count').text(<?php echo $total ?>);
    
    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'car_detail_action_page', container = '#UsersInCompanyTable');
</script>