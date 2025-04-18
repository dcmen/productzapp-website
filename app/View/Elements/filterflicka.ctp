<?php
$result2 = $this->requestAction('cars/ResultDatasearch');
if($result2 != ''){
    $message = $result2[0];
    for($i=0;$i < sizeof($message);$i++){
        if($message[$i]->field_name == 'make'){
            $car_make = $message[$i]->values;
        }
        if($message[$i]->field_name == 'gearbox'){
            $gearbox = $message[$i]->values;
        }
        if($message[$i]->field_name == 'body_colour'){
            $body_colour = $message[$i]->values;
        }
        if($message[$i]->field_name == 'body'){
            $body = $message[$i]->values;
        }
        if($message[$i]->field_name == 'fuel_type'){
            $fuel_type = $message[$i]->values;
        }
        if($message[$i]->field_name == 'seats'){
            $seats = $message[$i]->values;
        }
        if($message[$i]->field_name == 'location'){
            $location = $message[$i]->values;
        }
        if($message[$i]->field_name == 'series'){
            $series = $message[$i]->values;
        }
    }

}
?>
<div class="hidden-md hidden-sm hidden-lg">
    <div id="search_xs">
        <div class="line_bt">
            <a class="c_grid_flicka pull-right" href="javascript:;"><i class="fa fa-th-large"></i></a>
            <a class="c_list_flicka pull-right" href="javascript:;"><i class="fa fa-list"></i></a>
            <a class="pull-right" href="javascript:;" data-toggle="modal" data-target="#searchfilter" rel="searchbox">
                <i class="fa fa-filter"></i>
            </a>
        </div>
        <div id="searchfilter" class="modal fade" role="dialog">
            <div class="modal-body">
                <div class="modal-dialog vdialog_filter" style="max-width: 500px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Filter</h4>
                        </div>
                        <div class="modal-body">
                            <div class="<?php echo ($type != '')?'col-xs-12':'col-xs-6'?> form-group">
                                <button class="btn btn-primary btn-filter dropdown-toggle col-xs-12" data-toggle="dropdown">
                                    Filter by: <span class="c_select"><?php echo $type?></span>
                                   <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                </button>
                                <ul class="dropdown-menu selectfilter">
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#make" rel="Make">Make</a></li>
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#price_range" rel="Price Range">Price Range</a></li>
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#year_range" rel="Year Range">Year Range</a></li>
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#body_type" rel="Body type">Body type</a></li>
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#km_range" rel="KM range">KM range</a></li>
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#fuel_type" rel="Fuel type">Fuel type</a></li>
                                </ul>
                            </div>
                            <div class="<?php echo ($sort != 0)?'col-xs-12':'col-xs-6'?>">
                                <button class="btn btn-primary btn-filter dropdown-toggle col-xs-12" data-toggle="dropdown">
                                    Sort by:
                                    <?php 
                                    if($sort==0){
                                        echo 'Random';
                                    }else if($sort==1){
                                        echo 'Low price first';
                                    }else if($sort==2){
                                        echo 'High price first';
                                    }else if($sort==3){
                                        echo 'Oldest stock first';
                                    }else if($sort==4){
                                        echo 'New stock first';
                                    }
                                    ?>
                                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                </button>
                                <ul onchange="window.open(this.options[this.selectedIndex].value,'_self');" class="dropdown-menu">
                                    <?php 
                                    $url = $this->request->here();
                                    $posSort = strrpos($url, '&sort=');
                                    if ($posSort > 0) {
                                        $url = substr($url, 0, $posSort);
                                    }
                                    if (strrpos($url, '?') == FALSE) {
                                        $url .= '?a=1';
                                    }
                                    ?>
                                    <?php for($i=1;$i<=4;$i++){?>
                                    <li>
                                        <a href="<?php echo $url.'&sort='.$i; ?>">
                                            <?php 
                                            if($i==0){
                                                echo 'Random';
                                            }else if($i==1){
                                                echo 'Low price first';
                                            }else if($i==2){
                                                echo 'High price first';
                                            }else if($i==3){
                                                echo 'Oldest stock first';
                                            }else if($i==4){
                                                echo 'New stock first';
                                            }
                                            ?>
                                        </a>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="pull-right hidden-xs">
    <div class="btn-group">
        <button class="btn btn-primary btn-filter dropdown-toggle" data-toggle="dropdown">
            Filter by: <span class="c_select"><?php echo $type?></span>
           <i class="ace-icon fa fa-angle-down icon-on-right"></i>
        </button>
        <ul class="dropdown-menu selectfilter">
            <li><a href="javascript:;" data-toggle="modal" data-target="#make" rel="Make">Make</a></li>
            <li><a href="javascript:;" data-toggle="modal" data-target="#price_range" rel="Price Range">Price Range</a></li>
            <li><a href="javascript:;" data-toggle="modal" data-target="#year_range" rel="Year Range">Year Range</a></li>
            <li><a href="javascript:;" data-toggle="modal" data-target="#body_type" rel="Body type">Body type</a></li>
            <li><a href="javascript:;" data-toggle="modal" data-target="#km_range" rel="KM range">KM range</a></li>
            <li><a href="javascript:;" data-toggle="modal" data-target="#fuel_type" rel="Fuel type">Fuel type</a></li>
        </ul>
    </div>
    <div class="btn-group">
        <button class="btn btn-primary btn-filter dropdown-toggle" data-toggle="dropdown">
            Sort by:
            <?php 
            if($sort==0){
                echo 'Random';
            }else if($sort==1){
                echo 'Low price first';
            }else if($sort==2){
                echo 'High price first';
            }else if($sort==3){
                echo 'Oldest stock first';
            }else if($sort==4){
                echo 'New stock first';
            }
            ?>
            <i class="ace-icon fa fa-angle-down icon-on-right"></i>
        </button>
        <ul onchange="window.open(this.options[this.selectedIndex].value,'_self');" class="dropdown-menu">
            <?php 
            $url = $this->request->here();
            $posSort = strrpos($url, '&sort=');
            if ($posSort > 0) {
                $url = substr($url, 0, $posSort);
            }
            if (strrpos($url, '?') == FALSE) {
                $url .= '?a=1';
            }
            ?>
            <?php for($i=0;$i<=4;$i++){?>
            <li>
                <a href="<?php echo $url.'&sort='.$i; ?>">
                    <?php 
                    if($i==0){
                        echo 'Random';
                    }else if($i==1){
                        echo 'Low price first';
                    }else if($i==2){
                        echo 'High price first';
                    }else if($i==3){
                        echo 'Oldest stock first';
                    }else if($i==4){
                        echo 'New stock first';
                    }
                    ?>
                </a>
            </li>
            <?php }?>
        </ul>
    </div>
    <div class="btn-group">
        <div id="search_xs">
            <a class="c_grid_flicka pull-right" href="javascript:;"><i class="fa fa-th-large"></i> </a>
            <a class="c_list_flicka pull-right" href="javascript:;"><i class="fa fa-list"></i></a>
        </div>
    </div>
</div>

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
                        <?php foreach ($car_make as $data) : ?>
                            <?php if (trim($data) != '') :?>
                                <div class="line-form">
                                    <input type="checkbox" name="make" class="c_make" value="<?php echo $data ?>">
                                    <?php echo $data ?>
                                </div>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view col-xs-12 col-lg-6 col-lg-offset-3 choosemake">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="price_range" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 400px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Price range</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="price" id="price" readonly="readonly" value="0" />
                    <input type="hidden" name="price2" id="price" readonly="readonly" value="1000000"/>
                    <div class="form-group line-form">
                        <div class="col-lg-12">
                            <div class="space-2"></div>
                            <div class="help-block" id="input-span-price"></div>
                            <div class="col-lg-6" style="text-align: left;padding: 0;">
                                $0
                            </div>
                            <div class="col-lg-6" style="text-align: right;color: #fe6309; font-weight: 600;padding: 0">
                                $ 1.000.000
                            </div>
                        </div>
                    </div>

                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view col-xs-12 col-lg-6 col-lg-offset-3 chooseprice">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="year_range" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 400px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Year range</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 no-padding">
                        <div class="col-xs-6 no-padding">
                            <label>From year</label>
                            <select name="year_from" class="form-control">
                                <?php $curYear = (int) date("Y"); ?>
                                <?php for($i=1980;$i<=$curYear;$i++){?>
                                <option <?php echo ($i == $curYear)? 'selected="selected"' : '' ?> value="<?php echo $i?>"><?php echo $i?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-xs-6 no-padding">
                            <label>To year</label>
                            <select name="year_to" class="form-control">
                                <?php $curYear = (int) date("Y"); ?>
                                <?php for($i=1980;$i<=$curYear;$i++){?>
                                <option <?php echo ($i == $curYear)? 'selected="selected"' : '' ?> value="<?php echo $i?>"><?php echo $i?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view col-xs-12 col-lg-6 col-lg-offset-3 chooseyear">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="body_type" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 500px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter by body type</h4>
                </div>
                <div class="modal-body">
                    <div class="content-make">
                        <?php foreach ($body as $data) : ?>
                            <?php if (trim($data) != '') :?>
                                <div class="line-form">
                                    <input type="checkbox" name="body" class="c_body" value="<?php echo $data ?>">
                                    <?php echo $data ?>
                                </div>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view col-xs-12 col-lg-6 col-lg-offset-3 choosebody">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="km_range" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 450px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter by Km range</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="km" id="km" readonly="readonly" value="0" />
                    <input type="hidden" name="km2" id="km2" readonly="readonly" value="1000000" />
                    <div class="form-group line-form">
                        <div class="col-lg-12">
                            <div class="space-2"></div>
                            <div class="help-block" id="input-span-km"></div>
                            <div class="col-lg-6" style="text-align: left;padding: 0;">
                                0 Km
                            </div>
                            <div class="col-lg-6" style="text-align: right;color: #fe6309; font-weight: 600;padding: 0">
                                1.000.000 Km
                            </div>
                        </div>
                    </div>

                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view col-xs-12 col-lg-6 col-lg-offset-3 choosekm">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="fuel_type" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog_filter" style="max-width: 500px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter by Fuel type</h4>
                </div>
                <div class="modal-body">
                    <div class="content-make">
                        <?php foreach ($fuel_type as $data) : ?>
                            <?php if (trim($data) != '') :?>
                                <div class="line-form">
                                    <input type="checkbox" name="fuel_type" class="c_fuel" value="<?php echo $data ?>">
                                    <?php echo $data ?>
                                </div>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group line-form">
                        <button type="button" class="btn btn-view col-xs-12 col-lg-6 col-lg-offset-3 choosefuel">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
Vcore.Flicka.Filter();
$(document).ready(function() {
    $($('#input-span-price .ui-slider-handle .tooltip-arrow').get(1)).addClass('second-holder');
    $($('#input-span-price .ui-slider-handle .tooltip').get(1)).css({
        'left': '-4px',
        'top': '16px'
    });
});
</script>