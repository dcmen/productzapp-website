<div class="main-page">
    <?php echo $this->element('cz_menu_bar_stock'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-04">
        <div id="listCars">
            <?php if ($list) : ?>
                <?php echo $this->element('cz_cars_list', array('list' => $list, 'view_type' => 2)); ?>
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
    var curPage = <?php echo $page?>;
    var maxPage = <?php echo $maxpages?>;
    var totalCars = <?php echo $total ?>;
    
    $(document).ready(function () {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'other_stock', container = '#listCars');
    });
</script>