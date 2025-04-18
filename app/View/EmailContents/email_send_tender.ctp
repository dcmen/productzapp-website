<div class="panel">
    <!--search and filter location-->
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12 no-padding">

        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="ListCarTable" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <!--Description-->
                    <th>
                       Description
                    </th>
                    <!--subject-->
                    <th>
                        Subject
                    </th>
                    <!--content-->
                    <th>
                        Content
                    </th>
                    <!--action-->
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <tbody class="body-list-car">
                <?php
                $i = 0 ;
                if ($list) : ?>
                    <?php foreach($list as $rs) : $i++ ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $rs->name ?></td>
                            <td><?php echo $rs->subject ?></td>
                            <td><div style="overflow-y: auto; max-height: 140px;"><?php echo $rs->content ?></div></td>
                            <td>
                                <a title="Edit" href="<?php echo $this->Html->Url('/emailcontents/edit_email_send_tender/'.$rs->_id)?>"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="6">Not found</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    function createLink(linkBase, parameters) {
        str = '';
        $.each(parameters, function(key, val) {
            str = str + key + '=' + val + '&';
        });
        str = str.replace(/^\&+|\&+$/g, '');

        return linkBase.replace(/^\?+|\?+$/g, '') + '?' + str;
    }

    function sort_head(fieldsort, sort){
//        parasOnLink.fieldsort = fieldsort;
//        parasOnLink.sort = sort;
//
//        window.location.href = createLink(linkCurPage, parasOnLink);
    }

    function limitViewChange() {
        limit = $('#ViewLimit').val();
        parasOnLink.limit = limit;
        parasOnLink.page = 1;
        window.location.href = createLink(linkCurPage, parasOnLink);
    }

    $(document).ready(function() {
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $page?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            parasOnLink.page = num;
            window.location.href = createLink(linkCurPage, parasOnLink);
        });

        $(".keyword").keydown(function(){
            $(".reset_text").show();
        });
        $(".type").change(function(){
            $(".reset_text").show();
        });
        $(".reset_text").click(function(){
            window.location.href = linkCurPage;
        });

        $(".btn-delete").click(function(){
            idEmailContent = $(this).attr('data-id');
            jConfirm('Are you sure you want to delete this email content?','Message',function(r) {
                if(r){
                    load_show();
                    parasOnLink.id = idEmailContent;
                    window.location.href = createLink(root + 'emailcontents/delete_email', parasOnLink);
                }
            });
            return false;
        });
    });
</script>