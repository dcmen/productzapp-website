<?php echo $this->Html->script('cz/ckeditor/ckeditor');?>

<style>
    /*export*/
    .export-file-item {
        line-height: 22px;
    }
</style>
<div class="panel">
    <div class="panel-body">
        <div class="form-group">
            <div class="pull-right" style="font-size: 15px;">
                <i class="fa fa-circle-o-notch" ></i> New registration >
                <i class="fa fa-check-square-o"></i> Email verified >
                <i class="fa fa-check"></i> Admin approved >
                <i class="fa fa-ban"></i> Blocked
            </div>
        </div>
        <div class="form-group form_search">
            <form id="SearchUser" method="get">
                <div class="col-lg-3" style="padding: 0px 0px 0px 4px;;">
                    <label>Keyword</label>
                    <input type="text" name="key" class="form-control keyword" placeholder="Name, Email, Dealership" value="<?php echo ($key != '')?$key:''?>">
                </div>
                <div class="view_search col-lg-4" >
                    <div class="col-lg-7" style="padding: 0px;">
                        <div class="col-lg-6" style="padding: 0px 3px 0px 2px;">
                            <label>Date from:</label>
                            <input type="text" value="<?php echo ($date_from != '')?date('Y-m-d',strtotime($date_from)):''?>" class="form-control date" id="date_from" name="date_from">
                        </div>
                        <div class="col-lg-6" style="padding: 0px 2px 0px 3px;">
                            <label>Date to:</label>
                            <input type="text" value="<?php echo ($date_to != '')?date('Y-m-d',strtotime($date_to)):''?>" class="form-control date" id="date_to" name="date_to">
                        </div>
                    </div>
                    <div class="col-lg-5" style="padding: 0px 0px 0px 4px;;">
                        <label for="sel1">Status</label>
                        <select name="type" class="form-control">
                            <option value="4" <?php echo ($type == 4)?'selected':''?>>All</option>
                            <option value="0" <?php echo ($type == 0)?'selected':''?>>New registration</option>
                            <option value="2" <?php echo ($type == 2)?'selected':''?>>Email verified</option>
                            <option value="1" <?php echo ($type == 1)?'selected':''?>>Admin approved</option>
                            <option value="3" <?php echo ($type == 3)?'selected':''?>>Blocked</option>
                        </select>

                    </div>    
                </div>
                <div class="col-lg-5 btn_control text-right" style="margin-top: 24px; ">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Export" class="btn btn-view export_user">
                    <input type="button" value="Import" class="btn btn-view import_user">
                    <input type="button" value="Send mail" class="btn btn-view sendmailuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($key != '' || $date_from != '' || $date_to != '')?'':'style="display: none"'?>>

                    <!--<a href="javascript:;" class="click_view_search"><i class="fa fa-arrow-right"></i></a>-->
                </div>
            </form>    
            <form id="importForm" class="hide" action="<?php echo './import_user' ?>" enctype='multipart/form-data' method="post">
                <input type="file" name="import_file" id="import_file" accept=".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            </form>
        </div>
        
        <div class="col-xs-12">
            <div class="table-responsive">
                <table id="alluser" cellspacing="0" class="tablesorter table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:1)?>)">
                                CarZapp number <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:3)?>)">
                                First Name <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:3)?>)">
                                Last Name <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:5)?>)">
                                Email <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            Dealership
                        </th>
                        <th>Time login</th>
                        <th>Time logout</th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head(<?php echo (isset($u_sort)?$u_sort:9)?>)">
                                Registration Time <?php echo ($i_sort == 0)?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="result_list">
                        <?php
                        if($list != ''){
                            $i=1;
                            foreach($list as $rs):
                        ?>
                        <tr>
                            <td><?php echo ($rs->is_principle == 1)?'A':'B'?><?php echo ($rs->carzapp_code != '')?$rs->carzapp_code:''?></td>
                            <td><?php echo ($rs->name != '')?$rs->name:'Not set'?></td>
                            <td><?php echo ($rs->last_name != '')?$rs->last_name:''?></td>
                            <td><?php echo ($rs->email != '')?$rs->email:'Not set'?></td>
                            <td><?php echo ($rs->company_name != '')?$rs->company_name:'Not set'?></td>
                            <td><?php echo ($rs->time_login!= '')?$rs->time_login:'Not set'?></td>
                            <td><?php echo ($rs->time_logout != '')?$rs->time_logout:'Not set'?></td>
                            <td><?php echo $rs->created_at?></td>
                            <td>
                                <a title="Edit User Info" href="<?php echo $this->Html->Url('/edit_info_user/'.$rs->_id)?>"><i class="fa fa-edit"></i></a>
                                <a title="View User Info" href="<?php echo $this->Html->Url('/view_info_user/'.$rs->_id)?>"><i class="fa fa-eye"></i></a>

                                <?php if($rs->is_active == 0){?>
                                    <a title="Activate" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                                        <i class="fa fa-circle-o-notch"></i>
                                    </a>
                                <?php }else if($rs->is_active == 1){?>
                                    <a title="Block" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',3)">
                                        <i class="fa fa-check"></i>
                                    </a>
                                 <?php }else if($rs->is_active == 2){?>
                                    <a title="Activate" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                <?php }else if($rs->is_active == 3){ ?>
                                    <a title="Activate" href="javascript:;" onclick="change_active('<?php echo $rs->_id ?>',1)">
                                        <i class="fa fa-ban"></i>
                                    </a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php 
                        $i++;
                        endforeach; }else{?> <tr><td colspan="9">Not found</td></tr><?php }?>
                    </tbody>
                </table>
                <div class="row" style="margin: 20px 0 0;font-size: 13px;float: right">
                    <div class="total_pag">
                        Total: <b><?php echo $total?></b>.             
                    </div>
                    <?php if($total > $limit) :?>
                    <div class="pagina_select col-lg-2 col-xs-6 no-padding form-group">
                        <?php
                            $limit = (isset($this->params->query['limit'])) ? $this->params->query['limit'] : '20';
                            $options = array(20 => '20', 50 => '50', 100 => '100', 200 => '200');

                            echo $this->Form->create(array('type' => 'get'));
                        ?>
                        <label>Show</label>
                        <?php
                            echo $this->Form->select('limit', $options, array(
                                'value' => $limit,
                                'default' => 10,
                                'empty' => FALSE,
                                'onChange' => 'this.form.submit();',
                                'name' => 'limit'
                                    )
                            );
                            echo $this->Form->end();
                        ?>
                    </div>
                    <div class="pagecars pull-right"></div>
                    <?php endif;?>

                </div>
            </div>
        </div>    
    </div>
</div>
<div id="sendmail" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    Send mail
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="SendmailForm" action="sendmail" method="post">
                        <input type="hidden" name="type" value="<?php echo $type?>">
                        <input type="hidden" name="key" value="<?php echo $key?>">
                        <input type="hidden" name="date_from" value="<?php echo $date_from?>">
                        <input type="hidden" name="date_to" value="<?php echo $date_to?>">
                        <div class="form-group">
                            <label>To <i>(Enter email separated by a ';')</i></label>
                            <textarea class="form-control" name="to" style="height: 35px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label>CC</label>
                            <textarea class="form-control" name="cc" style="height: 35px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label>BCC</label>
                            <textarea class="form-control" name="bcc" style="height: 35px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="ckeditor" id="content"></textarea>
                        </div>
                        <div class="text-center"><input type="submit" class="btn btn-view btn-send-email" value="Send mail"></div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>

<div id="ExportModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog modal-sm vdialog" style="width: 300px;">
            <div class="modal-content">
                <div class="modal-header">
                    Export Users
                    <button style="position: absolute; top: 6px; right: 9px;" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="max-height: 250px; overflow-y: auto;">
                    <ul class="export-file-container">
                    </ul>
                </div>
            </div>
        </div>
   </div>
</div>

<script type="text/javascript">
    function CKupdate(){
        for ( instance in CKEDITOR.instances ){
            CKEDITOR.instances[instance].updateElement();
            CKEDITOR.instances[instance].setData('');
        }
        $('textarea[name="content"]').val('');
    }
    
    var totalData = <?php echo $total ?>;
    
    document.getElementById("import_file").onchange = function() {
        document.getElementById("importForm").submit();
    };
    
    $('select[name="type"]').change(function(){
        $('.searchuser').click();
    });
    
    $(".searchuser").click(function(event){
        if(($("#date_from").val() === null || $("#date_from").val() === '') &&
                ($("#date_to").val() === null || $("#date_to").val() === ''))
        {
            return true;
        }else
        {
            if($("#date_from").val() === null || $("#date_from").val() === ''){
            jAlert("Both From date and To date are required");
            return false;
            event.preventDefault();
            }
            if($("#date_to").val() === null || $("#date_to").val() === ''){
                jAlert("Both From date and To date are required");
                return false;
                event.preventDefault();
            }
        }
    });
    $(document).ready(function(){      
        $(".sendmailuser").click(function(){
            key = $("input[name='key']").val();
            date_from = $("input[name='date_from']").val();
            date_to = $("input[name='date_to']").val();
            $.post(root + 'getlistmailuser',{'type':'<?php echo $type?>','key':key, 'date_from':date_from,'date_to':date_to, 'sort':'<?php echo $sort?>'},function(data){
                $("textarea[name='to']").html(data.to);
                $("textarea[name='cc']").html(data.cc);
                $("textarea[name='bcc']").html(data.bcc);
                
                // reset form
                $('#SendmailForm').trigger('reset');
                
                $('.btn-send-email').prop('disabled', false);
                $('.bv-hidden-submit').prop('disabled', false);

                $('textarea[name="content"]').text('');

                CKupdate();

                $("#sendmail").modal('show');
            },'json');
        });
        $(".keyword").keydown(function(){
            $(".reset_text").show();
        });
        $(".date").keydown(function(){
            $(".reset_text").show();
        });
        $(".date").click(function(){
            $(".reset_text").show();
        });
        $(".remove_text").click(function(){
            $("input[name='key']").val('');
            $("input[name='date_from']").val('');
            $("input[name='date_to']").val('');
            $(this).css('display','none');
        });
         $(".reset_text").click(function(){
            $("input[name='key']").val('');
            $("input[name='date_from']").val('');
            $("input[name='date_to']").val('');
             $(".reset_text").hide();
             window.location.href = root +'all_user';
        });
        
        key = '<?php echo $key?>';
        date_from = '<?php echo $date_from?>';
        date_to = '<?php echo $date_to?>';
        type = '<?php echo $type?>';
        limit= '<?php echo $limit?>';
        sort = '<?php echo $sort?>';
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $page_s?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num) {

            window.location.href = root + 'all_user?key=' + key + '&date_from=' + date_from + '&date_to=' + date_to + '&type=' + type + '&limit=' + limit + '&sort=' + sort + '&page=' + num;

        });
        $('#date_from').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            enableOnReadonly: true,
        }).on('changeDate', function (e) {
            $('input[name="date_from"]').datepicker('setStartDate', $('input[name="date_from"]').datepicker('getDate'));
            var startDate = new Date($('#date_from').val());
            var endDate = new Date($('#date_to').val());
            if (startDate > endDate){
                // Do something
                jAlert("Date (from) must be less than date (to)");
                $("input[name='date_from']").val('');
            }
        });
        $('#date_to').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            enableOnReadonly: true,
        }).on('changeDate', function (e) {
            $('input[name="date_to"]').datepicker('setEndDate', $('input[name="date_to"]').datepicker('getDate'));
            var startDate = new Date($('#date_from').val());
            var endDate = new Date($('#date_to').val());
            if (startDate > endDate){
                // Do something
                jAlert("Date (from) must be less than date (to)");
                $("input[name='date_to']").val('');
            }
        });
        $(".export_user").click(function(){
            jConfirm('Do you want to export data?', 'Message', function(r) {
                if (r) {
                    $('.export-file-container').html('');
                    
                    numberFileExport = Math.ceil(totalData / 500);
                    
                    for(i = 1; i <= numberFileExport; i++) {
                        $('.export-file-container').append('<li data-id="'+i+'" class="export-file-item id-'+i+'"><div class="file-name col-lg-10 col-md-10">Loading...</div><a target="_blank" class="btn-download col-lg-2 col-md-2"><i class="fa fa-download"></i></a></li>');
                    }
                    
                    for(j = 1; j <= numberFileExport; j++) {
                        dataPost = {
                            type : parasOnLink.type,
                            key : parasOnLink.key,
                            date_from : parasOnLink.date_from,
                            date_to : parasOnLink.date_to,
                            id : j
                        };
                        $.post(root + 'users/export_user', dataPost, function(data){
                            if (data.error == 0) {
                                fileItem =  $('li.export-file-item.id-' + data.id);
                                if (Math.ceil(totalData / 500) > 1) {
                                    fileItem.find('.file-name').text('File ' + data.id);
                                }
                                else {
                                    fileItem.find('.file-name').text('Export File');
                                }
                                fileItem.find('.btn-download').attr('href', data.link);
                            }
                        }, 'json');
                    }
                    
                    $('#ExportModal').modal('show');
                }
            });
        });
        
        $(".import_user").click(function(){ 
            $("#import_file").click();
        });
        $('#SendmailForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                subject: {
                    validators: {
                        notEmpty: {
                            message: 'Subject is required and can\'t be empty'
                        }
                    }
                },
                content: {
                    validators: {
                        notEmpty: {
                            message: 'Content is required and can\'t be empty'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            load_show();
            e.preventDefault();
            var $form = $(e.target);
            
            to = $('#SendmailForm textarea[name="to"]').val();
            cc = $('#SendmailForm textarea[name="cc"]').val();
            bcc = $('#SendmailForm textarea[name="bcc"]').val();
            subject = $('#SendmailForm input[name="subject"]').val();
            content = CKEDITOR.instances.content.getData();
            //content = $('#SendmailForm textarea[name="content"]').val();
            
            $.post($('#SendmailForm').attr('action'), {to:to, cc:cc, bcc:bcc, subject:subject, content:content}, function (data) {
                load_hide();
                jAlert('Sent email successfully');
                $("#sendmail").modal('hide');
            });
        });
        
    });
    
    function sort_head(sort){
        var type = $("select[name='type']").val();
        key = $("input[name='key']").val();
        date_from = $("input[name='date_from']").val();
        date_to = $("input[name='date_to']").val();
        window.location.href = root + 'all_user?key='+key+'&date_from='+ date_from + '&date_to='+date_to+'&type='+type+'&limit='+limit+'&sort='+sort+'&page=<?php echo $page_s?>';
        
    }
    function change_active($id,$active){
        if($active == 1){
            $msg = 'Are you sure you want to activate this user?';
        }else{
            $msg = 'Are you sure you want to block this user?';
        }

        jConfirm($msg,'Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'activate_user',{'id':$id,'active':$active},function(data){
                    window.location.href = root + 'all_user' + "?type=" + <?php echo $type;?>;
                    load_hide();
                });
            }
        });
        return false;
    }
    function load_show(msg){
        $("#loading-body, #loading").show();
        $("#loading #msg").text(msg);
    }

    function load_hide(){
        $("#loading-body, #loading").hide();
    }
</script>
