<table cellspacing="0" class="table group">
    <thead>
        <th>No.</th>
        <th>Group Name</th>
        <th>Number of Members</th>
        <th class="text-right">Action</th>
    </thead>

    <tbody>
        <?php $i = $limit*($page-1) ?>
        <?php foreach($list as $rs) :?>
        <tr>
            <td><?php echo ++$i ?></td>
            <td><a style="padding: 0px;" class="no-underline-hover" href="<?php echo $this->Html->Url('/group_detail/'.$rs->_id)?>"><?php echo $rs->name ?></a></td>
            <td><?php echo $rs->count_member?></td>
            <td class="text-right">
                <a title="View Group" href="<?php echo $this->Html->Url('/group_detail/'.$rs->_id)?>" class="mg-right-8"><i class="fa fa-eye color-orange"></i></a>
                <a title="Delete Group" href="javascript:;" group-id="<?php echo $rs->_id?>" class="del_group"><i class="fa fa-times color-red"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // update data
    curPage = <?php echo $page?>;
    maxPage = <?php echo $maxpages?>;
    
    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'group', container = '#GroupContainer');
</script>