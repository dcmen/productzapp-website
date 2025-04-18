<?php 
$data = json_decode($dataSet4Get->search_params);
// name search
$carName = '';
if (isset($data->make)) {
    $carName .= $data->make . ' ';
}
if (isset($data->model)) {
    $carName .= $data->model . ' ';
}
if (isset($data->series)) {
    $carName .= $data->series . ' ';
}
if (isset($data->gearbox)) {
    $carName .= $data->gearbox . ' ';
}
$carName = trim($carName);
// odometer search
$odometer = '';

if (isset($data->odometer_from) && isset($data->odometer_to)) {
    $odometer = number_format(str_replace(",","", $data->odometer_from)) . '-' . number_format(str_replace(",","", $data->odometer_to)) . ' kms';
}
else {
    if (isset($data->odometer_from)) {
        $odometer = '>' . number_format(str_replace(",","", $data->odometer_from)) . ' kms';
    }
    if (isset($data->odometer_to)) {
        $odometer = '<' . number_format(str_replace(",","", $data->odometer_to)) . ' kms';
    }
}
// year search
$year = '';
if (isset($data->manu_year_from)) {
    $year .= $data->manu_year_from;
}
if (isset($data->manu_year_to)) {
    $year .= '-' . $data->manu_year_to;
}
$year = trim($year, '-');
//price search
$price = '';
if (isset($data->price_from) && isset($data->price_to)) {
    $price = number_format(str_replace("$","", str_replace(",","", $data->price_from))) . '-' . number_format(str_replace("$","", str_replace(",","", $data->price_to)));
}
else {
    if (isset($data->price_from)) {
        $price = '>' . number_format(str_replace("$","", str_replace(",","", $data->price_from)));
    }
    if (isset($data->price_to)) {
        $price = '<' . number_format(str_replace("$","", str_replace(",","", $data->price_to)));
    }
}
?>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 row_set mg-bottom-25" data-car="<?php echo $carName ?>">
    <div class="wg-box-shadow">
        <div class="setforget-item-container">
            <!--left content-->
            <div class="col-lg-1 col-md-1 setforget-item-left no-padding">
                <div class="btn-s4g-left">
                    <a href="javascript:;">
                        <i class="fa fa-envelope"></i>
                    </a>
                </div>
                <div class="btn-s4g-left">
                    <a href="<?php echo $this->Html->Url('/set_forget_id/'.$dataSet4Get->_id)?>">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>
            <!--right content-->
            <div class="col-lg-11 col-md-11 setforget-item-right height-full no-padding">
                <div class="content-s4g-right height-full">
                    <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 height-full">
                        <div class="content-s4g kb-container-middle">
                            <span class="kb-item-middle detail-s4g car-name" title="<?php echo ($carName != '') ? $carName : 'Not set' ?>"><i class="fa fa-car pos-abs"></i><span class="truncate"><?php echo ($carName != '') ? $carName : 'Not set' ?></span></span>
                        </div>
                        <div class="content-s4g kb-container-middle">
                            <span class="kb-item-middle detail-s4g"><i class="fa fa-tachometer pos-abs"></i><?php echo ($odometer != '') ? $odometer : 'Not set' ?></span>
                        </div>
                        <div class="content-s4g kb-container-middle">
                            <span class="kb-item-middle detail-s4g"><i class="fa fa-square pos-abs"></i><?php echo (isset($data->body_colour)) ? $data->body_colour : 'Not set' ?></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 height-full">
                        <div class="content-s4g kb-container-middle">
                            <span class="kb-item-middle detail-s4g"><i class="fa fa-clock-o pos-abs"></i><?php echo (isset($dataSet4Get->updated_at) && $dataSet4Get->updated_at) ? date("d/m/Y", strtotime($dataSet4Get->updated_at)) : 'Not set' ?></span>
                        </div>
                        <div class="content-s4g kb-container-middle">
                            <span class="kb-item-middle detail-s4g"><i class="fa fa-calendar pos-abs"></i></i><?php echo ($year) ? $year : 'Not set' ?></span>
                        </div>
                        <div class="content-s4g kb-container-middle">
                            <span class="kb-item-middle detail-s4g"><span class="pos-abs">A<i class="fa fa-usd"></i></span><?php echo ($price) ? $price : 'Not set' ?></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>