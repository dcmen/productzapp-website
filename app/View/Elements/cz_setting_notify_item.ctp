<div class="wg-box-shadow height-auto1" style="padding-bottom: 10px; height: 190px;">
    <div class="setting-header">
        <img src="<?php echo $this->webroot ?>images/<?php echo ++$index ?>.png"/>
        <span><?php echo $item->notification_name ?></span>
    </div>
    <div class="clearfix"></div>
    <div>
        <?php if ($item->is_show_menu_indicator) : ?>
        <div class="setting-item">
            <div class="col-lg-1"></div>
            <div class="col-lg-7">
                <span>Menu Indicator</span>
            </div>
            <div class="col-lg-4">
                <label class="switch">
                    <input name="menu_indicator" type="checkbox" data-type="0" data-notification-id="<?php echo $item->_id ?>" <?php echo ($item->settings->menu_indicator)? 'checked' : '' ?> >
                    <div class="slider round"></div>
                </label>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php endif; ?>
        
        <?php if ($item->is_show_popup) : ?>
        <div class="setting-item">
            <div class="col-lg-1"></div>
            <div class="col-lg-7">
                <span>Pop Up</span>
            </div>
            <div class="col-lg-4">
                <label class="switch">
                    <input name="pop_up" type="checkbox" data-type="1" data-notification-id="<?php echo $item->_id ?>" <?php echo ($item->settings->pop_up)? 'checked' : '' ?> >
                    <div class="slider round"></div>
                </label>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php endif; ?>
        
        <?php if ($item->is_show_notification_center) : ?>
        <div class="setting-item">
            <div class="col-lg-1"></div>
            <div class="col-lg-7">
                <span>Notification Center</span>
            </div>
            <div class="col-lg-4">
                <label class="switch">
                    <input name="notification_center" type="checkbox" data-type="2" data-notification-id="<?php echo $item->_id ?>" <?php echo ($item->settings->notification)? 'checked' : '' ?> >
                    <div class="slider round"></div>
                </label>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
</div>