<div class="main-page test">
    <div class="mg-bottom-25 clearfix"></div>

    <div id="SharePage" class="pd-content-01">
        <div class="col-lg-12">
            <div class="wg-box-shadow data-content" style="padding: 30px 20px 40px;">
                <div id="ShareCar" class="col-lg-10 col-lg-offset-1 col-xs-12">
                    <div>
                        <div class="title_car" style="margin-bottom: 0">
                            You want to share this car: <?php echo $car->manu_year . ' ' . $car->make . ' ' . $car->model . ' ' . $car->series . ' ' . $car->gearbox ?>
                        </div>
                        <div class="content_share">
                            <form id="Share" action="<?php echo $this->Html->Url('ajaxshare') ?>" method="post" class="form-horizontal">
                                <input type="hidden" name="share_id" value="<?php echo $id; ?>"/>
                                <input type="hidden" name="car_id" value="<?php echo $car->_id; ?>"/>
                                <input type="hidden" name="comments" value="User shared this car as a post."/>
                                <input type="hidden" name="is_custom_zooper" value="<?php echo isset($custom_zooper) && $custom_zooper ? 1 : null ; ?>"/>
                                <input type="hidden" name="type_share" value="0"/> <!--0 - share car; 1 - share rss-->
                                <div class="content_pulse">
                                    <div class="col-xs-12">
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
                                    </div>
                                    <div class="col-xs-12 dealer-container" style="display: none">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-md-3">Dealer(s)</div>
                                            <div class="col-xs-12 col-md-9">
                                                <?php if (sizeof($dealers) > 0 && $dealers) : ?>
                                                    <div class="content-item">
                                                        <?php foreach ($dealers as $data) : ?>
                                                            <?php if (isset($data->_id) && $data->_id != '') : ?>
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
                                    </div>
                                    <div class="col-xs-12 group-container" style="display: none">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-md-3">Group(s)</div>
                                            <div class="col-xs-12 col-md-9">
                                                <?php if (sizeof($groups) > 0) : ?>
                                                    <div class="content-item">
                                                        <?php foreach ($groups as $data) : ?>
                                                            <?php if (isset($data->_id) && $data->_id != '') : ?>
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
                                    </div>
                                    <div class="col-xs-12 hidden">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-md-3">Subject</div>
                                            <div class="col-xs-12 col-md-9">
                                                <input type="text" name="subject" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-md-3">Content</div>
                                            <div class="col-xs-12 col-md-9">
                                                <textarea name="content" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-md-3">Image</div>
                                            <div class="col-xs-12 col-md-9">
                                                <div id="myCarousel" class="carousel slidecardetail">
                                                    <ol class="carousel-indicators">
                                                        <?php for ($i = 0; $i < sizeof($images); $i++) { ?>
                                                            <li data-target="#myCarousel" data-slide-to="<?php echo $i ?>" <?php echo ($i == 0) ? 'class="active"' : ''; ?>></li>
                                                        <?php } ?>
                                                    </ol>
                                                    <div class="carousel-inner" role="listbox">
                                                        <?php
                                                        if ($images) {
                                                            for ($j = 0; $j < sizeof($images); $j++) {
                                                                ?>
                                                                <div class="item <?php echo ($j == 0) ? 'active' : '' ?>">
                                                                    <?php if ($images[$j]->image_file_name != '') { ?>
                                                                        <img style="width:600px" class="img-responsive" src="<?php echo (isset($images[$j]->image_file_name)  && $images[$j]->image_file_name) ?$images[$j]->image_file_name : $this->webroot . 'images/no_car.png' ?>"onError="this.onerror=null;this.src='<?php echo $this->webroot;?>images/no_car.png';">

<!--                                                                        <img src="--><?php //echo $images[$j]->image_file_name ?><!--" class="img-responsive img-cover"  style="width:600px">-->
                                                                    <?php } ?>
                                                                </div>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo $this->Html->image('/images/no_car.png', array('class' => 'img-responsive img-cover', 'width' => '600'));
                                                        }
                                                        ?>
                                                    </div>
                                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                        <?php echo $this->Html->image('/images/prev2.png') ?>
                                                    </a>
                                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                        <?php echo $this->Html->image('/images/next2.png') ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mg-top-10">
                                        <button type="submit" class="btn-search-submit kb-btn-02 color-bg-site pull-right submit_pulse"> SHARE <span class="fa fa-angle-right"></span></button>
                                        <button type="button" class="btn-search-submit kb-btn-02 color-bg-site pull-right clear_text" style="margin-right: 15px;"> RESET <span class="fa fa-angle-right"></span></button>
                                    </div>
    <!--                                <div class="col-xs-12 col-lg-offset-5 text-center">
                                        <button type="submit" class="btn btn-view col-xs-12 col-md-2 submit_pulse" style="margin-right: 5px"><i class="fa fa-share-alt"></i> Share</button>
                                        <button type="button" class="clear_text btn btn-view col-xs-12 col-md-2">Reset</button>
                                    </div>-->
                                </div>
                            </form>
                        </div>    
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>    
        </div>
    </div>
</div>
<input type="hidden" name="link" value="<?php echo $this->request->here() ?>">

<script type="text/javascript">
    $(document).on('click', '.back_pulse', function () {
        $("#AddPulseAdminAddPulseForm input[type='submit']").removeAttr('disabled');
        $(".list_dealer").hide();
        $(".content_pulse").show();
    });
    function change_limit() {
        var limit = $("#CarLimit").val();
        type_share = $("input[name='type_share']").val();
        if (type_share == 2) {
            $.get(root + 'loadmynetwork?limit=' + limit, function (data) {
                $(".list_dealer").html(data);
            });
        } else if (type_share == 3) {
            $.get(root + 'loadmygroups?limit=' + limit, function (data) {
                $(".list_dealer").html(data);
            });
        }
    }
    $(document).on('click', '.searchuser', function () {
        var keyword = $(".form_search input[name='keyword']").val();
        type_share = $("input[name='type_share']").val();
        if (type_share == 2) {
            $.get(root + 'loadmynetwork?key=' + keyword, function (data) {
                $(".list_dealer").html(data);
            });
        } else if (type_share == 3) {
            $.get(root + 'loadmygroups?key=' + keyword, function (data) {
                $(".list_dealer").html(data);
            });
        }
    });
    $(document).on('click', '.reset_text', function () {
        $(".form_search input[name='keyword']").val('');
        type_share = $("input[name='type_share']").val();
        if (type_share == 2) {
            $.get(root + 'loadmynetwork', function (data) {
                $(".list_dealer").html(data);
            });
        } else if (type_share == 3) {
            $.get(root + 'loadmygroups', function (data) {
                $(".list_dealer").html(data);
            });
        }
    });
    $(document).on('click', '.number_id', function () {
        $("#btn_submit_last_step").removeAttr("disabled");
        var member_str = $("input[name='is_share_dealers']").val();
        member_id = ',' + $(this).val();
        if ($(this).is(':checked')) {
            if (member_str.indexOf(member_id) < 0) {
                member_str += member_id;
            }
            $("input[name='is_share_dealers']").val(member_str);
        } else {
            var myNewString = member_str.replace(member_id, '');
            $("input[name='is_share_dealers']").val(myNewString);
        }
        if ($("input[name='is_share_dealers']").val() == '') {
            $("#btn_submit_last_step").prop("disabled", "disabled");
        }
        $.post(root + 'admin_load_user', {'member_id': $("input[name='is_share_dealers']").val()}, function (data) {});

    });
    $(document).ready(function () {
        $("input[name='is_share_dealers']").val('');

        $('#Share').formValidation({
            message: 'This value is not valid',
            fields: {
                content: {
                    validators: {
                        notEmpty: {
                            message: 'The content is required and can\'t be empty'
                        }
                    }
                },
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var type = $("select[name='type']").val();

            // validate
            if (type == 2 && $('input[name="dealer[]"]:checked').length <= 0) {
                showMessage('No dealer has checked', 1);
                $("#Share").formValidation('updateStatus', 'content', 'NOT_VALIDATED');
                return false;
            }
            if (type == 3 && $('input[name="group[]"]:checked').length <= 0) {
                showMessage('No group has checked', 1);
                $("#Share").formValidation('updateStatus', 'content', 'NOT_VALIDATED');
                return false;
            }

            var $form = $(e.target);

            load_show();
            $.post($('#Share').attr('action'), $form.serialize(), function (data) {
                load_hide();
                if (data.error == 0) {
                    jConfirm('Your post has been shared to News & Posts. Do you want to view post on News & Posts?', 'Carzapp', function (r) {
                        if (r) {
                            window.location.href = root + 'pulse';
                        }
                    });
                    $('.cancel').hide();
                } else {
                    showMessage('Failure', 1);
                }
            }, 'json');
            var isCustomZooper = $('#Share input[name="is_custom_zooper"]').val();
            var comments = $('#Share input[name="comments"]').val();

            carId = $('input[name="car_id"]').val();
            if(isCustomZooper){
                console.log(comments);
                $.post(root + 'cars/ajaxsendmailattachfileadf', {car_id:carId,comments:comments},function(data){
                    if(data.error == 0){
                        $('#MakeOfferModal').modal('hide');
                        showMessage('Email sent successfully', 0);
                    }else{
                        showMessage('Failure', 1);
                    }
                },'json');
            }
        });

        $('.choose_share').change(function () {
            type = $(this).val();
            if (type == 1) {
                $('.dealer-container').hide();
                $('.group-container').hide();
            } else if (type == 2) {
                $('.dealer-container').show();
                $('.group-container').hide();
            } else if (type == 3) {
                $('.dealer-container').hide();
                $('.group-container').show();
            }
        });

        $(".clear_text").click(function () {
            $("#Share").trigger('reset');

            $('.dealer-container').hide();
            $('.group-container').hide();

            $("#Share").formValidation('updateStatus', 'content', 'NOT_VALIDATED');
        });
    });
</script>
