<table cellspacing="0" id="tech-companies-1" class="table customer table-card">
    <thead>
        <th style="width: 50px; display: none;">No.</th>
        <th style="width: 95px;">Avatar</th>
        <th>Name</th>
        <th>Dealership</th>
        <th style="width: 120px;">Status</th>
        <th style="width: 120px;" class="text-right">Action</th>
    </thead>
    <tbody>
        <?php $i = ($page - 1) * $limit ?>
        <?php foreach ($list as $rs) : $i++; ?>
            <tr>
                <td data-card-display="hide" align="text-left" class="hidden"><?php echo $i ?></td>
                <td>
                    <img src="<?php echo (isset($rs->avatar) && $rs->avatar)? $rs->avatar : $this->webroot . 'images/no-avatar.png' ?>" class="img-circle" style="width: 40px; height: 40px;" />
                </td>
                <td><?php echo $rs->name ?></td>
                <td><?php echo $rs->company_info->company_name ?></td>
                <td><?php echo ($rs->is_received)? 'Request Received' : 'Request Sent' ?></td>
                <td class="text-right">
                    <?php if (!$rs->is_received) : ?>
                    <a title="Resend" href="javascript:;" class="btn-resend-invite mg-right-8"
                            data-invite-id="<?php echo $rs->_id ?>"
                            data-sender-id="<?php echo CakeSession::read('Auth.User._id') ?>"
                            data-sender-name="<?php echo CakeSession::read('Auth.User.name') ?>"
                            data-request-email="<?php echo $rs->email ?>">
                        <i class="fa fa-reply-all color-orange"></i>
                    </a>
                    <a title="Cancel" href="javascript:;" invi_id="<?php echo $rs->invited_id ?>" class="del_invite"><i class="fa fa-times color-red"></i></a>
                    <?php else : ?>
                    <a title="Accept" href="javascript:;" request_id="<?php echo $rs->_id ?>" request_email="<?php echo $rs->email ?>" class="accept_invite mg-right-8"><i class="fa fa-check color-orange"></i></a>
                    <a title="Cancel" href="javascript:;" invi_id="<?php echo $rs->invited_id ?>" class="del_invite"><i class="fa fa-times color-red"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // update data
    curPage = <?php echo $page?>;
    maxPage = <?php echo $maxpages?>;
    
    // update total
    $('.total-count').text(<?php echo $total ?>);
    
    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'request_network', container = '#RequestTable');
</script>