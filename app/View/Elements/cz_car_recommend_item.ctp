
<div class="special_item">
    <div class="col-md-6 special_image no-padding" style="border-right: 0px none;">
        <a class="btn-img-car" style="outline: medium none;" hidefocus="true" href="javascript:;">
            <img class="img-cover" src="<?php echo ($car->cars->image_url)? $car->cars->image_url : $this->webroot . 'images/no_car.png' ?>" onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';" />
        </a>
        <?php if (trim($car->cars->video_url)) : ?>
        <a class="wg-car-btnvideo " data-video-url="<?php echo $car->cars->video_url ?>"><span class="fa fa-film"></span>VIDEO</a>
        <?php endif; ?>
    </div>
    <div class="col-md-6 special_text">
        <?php $carName = $car->cars->manu_year . ' ' . $car->cars->make . ' ' . $car->cars->model . ' ' . $car->cars->series . ' ' . $car->cars->gearbox;?>
        <h3><a style="color: #4cbcf6;" class="color-site-hover truncate" hidefocus="true" href="<?php echo $this->Html->Url('/cardetails/'. $car->cars->_id.'/'.str_replace(' ', '-', $carName)); ?>" title="<?php echo $carName ?>"><?php echo $carName ?></a></h3>
        <div class="info_row truncate"><span>MAKE:</span> <?php echo $car->cars->make ?></div>
        <div class="info_row truncate"><span>COLOR:</span> <?php echo $car->cars->body_colour ?></div>
        <div class="info_row truncate"><span>MILEAGE:</span> <?php echo $car->cars->odometer ?></div>
        <div class="special_price">
            <?php 
            $price = number_format($car->cars->price,0,',',',');
            if($price != '0') {
                echo '$' . $price;
            }
            else {
                echo 'Send Offer';
            }
            ?>
        </div>
    </div>
</div>