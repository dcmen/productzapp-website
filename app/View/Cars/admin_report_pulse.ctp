<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-6"><h3 class="panel-title">View all report of pulse</h3></div>
<!--        <div class="col-xs-6 text-right">
            <a href="<?php echo $this->Html->Url('/admin_pulse_detail/'.$id)?>" class="btn btn-primary">View pulse details</a>
        </div>-->
    </div>
    <div class="panel-body">
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
                    foreach($list as $rs):  
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td>
                        <?php echo $rs->full_name?>
                    </td>
                    <td>
                        <?php echo $rs->phone?>
                    </td>
                    <td>
                        <?php echo $rs->company_name?>
                    </td>
                    <td class="w300"><?php echo $rs->comment?></td>
                    <td><?php echo $rs->created_at?></td>
                    <td>
                       <a data-container="body" data-original-title="Delete" href="<?php echo $this->Html->Url('/del_report/'.$rs->_id)?>" data-toggle="tooltip" class="btn btn-xs btn-danger add-tooltip delete_record"><i class="fa fa-times"></i></a> 
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
    $(function() {
        $("#regisbrochure").tablesorter({
            headers: { 
                6: { 
                    sorter: false 
                }
            }
        });
    });
    
    
    $('#date_from').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        enableOnReadonly: true,
    }).on('changeDate', function (e) {
        $('input[name="date_from"]').datepicker('setStartDate', $('input[name="date_from"]').datepicker('getDate'));
    });
    $('#date_to').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        enableOnReadonly: true,
    }).on('changeDate', function (e) {
        $('input[name="date_to"]').datepicker('setEndDate', $('input[name="date_to"]').datepicker('getDate'));
    }); 
    $(".export_brochures").click(function(){
        var type = $("select[name='type']").val();
        key = $("input[name='key']").val();
        date_from = $("input[name='date_from']").val();
        date_to = $("input[name='date_to']").val();
        window.location.href = root + 'Regisbrochures/export_brochures?key='+key;
    });
    
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