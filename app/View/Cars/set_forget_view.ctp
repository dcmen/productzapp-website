<div class="main-page">
    
    <?php echo $this->element('cz_menu_bar_set4get_manage', ['set4getview' => 1]); ?> 
    
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <?php if (isset($manage_customers) && sizeof($manage_customers) > 0) : ?>
            <?php foreach($manage_customers as $dataSet4Get) {
                echo $this->element('cz_set4get_item', array('dataSet4Get' => $dataSet4Get));
            }?>
        <?php else : ?>
            <div class="mg-top-50 text-center font-size-24"><span>No car to display</span></div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    Vcore.Flicka.Follow();
    Vcore.Flicka.CarsforSale();
    Vcore.Flicka.Setforget();
</script>