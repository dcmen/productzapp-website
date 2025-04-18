<table cellspacing="0" id="tech-companies-1" class="table table-striped customer">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th class="text-center">Action</th>
    </thead>
    <tbody class="result_search_network table-card">
        <?php if ($list): ?>
            <?php foreach ($list as $dealer) : ?>
            <tr>
                <td><?php echo $dealer->name?></td>
                <td><?php echo $dealer->email?></td>
                <td align="center">
                    <a title="Unblock network" href="javascript:;" class="un_blockuser" user-id="<?php echo $dealer->_id?>"><i class="fa fa-unlock"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<script type="text/javascript">
    // update data
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    // update menubar
    $('.count-dealer').text(<?php echo $total ?>);
    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'block_network', container = '#BlockTable');
</script>