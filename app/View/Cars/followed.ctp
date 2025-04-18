<div class="main-page">
    <?php // echo $this->element('cz_breadcrumb'); ?>
    <?php // echo $this->element('cz_title_page'); ?>
    
    <?php echo $this->element('cz_menu_bar_follow'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div id="FollowPage" class="pd-content-04">
        <div id="listCars">
            <div class="mg-bottom-40"></div>
            
            <?php if ($list) : ?>
                <div class="dis-none-max-640">
                    <?php echo $this->element('cz_cars_list', array('list' => $list)); ?>
                </div>
                <div class="dis-block-max-640 dis-none-min-641">
                    <?php echo $this->element('cz_cars_grid', array('list' => $list)); ?>
                </div>
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
    
    Vcore.Flicka.Follow();
    Vcore.Flicka.Filter();
    
    $(document).ready(function () {
        initPagination(maxPage, curPage, maxVisible = 5, url = 'followed', container = '#listCars');
    });
</script>