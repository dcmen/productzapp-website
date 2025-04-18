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
                                <i class="fa fa-money"></i>

                                <label style="margin-left:15px">
                                    Setting by price
                                </label>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <input type="checkbox" id="check-by-price" name="check-by" value="1" <?php echo ($this->Session->read('price_cheaper_type') && $this->Session->read('price_cheaper_type') == 1 )? 'checked' : null ?> />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="setting-item">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                <i class="fa fa-line-chart"></i>
                                <label style="margin-left:15px">Setting by percent</label>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <input type="checkbox" id="check-by-percent" name="check-by" <?php echo ($this->Session->read('price_cheaper_type') && $this->Session->read('price_cheaper_type') == 2 )? 'checked' : null ?> />
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
<div id="settingofferruleModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <div class="modal-dialog vdialog" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Don't allow price cheaper than</h4>
                </div>
                <div class="modal-body">
                    <form id="setrule" class="form-horizontal">
                        <div class="form-group" id="set-by-price">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 7px;">Price($)</label></div>
                            <div class="col-xs-12 col-md-9">
                                <input style="font-weight: bold;" class="form-control set-price"  name="setbyprice">
                            </div>
                        </div>
                        <div class="form-group" id="set-by-percent">
                            <div class="col-xs-12 col-md-3"><label style="font-weight: 500; margin-top: 7px;">Percent(%)</label></div>
                            <div class="col-xs-12 col-md-9">
                                <input style="font-weight: bold;" class="form-control set-percent"  name="setbypercent">
                            </div>
                        </div>
                        <div class="form-group" style="text-align: center; margin-top: 10px;">
                            <div class="col-xs-12">
                                <button id="btnsub" class="btn btn-view">Send</button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('input:checkbox#check-by-price').click(function(){
            load_show();
            if ($('#check-by-price').prop('checked')) {
                $('#set-by-percent').css('display','none');
                $('#set-by-price').css('display','block');
                //$('.setting-value-by-price').css('display','block');
                $('#check-by-percent').prop('checked',false);
                //$('.setting-value-by-percent').css('display','none');
                $('.set-percent').val('');
                $('#settingofferruleModal').modal('show');
                load_hide();

            }
            else {
                load_hide();
                }
            });
        $('input:checkbox#check-by-percent').click(function(){
            load_show();
            if ($('#check-by-percent').prop('checked')) {
                $('#set-by-price').css('display','none');
                $('#set-by-percent').css('display','block');
                //$('.setting-value-by-percent').css('display','block');
                $('#check-by-price').prop('checked',false);
                //$('.setting-value-by-price').css('display','none');
                $('.set-price').val('');
                $('#settingofferruleModal').modal('show');
                load_hide();

            }
            else {
                load_hide();
            }
        });
        var checked_price = <?php echo $this->Session->read('price_cheaper_type') && $this->Session->read('price_cheaper_type') == 1 ? $this->Session->read('price_cheaper_type') : 0 ?>;
        var checked_percent = <?php echo $this->Session->read('price_cheaper_type') && $this->Session->read('price_cheaper_type') == 2 ? $this->Session->read('price_cheaper_type') : 0 ?>;
        $('.close').click(function(){
            if( checked_price == 0 && checked_percent ==0){
                $('#check-by-price').prop('checked',false);
                $('#check-by-percent').prop('checked',false);
            }

        });
        $('#btnsub').click(function () {
            if (!$('input[name="setbyprice"]').val() && !$('input[name="setbypercent"]').val() ) {
                showMessage('Please enter a value', 1);
                return false;
            }
            if (!$.isNumeric($('input[name="setbyprice"]').val()) && !$.isNumeric($('input[name="setbypercent"]').val())) {
                showMessage('Value must be number', 1);
                return false;
            }
            if(  $('.set-price input[name="setbyprice"]').val() <= 0) {
                showMessage('Value must be heighter 0', 1);
                return false;
            }
            if(  $('input[name="setbypercent"]').val() < 0 || $('input[name="setbypercent"]').val() > 100 ){
                showMessage('Value must be from 0 to 100', 1);
                return false;
            }

            load_show();
            var f =  $('#setrule');
            $.post('cars/save_offer_rules',f.serialize(),function(data){
                load_hide();
                if(data.error == 0){
                    load_show();
                    //$("#ans").is(':checked') ? 1 : 0;
                    window.location.href = root + 'setting_make_offer';
                    showMessage('Set up offer rule successfully', 0);

                }else{
                    showMessage('Failure', 1);
                }
            },'json');
            return false;

        });
    });
</script>