<div>
    <div class="flt-menu-bar">
        <div class="flt-menu-ridbon color-bg-site"></div>
        <div class="pd-content-05">
            <!--select view by-->
            <div class="pull-right flt-menu">
                <span class="flt-menu-txt">View By</span>
                <div class="btn-group mg-bottom-4">
                    <button class="flt-menu-content btn dropdown-toggle" data-toggle="dropdown">
                        <span>
                            <?php 
                            if ($type == 0) {
                                echo 'All Request';
                            }
                            else if ($type == 1) {
                                echo 'Request Received';
                            }
                            else if ($type == 2) {
                                echo 'Request Sent';
                            }     
                            ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php $paras['type'] = 0; echo $this->Common->createLink($paras, $this->request->here); ?>">All Request</a></li>
                        <li><a href="<?php $paras['type'] = 1; echo $this->Common->createLink($paras, $this->request->here); ?>">Request Received</a></li>
                        <li><a href="<?php $paras['type'] = 2; echo $this->Common->createLink($paras, $this->request->here); ?>">Request Sent</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="flt-menu pull-left">
                <a href="<?php echo $this->Html->Url('/mynetwork') ?>" class="color-black no-underline-hover"><i class="fa fa-angle-left font-size-17"></i> <span> BACK</span></a>
            </div>
        </div>
    </div>
</div>