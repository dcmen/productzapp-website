<style>
    .seleted-datafeed {
        margin: 0;
    }
    .seleted-datafeed > li {
        line-height: 25px;
    }
</style>
<div id="dealership" class="tab-pane fade in active">
    <div class="panel">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <td>Name</td>
                        <td><?php echo $rs->name ?></td>
                    </tr>
                    <tr>
                        <td>License Number</td>
                        <td><?php echo isset($rs->license_number)? $rs->license_number : '' ?></td>
                    </tr>
                    <tr>
                        <td>Selected Datafeeds</td>
                        <td>
                            <?php if (isset($rs->datafeed) && $rs->datafeed && sizeof($rs->datafeed) > 0) : ?>
                            <ul class="seleted-datafeed">
                                <?php foreach ($rs->datafeed as $datafeed) : ?>
                                <li><?php echo $datafeed->name ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <!--address info-->
                    <tr>
                        <td>Address</td>
                        <td><?php echo isset($rs->address)? $rs->address : '' ?></td>
                    </tr>
                    <?php if (isset($rs->address2) && $rs->address2) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo (isset($rs->address2) && $rs->address2) ? $rs->address2 : '' ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if (isset($rs->address3) && $rs->address3) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo (isset($rs->address3) && $rs->address3) ? $rs->address3 : '' ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Suburb</td>
                        <td><?php echo (isset($rs->suburb) && $rs->suburb) ? $rs->suburb : '' ?></td>
                    </tr>
                    <tr>
                        <td>Post Code</td>
                        <td><?php echo (isset($rs->postcode) && $rs->postcode) ? $rs->postcode : '' ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo (isset($rs->state) && $rs->state) ? $rs->state : '' ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?php echo (isset($rs->country) && $rs->country) ? $rs->country : '' ?></td>
                    </tr>
                    <!--other info-->
                    <tr>
                        <td>Email</td>
                        <td><?php echo isset($rs->email)? $rs->email : '' ?></td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td><?php echo isset($rs->website)? $rs->website : '' ?></td>
                    </tr>
                    <tr>
                        <td>Fax</td>
                        <td><?php echo isset($rs->fax)? $rs->fax : '' ?></td>
                    </tr>
                    <tr>
                        <td>ABN</td>
                        <td><?php echo isset($rs->abn)? $rs->abn : '' ?></td>
                    </tr>
                    <tr>
                        <td>ACN</td>
                        <td><?php echo isset($rs->acn)? $rs->acn : '' ?></td>
                    </tr>
                    <tr>
                        <td>DUN</td>
                        <td><?php echo isset($rs->dun)? $rs->dun : '' ?></td>
                    </tr>
                    <tr>
                        <td>Active since</td>
                        <td><?php echo (isset($rs->active_since) && $rs->active_since) ? $rs->active_since : 'inactive' ?></td>
                    </tr>
                </table>
                <div class="form-group text-center">
                    <a href="<?php echo $this->Html->Url('/admin_company_edit?id=' . $rs->_id) ?>" class="btn">Edit</a>
                    <a class="btn btn-view" href="<?php echo $this->Html->Url('/admin_company') ?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>