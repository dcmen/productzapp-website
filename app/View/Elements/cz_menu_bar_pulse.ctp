<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-03">
            <!--select sort by-->
            <?php if (!isset($nofilter)) : ?>
            <div class="flt-menu pull-right">
                <span class="flt-menu-txt">Filter By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span>
                        <?php 
                        if($filter == 1){
                            echo 'Admin post';
                        }else if($filter == 2){
                            echo 'Posts';
                        }else if($filter == 3){
                            echo 'News';
                        }else {
                            echo 'All';
                        }
                        ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->Url('/pulse?type='.$type)?>">All</a></li>
                        <?php if($type == 'all') : ?>
                        <li><a href="<?php echo $this->Html->Url('/pulse?type='.$type.'&filter=1')?>">Admin post</a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo $this->Html->Url('/pulse?type='.$type.'&filter=2')?>">Posts</a></li>
                        <li><a href="<?php echo $this->Html->Url('/pulse?type='.$type.'&filter=3')?>">News</a></li>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="flt-menu pull-left">
                <span class="flt-menu-txt"><?php echo $total ?>  RESULT(S)</span>
            </div>
        </div>
    </div>
</div>