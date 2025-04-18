<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-6">
            <h1 class="panel-title" style="font-size: 17px">View pulse info</h1>
        </div>
        <div class="col-xs-6 text-right">
            <a data-container="body" data-original-title="Delete" href="<?php echo $this->Html->Url('/del_pulse_report?id='.$rs->_id.'&key='.$keyword.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$s_page)?>" data-toggle="tooltip" class="btn btn-danger add-tooltip delete_record">Delete</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
             <table class="table table-striped table-hover">
                <tr>
                    <td>Dealer</td>
                    <td><a href="<?php echo $this->Html->Url('/admin_pulse_user/'.$rs->user_id)?>"><?php echo $rs->full_name?></a></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?php echo $rs->phone?></td>
                </tr>
                <tr>
                    <td>Dealership</td>
                    <td><?php echo $rs->company_name?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $rs->email?></td>
                </tr>
                <tr>
                    <td>Subject</td>
                    <td><?php echo $rs->subject?></td>
                </tr>
                <tr>
                    <td>Content</td>
                    <td><?php echo $rs->content?></td>
                </tr>
                <tr>
                    <td>Share to</td>
                    <td><?php echo ($rs->is_network == 1)?'Your network':'Pulse'?></td>
                </tr>
                <tr>
                    <td>Create date</td>
                    <td><?php echo $rs->created_at?></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>
                        <ul class="pulse_image">
                        <?php 
                        if($images != ''){
                            for($j=0;$j< sizeof($images);$j++){
                            ?>
                            <li><img src="<?php echo $images[$j]?>" class="img-responsive" width="200px"></li>
                            <?php } }?>
                        </ul>     
                    </td>
                </tr>

            </table>
        </div>
        
        <div class="row panel-heading" style="overflow: hidden">
            <div class="col-xs-6 text-left">
                <h3 class="panel-title" style="font-size: 17px">View all reports</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table id="regisbrochure" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Dealership</th>
                        <th>Comment</th>
                        <th>Time / Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="body_pulse">
                <?php
                if($list != ''){
                    $i=1;
                    foreach($list as $result):  
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td>
                        <?php echo $result->full_name?>
                    </td>
                    <td>
                        <?php echo $result->phone?>
                    </td>
                    <td>
                        <?php echo $result->company_name?>
                    </td>
                    <td class="w300"><?php echo $result->comment?></td>
                    <td><?php echo $result->created_at?></td>
                    <td>
                       <a data-container="body" data-original-title="Delete" href="<?php echo $this->Html->Url('/del_report_pulse?id='.$result->_id.'&key='.$keyword.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$s_page.'&pulse_id='.$rs->_id)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a> 
                    </td>
                </tr>
                <?php 
                $i++;
                endforeach;}?>
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
<script type="text/javascript">
    $(function() {
        $("#regisbrochure").tablesorter({
            headers: { 
                6: { 
                    sorter: false 
                }
            }
        });
    });
    
    function createLink(linkBase, parameters) {
        str = '';
        $.each(parameters, function(key, val) {
            str = str + key + '=' + val + '&';
        });
        str = str.replace(/^\&+|\&+$/g, '');
        
        return linkBase.replace(/^\?+|\?+$/g, '') + '?' + str;
    }
    
    function limitViewChange() {
        limit = $('#ViewLimit').val();
        parasOnLink.limit = limit;
        parasOnLink.page = 1;
        window.location.href = createLink(linkCurPage, parasOnLink);
    }
    
    $(document).ready(function(){
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: 1,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            var dataString = {
                ajax: 'true',
                page: num
            }; 

            load_show();
            $.get("admin_pulse", dataString , function( data ) {
                $(".body_pulse").html(data);
                load_hide();
            });
        });
        
        function load_show(msg){
            $("#loading-body, #loading").show();
            $("#loading #msg").text(msg);
        }

        function load_hide(){
            $("#loading-body, #loading").hide();
        }
    });
</script>