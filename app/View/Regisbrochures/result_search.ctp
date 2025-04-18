<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-12">
            <form action="<?php echo $this->Html->Url('/Regisbrochures/result_search')?>" method="get">
                <div class="col-md-4">
                    <label>Enter key:</label>
                    <input class="form-control" type="text" name="key" placeholder="First name, Last name, Email" value="<?php echo ($key != '')?$key:''?>" autocomplete="false">
                </div>
                <div class="view_search col-md-4 no-padding">
                    <div class="col-xs-6">
                        <label>Date from:</label>
                        <input type="text" value="<?php echo ($date_from != '')?date('Y-m-d',  strtotime($date_from)):''?>" class="form-control date" id="date_from" name="date_from" autocomplete="false">
                    </div>
                    <div class="col-xs-6">
                        <label>Date to:</label>
                        <input type="text" value="<?php echo ($date_to != '')?date('Y-m-d',  strtotime($date_to)):''?>" class="form-control date" id="date_to" name="date_to" autocomplete="false">
                    </div>
                </div>
                <div class="col-md-4 btn_control text-right" style="margin-top: 21px">
                    <input type="submit" value="Search" class="btn btn-view searchuser">
                    <input type="button" value="Export" class="btn btn-view export_brochures">
                    <input type="button" value="Reset" class="btn btn-view reset_text" style="display: none">
                </div>
            </form>    
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="regisbro" cellspacing="0" class="tablesorter table table-striped table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>
                        <a href="javascript:;" class="sort_header" onclick="sort_head('firstname','<?php echo $u_sort?>')">
                            First name <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                        </a>
                    </th>
                    <th>
                        <a href="javascript:;" class="sort_header" onclick="sort_head('lastname','<?php echo $u_sort?>')">
                            Last name <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                        </a>
                    </th>
                    <th>
                        <a href="javascript:;" class="sort_header" onclick="sort_head('email','<?php echo $u_sort?>')">
                            Email <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                        </a>
                    </th>
                    <th>
                        <a href="javascript:;" class="sort_header" onclick="sort_head('timecreate','<?php echo $u_sort?>')">
                            Date/ Time <?php echo ($sort == 'desc')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>'?>
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="result_list">
                    <?php if($list!=null):?>
                        <?php $i=$start+1;?>
                        <?php foreach ( $list as $rs): ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td>
                                    <?php echo $rs->first_name?>
                                </td>
                                <td>
                                    <?php echo $rs->last_name?>
                                </td>
                                <td><?php echo $rs->email?></td>
                                <td><?php echo $rs->create_date?></td>
                                <td>
                                    <a data-container="body" data-original-title="Del" href="<?php echo $this->Html->Url('/del_regis_brochure_search?id='.$rs->_id.'&key='.$key.'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&page='.$s_page)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;?>
                        <?php else:?>
                            <tr><td colspan="7">Not found</td></tr>
                    <?php endif;?>

                </tbody>
            </table>
            <div class="row" style="margin: 20px 0 0;font-size: 13px;float: right">
                    <div class="total_pag">
                        Total: <b><?php echo $total?></b>.
                    </div>
                    <?php if($total > $limit):?>
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
                    <?php 
                    if($total > $limit){
                        echo '<div class="pagecars pull-right"></div>';
                    }
                    ?>
                    <?php endif;?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function sort_head(fieldsort,sort){
        key = $("input[name='key']").val();
        window.location.href = root + 'result_search_brochures?key='+key+'&date_from='+date_from+'&date_to='+date_to+'&fieldsort='+fieldsort+'&limit=<?php echo $limit?>&sort='+sort+'&page=<?php echo $s_page?>';
    }
    $(document).ready(function(){
        key = '<?php echo $key?>',
        date_from = '<?php echo date('Y-m-d',  strtotime($date_from))?>';
        date_to = '<?php echo date('Y-m-d',  strtotime($date_to))?>';
        limit = '<?php echo $limit?>',
        fieldsort = '<?php echo $fieldsort?>',
        sort = '<?php echo $sort?>',
        $('.pagecars').bootpag({
            total: '<?php echo $maxpages?>',
            page: <?php echo $s_page?>,
            maxVisible: 5,
            leaps: true
        }).on("page", function(event, num){
            window.location.href = root + 'result_search_brochures?key='+key+'&date_from='+date_from+'&date_to='+date_to+'&fieldsort='+fieldsort+'&limit='+limit+'&page='+num;
        });
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
    $(".export_brochures").click(function(){
        var total = <?php echo $total?>;
        if(total > 200)
        {
            jAlert("Due to performace issue. You cannot export more than 200 records!");
        }else
        {
            var type = $("select[name='type']").val();
            key = $("input[name='key']").val();
            date_from = $("input[name='date_from']").val();
            date_to = $("input[name='date_to']").val();
            window.location.href = root + 'Regisbrochures/export_brochures?key='+key+'&date_from='+ date_from + '&date_to='+date_to;
        }
        
    });
       $(".reset_text").click(function(){
        $("input[name='key']").val('');
        $("input[name='date_from']").val('');
        $("input[name='date_to']").val('');
        $(".reset_text").hide();
        window.location.href = root +'list_regis_brochures';
    });
</script>
