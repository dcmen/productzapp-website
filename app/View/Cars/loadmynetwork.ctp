
<div class="form-group form_search">
    <div class="col-lg-9">
        <label>Keyword</label>
        <input type="text" name="keyword" class="form-control keyword" placeholder="Name, Email, Dealership" value="<?php echo ($key != '') ? $key : '' ?>">
    </div>
    <div class="col-lg-3" style="margin-top: 24px">
        <input type="button" value="Search" class="btn btn-view searchuser">
        <input type="button" value="Reset" class="btn btn-view reset_text">
    </div>
</div>

<div class="col-xs-12">
    <table id="alluser" cellspacing="0" class="tablesorter table table-striped table-hover">
        <thead>
            <tr>
                <th>Choose</th>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Dealership</th>
            </tr>
        </thead>
        <tbody class="result_list">
            <?php
            if ($dealers != '') {
                $i = 1;
                foreach ($dealers as $rs):
                    $check = (in_array($rs->_id, $listMember)) ? 'checked="checked"' : '';
                    ?>
                    <tr>
                        <td><input type="checkbox" <?php echo $check;?> class="number_id" name="member_id[]" value="<?php echo $rs->_id ?>"></td>
                        <td><?php echo $i ?></td>
                        <td><?php echo ($rs->name != '') ? $rs->name : 'Not set' ?></td>
                        <td><?php echo ($rs->email != '') ? $rs->email : 'Not set' ?></td>
                        <td><?php echo ($rs->company_name != '') ? $rs->company_name : 'Not set' ?></td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
            }else {
                ?> <tr><td colspan="9">Not found</td></tr><?php } ?>
        </tbody>
    </table>

    <div class="form-group col-xs-12">
        <div class="total_pag col-lg-2" style="margin-top: 8px">
            Total: <b><?php echo $total ?></b>.             
        </div>
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
                'onChange' => 'change_limit()',
                'name' => 'limit'
                    )
            );
            echo $this->Form->end();
            ?>
        </div>
        <?php
        if ($total > $limit) {
            echo '<div class="pagecars pull-right"></div>';
        }
        ?>
    </div>
    <div class="form_group col-md-offset-4">
        <div id="empty_leader"></div>
        <button type="button" class="btn btn-view col-xs-12 col-md-2 back_pulse" style="margin-right: 5px">Back</button>
        <button type="submit" id="btn_submit_last_step" class=" btn btn-view col-xs-12 col-md-2" style="margin-right: 5px">Done</button>
    </div>
</div>
<script type="text/javascript">
    if($("input[name='is_share_dealers']").val() == ''){
        $("#btn_submit_last_step").prop("disabled","disabled");
    }
    $(document).ready(function(){
        $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: 1,
            maxVisible: 5
        }).on('page', function(event, num){
            var dataString = {
                key: '<?php echo $key?>',
                page: num
            };
            $.get(root + "loadmynetwork", dataString , function( data ) {
                $(".list_dealer" ).html( data ); 
            });
        });
    });
</script>