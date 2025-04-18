<div class="panel">
    <div class="panel-heading" style="overflow: hidden">
        <div class="col-xs-6"><h3 class="panel-title">Edit price sell app</h3></div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <?php echo $this->Form->create('OptionPaypal'); ?>
            <input type="hidden" name="id" value="<?php echo $rs['OptionPaypal']['id']?>">
            <table class="table table-striped table-hover">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $rs['OptionPaypal']['title']?>" style="width: 500px"></td>
                </tr>
                <tr>
                    <td>Number month</td>
                    <td><input type="text" name="number_month" value="<?php echo $rs['OptionPaypal']['number_month']?>"></td>
                </tr>
                <tr>
                    <td>Price($)</td>
                    <td><input type="text" name="price" value="<?php echo $rs['OptionPaypal']['price']?>"></td>
                </tr>
            </table>
            <?php echo $this->Form->end(__('Submit')); ?>
        </div>
    </div>
</div>

