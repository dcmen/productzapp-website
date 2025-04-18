<?php foreach ($listcars as $car) : ?>
<?php $carName = $car->cars->manu_year . ' ' . $car->cars->make . ' ' . $car->cars->model . ' ' . $car->cars->series . ' ' . $car->cars->gearbox; ?>
<a href="<?php echo $this->Html->Url('/cardetails/'. $car->cars->_id.'/'.str_replace(' ', '-', $carName)) ?>" class="car-slider-item" title="<?php echo $carName ?>">
    <div class="car-slider-item-container">
        <div class="car-slider-img">
            <img class="img-cover" src="<?php echo ($car->cars->image_url)? $car->cars->image_url : $this->webroot . 'images/no_car.png' ?>" />
        </div>
        <div class="slider-car-name truncate">
            <span><?php echo $carName ?></span>
        </div>
    </div>
</a>
<?php endforeach; ?>