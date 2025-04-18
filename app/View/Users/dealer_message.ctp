<?php echo $this->Html->script('cz/ckeditor/ckeditor');?>

<div class="panel">
    <!--search and filter location-->
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12 no-padding">
            <form action="<?php echo $this->Html->Url('/users/dealer_message')?>" method="get">
                <div class="col-md-5 no-padding-left">
                    <label>Enter key:</label>
                    <input class="form-control keyword" type="text" name="key" placeholder="Name, Email, Phone" autocomplete="false" value="<?php echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="col-md-4 btn_control text-right pull-right no-padding" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '')?'':'style="display: none"'?>>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="ListCarTable" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 10px;">No.</th>
                        <th style="width: 120px;">
                            <a href="javascript:;" class="sort_header" onclick="sort_head('name', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Name 
                                <?php if($fieldsort == 'name') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <th style="width: 150px;">
                            <a href="javascript:;" class="sort_header" onclick="sort_head('email', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Email
                                <?php if($fieldsort == 'email') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <th style="width: 130px;">
                            <a href="javascript:;" class="sort_header" onclick="sort_head('phone', '<?php echo (isset($sort) && $sort == 'asc')? 'desc' : 'asc' ?>')">
                                Phone
                                <?php if($fieldsort == 'phone') { echo ($sort == 'desc')? '<i class="fa fa-sort-asc"></i>' : '<i class="fa fa-sort-desc"></i>';} ?>
                            </a>
                        </th>
                        <th>
                            Content
                        </th>
                        <th style="width: 130px;">
                            Contact Us Time
                        </th>
                        <th style="width: 80px;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="body-list-car">
                    <?php if ($list) : ?>
                        <?php $i = $limit * ($page - 1); ?>
                        <?php foreach($list as $rs) : $i++ ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $rs->name ?></td>
                            <td><?php echo $rs->email ?></td>
                            <td><?php echo $rs->phone ?></td>
                            <!--<td title="<?php echo $rs->content ?>"><?php // echo (strlen($rs->content) > 250)? substr($rs->content, 0, 250) . '...' : $rs->content ?></td>-->
                            <td title="<?php echo $rs->content ?>">
                                <div style="overflow-y: auto; max-height: 140px;">
                                    <?php echo $rs->content ?>
                                </div>
                            </td>
                            <td >
                                <?php echo $rs->created_at==""?"Not Set":$rs->created_at ?>
                            </td>
                            <td>
                                <a title="Reply" data-email="<?php echo $rs->email ?>" class="btn btn-xs btn-primary btn-reply"><i class="fa fa-reply"></i></a> 
                                <a title="Delete" href="<?php echo $this->Html->Url('/users/del_dealer_message?id='.$rs->_id.'&page='.$page)?>" class="btn btn-xs btn-danger delete_record"><i class="fa fa-times"></i></a> 
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="6">Not found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="row" style="margin: 20px 0 0;font-size: 13px; float: right">
                <div class="total_pag">
                    Total: <b><?php echo $total?></b>.             
                </div>
                <?php if($total > $limit) : ?>
                <div class="pagina_select col-lg-2 col-xs-6 no-padding form-group">
                    <label>Show</label>
                    <select id="ViewLimit" onchange="limitViewChange();">
                        <option value="20" <?php echo ($limit == 20)? 'selected' : '' ?> >20</option>
                        <option value="50" <?php echo ($limit == 50)? 'selected' : '' ?> >50</option>
                        <option value="100" <?php echo ($limit == 100)? 'selected' : '' ?> >100</option>
                        <option value="200" <?php echo ($limit == 200)? 'selected' : '' ?> >200</option>
                    </select>
                </div>
                <div class="pagecars pull-right"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div id="ReplyDealerMessageModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reply</h4>
                </div>
                <div class="modal-body">
                    <form id="ReplyDealerMessageForm" method="post">
                        <div class="form-group">
                            <label>Send to</label>
                            <input class="form-control" name="email" readonly />
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="ckeditor" id="content"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-view btn-send-email">SEND</button>
                        </div>
                    </form>   
                </div>
            </div>
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
    }
    
    function limitViewChange() {
        limit = $('#ViewLimit').val();
        parasOnLink.limit = limit;
        parasOnLink.page = 1;
        window.location.href = createLink(linkCurPage, parasOnLink);
    }
    
    function CKupdate(){
        for ( instance in CKEDITOR.instances ){
            CKEDITOR.instances[instance].updateElement();
            CKEDITOR.instances[instance].setData('');
        }
        $('textarea[name="content"]').val('');
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
        
        $('.btn-reply').click(function () {
            // reset form
            $('#ReplyDealerMessageForm').trigger('reset');
                                        
            $('#ReplyDealerMessageForm input[name="email"]').val($(this).attr('data-email'));
            $('.btn-send-email').prop('disabled', false);
            $('.bv-hidden-submit').prop('disabled', false);
            
            $('textarea[name="content"]').text('');
            
            CKupdate();
            
            $('#ReplyDealerMessageModal').modal('show');
        });
        
        $('#ReplyDealerMessageForm').submit(function () {
            email = $('#ReplyDealerMessageForm input[name="email"]').val();
            content = CKEDITOR.instances.content.getData();
            
            if (content) {
                load_show();
                $.post(root + 'users/reply_dealer_message', {email:email, content:content}, function (data) {
                    load_hide();
                    if(data.error == 0){
                        $('#ReplyDealerMessageModal').modal('hide');
                        alert('Sent successfully');
                    }else{
                        alert(data.msg);
                    }
                },'json');
            }
            else {
                alert('Please input content');
            }
            
            return false;
        });
    });
</script>