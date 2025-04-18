<div class="main-page">
    <?php // echo $this->element('cz_breadcrumb'); ?>
    <?php // echo $this->element('cz_title_page'); ?>
    
    <?php echo $this->element('cz_menu_bar_stock'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    <div class="pd-content-04">
        <div id="listCars">
            <div class="mg-bottom-40"></div>
            
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
    Vcore.Flicka.Follow();
    $(document).ready(function () {
        $('.cz-pagination').bootpag({
            total: <?php echo $maxpages?>,
            page: 1,
            maxVisible: 5
        }).on('page', function(event, num){
            parasOnLink.page = num;
            parasOnLink.ajax = 1;
            load_show();
            $.get("view_stock", parasOnLink , function(data) {
                $("#listCars").html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                load_hide();
            });
        });
    });
</script>