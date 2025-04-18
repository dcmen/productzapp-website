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
    .setting-value{display: none;}
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
                <form id="offer_rules" method="post">
                    <div>
                        <div class="setting-item">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                <p>
                                    <i class="fa fa-times"></i>
                                    All cars added to Tender, will be hidden from general view, immediately after Tender is created and only released for view, after Tender is over if car has not been sold.
                                </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <input type="radio" id="set-hidden" name="set-option" checked="<?php echo (isset($option) && $option == 1 )? 'checked' : null ?>" />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="setting-item">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                <p>
                                    <i class="fa fa-eye"></i>
                                     All cars that are added to a Tender, will always be available for general view and offer by public. This will create Offers arriving on the same car from the Tender as well as from the public.
                                </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <input type="radio" id="set-display" name="set-option" checked="<?php echo (isset($option) && $option == 2 )? 'checked' : null ?>" />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="mg-bottom-50"></div>
</div>

<script>
    $(document).ready(function (){
        option1 = <?php echo (isset($option) && $option  )? $option : null  ?>;
        console.log(option1);
        $('input:radio#set-hidden').click(function(){
                load_show();
                if ($('#set-hidden').not(':checked')){
                    $('#set-display').prop('checked',false);
                    var option = 1;
                    $('#set-hidden').prop('checked',true);
                    $.post('cars/save_setting_tender',{option:option},function(data){
                        if(data.error == 0){
                            showMessage('Successfully', 0);
                        }else{
                            showMessage('Failure', 1);
                        }
                    },'json');
                    load_hide();
                }
                else {
                    load_hide();
                }
            });
        $('input:radio#set-display').click(function(){
                load_show();
                if ($('#set-display').not('checked')) {
                    var option = 2;
                    $('#set-hidden').prop('checked',false);
                    $('#set-display').prop('checked',true);
                    $.post('cars/save_setting_tender',{option:option},function(data){
                        if(data.error == 0){
                            showMessage('Successfully', 0);
                        }else{
                            showMessage('Failure', 1);
                        }
                    },'json');
                    load_hide();
                }
                else {
                    load_hide();
                }
        });
    });
</script>