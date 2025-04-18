<?php
$result2 = $this->requestAction('cars/ResultDatasearch');
if($result2 != ''){
    $car_make = $result2[1];
?>
<div id="make" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 500px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Make</h4>
                </div>
                <div class="modal-body">
                    <div class="content-make">
                    <?php 
                    for($i=0;$i < sizeof($car_make);$i++){
                    ?>
                        <div class="line-form">
                            <input type="checkbox" name="make" class="c_make" value="<?php echo $car_make[$i]?>">
                            <?php echo $car_make[$i]?>
                        </div>
                    <?php }?>
                    </div>
                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view col-xs-12 col-lg-6 col-lg-offset-3 choosemake">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<script type="text/javascript">
Vcore.Flicka.Filter();
</script>