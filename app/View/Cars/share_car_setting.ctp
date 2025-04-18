<style>
    .setting-header {
        padding: 15px 15px 15px 50px;
        position: relative;
        margin-bottom: 10px;
    }
    .setting-header > img {
        height: 30px;
        position: absolute;
        left: 10px;
    }
    .setting-item {
        margin-bottom: 8px;
    }
    /*toggle button*/
    .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 25px;
}
    .switch input {display:none;}
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
}
    .slider::before {
    position: absolute;
    content: "";
    height: 17px;
    width: 17px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
}
    input:checked + .slider {
        background-color: #2196F3;
    }
    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }
    input:checked + .slider:before {
        transform: translateX(25px);
    }
    .slider.round {
        border-radius: 34px;
    }
    .slider.round:before {
        border-radius: 50%;
    }
</style>

<div class="main-page">
    <div class="mg-bottom-25 clearfix"></div>
    
    <div class="pd-content-01">
        <div class="col-lg-12 mg-bottom-20">
            <div class="wg-box-shadow pd-content-07">
                <div>
                    <div class="setting-item">
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                            <span>Allow other dealers to share my cars by Posting to their networks.</span>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <input type="checkbox" name="share_cbox" <?php echo ($rs)? 'checked' : '' ?> />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    <div class="mg-bottom-50"></div>
</div>

<script>
    $(document).ready(function () {
        $('input[type="checkbox"]').change(function () {
            status_setting = ($(this).is(':checked'))? 1 : 0;
            
            load_show();
            $.post(root + 'cars/change_share_car_setting', {status_setting:status_setting},function(data){
                load_hide();
                if(data.error === 1){
                    showMessage('Failure !', 1);
                }
            },'json');
        });
    });
</script>