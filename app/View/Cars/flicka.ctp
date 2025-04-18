<style>
    .car-detail-01 {
        display: none;
    }
    .car-detail-01.active {
        display: block;
    }
</style>
<div class="main-page">
    <?php echo $this->element('cz_filterflicka'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-04">
        <div id="listCars">
            <?php if ($list) : ?>
                <?php foreach($list as $data) {
                    echo $this->element('cz_car_item_list', array('data' => $data, 'hide_btn_follow' => true)); 
                } ?>
            <?php else : ?>
                <div class="mg-top-50 text-center font-size-24"><span>No car to display</span></div>
            <?php endif; ?>
        </div>
        <div class="clearfix mg-bottom-20"></div>
        <?php if ($list) : ?>
            <div class="group-btn-flicka text-center">
                <div class="dis-inlblock">
                    <div class="dis-inlblock width-120 width-110-max-360 text-center noselect">
                        <button class="btn-back kb-btn-03 width-108 width-100-max-360 color-bg-site pull-left noselect" style="padding-left: 30px;position: relative;font-size: 16px;height: 38px;"><span class="fa fa-angle-left" style="position: absolute;left: 5px;margin: 0;top: 5px;"></span> BACK </button>
                    </div>
                    <div class="dis-inlblock width-100 width-70-max-360 width-50-max-320 text-center noselect">
                        <a class="btn-follow-car clickfollow color-bg-site color-bg-site-hover" car_id="<?php echo isset($list->cars->_id) ? $list->cars->_id : ''; ?>">
                            <i class="fa fa-star" style="position: absolute;left: 0;right: 0;"></i>
                        </a>
                    </div>
                    <div class="dis-inlblock width-120 width-110-max-360 text-center noselect">
                        <button class="btn-next kb-btn-02 width-108 width-100-max-360 color-bg-site pull-right noselect" style="padding-right: 30px;position: relative;font-size: 16px;height: 38px;"> NEXT <span class="fa fa-angle-right" style="position: absolute;right: 5px;margin: 0;top: 5px;"></span></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    var type = <?php echo $type ?>;// 0 - No filter; 1 - Has filter
    var limit = <?php echo $limit ?>;
    var page = <?php echo $page ?>;
    
    var btnFollowCar = $('.btn-follow-car');
    
    Vcore.Flicka.Follow();
    Vcore.Flicka.Filter();
    
    if (type === 0) {
        curItem = $('.car-detail-01').eq(limit/2);
        curItem.addClass('active');
        
        btnFollowCar.attr('car_id', curItem.data('car-id'));
        if (curItem.hasClass('dis_follow')) {
            btnFollowCar.find('.fa-star').addClass('star-yellow');
            btnFollowCar.attr('title', 'Unfollow this car');
        }
        else {
            btnFollowCar.find('.fa-star').removeClass('star-yellow');
            btnFollowCar.attr('title', 'Follow this car');
        }
    }
    else {
        curItem = $('.car-detail-01').eq(0).addClass('active');
        curItem.addClass('active');
        
        btnFollowCar.attr('car_id', curItem.data('car-id'));
        if (curItem.hasClass('dis_follow')) {
            btnFollowCar.find('.fa-star').addClass('star-yellow');
            btnFollowCar.attr('title', 'Unfollow this car');
        }
        else {
            btnFollowCar.find('.fa-star').removeClass('star-yellow');
            btnFollowCar.attr('title', 'Follow this car');
        }
        
        $('.btn-back').hide();
    }
    
    function viewCar(move, element) {
        // get current car
        curCar = $('.car-detail-01.active');
        // get current index
        curIndex = curCar.index();
        // get next index
        nextIndex = curIndex + move;
    }
    
    $(document).ready(function () {
        $('.btn-next').click(function () {
            $('.btn-back').show();
            
            curItem = $('.car-detail-01.active');
            nextItem = curItem.next('.car-detail-01');
            if (nextItem.length) {
                btnFollowCar.attr('car_id', nextItem.data('car-id'));
                if (nextItem.hasClass('dis_follow')) {
                    btnFollowCar.removeClass('follow');
                    btnFollowCar.addClass('dis_follow');
                    btnFollowCar.find('.fa-star').addClass('star-yellow');
                    btnFollowCar.attr('title', 'Unfollow this car');
                }
                else {
                    btnFollowCar.removeClass('dis_follow');
                    btnFollowCar.addClass('follow');
                    btnFollowCar.find('.fa-star').removeClass('star-yellow');
                    btnFollowCar.attr('title', 'Follow this car');
                }

                curItem.removeClass('active');
                nextItem.addClass('active');
                if (nextItem.hasClass('end')) {
                    $(this).hide();
                }
            }
            else {
                parasOnLink.ajax = 1;
                parasOnLink.page = ++page;
                load_show();
                $.get("flicka", parasOnLink , function(data) {
                    if (data) {
                        $('#listCars').append(data);

                        curItem.removeClass('active');
                        nextItem = curItem.next('.car-detail-01');
                        nextItem.addClass('active');
                        
                        btnFollowCar.attr('car_id', nextItem.data('car-id'));
                        if (nextItem.hasClass('dis_follow')) {
                            btnFollowCar.removeClass('follow');
                            btnFollowCar.addClass('dis_follow');
                            btnFollowCar.find('.fa-star').addClass('star-yellow');
                            btnFollowCar.attr('title', 'Unfollow this car');
                        }
                        else {
                            btnFollowCar.removeClass('dis_follow');
                            btnFollowCar.addClass('follow');
                            btnFollowCar.find('.fa-star').removeClass('star-yellow');
                            btnFollowCar.attr('title', 'Follow this car');
                        }
                    }
                    else {
                        $('.btn-next').hide();
                        curItem.addClass('end');
                    }
                    load_hide();
                });
            }
        });
        
        $('.btn-back').click(function () {
            $('.btn-next').show();
            curItem = $('.car-detail-01.active');
            
            prevItem = curItem.prev('.car-detail-01');
            if (type === 1 && (curItem.index() - 1) === 0) {
                $(this).hide();
            }
            if (prevItem.length) {
                btnFollowCar.attr('car_id', prevItem.data('car-id'));
                if (prevItem.hasClass('dis_follow')) {
                    btnFollowCar.removeClass('follow');
                    btnFollowCar.addClass('dis_follow');
                    btnFollowCar.find('.fa-star').addClass('star-yellow');
                    btnFollowCar.attr('title', 'Unfollow this car');
                }
                else {
                    btnFollowCar.removeClass('dis_follow');
                    btnFollowCar.addClass('follow');
                    btnFollowCar.find('.fa-star').removeClass('star-yellow');
                    btnFollowCar.attr('title', 'Follow this car');
                }
                
                curItem.removeClass('active');
                prevItem.addClass('active');
            }
            else {
                parasOnLink.ajax = 1;
                load_show();
                $.get("flicka", parasOnLink , function(data) {
                    $('#listCars').prepend(data);

                    curItem.removeClass('active');
                    prevItem = curItem.prev('.car-detail-01');
                    prevItem.addClass('active');
                    
                    btnFollowCar.attr('car_id', prevItem.data('car-id'));
                    if (prevItem.hasClass('dis_follow')) {
                        btnFollowCar.removeClass('follow');
                        btnFollowCar.addClass('dis_follow');
                        btnFollowCar.find('.fa-star').addClass('star-yellow');
                        btnFollowCar.attr('title', 'Unfollow this car');
                    }
                    else {
                        btnFollowCar.removeClass('dis_follow');
                        btnFollowCar.addClass('follow');
                        btnFollowCar.find('.fa-star').removeClass('star-yellow');
                        btnFollowCar.attr('title', 'Follow this car');
                    }
                    load_hide();
                });
            }
        });
    });
</script>