<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12">
            <form action="<?php echo $this->Html->Url('/admin_pulse')?>" method="get">
                <div class="col-md-3">
                    <label>Enter key:</label>
                    <input class="form-control keyword" type="text" name="key" placeholder="Subject, Title car, Dealer" autocomplete="false" value="<?php echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="col-lg-1" style="padding: 0px 0px 0px 4px;;">
                    <label>Type:</label>
                    <select name="type" class="form-control type">
                        <option value="0" <?php echo ($type == 0)?'selected':''?>>All</option>
                        <option value="2" <?php echo ($type == 2)?'selected':''?>>News</option>
                        <option value="1" <?php echo ($type == 1)?'selected':''?>>Posts</option>
                    </select>
                </div> 
                <div class="view_search col-md-4 no-padding">
                    <div class="col-xs-6">
                        <label>Date from:</label>
                        <input type="text" autocomplete="false" value="<?php echo ($date_from != '')? date('Y-m-d', strtotime($date_from)):''?>" class="form-control date" id="date_from" name="date_from">
                    </div>
                    <div class="col-xs-6">
                        <label>Date to:</label>
                        <input type="text" autocomplete="false" value="<?php echo ($date_to != '')? date('Y-m-d', strtotime($date_to)):''?>" class="form-control date" id="date_to" name="date_to">
                    </div>
                </div>
                <div class="col-md-4 btn_control text-right" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '' || $date_from != '' || $date_to != '')?'':'style="display: none"'?>>
                    <a href="<?php echo $this->Html->Url('/admin_add_pulse')?>" class="btn btn-primary">Add new pulse</a>
                </div>
            </form>    
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="regisbrochure" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('subject','<?php echo $u_sort?>')">
                                Subject <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('titlecar','<?php echo $u_sort?>')">
                                Title car <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('namedealer','<?php echo $u_sort?>')">
                                Dealer <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                            <a href="javascript:;" class="sort_header" onclick="sort_head('timecreate','<?php echo $u_sort?>')">
                                Time / Date <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                            </a>
                        </th>
                        <th>
                                Action 
                        </th>
                    </tr>
                </thead>
                <tbody class="body_pulse">
                    <?php
                    if($list != ''){
                        $i = $stt;
                        foreach($list as $rs):
                        $car = ($rs->cars != null)?$rs->cars:'';    
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td>
                            <a href="<?php echo $this->Html->Url('/admin_pulse_detail/'.$rs->_id)?>"><?php echo $rs->subject?></a>
                        </td>
                        <td>
                            <?php echo ($car != '')?$car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox:''?>
                        </td>
                        <td>
                            <a href="<?php echo $this->Html->Url('/admin_pulse_user/'.$rs->user_id)?>"><?php echo $rs->full_name?> </a>
                        </td>
                        <td><?php echo $rs->created_at?></td>
                        <td>
                           <a data-container="body" data-original-title="View pulse" href="<?php echo $this->Html->Url('/admin_pulse_detail?id='.$rs->_id.'&key='.$keyword.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$s_page)?>" data-toggle="tooltip" class="btn btn-xs btn-primary add-tooltip"><i class="fa fa-eye"></i></a> 
                           <a data-container="body" data-original-title="Delete" href="<?php echo $this->Html->Url('/del_pulse?id='.$rs->_id.'&key='.$keyword.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$s_page)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a> 
                        </td>
                    </tr>
                    <?php 
                    $i++;
                    endforeach;}?>
                </tbody>
            </table>
            <div class="row" style="margin: 20px 0 0;font-size: 13px;float: right">
                <div class="total_pag">
                    Total: <b><?php echo $total?></b>.             
                </div>
                <div class="pagina_select col-lg-2 col-xs-6 no-padding form-group">
                    <?php
                        $limit = (isset($this->params->query['limit'])) ? $this->params->query['limit'] : '6';
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
                <?php 
                if($total > $limit){
                    echo '<div class="pagecars pull-right"></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function sort_head(fieldsort,sort){
        key = $("input[name='key']").val();
        window.location.href = root + 'admin_pulse?key='+key+'&date_from='+date_from+'&date_to='+date_to+'&page='+num+'&sort='+sort+'&fieldsort='+fieldsort+'&limit=<?php echo $limit?>'+'&page=<?php echo $s_page?>';
    }
    $(document).ready(function(){
    key = '<?php echo $keyword?>',
    date_from = '<?php echo $date_from?>',
    date_to = '<?php echo $date_to?>',
    fieldsort = '<?php echo $fieldsort?>',
    sort = '<?php echo $sort?>',
    $('.pagecars').bootpag({
        total: <?php echo $maxpages?>,
        page: <?php echo $s_page?>,
        maxVisible: 5,
        leaps: true
    }).on("page", function(event, num){
        window.location.href = root + 'admin_pulse?key='+key+'&date_from='+date_from+'&date_to='+date_to+'&page='+num+'&sort='+sort+'&fieldsort='+fieldsort;
    });
    
    $(".keyword").keydown(function(){
        $(".reset_text").show();
    });
    $(".type").change(function(){
        //$(".reset_text").show();
        $('.searchuser').click();
    });
    $(".date").keydown(function(){
        $(".reset_text").show();
    });
    $(".date").click(function(){
        $(".reset_text").show();
    });
    $(".reset_text").click(function(){
        $("input[name='key']").val('');
        $("input[name='date_from']").val('');
        $("input[name='date_to']").val('');
         $(".reset_text").hide();
         window.location.href = root +'admin_pulse';
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
            jAlert("Date (from) must be less than date (to)");
            $("input[name='date_to']").val('');
        }
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