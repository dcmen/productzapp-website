<div class="mg-bottom-40"></div>

<?php if ($list) : ?>
    <?php echo $this->element('cz_cars_list', array('list' => $list, 'view_type' => 1)); ?>
<?php else : ?>
    <div class="mg-top-50 text-center font-size-24"><span>No car to display</span></div>
<?php endif; ?>

<script>
    // update data
    curPage = <?php echo $page?>;
    maxPage = <?php echo $maxpages?>;
    totalCars = <?php echo $total ?>;
    
    // update number cars in menubar
    $('.count-car').text(totalCars);
    
    // update pagination
    updatePagination(maxPage, curPage, maxVisible = 5, url = 'my_stock', container = '#listCars');
</script>