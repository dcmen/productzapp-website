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
<!--                    <tr>
                        <td>Engine number</td>
                        <td><?php // echo (isset($rs->engineno))? $rs->engineno : ''?></td>
                    </tr>-->
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
<!--                    <tr>
                        <td>Stock location code</td>
                        <td><?php // echo (isset($rs->stock_location_code))? $rs->stock_location_code : ''?></td>
                    </tr>-->
<!--                    <tr>
                        <td>Drive away amount</td>
                        <td><?php // echo (isset($rs->driveaway_amount))? $rs->driveaway_amount : ''?></td>
                    </tr>-->
<!--                    <tr>
                        <td>Is drive away</td>
                        <td><?php // echo (isset($rs->isdriveaway) && $rs->isdriveaway == 1)?'<i class="fa fa-check"></i>':''?></td>
                    </tr>-->
<!--                    <tr>
                        <td>Rego valid</td>
                        <td><?php // echo (isset($rs->regovalid))? $rs->regovalid : ''?></td>
                    </tr>-->
                    
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
<!--                    <tr>
                        <td>Inventory</td>
                        <td><?php // echo (isset($rs->inventory))? $rs->inventory : ''?></td>
                    </tr>-->
                </table>
                <div class="form-group text-center">
                    <a href="<?php echo $this->Html->Url('/edit_car/'.$id)?>" class="btn">Edit</a>
                    <a class="btn btn-view" href="<?php echo $this->Html->Url('/list_car')?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>