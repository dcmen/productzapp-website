<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12">
            <form action="<?php echo $this->Html->Url('/pulse_report')?>" method="get">
                <div class="col-md-4">
                    <label>Enter key:</label>
                    <input class="form-control keyword" type="text" name="key" placeholder="Subject, Title car, Dealer" autocomplete="false" value="<?php echo ($keyword != '')?$keyword:''?>">
                </div>
                <div class="view_search col-md-5 no-padding">
                    <div class="col-xs-6">
                        <label>Date from:</label>
                        <input type="text" autocomplete="false" value="<?php echo ($date_from != '')? date('Y-m-d', strtotime($date_from)):''?>" class="form-control date" id="date_from" name="date_from">
                    </div>
                    <div class="col-xs-6">
                        <label>Date to:</label>
                        <input type="text" autocomplete="false" value="<?php echo ($date_to != '')? date('Y-m-d', strtotime($date_to)):''?>" class="form-control date" id="date_to" name="date_to">
                    </div>
                </div>
                <div class="col-md-3 btn_control text-left" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Reset" class="btn btn-view reset_text" <?php echo ($keyword != '' || $date_from != '' || $date_to != '')?'':'style="display: none"'?>>
                </div>
            </form>    
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="regisbrochure" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Subject</th>
                        <th>Title car</th>
                        <th>Dealer</th>
                        <th>Time / Date</th>
                        <th class="text-center">Report count </th>
                        <th>Action </th>
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
                        <td class="text-center"><?php echo $i?></td>
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
                        <td class="text-center"><?php echo $rs->report_count?> </td>
                        <td>
                           <a data-container="body" data-original-title="View report" href="<?php echo $this->Html->Url('/pulse_report_detail?id='.$rs->_id.'&key='.$keyword.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$s_page)?>" data-toggle="tooltip" class="btn btn-xs btn-primary add-tooltip"><i class="fa fa-eye"></i></a> 
                           <a data-container="body" data-original-title="Delete" href="<?php echo $this->Html->Url('/del_pulse_report?id='.$rs->_id.'&key='.$keyword.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$s_page)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a> 
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
    $(document).ready(function(){
    key = '<?php echo $keyword?>',
    date_from = '<?php echo $date_from?>',
    date_to = '<?php echo $date_to?>',
    $('.pagecars').bootpag({
        total: '<?php echo $maxpages?>',
        page: '<?php echo $s_page?>',
        maxVisible: 5,
        leaps: true
    }).on("page", function(event, num){
        window.location.href = root + 'pulse_report?key='+key+'&date_from='+date_from+'&date_to='+date_to+'&page='+num;
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
    $(".reset_text").click(function(){
        $("input[name='key']").val('');
        $("input[name='date_from']").val('');
        $("input[name='date_to']").val('');
         $(".reset_text").hide();
         window.location.href = root +'pulse_report';
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
    function load_show(msg){
        $("#loading-body, #loading").show();
        $("#loading #msg").text(msg);
    }

    function load_hide(){
        $("#loading-body, #loading").hide();
    }
});
</script>