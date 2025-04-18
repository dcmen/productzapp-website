<div class="panel">
    <div class="panel-body">
        <div id="AdminPulse" class="col-md-8">
            <?php echo $this->Form->create('AddPulse',array('type' => 'file','class'=>'form-horizontal','role'=>'form')); ?>
                <div class="content_pulse">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3">Share to</div>
                            <div class="col-xs-12 col-md-9">
                                <select class="form-control" name="share_id" class="choose_share">
                                    <option value="2">Share to dealer(s)</option>
                                    <option value="0" selected="">Share to Pulse</option>
                                </select>
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
                                <div class="text-center">
                                    <div id="myCarousel" class="carousel slidecardetail" >
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active" id="abcd1">
                                                <?php echo $this->Html->image('/images/no_car.png',array('class'=>'img-responsive','width'=>'600px'))?>   
                                            </div>
                                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                <?php echo $this->Html->image('/images/prev2.png')?>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                <?php echo $this->Html->image('/images/next2.png')?>
                                            </a>
                                        </div>
                                        <div id="listfile">
                                            <div class="camera" id="c_1" style="z-index: 1;"><input name="file[]" type="file" id="file" multiple=true/></div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-offset-5">
                        <button type="submit" class="btn btn-view col-xs-12 col-md-2 submit_pulse" style="margin-right: 5px">Share</button>
                        <button type="button" class="clear_text btn btn-view col-xs-12 col-md-2">Reset</button>
                        <input type="hidden" name="is_share_dealers" value="">
                    </div>
                </div>    

                <div class="list_dealer" style="display: none">
                    
                </div>
            
            <?php echo $this->Form->end(); ?>
        </div>    
    </div>
</div>
<script type="text/javascript">
    var abc = 1; 
    function change_limit(){
        var limit = $("#CarLimit").val();
        $.get( root + 'admin_load_user?limit='+limit, function( data ) {
            $(".list_dealer" ).html( data );  
        });
    }
    $(document).on('click','.searchuser',function(){
        var keyword = $(".form_search input[name='keyword']").val();
        $.get( root + 'admin_load_user?key='+keyword, function( data ) {
            $(".list_dealer" ).html( data );  
        });
    })
    
    $(document).on('click','.reset_text',function(){
        $(".form_search input[name='keyword']").val('');
        $.get( root + 'admin_load_user', function( data ) {
            $(".list_dealer" ).html( data );  
        });
    })
    
    $(document).on('click','.number_id',function(){
        $("#btn_submit_last_step").removeAttr("disabled");
        var member_str  = $("input[name='is_share_dealers']").val();
        member_id = ','+$(this).val();
        if($(this).is(':checked')){
            if(member_str.indexOf(member_id) < 0){
                member_str +=member_id;
            }
            $("input[name='is_share_dealers']").val(member_str);
        }else{
            var myNewString = member_str.replace(member_id,'');
            $("input[name='is_share_dealers']").val(myNewString);
        }
        if($("input[name='is_share_dealers']").val() == ''){
            $("#btn_submit_last_step").prop("disabled","disabled");
        }
        $.post( root + 'admin_load_user',{'member_id' : $("input[name='is_share_dealers']").val()}, function( data ) {})
        
    })
   $(document).ready(function() {
       $("input[name='is_share_dealers']").val('');
       $('.pagecars').bootpag({
            total: <?php echo $maxpages?>,
            page: 1,
            maxVisible: 5
        }).on('page', function(event, num){
            var dataString = {
                key: '<?php echo $key?>',
                page: num
            };
            $.get( root + 'admin_load_user',dataString, function( data ) {
                $(".list_dealer" ).html( data );  
            });
        });
        $('#AddPulseAdminAddPulseForm').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                content: {
                    validators: {
                        notEmpty: {
                            message: 'The content is required and can\'t be empty'
                        }
                    }
                },
                'file[]': {
                        validators: {
                            notEmpty: {
                                message: "Please upload at least an image!"
                            }
                        }
                    }
            }
        }).on('success.form.bv', function (event) {
            event.preventDefault();
            var share_id = $("select[name='share_id']").val();
            if( (share_id == 0 && ($(".list_dealer").css('display') == 'none')) || ($(".list_dealer").css('display') == 'block')){
                if(($(".list_dealer").css('display') == 'block')){
                    if( $("input[name='is_share_dealers']").val() == ''){
                        $("#empty_leader").html('Please check choice user');
                        return false;
                    }
                }
                var formData = new FormData($("#AddPulseAdminAddPulseForm")[0]);
                $.ajax({
                    url: $("#AddPulseAdminAddPulseForm").attr("action"),
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (data) {
                        if(data.error == 0){
                            jAlert('Added successfully','Messages');
                            window.location.href = root + 'admin_pulse';
                        }else{
                            jAlert('Added not successfully','Messages');
                        }    
                    }
                });
                
            }else{

                $("#AddPulseAdminAddPulseForm input[type='submit']").removeAttr('disabled');
                $.get( root + 'admin_load_user', function( data ) {
                    $(".list_dealer" ).html( data );  
                    $(".list_dealer").show();
                    $(".content_pulse").hide();
                });
            }
            return false;
        });
  
        
        $('body').on('change', '#file', function() {
        if (this.files && this.files[0]) {
            $(".item").removeClass('active');
            abc += 1; 
            var z = abc - 1;
  
            var x = $(this).parent().find('#previewimg' + z).remove();
            $("#abcd" + z).before("<div id='abcd" + abc + "' class='item active' ><img id='previewimg" + abc + "' src=''/></div>");
            $("#listfile").append('<div class="camera" id="c_'+abc+'" style="z-index: '+abc+';"><input name="file[]" type="file" id="file" multiple=true/></div>');
            
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);

            $("#abcd" + abc).append($("<img/>", {
                class:'img_del',
                id: 'img_' + abc,
                src: root + 'app/webroot/images/delete.png'
            }).click(function() {
                $("#abcd" + z).addClass('active');
                $('#c_'+abc).remove();
                $("#img_"+abc).parent(this).remove();
                
                abc -= 1;
            }));
            
            $(".clear_text").click(function(){
                jConfirm('Are you sure you want to reset this form?<br />Choose <b>OK</b> Or <b>Cancel</b>','Messages',function(r) {
                    if(r){
                        $("input[name='subject']").val('');
                        $("textarea[name='content']").val('');
                        for(i=2; i<= abc; i++){
                           $('#abcd'+i).remove();
                           $('#c_'+i).remove();
                           $('#abcd1').addClass('active');
                        }
                        abc=1;
                    }
                }); 
            });
        }
    });
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    });
</script>
    