<div class="main-page">
    
    <?php echo $this->element('cz_menu_bar_car4sale'); ?>
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-04">
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
<script type="text/javascript">
    Vcore.Flicka.Follow();
    $(document).ready(function () {
        $('.cz-pagination').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo (isset($page) && $page) ? $page : 1?>,
            maxVisible: 5
        }).on('page', function(event, num){
            parasOnLink.page = num;
            parasOnLink.ajax = 1;
            load_show();
            $.get("resultcarsforsale", parasOnLink , function(data) {
                $("#listCars").html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                load_hide();
            });
        });
    });
</script>