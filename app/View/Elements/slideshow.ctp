<link rel="stylesheet" href="cars/jquery.bxslider.css" type="text/css" />
<script src="cars/jquery.bxslider.js"></script>
<script src="cars/rainbow.min.js"></script>

<div class="container">
    <div id="slide" class="col-xs-12 no-padding">
        <script type="text/javascript">
            $(document).ready(function () {
                $('.bxslider').bxSlider({
                    mode: 'fade',
                    captions: true,
                    interval: 3000,
                    auto: true,
                    height: 400
                });
            });
        </script>
        <div class="slider">
            <ul class="bxslider">
                <?php
                for ($j = 0; $j < sizeof($listcars); $j++) {
                $rs = $listcars[$j]->cars;
                $img = $listcars[$j]->image;
                $a = $rs->manu_year . ' ' . $rs->make . ' ' . $rs->model . ' ' . $rs->series . ' ' . $rs->gearbox;
                $b = (isset($img[1])) ? '<img class="img-responsive" height="183px" src="'.$img[1]->image_file_name.'">' : '<img class="img-responsive" height="183px" src="cars/car2.jpg">';
                $c = (isset($img[2])) ? '<img class="img-responsive" height="183px" src="'.$img[2]->image_file_name.'">' : '<img class="img-responsive" height="183px" src="cars/car2.jpg">';
                ?>
                <li id="slidehome">
                    <div class="col-lg-8 col-sm-8 col-xs-12 col-md-8 no-padding">
                        <div class="img_max">
                            <?php if(isset($img[0])){?>
                                <img class="img-responsive" height="355px" src="<?php echo $img[0]->image_file_name?>" title="<?php echo $a?>" img1='<?php echo $b?>' img2='<?php echo $c?>'>
                            <?php } else {?>
                                <img class="img-responsive" height="355px" src="cars/car1.jpg">
                            <?php } ?>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
                        <div class="col-xs-6 col-lg-12 col-sm-12 no-padding img_min img1"></div>
                        <div class="col-xs-6 col-lg-12 col-sm-12 no-padding img_min img2"></div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
