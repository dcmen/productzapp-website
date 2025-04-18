<style>
    /*showmore*/
    .showmore-container {
        overflow-y: hidden;
        transition: height ease 1000ms;
        margin-bottom: 5px;
    }
    .showmore-container.colapsed-content {
        max-height: 38px;
    }
    .showmore-container.expanded-content {
        height: auto;
    }
    .showmore-container + .group-btn-showmore > .btn-showmore {
        display: none;
    }
    .showmore-container.colapsed-content + .group-btn-showmore > .showmore, .showmore-container.expanded-content + .group-btn-showmore > .showless {
        display: block;
    }
    .btn-showmore {
        cursor: pointer;
    }
    /*End showmore*/
</style>

<div class="main-page">
    <?php echo $this->element('cz_menu_bar_pulse'); ?>
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-8">
            <div id="listCars">
                <?php if($list != '') : ?>
                    <?php
                    foreach ($list as $data) {
                        echo $this->element('cz_car_item_post', array('data' => $data));
                    }
                    ?>
                    <div class="clearfix mg-bottom-50"></div>
                <?php else : ?>
                    <div class="text-center font-size-24"><span>No data to display</span></div>
                <?php endif; ?>
            </div>

            <div class="mg-bottom-50 dis-none-max-640"></div>

            <?php if ($maxpages > 1) :  ?>
            <div class="cz-pagination"></div>
            <?php endif; ?>
        </div>
        
        <div class="col-lg-4 dis-none-max-640">
            <div class="wg-box-shadow" style="padding: 9px 20px 6px;">
                <div class="col-lg-12">
                    <header class="wg-info-header no-underline" style="padding-bottom: 0">
                        <div class="wg-name-ridbon color-bg-site"></div>
                        <h2 class="wg-name font-size-17 truncate">Recommended Cars</h2>
                    </header>
                </div>
                
                <div class="clearfix"></div>
            </div>
            
            <div class="clearfix mg-bottom-15"></div>
            
            <?php foreach ($cars as $car) : ?>
                <?php echo $this->element('cz_car_recommend_item', array('car' => $car)); ?>
                <div class="clearfix mg-bottom-15"></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div id="sharerssmodal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share</h4>
                </div>
                <div class="modal-body">
                    <form id="Share" action="<?php echo $this->Html->Url('ajaxshare')?>" method="post" class="form-horizontal">
                        <input id="RSSID" type="hidden" name="share_id" value=""/>
                        <input type="hidden" name="type_share" value="1"/> <!--0 - share car; 1 - share rss-->
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Share to</div>
                            <div class="col-xs-12 col-md-9">
                                <select class="form-control choose_share" name="type">
                                    <option value="2">Share to dealer(s)</option>
                                    <option value="3">Share to group(s)</option>
                                    <option value="1" selected>Share to my network</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group dealer-container" style="display: none">
                            <div class="col-xs-12 col-md-3">Dealer(s)</div>
                            <div class="col-xs-12 col-md-9">
                                <?php if (sizeof($dealers) > 0) : ?>
                                <div class="content-item">
                                    <?php foreach ($dealers as $data) : ?>
                                        <?php if (isset($data->_id) && $data->_id != '') :?>
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="dealer[]" value="<?php echo $data->_id ?>">
                                                    <?php echo $data->name ?>
                                                </label>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </div>
                                <?php else : ?>
                                Don't have dealer to share
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group group-container" style="display: none">
                            <div class="col-xs-12 col-md-3">Group(s)</div>
                            <div class="col-xs-12 col-md-9">
                                <?php if (sizeof($groups) > 0) : ?>
                                <div class="content-item">
                                    <?php foreach ($groups as $data) : ?>
                                        <?php if (isset($data->_id) && $data->_id != '') :?>
                                            <div class="">
                                                <label>
                                                    <input type="checkbox" name="group[]" value="<?php echo $data->_id ?>">
                                                    <?php echo $data->name ?>
                                                </label>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </div>
                                <?php else : ?>
                                Don't have group to share
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: right; margin-top: 10px;">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-view">Share</button>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
   </div>
</div>

<script>
    function shareRSS(rssId) {
        $('#RSSID').val(rssId);
        $('#Share').trigger('reset');
        $('.dealer-container').hide();
        $('.group-container').hide();
        $('#sharerssmodal').modal('show');
    }
    
    function resetViewData() {
        $('.showmore-content').each(function(i, obj) {
            if ($(this).height() < 38) {
                itemId = $(this).attr('data-id');
                $('.showmore-container-' + itemId + ' + .group-btn-showmore').hide();
            }
        });
    }
    
    $(document).ready(function () {
        $('.cz-pagination').bootpag({
            total: <?php echo $maxpages?>,
            page: <?php echo $page ?>,
            maxVisible: 5
        }).on('page', function(event, num){
            parasOnLink.page = num;
            parasOnLink.ajax = 1;
            load_show();
            $.get(root+'pulse_user/' + '<?php echo isset($id)? $id : '' ?>', parasOnLink , function(data) {
                $("#listCars").html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                load_hide();
            });
        });
        
        $('.choose_share').change(function() {
            type = $(this).val();
            if (type == 1) {
                $('.dealer-container').hide();
                $('.group-container').hide();
            }
            else if (type == 2) {
                $('.dealer-container').show();
                $('.group-container').hide();
            }
            else if (type == 3) {
                $('.dealer-container').hide();
                $('.group-container').show();
            }
        });
        
        $('#Share').formValidation({
            framework: 'bootstrap',
            message: 'This value is not valid'
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var type = $("select[name='type']").val();

            // validate
            if (type == 2 && $('input[name="dealer[]"]:checked').length <= 0) {
                showMessage('No dealer has checked', 1);
                $("#Share").formValidation('updateStatus', 'subject', 'NOT_VALIDATED');
                return false;
            }
            if (type == 3  && $('input[name="group[]"]:checked').length <= 0) {
                showMessage('No group has checked', 1);
                $("#Share").formValidation('updateStatus', 'subject', 'NOT_VALIDATED');
                return false;
            }

            var $form = $(e.target);

            load_show();
            $.post($('#Share').attr('action'), $form.serialize(), function (data) {
                load_hide();
                if(data.error == 0){
                    $('#sharerssmodal').modal('hide');
                    showMessage('Your post has been shared to News & Posts', 0);
                    window.location.href = root + 'pulse';
                }else{
                    showMessage('Cannot share', 1);
                }
            },'json');
        });
        
        resetViewData();
    });
    
    $(document).on('click', '.btn-showmore', function() {
        itemId = $(this).closest('.group-btn-showmore').attr('data-id');
        container = $('.showmore-container-' + itemId);
        
        if ($(this).hasClass('showmore')) {
            container.removeClass('colapsed-content');
            container.addClass('expanded-content');
        }
        else {
            container.addClass('colapsed-content');
            container.removeClass('expanded-content');
        }
    });
</script>