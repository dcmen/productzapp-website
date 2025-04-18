<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <form id="EditCarForm" action="<?php echo $this->Html->Url('/edit_car/'.$id)?>" method="post">
                <div class="form-group">
                    <div class="col-lg-4">Manufactory year</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="manu_year" value="<?php echo (isset($rs->manu_year))? $rs->manu_year : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Make</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="make" value="<?php echo (isset($rs->make))? $rs->make : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Model</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="model" value="<?php echo (isset($rs->model))? $rs->model : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Series</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="series" value="<?php echo (isset($rs->series))? trim($rs->series) : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Badge</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="badge" value="<?php echo (isset($rs->badge))? $rs->badge : ''?>"></div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-4">Body</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="body" value="<?php echo (isset($rs->body))? $rs->body : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Doors</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="doors" value="<?php echo (isset($rs->doors))? trim($rs->doors) : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Seats</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="seats" value="<?php echo (isset($rs->seats))? $rs->seats : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Color</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="body_colour" value="<?php echo (isset($rs->body_colour))? $rs->body_colour : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Interior color</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="trim_colour" value="<?php echo (isset($rs->trim_colour))? trim($rs->trim_colour) : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Gears</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="gears" value="<?php echo (isset($rs->gears))? $rs->gears : ''?>"></div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-4">Transmission</div>
                    <div class="col-md-8">
<!--                        <select class="form-control" name="gearbox">
                            <option value="">Choose transmission</option>
                            <option value="Manual" <?php // echo (isset($rs->gearbox) && $rs->gearbox == 'Manual')? 'selected' : '' ?> >Manual</option>
                            <option value="Automatic" <?php // echo (isset($rs->gearbox) && $rs->gearbox == 'Automatic')? 'selected' : '' ?> >Automatic</option>
                        </select>-->
                        <input type="text" class="form-control" name="gearbox" value="<?php echo (isset($rs->gearbox))? $rs->gearbox : ''?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Fuel type</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="fueltype" value="<?php echo (isset($rs->fueltype))? $rs->fueltype : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Price</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="retail" value="<?php echo (isset($rs->retail))? $rs->retail : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Wholesale</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="price" value="<?php echo (isset($rs->price))? $rs->price : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Rego</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="rego" value="<?php echo (isset($rs->rego))? $rs->rego : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Odometer</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="odometer" value="<?php echo (isset($rs->odometer))? $rs->odometer : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Cylinders</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="cylinders" value="<?php echo (isset($rs->cylinders))? $rs->cylinders : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Capacity</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="engine_capacity" value="<?php echo (isset($rs->engine_capacity))? $rs->engine_capacity : ''?>"></div>
                </div>
<!--                <div class="form-group">
                    <div class="col-md-4">Engine number</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="engineno" value="<?php // echo (isset($rs->engineno))? $rs->engineno : ''?>"></div>
                </div>-->
                <div class="form-group">
                    <div class="col-md-4">Manufactory month</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="manu_month" value="<?php echo (isset($rs->manu_month))? $rs->manu_month : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Options</div>
                    <div class="col-md-8">
                        <textarea class="form-control" name="options" rows="4" cols="50"><?php echo (isset($rs->options))? $rs->options : ''?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Comments</div>
                    <div class="col-md-8">
                        <textarea class="form-control" name="comments" rows="4" cols="50"><?php echo (isset($rs->comments))? $rs->comments : ''?> </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">NVIC</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="nvic" value="<?php echo (isset($rs->nvic))? trim($rs->nvic) : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Red book code</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="redbookcode" value="<?php echo (isset($rs->redbookcode))? $rs->redbookcode : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">EGC</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="egc" value="<?php echo (isset($rs->egc))? $rs->egc : ''?>"></div>
                </div>
<!--                <div class="form-group">
                    <div class="col-md-4">Stock location code</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="stock_location_code" value="<?php // echo (isset($rs->stock_location_code))? $rs->stock_location_code : ''?>"></div>
                </div>-->
<!--                <div class="form-group">
                    <div class="col-md-4">Drive away amount</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="driveaway_amount" value="<?php // echo (isset($rs->driveaway_amount))? $rs->driveaway_amount : ''?>"></div>
                </div>-->
<!--                <div class="form-group">
                    <div class="col-md-4">Is drive away</div>
                    <div class="col-md-8"><input style="width: auto;" type="checkbox" class="form-control" name="isdriveaway" value="1" <?php // echo (isset($rs->isdriveaway))? 'checked' : ''?> ></div>
                </div>-->
<!--                <div class="form-group">
                    <div class="col-md-4">Rego valid</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="regovalid" value="<?php // echo (isset($rs->regovalid))? $rs->regovalid : ''?>"></div>
                </div>-->
                <div class="form-group">
                    <div class="col-md-4">Engine type</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="drive_type" value="<?php echo (isset($rs->drive_type))? $rs->drive_type : ''?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Received date</div>
                    <div class="col-md-8">
                        <input id="ReceivedDate" type="text" class="form-control" name="receiveddate" value="<?php echo (isset($rs->receiveddate))? date('Y-m-d',strtotime($rs->receiveddate)) : ''?>" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">Status</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="status" value="<?php echo (isset($rs->status))? $rs->status : ''?>"></div>
                </div>
<!--                <div class="form-group">
                    <div class="col-md-4">Inventory</div>
                    <div class="col-md-8"><input type="text" class="form-control" name="inventory" value="<?php // echo (isset($rs->inventory))? $rs->inventory : ''?>"></div>
                </div>-->
                
                <div class="form-group text-center">
                    <button type="submit" class="btn">Update</button>
                    <a class="btn btn-view" href="<?php echo $this->Html->Url('/list_car')?>">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#ReceivedDate').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            enableOnReadonly: true
        });

        $('#EditCarForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
//                manu_year: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
                make: {
                    validators: {
                        notEmpty: {
                            message: 'This field is required and can\'t be empty'
                        }
                    }
                },
                model: {
                    validators: {
                        notEmpty: {
                            message: 'This field is required and can\'t be empty'
                        }
                    }
                },
//                series: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                badge: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                body: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
                doors: {
                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        },
                        integer: {
                            message: 'Wrong data format'
                        }
                    }
                },
                seats: {
                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        },
                        integer: {
                            message: 'Wrong data format'
                        }
                    }
                },
//                body_colour: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                trim_colour: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                gears: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                gearbox: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                fueltype: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
                retail: {
                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        },
                        integer: {
                            message: 'Wrong data format'
                        }
                    }
                },
                price: {
                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        },
                        integer: {
                            message: 'Wrong data format'
                        }
                    }
                },
//                rego: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                odometer: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                cylinders: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                engine_capacity: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                engineno: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                manu_month: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                nvic: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                redbookcode: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                egc: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                drive_type: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                receiveddate: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                status: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                },
//                inventory: {
//                    validators: {
//                        notEmpty: {
//                            message: 'This field is required and can\'t be empty'
//                        }
//                    }
//                }
            }
        });
    });
</script>