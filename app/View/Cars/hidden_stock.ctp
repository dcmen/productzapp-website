<div class="main-page">
    <?php echo $this->element('cz_menu_bar_stock_hidden'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-04">
        <div id="listCars">
            <div class="mg-bottom-40"></div>
            
            <?php if ($list) : ?>
                <?php echo $this->element('cz_cars_list', array('list' => $list, 'view_type' => 1, 'is_hide' => 1)); ?>
            <?php else : ?>
                <div class="mg-top-50 text-center font-size-24"><span>No car to display</span></div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="mg-bottom-50"></div>
    
    <?php if ($maxpages > 1) :  ?>
    <div class="cz-pagination"></div>
    <?php endif; ?>
</div>
<script>
    curPage = <?php echo $page?>;
    maxPage = <?php echo $maxpages?>;
    totalCars = <?php echo $total ?>;
    
    $(document).ready(function () {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'hidden_stock', container = '#listCars');
        
        $(document).on('click', '.btn-unhide-car', function () {
            carId = $(this).attr('data-car-id');
            item = $(this);
            jConfirm('Are you sure want to show this car?','Message',function(r) {
                if(r){
                    load_show();
                    $.post(root + 'cars/setDisplayCar',{car_id:carId, type:1},function(data){
                        if(data.error == 0){
                            // update number car
                            countCar = parseInt($('.count-car').text());
                            if (countCar > 0) {
                                $('.count-car').text(--countCar);
                            }
                            // remove car
                            $('#'+carId).fadeOut('slow', function() {
                                $(this).remove();
                                
                                if (countCar == 0) {
                                    $('#listCars').html();
                                    $('#listCars').append('<div class="mg-top-50 text-center font-size-24"><span>No car to display</span></div>');
                                    load_hide();
                                    return false;
                                }

                                // show message and refresh page
                                showMessage('Successfully', 0, function () {
                                    if (countCar > 0 && $('.wg-car-list').length === 0) {
                                        curPage = (curPage < maxPage)? curPage : --curPage;
                                        curPage = (curPage < 1)? 1 : curPage;
                                        maxPage--;

                                        loadHTMLAjax('hidden_stock', $.extend(parasOnLink, {page:curPage, ajax:1}), container = '#listCars');
                                    }
                                });
                                
                                load_hide();
                            });
                        } else {
                            showMessage(data.msg, 1);
                            load_hide();
                        }
                    },'json');
                }
            });
        });
    });
</script>