<?php $carName = (isset($data->cars) && (array)$data->cars != null)? trim($data->cars->manu_year.' '.$data->cars->make.' '.$data->cars->model.' '.$data->cars->series.' '.$data->cars->gearbox) : '' ?>

<div class="mg-bottom-20 car-post-item">
    <div class="wg-car-list">
        <!--User post info-->
        <div class="col-xs-12 form-group no-padding">
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 no-padding">
                <?php
                if ($data->type != 2) {
                    if (isset($data->avatar_file_name) && $data->avatar_file_name != '') {
                        echo '<img src="' . $data->avatar_file_name . '" class="pulse_avata">';
                    } else {
                        echo $this->Html->image('/images/profile.png', array('class' => 'pulse_avata'));
                    }
                } else {
                    if (isset($data->rss_info->url_image_company)) {
                        echo '<img src="' . $data->rss_info->url_image_company . '" class="pulse_avata">';
                    } else if (isset($data->avatar_file_name) && $data->avatar_file_name != '') {
                        echo '<img src="' . $data->avatar_file_name . '" class="pulse_avata">';
                    } else {
                        echo $this->Html->image('/images/profile.png', array('class' => 'pulse_avata'));
                    }
                }
                ?>
            </div>
            <div class="col-lg-11 col-md-11 col-sm-10 col-xs-10 no-padding-mb font-size-14">
                <?php if ($data->type != 2) : ?>
                    <a href="<?php echo $this->Html->Url('/pulse_user/' . $data->user_id) ?>"><?php echo (isset($data->full_name)) ? $data->full_name : '' ?> </a><br>
                    <?php echo (isset($data->company_name)) ? '<span>Company ' . $data->company_name . '</span>' : '' ?>
                <?php elseif (isset($data->rss_info->url_image_company)) : ?>
                    <a href="<?php echo $data->rss_info->link_company ?>"><?php echo $data->rss_info->title_company ?> </a><br>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <span class="post-time">
                <?php if ($data->type != 2 && $data->user_id && $data->user_id != CakeSession::read('Auth.User._id')) : ?>
                <a href="javascript:;" class="btn-post-report font-size-14 mg-right-8 dis-none-max-640" data-post-id="<?php echo $data->_id ?>" title="Report"><i class="fa fa-flag"></i></a>
                <?php endif; ?>
                <span><?php $date = str_replace('/', '-', $data->created_at); echo date('d/m/Y', strtotime($date)) ?></span>
            </span>
        </div>
        <div class="col-lg-12 no-padding" style="margin-bottom: 12px;">
            <div class="col-lg-12 showmore-container colapsed-content no-padding font-size-14 showmore-container-<?php echo $data->_id ?>">
                <div data-id="<?php echo $data->_id ?>" class="showmore-content">
                    <?php echo $data->content?>
                </div>
            </div>
            <div data-id="<?php echo $data->_id ?>" class="col-lg-12 group-btn-showmore no-padding">
                <div class="btn-showmore showmore">Show more</div>
                <div class="btn-showmore showless">Show less</div>
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="wg-car-img car-post-img">
            <!--car image-->
            <a href="<?php echo (isset($data->rss_info->link_to_article))? $data->rss_info->link_to_article : $this->Html->Url('/pulse_detail/'.$data->_id)?>" style="display: block; width: 100%; height: 100%;">
                <img style="display: block; width: 100%; height: 100%;" src="<?php echo (isset($data->image_url)  && $data->image_url) ? $data->image_url : $this->webroot . 'images/no_car.png' ?>" onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">
            </a>
        </div>
        <div class="wg-car-info-box" style="position: static !important; margin: 5px 25px 0 260px;">
            <div class="wg-car-info mystock" style="height: 100%;">
                <div class=""><?php echo isset($carName)? $carName : '' ?></div>
            </div>
        </div>
        
        <div class="clearfix mg-bottom-50 dis-none-min-641"></div>
        
        <?php if ($data->type != 2 && $data->user_id && $data->user_id != CakeSession::read('Auth.User._id')) : ?>
        <a href="javascript:;" style="bottom: 25px;" class="btn-post-report font-size-14 mg-right-8 dis-none-min-641 pos-abs" data-post-id="<?php echo $data->_id ?>" title="Report"><i class="fa fa-flag"></i> Report</a>
        <?php endif; ?>
        
        <div class="car-post-btn">
            <?php if ($carName != '') : ?>
                <a style="width: 100%" class="btn-view-car-detail btn-share color-bg-btn-hover" href="<?php echo $this->Html->Url('/share/'.$data->cars->_id)?>" >SHARE<span class="fa fa-angle-right"></span></a>
            <?php else : ?>
                <a style="width: 100%" class="btn-view-car-detail  btn-share  color-bg-btn-hover" href="javascript:;" onclick="shareRSS('<?php echo $data->_id ?>')">SHARE<span class="fa fa-angle-right"></span></a>
            <?php endif; ?>
        </div>
    </div>
</div>