<div id="CarDetail" class="tab-pane fade in active">
    <div class="panel">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <td style="width: 200px;">Manufactory year</td>
                        <td><?php echo (isset($rs->manu_year))? $rs->manu_year : ''?></td>
                    </tr>
                    <tr>
                        <td>Make</td>
                        <td><?php echo (isset($rs->make))? $rs->make : ''?></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><?php echo (isset($rs->model))? $rs->model : ''?></td>
                    </tr>
                    <tr>
                        <td>Series</td>
                        <td><?php echo (isset($rs->series))? $rs->series : ''?></td>
                    </tr>
                    <tr>
                        <td>Badge</td>
                        <td><?php echo (isset($rs->badge))? $rs->badge : ''?></td>
                    </tr>
                    <tr>
                        <td>Body</td>
                        <td><?php echo (isset($rs->body))? $rs->body : ''?></td>
                    </tr>
                    <tr>
                        <td>Doors</td>
                        <td><?php echo (isset($rs->doors))? $rs->doors : ''?></td>
                    </tr>
                    <tr>
                        <td>Seats</td>
                        <td><?php echo (isset($rs->seats))? $rs->seats : ''?></td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td><?php echo (isset($rs->body_colour))? $rs->body_colour : ''?></td>
                    </tr>
                    <tr>
                        <td>Interior color</td>
                        <td><?php echo (isset($rs->interior_colour))? $rs->interior_colour : ''?></td>
                    </tr>
                    <tr>
                        <td>Gears</td>
                        <td><?php echo (isset($rs->gears))? $rs->gears : ''?></td>
                    </tr>
                    <tr>
                        <td>Transmission</td>
                        <td><?php echo (isset($rs->gearbox))? $rs->gearbox : ''?></td>
                    </tr>
                    <tr>
                        <td>Fuel type</td>
                        <td><?php echo (isset($rs->fueltype))? $rs->fueltype : ''?></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><?php echo (isset($rs->retail))? $rs->retail : ''?></td>
                    </tr>
                    <tr>
                        <td>Wholesale</td>
                        <td><?php echo (isset($rs->price))? $rs->price : ''?></td>
                    </tr>
                    <tr>
                        <td>Rego</td>
                        <td><?php echo (isset($rs->rego))? $rs->rego : ''?></td>
                    </tr>
                    <tr>
                        <td>Odometer</td>
                        <td><?php echo (isset($rs->odometer))? $rs->odometer : ''?></td>
                    </tr>
                    <tr>
                        <td>Cylinders</td>
                        <td><?php echo (isset($rs->cylinders))? $rs->cylinders : ''?></td>
                    </tr>
                    <tr>
                        <td>Capacity</td>
                        <td><?php echo (isset($rs->engine_capacity))? $rs->engine_capacity : ''?></td>
                    </tr>
                    <tr>
                        <td>Manufactory month</td>
                        <td><?php echo (isset($rs->manu_month))? $rs->manu_month : ''?></td>
                    </tr>
                    <tr>
                        <td>Options</td>
                        <td>
                            <div style="overflow-y: auto; max-height: 140px;">
                                <?php echo (isset($rs->options))? $rs->options : ''?>
                            </div>
                        </td>

                    </tr>
                    
                    <tr>
                        <td>Comments</td>
                        <td>
                            <div style="overflow-y: auto; max-height: 140px;">
                                <?php echo (isset($rs->comments))? $rs->comments : ''?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>NVIC</td>
                        <td><?php echo (isset($rs->nvic))? $rs->nvic : ''?></td>
                    </tr>
                    <tr>
                        <td>Red book code</td>
                        <td><?php echo (isset($rs->redbookcode))? $rs->redbookcode : ''?></td>
                    </tr>
                    <tr>
                        <td>EGC</td>
                        <td><?php echo (isset($rs->egc))? $rs->egc : ''?></td>
                    </tr>
                    
                    <tr>
                        <td>Engine type</td>
                        <td><?php echo (isset($rs->drive_type))? $rs->drive_type : ''?></td>
                    </tr>
                    <tr>
                        <td>Received date</td>
                        <td><?php echo (isset($rs->receiveddate))? date('Y-m-d',strtotime($rs->receiveddate)) : ''?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo (isset($rs->status))? $rs->status : ''?></td>
                    </tr>
                </table>
                <table class="table table-striped table-hover">
                    <?php if(isset($is_car_sold) && $is_car_sold == 1 ){ ?>
                    <tr>
                        <td colspan="2">BUYER INFORMATION</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo (isset($buyer_info->name))? $buyer_info->name : ''?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo (isset($buyer_info->email))? $buyer_info->email : ''?></td>
                    </tr>
                    <tr>
                        <td>Date sold</td>
                        <td><?php echo ($buyer_info->date_sold)? $buyer_info->date_sold : ''?></td>
                    </tr>
                    <tr>
                        <td>Price sold</td>
                        <td><?php echo (isset($buyer_info->price_sold))? $buyer_info->price_sold."$" : ''?></td>
                    </tr>
                    <tr>
                        <td>Company name</td>
                        <td><?php echo (isset($buyer_info->company_info->company_name))? $buyer_info->company_info->company_name : ''?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo (isset($buyer_info->company_info->address))? $buyer_info->company_info->address : ''?></td>
                    </tr>
                    <?php } elseif(isset($is_car_sold) && $is_car_sold == 0){?>
                        <tr>
                            <td>Last seen</td>
                            <td><?php echo (isset($latest_update))? $latest_update : ''?></td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="form-group text-center">
                    <a class="btn btn-view" href="<?php echo $this->Html->Url('/list_car_analysis')?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>