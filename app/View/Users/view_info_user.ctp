<style>
    .nav.nav-tabs {
        border: 0;
    }
</style>



<div class="tab-content">
    <div id="user" class="tab-pane fade in active">
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <td>Name</td>
                            <td><?php echo $rs->name?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $rs->email?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $rs->phone?></td>
                        </tr>
                        <tr>
                            <td>Dealership Name</td>
                            <td><?php echo $rs->company_info->company_name?></td>
                        </tr>
                        <tr>
                            <td>Dealership Phone</td>
                            <td><?php echo $rs->company_info->company_phone?></td>
                        </tr>
                        <tr>
                            <td>Dealer solution number</td>
                            <td><?php echo $rs->dealer_solution_number?></td>
                        </tr>
                        <tr>
                            <td>License number</td>
                            <td><?php echo $rs->company_info->license_number?></td>
                        </tr>
                        <tr class="hidden">
                            <td>Easy car number</td>
                            <td><?php echo $rs->easy_car_number?></td>
                        </tr>
                        <tr>
                            <td>Is principal</td>
                            <td><?php echo ($rs->is_principle == 1)?'<i class="fa fa-check"></i>':''?></td>
                        </tr>
                        <!--company info-->
                        <tr>
                            <td>Address</td>
                            <td><?php echo (isset($rs->company_info->street1) && $rs->company_info->street1)? $rs->company_info->street1 : ''?></td>
                        </tr>
                        <?php if (isset($rs->company_info->street2) && $rs->company_info->street2) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo (isset($rs->company_info->street2) && $rs->company_info->street2)? $rs->company_info->street2 : ''?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (isset($rs->company_info->street3) && $rs->company_info->street3) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo (isset($rs->company_info->street3) && $rs->company_info->street3)? $rs->company_info->street3 : ''?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Suburb</td>
                            <td><?php echo (isset($rs->company_info->suburb) && $rs->company_info->suburb)? $rs->company_info->suburb : ''?></td>
                        </tr>
                        <tr>
                            <td>Post Code</td>
                            <td><?php echo (isset($rs->company_info->post_Code) && $rs->company_info->post_Code)? $rs->company_info->post_Code : ''?></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td><?php echo (isset($rs->company_info->state) && $rs->company_info->state)? $rs->company_info->state : ''?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><?php echo (isset($rs->company_info->country) && $rs->company_info->country)? $rs->company_info->country : ''?></td>
                        </tr>
                        <tr>
                            <td>Credit Card</td>
                            <td><?php echo (isset($rs->credit_card_infor->credit_number) && $rs->credit_card_infor->credit_number)? 'xxxx-xxxx-xxxx-' . $rs->credit_card_infor->credit_number : '' ?></td>
                        </tr>
                        <tr>
                            <td>Active since</td>
                            <td><?php echo (isset($rs->company_info->active_since) && $rs->company_info->active_since)? $rs->company_info->active_since : 'inactive'?></td>
                        </tr>
                    </table>
                    <div class="form-group text-center">
                        <a href="<?php echo $this->Html->Url('/edit_info_user/'.$rs->_id)?>" class="btn">Edit</a>
                        <a class="btn btn-view" href="<?php echo $this->Html->Url('/all_user')?>">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="datafeed" class="tab-pane fade">
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr class="header-row">
                            <td class="header-content" colspan="2">Datafeed</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo (isset($rs->datafeed->name) && $rs->datafeed->name)? $rs->datafeed->name : ''; ?></td>
                        </tr>
                        <tr>
                            <td>Dealer ID</td>
                            <td><?php echo (isset($rs->datafeed->dealer_id) && $rs->datafeed->dealer_id)? $rs->datafeed->dealer_id : ''; ?></td>
                        </tr>
                        <tr>
                            <td>File Name</td>
                            <td><?php echo (isset($rs->datafeed->file_name) && $rs->datafeed->file_name)? $rs->datafeed->file_name : ''; ?></td>
                        </tr>
                        
                        <tr>
                            <td class="header-content" colspan="2">Ftp Detail</td>
                        </tr>
                        <tr>
                            <td>Server</td>
                            <td><?php echo (isset($rs->datafeed->server) && $rs->datafeed->server)? $rs->datafeed->server : ''; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?php echo (isset($rs->datafeed->username) && $rs->datafeed->username)? $rs->datafeed->username : ''; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo (isset($rs->datafeed->name) && $rs->datafeed->name)? $rs->datafeed->name : ''; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

