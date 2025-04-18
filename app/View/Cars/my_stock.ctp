<div class="main-page">
    <?php echo $this->element('cz_menu_bar_stock', ['my_stock' => 1]); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-04">
        <div id="listCars">
            <div class="mg-bottom-40"></div>
            
            <?php if ($list) : ?>
                <?php echo $this->element('cz_cars_list', array('list' => $list, 'view_type' => 1)); ?>
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
        initPagination(maxPage, curPage, maxVisible = 5, url = 'my_stock', container = '#listCars');
        
        $(document).on('click', '.btn-hide-car', function () {
            carId = $(this).attr('data-car-id');
            item = $(this);
            jConfirm('Are you sure want to hide this car?','Message',function(r) {
                if(r){
                    load_show();
                    $.post(root + 'cars/setDisplayCar',{car_id:carId, type:2},function(data){
                        if(data.error == 0){
                            if (parasOnLink.filter && parasOnLink.filter != 0) {
                                UpdateListCar();
                            }
                            else {
                                $('#'+carId + ' .show-car-item').addClass('hidden');
                                $('#'+carId + ' .hidden-car-item').removeClass('hidden');
                                load_hide();
                                showMessage('Successfully', 0);
                            }
                            //$('#'+carId).
                        } else {
                            showMessage(data.msg, 1);
                            load_hide();
                        }
                    },'json');
                }
            });
        });
        
        $(document).on('click', '.btn-unhide-car', function () {
            carId = $(this).attr('data-car-id');
            item = $(this);
            jConfirm('Are you sure want to show this car?','Message',function(r) {
                if(r){
                    load_show();
                    $.post(root + 'cars/setDisplayCar',{car_id:carId, type:1},function(data){
                        if(data.error == 0){
                            if (parasOnLink.filter && parasOnLink.filter != 0) {
                                UpdateListCar();
                            }
                            else {
                                $('#'+carId + ' .show-car-item').removeClass('hidden');
                                $('#'+carId + ' .hidden-car-item').addClass('hidden');

                                load_hide();
                                showMessage('Successfully', 0);
                            }
                        } else {
                            showMessage(data.msg, 1);
                            load_hide();
                        }
                    },'json');
                }
            });
        });
        function UpdateListCar() {
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
                if (countCar > 0 && $('.wg-car-list').length === 0) {
                    showMessage('Successfully', 0, function () {
                        curPage = (curPage < maxPage)? curPage : --curPage;
                        curPage = (curPage < 1)? 1 : curPage;
                        maxPage--;
                        loadHTMLAjax('my_stock', $.extend(parasOnLink, {page:curPage, ajax:1}), container = '#listCars');
                    });
                }
                else {
                    showMessage('Successfully', 0);
                }
                load_hide();
            });
        }
    });
</script>